<?php
    session_start();
    if(isset($_SESSION['Correo'])){
        echo("Bienvenido :".$_SESSION['Correo']);
    }else{
        header("location:iniciarSesion.php?e=3");
    }
?>