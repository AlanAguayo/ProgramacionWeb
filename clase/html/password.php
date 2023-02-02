<?php
session_start();

include "../recursos/funciones.php";
include "../recursos/barraNavegacion.php";
$cadena=captcha();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Pagina Alan</title>
  <link rel="stylesheet" href="../styles/style.css">
  <link rel="stylesheet" href="../styles/bootstrap.css">
</head>

<body>



  <div style="position:relative; left: 30%; width:40%;">
  <form action="registrarse.php?e=10" method="post">
    <fieldset>
      <div class="form-group">
        <label for="exampleInputEmail1" class="form-label mt-4">Correo</label>
        <input type="email" class="form-control" name="correo" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Correo" name="correo" required>
        <small id="emailHelp" class="form-text text-muted">No compartiremos tu correo a nadie.</small>
      </div>
      <br/>
        <div>
      <label style=" text-align: center; ">Cuanto es?</label>
      <input type="text" class="form-control" id="captcha" name="captcha" placeholder="<?php echo($cadena); ?>">
</div>
      <br/>
      <button type="submit" class="btn btn-success"  >Recuperar</button>
      </fieldset>
  </form>
</div>

<?php
              

if (isset($_GET['e'])){
  echo '<div class = "container">
  <div class = "row mt-4">
  <div class = "col-4">';

switch($_GET['e']){
  case 1:echo '<span class="btn btn-warning">Hubo un 
  error en los datos</span>';
  break;
  case 2:echo '<span class="btn btn-success">Ingresa el captcha</span>';
  break;
  case 3:echo '<span class="btn btn-success">Ingresa el correo</span>';
  break;
  
}

}
?>

</body>

</html>