<?php
session_start();
if (!isset($_SESSION['Email']) && !($_SESSION['rol'] == 2))
  header("location: ../html/index.php");
?>



<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="../html/indexUser.php">Polloyon</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      <a>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="../html/indexUser.php">Inicio
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../vistas/perfil.php">Perfil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../vistas/contratos.php?e=1">Contrato</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../vistas/contratos.php">Servicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../vistas/servicios.php">Sesion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../vistas/facturas.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../vistas/promociones.php">Promociones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../html/index.php">Cerrar sesion</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-sm-2" type="text" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>

      <p style="margin-left:10;">


        <?php
        if ($_SESSION['Foto'] == '')
          echo ('<img src="../images/fotos/usuario.png" style="width: 40px;" alt="foto"/>');
        else
          echo ('<img src="../images/fotos/' . $_SESSION['Foto'] . '" style="width: 40px;" alt="foto"/>');
        ?>
      </p>
      <p style="margin-left:10;" id="nombUsuario" name="nombUsuario">
        <?php
        echo ($_SESSION['nombUsuario']);
        ?>
      </p>

    </div>
  </div>
</nav>