<?php
$line = trim(fgets(STDIN));
for ($i = 0; $i < $line; $i++) {
    $entrada = trim(fgets(STDIN));
    $entradaSeparada = explode(":", $entrada);
    $mensaje = '';
    $n1 = 0;
    $parte1 = 0;
    $parte2 = 0;
    $valorFinal;
    $resultado = '';

    $ascci = asignarAscci($entradaSeparada);
    $valorFinal = valorFinal($ascci);

    $repeticiones = array_count_values($valorFinal);
    $repeticionesTotal = 0;

    foreach ($repeticiones as $repeticion) {
        $repeticionesTotal += $repeticion-1;
    }

    $resultado = intval(($repeticionesTotal / count($valorFinal)) * 100);
    echo ($resultado . '%') . PHP_EOL;
}

function asignarAscci($entradaSeparada)
{
    for ($j = 0; $j < count($entradaSeparada); $j++) {
        $ascci[$j] = '';
        for ($k = 0; $k < strlen($entradaSeparada[$j]); $k++) {
            $ascci[$j] .= ord(substr($entradaSeparada[$j], $k));
        }
    }
    return $ascci;
}
function valorFinal($ascci)
{
    for ($j = 0; $j < count($ascci); $j++) {
        $n1 = strlen($ascci[$j]) / 2;
        $n1 = intval($n1);
        $parte1 = intval(substr($ascci[$j], 0, $n1));
        $parte2 = intval(substr($ascci[$j], $n1));
        $valorFinal[$j] = ($parte1 + $parte2) % count($ascci);
        $valores = array_count_values($valorFinal);
        echo $ascci[$j].PHP_EOL;
        echo $parte1.PHP_EOL;
        echo $parte2.PHP_EOL;
        echo $valorFinal[$j].PHP_EOL;
        echo '------------------'.PHP_EOL;
    }
    return $valorFinal;
}

//5
//PEDRO:ANA:ANGEL:LUIS:MIGUEL:MARIA:PATRICIA:PASCAL:BASIC:JAVA:C++:PHP
//sad:sa:As:BNJM:!1241245:we:a
//dsafasa:sada:Fa:vaA:VA:Das
//a:d:v:c:d:x:g:asd:dq:r
//W*!ÑD:s02fn0210wd1k:¡PDSQ?!¡S!L