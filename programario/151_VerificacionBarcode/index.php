//Entregado
<?php
$entrada = trim(fgets(STDIN));
$eRegular = '/^([0-9]+)$/';
$inicio = true;
while ($entrada != 0) {
    $estado = 'INCORRECTO';
    $tipoValidacion = ' PAR';
    $parte1 = 0;
    $parte2 = 0;

    if ($inicio)
        $inicio = false;
    else
        $entrada = trim(fgets(STDIN));
    if (preg_match($eRegular, $entrada)) {
        $arregloEntrada = str_split($entrada);
        if (count($arregloEntrada) % 2 != 0)
            $tipoValidacion = ' IMPAR';
        if (count($arregloEntrada) >= 4) {
            if ($arregloEntrada[0] != $arregloEntrada[count($arregloEntrada) - 1]) {
                if ($tipoValidacion == ' IMPAR') {
                    $resultado = ($arregloEntrada[0] * $arregloEntrada[count($arregloEntrada) - 1]) % (abs($arregloEntrada[0] - $arregloEntrada[count($arregloEntrada) - 1]));
                    if ($resultado == $arregloEntrada[intVal((count($arregloEntrada) + 0.1) / 2)])
                        $estado = 'CORRECTO';
                } else {
                    for ($i = 0; $i < count($arregloEntrada); $i++) {
                        if ($i < (count($arregloEntrada) / 2))
                            $parte1 += $arregloEntrada[$i];
                        else
                            $parte2 += $arregloEntrada[$i];
                    }
                    $resultado = $parte1 & $parte2;

                    if ($resultado % 2 != 0)
                        $estado = 'CORRECTO';
                }
            }
        }
    }

    if ($entrada == 0)
        $mensaje = '';
    else
        $mensaje = ($estado . $tipoValidacion) . PHP_EOL;
    echo $mensaje;
}
