<?php

include "./classBaseDeDatos.php";

session_start();

//echo($oBD->m_obtenerRegistro("SELECT * from usuario where Correo='".$_POST['Correo']."'AND Password='".$_POST['pwd']."'"));
$datoUsuario = $oBD->m_obtenerRegistro("SELECT * from usuario where Correo='" . $_POST['Correo'] . "'AND Password='" . $_POST['pwd'] . "'");

if ($oBD->a_error)
    header("location: index.php?e=3");
else
if ($oBD->a_numRegistros == 1) {
    $_SESSION['Correo'] = $_POST['Correo'];
    $_SESSION['Nombre'] = $datoUsuario->Nombre;
    $_SESSION['Apellido'] = $datoUsuario->Apellido;
    $_SESSION['Genero'] = $datoUsuario->Genero;
    $_SESSION['Foto'] = $datoUsuario->Foto;
    $_SESSION['Password'] = $datoUsuario->Password;
    $_SESSION['Id'] = $datoUsuario->Id;
    
    $_SESSION['idRol'] = $datoUsuario->Id_Rol;
    $_SESSION['Correo'] = $_POST['Correo'];
    $_SESSION['Correo'] = $_POST['Correo'];
    $_SESSION['nombUsuario'] = $datoUsuario->Nombre . " " . $datoUsuario->Apellido;
    $_SESSION['rol'] = $datoUsuario->Id_Rol;

    $oBD->m_query("update Usuario set Fecha_Ultimo_Acceso='" . date("Y-m-d") . "',Accesos=(Accesos+1) where Correo='" . $_POST['Correo'] . "'");
    
    if($_SESSION['rol']==9)
        header("location: indexAdmin.php");
        else
        if($_SESSION['rol']==2)
        header("location: indexUser.php");
        else
        header("location: index.php?e=7");
        

        
    
} else {
    header("location: iniciarSesion.php?e=1");
}

function iniciarSesion()
{
}
