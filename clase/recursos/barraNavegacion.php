<?php

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Polloyon</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      <a>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Inicio
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="iniciarSesion.php">Iniciar sesion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registro.php">Registrarme</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">Sobre nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="password.php">Recuperar password</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
          </div>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-sm-2" type="text" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<script>
  function calcular() {
    var a = parseFloat(valorA.value);
    var b = parseFloat(valorB.value);
    var ope = operador.options[operador.selectedIndex].text;
    switch (operador.value) {
      case '+':
        alert(a + b);
        break;
      case '-':
        alert(a - b);
        break;
      case '*':
        alert(a * b);
        break;
      case '/':
        alert(a / b);
        break;
      case 'Sen':
        alert(Math.sin(a/57.29))
        break;
      case '#':
        alert (parseInt(Math.random()*1000));
        break;
      default:
        alert('No sirve');
        break;
    }
    prueba = confirm('Estas satisfecho?');
    if(!prueba)
    alert('Pos me vale ver...');
  }
</script>

<form onsubmit="return confirm('Estas segur@?')">
A<input onclick="" type="text" id="valorA">
B<input onclick="" type="text" id="valorB">
<select id="operador" onchange="calcular()">
  <option value='+'>+</option>
  <option value='-'>-</option>
  <option value='*'>*</option>
  <option value='/'>/</option>
  <option value='Sen'>Sen</option>
  <option value='#'>Random</option>
</select>
<button>Calcular</button>
</form>


