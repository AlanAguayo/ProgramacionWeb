<?php
$prueba = true;
$bandera = true;
$mensaje = '';
$llaveP = '';
$llaveF = '';

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
    $consulta = "select * from information_schema.key_column_usage WHERE table_schema = '" . $bd . "' and TABLE_NAME='facturas' order by COLUMN_NAME;";
else
    $consulta = "select * from information_schema.key_column_usage WHERE table_schema = '" . $bd . "' and TABLE_NAME='BD_PagoServ_Facturas';";

$registros = mysqli_query($conexion, $consulta);
$columnas = mysqli_num_rows($registros);

for ($i = 0; $i < $columnas; $i++) {
    $resul = mysqli_fetch_array($registros);
    if ($resul['CONSTRAINT_NAME'] == 'PRIMARY') {
        if ($prueba)
            $consulta2 = "select * from information_schema.columns WHERE table_schema = '" . $bd . "' and TABLE_NAME='facturas' and COLUMN_NAME = '" . $resul['COLUMN_NAME'] . "' And TABLE_NAME = '" . $resul['TABLE_NAME'] . "' order by COLUMN_NAME;";
        else
            $consulta2 = "select * from information_schema.columns WHERE table_schema = '" . $bd . "' and TABLE_NAME='BD_PagoServ_Facturas' and COLUMN_NAME = '" . $resul['COLUMN_NAME'] . "' And TABLE_NAME = '" . $resul['TABLE_NAME'] . "' order by COLUMN_NAME;";

        $registros2 = mysqli_query($conexion, $consulta2);
        $resul2 = mysqli_fetch_array($registros2);
        $llaveP .= ('Nombre de llave primaria: ' . $resul['COLUMN_NAME'] . ' [' . $resul2['COLUMN_TYPE'] . ']') . PHP_EOL;
    }
    if (!empty($resul['REFERENCED_TABLE_NAME'])) {
        if ($prueba)
            $consulta2 = "select * from information_schema.columns WHERE table_schema = '" . $bd . "' and TABLE_NAME='facturas' and COLUMN_NAME = '" . $resul['COLUMN_NAME'] . "' And TABLE_NAME = '" . $resul['TABLE_NAME'] . "' order by COLUMN_NAME;";
        else
            $consulta2 = "select * from information_schema.columns WHERE table_schema = '" . $bd . "' and TABLE_NAME='BD_PagoServ_Facturas' and COLUMN_NAME = '" . $resul['COLUMN_NAME'] . "' And TABLE_NAME = '" . $resul['TABLE_NAME'] . "' order by COLUMN_NAME;";

        $registros2 = mysqli_query($conexion, $consulta2);
        $resul2 = mysqli_fetch_array($registros2);
        $llaveF .= ('Nombre:' . $resul['COLUMN_NAME'] . ' <=> Tabla Referenciada:' . $resul['REFERENCED_TABLE_NAME'] . ' <=> CampoForaneo:' . $resul['REFERENCED_COLUMN_NAME'] . ' <=> [' . $resul2['COLUMN_TYPE'] . ']') . PHP_EOL;
        //$llaveF .= ('Nombre:' . $resul['COLUMN_NAME'] . ' <=> '.$resul['TABLE_NAME'].':' . $resul['REFERENCED_TABLE_NAME'] . ' <=> CampoForaneo:' . $resul['REFERENCED_COLUMN_NAME'] . ' <=> [' . $resul2['COLUMN_TYPE'] . ']') . PHP_EOL;
    }
    /*Nombre de llave primaria: id [int(8)]
    Foraneas:
    Nombre:nombForanea1 <=> Tabla Referenciada:nombTablaForanea <=> CampoForaneo:nombCampo <=> [char(25)]
    Nombre:nombForanea2 <=> Tabla Referenciada:nombTablaForanea <=> CampoForaneo:nombCampo <=> [char(25)]
*/
}

$mensaje .= $llaveP;
$mensaje .= 'Foraneas:' . PHP_EOL;
$mensaje .= $llaveF;

echo $mensaje;

mysqli_close($conexion);
