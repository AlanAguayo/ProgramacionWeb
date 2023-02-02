//Entregado
<?php
$line = trim(fgets(STDIN));
for ($i = 0; $i < $line; $i++) {
    $entrada = trim(fgets(STDIN));
    $entradaSeparada = explode(" ", $entrada);
    $mensaje = '';
    $nDespacho = 1;
    if (count($entradaSeparada) > 1) {
        $pildoras = $entradaSeparada[1];
        $despachos=separarCasos($entradaSeparada);
        for ($j = 1; $j < count($entradaSeparada); $j++) {
            if ($j != 1)
                $pildoras += $despachos[$j];
            if ($pildoras >= 100) {
                $mensaje .= $nDespacho.' ';
                $nDespacho = 1;
                $pildoras -= 100;
            } else {
                $nDespacho++;
            }
        }
    }
    echo $mensaje . PHP_EOL;
}

function separarCasos($cadena){
    for($j = 1; $j < count($cadena); $j++){
        $casos[$j] = $cadena[$j];
    }
    return $casos;
}

?>