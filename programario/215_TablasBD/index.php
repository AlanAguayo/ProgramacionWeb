//Entregado
<?php

fscanf(STDIN, "%s", $server);
fscanf(STDIN, "%s", $user);
fscanf(STDIN, "%s", $pass);
fscanf(STDIN, "%s", $bd);
/*
$server = 'localhost';
$user = 'alan';
$pass = '3312';
$bd = 'domino';
*/

$conexion = mysqli_connect($server, $user, $pass, $bd);

$consulta = "show tables";
$registros = mysqli_query($conexion, $consulta);
$columnas = mysqli_num_rows($registros);

for ($i = 0; $i < $columnas; $i++) {
    $resul = mysqli_fetch_array($registros);
    $tablas[$i] = $resul['Tables_in_' . $bd];
}

rsort($tablas);

for ($i = 0; $i < $columnas; $i++) {
    if ($i == 0)
        $mensaje = $tablas[$i];
    else
        $mensaje .= ':' . $tablas[$i];
}

echo ($mensaje) . PHP_EOL;

mysqli_close($conexion);
