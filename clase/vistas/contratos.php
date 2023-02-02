<?php
include "../recursos/classContratos.php";

if (isset($_GET['e']))
    switch ($_GET['e']) {

        case 1:
            include "../recursos/barraNavegacionUser.php";
            break;
        case 99:
            include "../recursos/barraNavegacionAdmin.php";
            break;
        default:
    }

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
        echo $oContratos->ejecutar($_REQUEST["accion"]);
    else
        echo $oContratos->ejecutar("list");
    ?>

</body>

</html>