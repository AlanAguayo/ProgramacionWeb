<?php
include "../recursos/barraNavegacionAdmin.php";
include "../recursos/classServicios.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>Pagina Alan</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/bootstrap.css">
</head>

<body>

    <?php

    if (isset($_REQUEST["accion"]))
        echo $oServicios->ejecutar($_REQUEST["accion"]);
    else
        echo $oServicios->ejecutar("list");
    ?>

</body>

</html>