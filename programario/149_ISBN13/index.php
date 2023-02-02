//Entregado
<?php
$line = trim(fgets(STDIN));
for ($i = 0; $i < $line; $i++) {
    $mensaje = 'INCORRECTO';
    $resultado = 0;
    $eRegular = '/^([0-9]+)$/';
    $operador = 1;
    $entrada = trim(fgets(STDIN));
    $nGuiones = substr_count($entrada, '-');
    $nEspacios = substr_count($entrada, ' ');
    $entradaFormateada = str_replace("-", '', $entrada);
    $entradaFormateada = str_replace(" ", '', $entradaFormateada);

    if (($nGuiones == 0 && $nEspacios == 0) || ($nGuiones == 4 && $nEspacios == 0) || ($nGuiones == 0 && $nEspacios == 4)) {
        if (preg_match($eRegular, $entradaFormateada)) {
            $arregloEntrada = str_split($entradaFormateada);
            for ($j = 0; $j < count($arregloEntrada) - 1; $j++) {
                $resultado += $arregloEntrada[$j] * $operador;
                if($operador==1)
                $operador=3;
                else
                $operador=1;
            }
            $resultado = $resultado % 10;
            if ($resultado == 0)
                $resultado = 0;
            else
                $resultado = 10 - $resultado;
            if ($resultado == substr($entradaFormateada, -1)) {
                $mensaje = 'CORRECTO';
            }
        }
    }

    echo $mensaje . PHP_EOL;
}
