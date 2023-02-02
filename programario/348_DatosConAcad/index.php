<?php
$bandera = true;
while ($bandera) {
    try {
        $entrada = trim(fgets(STDIN));

        if ($entrada == '')
            $bandera = false;


        $url = 'http://tigger.itc.mx/conacad/recursos/juez/acceConacad.php?fecha=' . $entrada;
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $datos = curl_exec($curl);
        curl_close($curl);

        $posicion = strpos($datos, '<!--begin::Amount-->') + 90;
        $cantidadTotal = explode("<", substr($datos, $posicion, 10));

        $posicion = strpos($datos, 'Women') + 71;
        $porcentajeMujeres = explode("%", substr($datos, $posicion, 10));

        $cantidadMujeres = intval(($porcentajeMujeres[0] * str_replace(',', '', $cantidadTotal[0])) / 100);

        $posicion = strpos($datos, 'Men<') + 69;
        $porcentajeHombres = explode("%", substr($datos, $posicion, 10));

        $cantidadHombres = intval(($porcentajeHombres[0] * str_replace(',', '', $cantidadTotal[0])) / 100);

        $posicion = strpos($datos, 'Others') + 72;
        $porcentajeOtros = explode("%", substr($datos, $posicion, 10));

        $cantidadOtros = intval(($porcentajeOtros[0] * str_replace(',', '', $cantidadTotal[0])) / 100);

        $posicion = strpos($datos, '0-7 hrs') + 148;
        $horasMVP1 = explode("<", substr($datos, $posicion, 10));

        $posicion = strpos($datos, '7-14 hrs') + 149;
        $horasMVP2 = explode("<", substr($datos, $posicion, 10));

        $posicion = strpos($datos, '14-20hrs') + 149;
        $horasMVP3 = explode("<", substr($datos, $posicion, 10));

        $posicion = strpos($datos, '20-24 hrs') + 150;
        $horasMVP4 = explode("<", substr($datos, $posicion, 10));

        $horasMVP = max($horasMVP1[0], $horasMVP2[0], $horasMVP3[0], $horasMVP4[0]);

        if ($horasMVP == $horasMVP1[0])
            $horario = '0-7 hrs';

        if ($horasMVP == $horasMVP2[0])
            $horario = '7-14 hrs';

        if ($horasMVP == $horasMVP3[0])
            $horario = '14-20hrs';

        if ($horasMVP == $horasMVP4[0])
            $horario = '20-24 hrs';

        $posicion = strpos($datos, '<!--begin::Users group-->') + 260;
        $usuarioMVP = explode("(", substr($datos, $posicion, 1000));
        $usuarioMVP = explode(')', $usuarioMVP[1]);

        $resp = $cantidadTotal[0] . ' ' . $cantidadMujeres . 'M ' . $cantidadHombres . 'H ' . $cantidadOtros . 'O ' . $horario . ' ' . $usuarioMVP[0];
        echo $resp . PHP_EOL;
    } catch (Exception $e) {
        $bandera = false;
    }
}
