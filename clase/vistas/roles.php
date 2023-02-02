<?php
include "../recursos/barraNavegacionAdmin.php";
include "../recursos/classRoles.php";

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
        echo $oRoles->ejecutar($_REQUEST["accion"]);

    else
        echo $oRoles->ejecutar("list");
    ?>

</body>

</html>