//Entregado
<?php

$prueba = false;
if ($prueba) {

    $server = 'localhost';
    $user = 'alan';
    $pass = '3312';
    $bd = 'domino';
} else {
    fscanf(STDIN, "%s", $server);
    fscanf(STDIN, "%s", $user);
    fscanf(STDIN, "%s", $pass);
    fscanf(STDIN, "%s", $bd);
}

$conexion = mysqli_connect($server, $user, $pass, $bd);

$mensaje = obtenerGanador($conexion);
echo imprimirConsulta($mensaje);


function obtenerGanador($conexion)
{
    $registros = mysqli_query($conexion, crearConsulta());

    $resul = mysqli_fetch_array($registros);

    mysqli_close($conexion);
    return $resul;
}

function imprimirConsulta($resul)
{
    $mensaje = $resul['nombreC'] . ' ' . $resul['puntosT'];
    return $mensaje;
}

function crearConsulta()
{

    $prueba = false;

    if ($prueba)
        $consulta = "SELECT concat(u.Nombre, ' ', u.Apellidos) as nombreC, SUM(j.puntos) as puntosT from juegos j
join usuarios u on u.Usuario = j.ganador
GROUP BY nombreC
ORDER BY puntosT DESC
LIMIT 1";

    else
        $consulta = "SELECT concat(u.Nombre, ' ', u.Apellidos) as nombreC, SUM(j.puntos) as puntosT from BD_Domino_Juegos j
    join Usuarios u on u.Usuario = j.ganador
    GROUP BY nombreC
    ORDER BY puntosT DESC
    LIMIT 1";

    return $consulta;
}
