<?php
include "../recursos/barraNavegacionUser.php";
include "../recursos/classUsuarios.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>Pagina Alan</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/bootstrap.css">
    <link rel="stylesheet" href="../styles/jquery-confirm.css">
    <script src="../scripts/jquery-3.6.1.js"></script>
    <script src="../scripts/jquery-confirm.js"></script>
    <script src="../controllers/usuarios.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>

<body>

    <?php

    if (isset($_REQUEST["accion"]))
        echo $oUsuarios->ejecutar($_REQUEST["accion"]);
    else
        echo $oUsuarios->ejecutar("viewPerfil");
    ?>

</body>

</html>