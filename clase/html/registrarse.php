<?
include "classBaseDeDatos.php";
include("../recursos/class.phpmailer.php");
include("../recursos/class.smtp.php");

session_start();

class Correo
{



  function registro()
  {
    $oBD2 = new classBaseDeDatos();

    $cadena = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789123456789";
    $numeC = strlen($cadena);
    $nuevPWD = "";
    for ($i = 0; $i < 8; $i++)
      $nuevPWD .= $cadena[rand() % $numeC];

    $cad = "insert into usuario set Nombre='" . $_POST['nombre'] . "', Apellido='" . $_POST['apellidos'] . "', Correo='" . $_POST['correo'] . "', Genero='" . $_POST['genero'] . "', Password = '" . $nuevPWD . "', Id_Rol = '" . $_POST['idRol'] . "'";

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = "smtp.gmail.com"; //mail.google
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Port = 465;     // set the SMTP port for the GMAIL server
    $mail->SMTPDebug  = 1;  // enables SMTP debug information (for testing)
    // 1 = errors and messages
    // 2 = messages only
    $mail->SMTPAuth = true;   //enable SMTP authentication

    $mail->Username =   "19030034@itcelaya.edu.mx"; // SMTP account username
    $mail->Password = "wjwpktghljhwgaza";  // SMTP account password

    $mail->From = "";
    $mail->FromName = "";
    $mail->Subject = "Registro completo";
    $mail->MsgHTML("<h1>BIENVENIDO " . $_POST['nombre'] . " " . $_POST['apellidos'] . "</h1><h2> tu clave de acceso es : " . $nuevPWD . "</h2>");
    $mail->AddAddress($_POST['correo']);
    //$mail->AddAddress("admin@admin.com");
    if (!$mail->Send())
      echo  "Error: " . $mail->ErrorInfo;
    else {
      $oBD2->m_query($cad);
      if ($oBD2->a_error)
        header("location: iniciarSesion.php?e=7");
      else
        header("location: iniciarSesion.php?e=2");
    }
  }

  function recuperarContrasena()
  {
    $oBD3 = new classBaseDeDatos();
    $cadena = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789123456789";
    $numeC = strlen($cadena);
    $nuevPWD = "";
    for ($i = 0; $i < 8; $i++)
      $nuevPWD .= $cadena[rand() % $numeC];

    $cad = "update usuario set Password='" . $nuevPWD . "'where Correo='" . $_POST['correo'] . "'";

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = "smtp.gmail.com"; //mail.google
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Port = 465;     // set the SMTP port for the GMAIL server
    $mail->SMTPDebug  = 1;  // enables SMTP debug information (for testing)
    // 1 = errors and messages
    // 2 = messages only
    $mail->SMTPAuth = true;   //enable SMTP authentication

    $mail->Username =   "19030034@itcelaya.edu.mx"; // SMTP account username
    $mail->Password = "wjwpktghljhwgaza";  // SMTP account password

    $mail->From = "";
    $mail->FromName = "";
    $mail->Subject = "Nueva Contraseña";
    $mail->MsgHTML("<h2> Tsu nueva clave de acceso es : " . $nuevPWD . "</h2>");
    $mail->AddAddress($_POST['correo']);
    //$mail->AddAddress("admin@admin.com");
    if (!$mail->Send())
      echo  "Error: " . $mail->ErrorInfo;
    else {
      $oBD3->m_query($cad);
      if ($oBD3->a_error)
        header("location: iniciarSesion.php?e=7");
      else
        header("location: iniciarSesion.php?e=2");
    }
  }


function registroAdmin()
{
  $oBD3 = new classBaseDeDatos();
  $cadena = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789123456789";
  $numeC = strlen($cadena);
  $nuevPWD = "";
  for ($i = 0; $i < 8; $i++)
    $nuevPWD .= $cadena[rand() % $numeC];

  $cad = "insert into usuario set Nombre='" . $_POST['nombre'] . "', Apellido='" . $_POST['apellido'] . "', Correo='" . $_POST['correo'] . "', Genero='" . $_POST['genero'] . "', Password = '" . $nuevPWD . "', Id_Rol = '" . $_POST['idRol'] . "'";

  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->Host = "smtp.gmail.com"; //mail.google
  $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
  $mail->Port = 465;     // set the SMTP port for the GMAIL server
  $mail->SMTPDebug  = 1;  // enables SMTP debug information (for testing)
  // 1 = errors and messages
  // 2 = messages only
  $mail->SMTPAuth = true;   //enable SMTP authentication

  $mail->Username =   "19030034@itcelaya.edu.mx"; // SMTP account username
  $mail->Password = "wjwpktghljhwgaza";  // SMTP account password

  $mail->From = "";
  $mail->FromName = "";
  $mail->Subject = "Nueva Contraseña";
  $mail->MsgHTML("<h2> Tu clave de acceso es : " . $nuevPWD . "</h2>");
  $mail->AddAddress($_POST['correo']);
  //$mail->AddAddress("admin@admin.com");
  if (!$mail->Send())
    echo  "Error: " . $mail->ErrorInfo;
  else {
    $oBD3->m_query($cad);
    if ($oBD3->a_error)
      header("location: ../vistas/usuarios.php");
    else
      header("location: ../vistas/usuarios.php");
  }
}

}

$oCorreo = new Correo();
switch ($_GET['e']) {
  case 10:
    if (isset($_POST['correo']))
      if ($_POST['captcha'] > "")
        if ($_SESSION['captcha'] == $_POST['captcha'])
          $oCorreo->recuperarContrasena();
        else
          header("location: password.php?e=1");
      else
        header("location: password.php?e=2");
    else
      header("location: password.php?e=3");


    break;
  case 11:


    if (isset($_POST['correo']))
      if ($_POST['captcha'] > "")
        if ($_SESSION['captcha'] == $_POST['captcha'])
          $oCorreo->registro();
        else
          header("location: registro.php?e=1");
      else
        header("location: registro.php?e=2");
    else
      header("location: registro.php?e=3");
    break;

    case 12:
      if (isset($_POST['correo']))
            $oCorreo->registroAdmin();
          else
            header("location: ../recursos/classUsuarios.php");
      break;
}
