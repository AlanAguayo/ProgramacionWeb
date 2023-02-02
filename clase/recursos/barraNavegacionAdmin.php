<?php
session_start();
if(!isset($_SESSION['Email']) && !($_SESSION['rol']==9))
header("location: ../html/index.php");
?>



<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="../html/indexAdmin.php">Polloyon</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        <a>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" href="../html/indexAdmin.php">Inicio
              <span class="visually-hidden">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../vistas/usuarios.php">Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../vistas/roles.php">Roles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../vistas/contratos.php?e=99">Contratos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../vistas/servicios.php">Servicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../vistas/facturas.php">Facturas</a>
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
        
        <p style ="margin-left:10;" id="nombUser" name = "nombUser">
       <?php 
      echo($_SESSION['nombUsuario']);
      ?>
      </p>
      </div>
    </div>
  </nav>
