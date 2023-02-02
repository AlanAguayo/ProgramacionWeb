<?php
$prueba = false;
$mensaje = '';

if ($prueba) {
    $server = 'localhost';
    $user = 'alan';
    $pass = '3312';
    $bd = 'pagoservicios';
} else {
    fscanf(STDIN, "%s", $server);
    fscanf(STDIN, "%s", $user);
    fscanf(STDIN, "%s", $pass);
    fscanf(STDIN, "%s", $bd);
}
$conexion = mysqli_connect($server, $user, $pass, $bd);

if ($prueba)
    $consulta = "SELECT s.Nombre, COALESCE(f.id,0) as facturas, round(COALESCE(sum(f.Monto),0),2) as montoT FROM facturas f right join servicios s on s.id = f.id_Servicio group by s.Nombre order by s.Nombre, montoT;";
else
    $consulta = "SELECT s.Nombre, COALESCE(f.id,0) as facturas, round(COALESCE(sum(f.Monto),0),2) as montoT FROM BD_PagoServ_Facturas f right join BD_PagoServ_Servicios s on s.id = f.id_Servicio group by s.Nombre order by s.Nombre, montoT;";

$registros = mysqli_query($conexion, $consulta);
$columnas = mysqli_num_rows($registros);

for ($i = 0; $i < $columnas; $i++) {
    $resul = mysqli_fetch_array($registros);
    $mensaje .= $resul['Nombre'] . ':' . $resul['facturas'] . ':$' . $resul['montoT'] . PHP_EOL;
}

echo ($mensaje);

mysqli_close($conexion);
