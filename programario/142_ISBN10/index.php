//Entregado
<?php
$line = trim(fgets(STDIN));
for ($i = 0; $i < $line; $i++) {
    $mensaje = 'INCORRECTO';
    $resultado = 0;
    $eRegular = '/^([0-9]+)$/';
    $entrada = trim(fgets(STDIN));
    $nGuiones = substr_count($entrada, '-');
    $nEspacios = substr_count($entrada, ' ');
    $entradaFormateada = str_replace("-", '', $entrada);
    $entradaFormateada = str_replace(" ", '', $entradaFormateada);

    if (($nGuiones == 0 && $nEspacios == 0) || ($nGuiones == 3 && $nEspacios == 0) || ($nGuiones == 0 && $nEspacios == 3)) {
        if (preg_match($eRegular, $entradaFormateada)) {
            $arregloEntrada = str_split($entradaFormateada);
            for ($j = 0; $j < count($arregloEntrada) - 1; $j++) {
                $resultado += $arregloEntrada[$j] * ($j + 1);
            }
            $resultado = $resultado % 11;
            if ($resultado == substr($entradaFormateada, -1)) {
                $mensaje = 'CORRECTO';
            }
        }
    }

    echo $mensaje . PHP_EOL;
}
?>