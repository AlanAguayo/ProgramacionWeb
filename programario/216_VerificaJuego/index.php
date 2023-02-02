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
$mensaje = '';
$bandera = true;

//$consulta = 'select j.id, j.id_usuario, id_invitado, j.secuencia from juegos j';
$consulta = 'select j.id, j.id_usuario, id_invitado, j.secuencia from BD_Domino_Juegos j';
$registros = mysqli_query($conexion, $consulta);
$columnas = mysqli_num_rows($registros);


for ($i = 0; $i < $columnas; $i++) {
    $bandera = true;
    $juego = mysqli_fetch_array($registros);
    $fichas = explode(" ", $juego['secuencia']);
    $mensaje = '';

    for ($j = 0; $j < count($fichas) && $bandera; $j++) {
        for ($k = 0; $k < count($fichas) && $bandera; $k++) {
            if ($j != $k) {
                if ($fichas[$j] == $fichas[$k] || $fichas[$j] == strrev($fichas[$k])) {
                    $consultaUser = "select concat(Nombre, ' ', Apellidos) as nombre_c from Usuarios where Usuario = '" . $juego['id_usuario'] . "'";
                    $registrosUser = mysqli_query($conexion, $consultaUser);
                    $userHost = mysqli_fetch_array($registrosUser);
                    $consultaUser = "select concat(Nombre, ' ', Apellidos) as nombre_c from Usuarios where Usuario = '" . $juego['id_invitado'] . "'";
                    $registrosUser = mysqli_query($conexion, $consultaUser);
                    $userInv = mysqli_fetch_array($registrosUser);
                    $mensaje = $juego['id'] . ':' . $userHost['nombre_c'] . ':' . $userInv['nombre_c'] . ':Ficha Duplicada';
                    $bandera = false;
                }
            }
        }
    }
    for ($j = 0; $j < count($fichas) - 1 && $bandera; $j++) {
        if (substr($fichas[$j], 2, 1) != substr($fichas[$j + 1], 0, 1)) {
            $consultaUser = "select concat(Nombre, ' ', Apellidos) as nombre_c from Usuarios where Usuario = '" . $juego['id_usuario'] . "'";
            $registrosUser = mysqli_query($conexion, $consultaUser);
            $userHost = mysqli_fetch_array($registrosUser);
            $consultaUser = "select concat(Nombre, ' ', Apellidos) as nombre_c from Usuarios where Usuario = '" . $juego['id_invitado'] . "'";
            $registrosUser = mysqli_query($conexion, $consultaUser);
            $userInv = mysqli_fetch_array($registrosUser);
            $mensaje = $juego['id'] . ':' . $userHost['nombre_c'] . ':' . $userInv['nombre_c'] . ':Secuencia Mal';
            $bandera = false;
        }
    }
    if ($mensaje != '')
        echo ($mensaje) . PHP_EOL;
}

mysqli_close($conexion);


/*
3:Jimena Perez Velarde:Juan Figueroa:Ficha Duplicada
8:Guadalupe Jimenez Z.:Miguel Duarte K.:Secuencia Mal
27: Felipe de Jesús Calderas Obrajuelo:Pedro Paramo López:Ficha Duplicada
*/