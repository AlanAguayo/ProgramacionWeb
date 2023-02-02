//Entregado
<?php
$prueba = false;
$mensaje = '';

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

if ($prueba)
    $consulta = "select concat(Nombre, ' ', Apellidos) as nombre_c, COUNT(id_usuario) as contador from Usuarios inner JOIN juegos on juegos.id_usuario=usuarios.Usuario group by nombre_c ORDER by contador desc, Apellidos ASC;";
else
    $consulta = "select concat(Nombre, ' ', Apellidos) as nombre_c, COUNT(id_usuario) as contador from Usuarios inner JOIN BD_Domino_Juegos j on j.id_usuario=Usuarios.Usuario group by nombre_c ORDER by contador desc, Apellidos ASC;";

$registros = mysqli_query($conexion, $consulta);
$columnas = mysqli_num_rows($registros);
$resul = mysqli_fetch_array($registros);
$mensaje .= 'Invita' . PHP_EOL;
$mensaje .= $resul['nombre_c'] . PHP_EOL;
$maximo = $resul['contador'];

if($columnas>0)
for ($i = 0; $i < $columnas-1; $i++) {
    $resul = mysqli_fetch_array($registros);
    if ($resul['contador'] == $maximo)
        $mensaje .= $resul['nombre_c'] . PHP_EOL;
}

if ($prueba)
    $consulta = "select concat(Nombre, ' ', Apellidos) as nombre_c, COUNT(id_invitado) as contador from Usuarios inner JOIN juegos on juegos.id_invitado=usuarios.Usuario group by nombre_c ORDER by contador desc, Apellidos ASC;";
else
    $consulta = "select concat(Nombre, ' ', Apellidos) as nombre_c, COUNT(id_invitado) as contador from Usuarios inner JOIN BD_Domino_Juegos j on j.id_invitado=Usuarios.Usuario group by nombre_c ORDER by contador desc, Apellidos ASC;";

$registros = mysqli_query($conexion, $consulta);
$columnas = mysqli_num_rows($registros);
$resul = mysqli_fetch_array($registros);
$mensaje .= 'Invitado' . PHP_EOL;
$mensaje .= $resul['nombre_c'] . PHP_EOL;
$maximo = $resul['contador'];

if($columnas>0)
for ($i = 0; $i < $columnas-1; $i++) {
    $resul = mysqli_fetch_array($registros);
    if ($resul['contador'] == $maximo)
        $mensaje .= $resul['nombre_c'] . PHP_EOL;
}

if ($mensaje != '')
    echo ($mensaje);

mysqli_close($conexion);
