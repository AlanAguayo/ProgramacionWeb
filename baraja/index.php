<?php
?>

<!DOCTYPE html>
<html>

<head>
    <title>Baraja</title>
    <script type="text/javascript">
        function carga() {
            posicion = 0;
            elMovimiento = null;

            // IE
            if (navigator.userAgent.indexOf("MSIE") >= 0 || navigator.userAgent.indexOf("Trident") >= 0) navegador = 0;
            // Otros
            else
                navegador = 1;
        }

        function evitaEventos(event) {
            // Funcion que evita que se ejecuten eventos adicionales

            event.preventDefault();
        }

        function comienzoMovimiento(event, id) {
            elMovimiento = document.getElementById(id);

            cursorComienzoX = event.clientX + window.scrollX;
            cursorComienzoY = event.clientY + window.scrollY;
            document.addEventListener("mousemove", enMovimiento, true);
            document.addEventListener("mouseup", finMovimiento, true);


            elComienzoX = parseInt(elMovimiento.style.left);
            elComienzoY = parseInt(elMovimiento.style.top);
            // Actualizo el posicion del elemento
            elMovimiento.style.zIndex = ++posicion;
            evitaEventos(event);
        }

        function enMovimiento(event) {
            var xActual, yActual;
            xActual = event.clientX + window.scrollX;
            yActual = event.clientY + window.scrollY;


            elMovimiento.style.left = (elComienzoX + xActual - cursorComienzoX) + "px";
            elMovimiento.style.top = (elComienzoY + yActual - cursorComienzoY) + "px";
            evitaEventos(event);
        }

        function finMovimiento(event) {
            document.removeEventListener("mousemove", enMovimiento, true);
            document.removeEventListener("mouseup", finMovimiento, true);
        }
    </script>
</head>

<body onload="carga();">

    <form method="post">
        <?php
        session_start();
        for ($i = 0; $i < 5; $i++) {
            if (!isset($_POST['c' . $i]))
                $mano[$i] = $i;
            else
                $mano[$i] = $_SESSION['c' . $i];
        }  

        if(isset($_SESSION['cartasFuera'])){
            //$cartasFuera = $_SESSION['cartasFuera'];
        }

        for ($i = 0; $i < 5; $i++) {
            if (!isset($_POST['c' . $i])) {
                $repite = false;
                $rand1 = rand(1, 13);
                $rand2 = substr(str_shuffle('TCDP'), 0, 1);
                $imagen = $rand1 . $rand2 . '.jpg';
                for ($j = 0; $j < 5; $j++) {
                    if(isset($cartasFuera))
                        if($mano[$j] == $imagen || in_array($mano[$j],$cartasFuera))
                        $repite = true;
                    else
                    if ($mano[$j] == $imagen)
                        $repite = true;
                }
                if (!$repite) {
                    $mano[$i] = $imagen;
                    $cartasFuera ['ajua']=0;
                    //array_push($cartasFuera,$mano[$i]);
                    $carta = '<div id="div' . $i . '" style="top:100px; width:112px; left:' . ($i + 1) . '00px; background-color:black; position:absolute; height:158px; " onmousedown="comienzoMovimiento(event, this.id);" onmouseover="this.style.cursor="move"">
    <img src="images/' . $mano[$i] . '">
    <input type ="checkbox" value = "Y" name="c' . $i . '">
</div>';

                    echo $carta;
                } else
                    $i--;
            } else
                $mano[$i] = $_SESSION['c' . $i];
            $carta = '<div id="div' . $i . '" style="top:100px; width:112px; left:' . ($i + 1) . '00px; background-color:black; position:absolute; height:158px; " onmousedown="comienzoMovimiento(event, this.id);" onmouseover="this.style.cursor="move"">
    <img src="images/' . $mano[$i] . '">
    <input type ="checkbox" value = "Y" name="c' . $i . '">
</div>';

            echo $carta;
        }

        for ($i = 0; $i < 5; $i++) {
            $_SESSION['c' . $i] = $mano[$i];
        }
        
        $_SESSION['cartasFuera'] = $cartasFuera;
        ?>

        <input name="enviar" id="enviar" type="submit" value="Enviar">
    </form>
</body>

</html>