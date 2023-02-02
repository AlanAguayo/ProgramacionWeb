<?php

session_start();
include "../recursos/barraNavegacion.php";
include "../recursos/funciones.php";
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
  
  <br/>
  <div style="position:relative; left: 30%; width:40%;">
  <form action="registrarse.php?e=11" method="post">
    <fieldset>
      <div class="form-group">
        <input type="text" class="form-control" id="exampleInputNombre" name="nombre" aria-describedby="nombre" placeholder="Nombre" required>
      </div>
      <br/>
      <div class="form-group">
        <input type="text" class="form-control" id="exampleInputApellido" name="apellidos" aria-describedby="apellido" placeholder="Apellido" required>
      </div>
      <br/>
      <div class="form-group">
        <input type="email" class="form-control" id="exampleInputEmail1" name="correo" aria-describedby="emailHelp" placeholder="Correo" required>
      </div>
      <br/>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="genero" id="optionsRadios1" value="M" checked="">
        <label class="form-check-label" for="optionsRadios1">
          Masculino
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="genero" id="optionsRadios2" value="F">
        <label class="form-check-label" for="optionsRadios2">
          Femenino
        </label>
      </div>
      <br/>
      <div>
      <label style=" text-align: center; ">Cuanto es?</label>
      <input type="text" class="form-control" id="captcha" name="captcha" placeholder="<?php echo($cadena); ?>">
</div>
      <br/>
      <button type="submit" class="btn btn-success">Registrar</button>
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