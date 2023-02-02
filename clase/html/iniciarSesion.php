<?php
session_start();

include "../recursos/barraNavegacion.php";
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
  <form action="validar.php" method="post">
    <fieldset>
      <div class="form-group">
        <label for="exampleInputEmail1" class="form-label mt-4">Correo</label>
        <input type="email" class="form-control" name="Correo" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Correo" name="correo" required>
        <small id="emailHelp" class="form-text text-muted">No compartiremos tu correo a nadie.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1" class="form-label mt-4">Contrasena</label>
        <input type="password" name="pwd" class="form-control" id="exampleInputPassword1" placeholder="Contrasena" name="Password" required>
      </div>
      <br/>
      <fieldset class="form-group">
      <button type="submit" class="btn btn-success"  >Iniciar sesion</button>
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
  error en los datos de accceso</span>';
  break;
  case 2:echo '<span class="btn btn-success">Bienvenido</span>';
  break;
    case 3:echo '<span class="btn btn-warning">No haz iniciado sesion</span>';
  break;
}

}
?>

</body>

</html>