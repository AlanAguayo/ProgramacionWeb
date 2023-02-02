//Entregado
<?php
$prueba = false;
$mensaje = '';

if ($prueba) {
    $server = 'localhost';
    $user = 'alan';
    $pass = '3312';
    $bd = 'elecciones';
} else {
    fscanf(STDIN, "%s", $server);
    fscanf(STDIN, "%s", $user);
    fscanf(STDIN, "%s", $pass);
    fscanf(STDIN, "%s", $bd);
}

$conexion = mysqli_connect($server, $user, $pass, $bd);

//primera parte
$consulta = "select concat(u.Nombre,' ', u.Apellidos) as nCandidato, p.Nombre as nPartido,
                            count(v.IdVoto) as votos 
                            from Usuarios u
                            join BD_Elecciones_Candidato c on u.Usuario = c.IdPersona
                            join BD_Elecciones_Partido p on p.IdPartido = c.IdPartido
                            join BD_Elecciones_Voto v on p.IdPartido = v.IdPartido
                            group by nCandidato 
                            order by votos desc limit 2;";

$registros = mysqli_query($conexion, $consulta);
$columnas = mysqli_num_rows($registros);

if ($columnas > 0) {
    $resul = mysqli_fetch_array($registros);
    $candidatoGanador = $resul['nCandidato'];
    $partidoGanador = $resul['nPartido'];
    $votosGanador = $resul['votos'];
    $resul = mysqli_fetch_array($registros);
    $candidatoPerdedor = $resul['nCandidato'];
    $votosPerdedor = $resul['votos'];
    $votosTotal = $votosGanador - $votosPerdedor;
    $mensaje = ('<b>' . $candidatoGanador . '</b> de ' . $partidoGanador . ' gano con ' . $votosTotal . ' votos a ' . $candidatoPerdedor . '.') . PHP_EOL;
}

//segunda parte
$consulta = "select p.nombre as nPartido
            from BD_Elecciones_Partido p
            left join BD_Elecciones_Voto v on v.IdPartido = p.IdPartido
            where COALESCE(v.IdPartido,0)=0;";
$registros = mysqli_query($conexion, $consulta);
$columnas = mysqli_num_rows($registros);

if ($columnas > 0) {

    for ($i = 0; $i < $columnas; $i++) {
        $resul = mysqli_fetch_array($registros);
        $mensaje .= $resul['nPartido'] . ', ';
    }
    $mensaje = (substr($mensaje, 0, -2) . ' Sin Votos.') . PHP_EOL;
}

//tercera parte
$consulta = "select p.nombre as nPartido
            from BD_Elecciones_Partido p
            left join BD_Elecciones_Candidato c on c.IdPartido = p.IdPartido
            where COALESCE(c.IdPartido,0)=0;";
$registros = mysqli_query($conexion, $consulta);
$columnas = mysqli_num_rows($registros);

if ($columnas > 0) {
    $mensaje .= '<i>';
    for ($i = 0; $i < $columnas; $i++) {
        $resul = mysqli_fetch_array($registros);
        $mensaje .= $resul['nPartido'] . ', ';
    }
    $mensaje = (substr($mensaje, 0, -2) . ' No tenian candidatos.</i>') . PHP_EOL;
}

//cuarta parte
$consulta = "select d.Nombre as nDistrito, count(v.IdDistrito) as votos 
            from BD_Elecciones_Distrito d
            join BD_Elecciones_Voto v on v.IdDistrito = d.IdDistrito
            group by nDistrito;";
$registros = mysqli_query($conexion, $consulta);
$columnas = mysqli_num_rows($registros);

if ($columnas > 0) {
    for ($i = 0; $i < $columnas; $i++) {
        $resul = mysqli_fetch_array($registros);
        $mensaje .= '<b>' . $resul['nDistrito'] . '</b> <u>' . $resul['votos'] . '</u> : ';
    }
    $mensaje = (substr($mensaje, 0, -2)) . PHP_EOL;
}

//quinta parte

$consulta = "select IdDistrito, Rango_Papeleta from BD_Elecciones_Distrito;";
$registros = mysqli_query($conexion, $consulta);
$columnas = mysqli_num_rows($registros);

if ($columnas) {
    for ($i = 0; $i < $columnas; $i++) {
        $resul = mysqli_fetch_array($registros);
        $limites = explode("-", $resul['Rango_Papeleta']);
        $limiteBajo[$i] = $limites[0];
        $limiteAlto[$i] = $limites[1];
        $distritos[$i] = $resul['IdDistrito'];
    }
}

if ($columnas > 0) {
    for ($i = 0; $i < $columnas; $i++) {
        $consulta = "select d.nombre as nDistrito, count(v.IdDistrito) as votos
                    from BD_Elecciones_Distrito d
                    join BD_Elecciones_Voto v on d.IdDistrito = v.IdDistrito
                    where d.IdDistrito = " . $distritos[$i] . 
                    " and (v.IdPapeleta < " . $limiteBajo[$i] . " or v.IdPapeleta > " . $limiteAlto[$i] . ")
                    group by 1;";
        $registros = mysqli_query($conexion, $consulta);

        $resul = mysqli_fetch_array($registros);
        if ($i % 2 == 0)
            $mensaje .= '<b>' . $resul['nDistrito'] . ' ' . $resul['votos'] . '</b> : ';
        else
            $mensaje .= '<i>' . $resul['nDistrito'] . ' ' . $resul['votos'] . '</i> : ';
    }
    $mensaje = (substr($mensaje, 0, -2)) . PHP_EOL;
}

if ($mensaje != '')
    echo ($mensaje);

mysqli_close($conexion);