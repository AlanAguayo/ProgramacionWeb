<?php

include "../html/classBaseDeDatos.php";

class Usuarios extends classBaseDeDatos
{

    function __construct()
    {
        if (isset($_REQUEST['accion'])) {
            if (!isset($_SESSION['Nombre']))
                session_start();
            echo $this->ejecutar($_REQUEST['accion']);
        }
    }

    function ejecutar($accion)
    {
        $html = "";
        switch ($accion) {
            case 'insert':
                $this->m_query("insert into usuario set Nombre='" . $_POST['nombre'] . "', Apellido='" . $_POST['apellido'] . "', Correo='" . $_POST['correo'] . "', Genero='" . $_POST['genero'] . "', Id_Rol = " . $_POST['idRol'] . "");
                $html = $this->listar();
                break;
            case 'delete':
                $this->m_query("DELETE from usuario where Id=" . $_POST['Id']);
                $html = $this->listar();
                break;
            case 'editForm':
            case 'newForm':
                $html = '
                <br/>
                <div style="position:relative; left: 30%; width:40%;">
                <form method="post"' . ((isset($_POST['Id'])) ? '' : 'action="../html/registrarse.php?e=12"') . '>
                  <fieldset>
                    <div class="form-group">
                    <label>Nombre</label>
                      <input type="text" class="form-control" id="exampleInputNombre" name="nombre" aria-describedby="nombre" placeholder="Nombre" required value="' . ((isset($_POST['Id'])) ? $_POST['nombre'] : '') . '">
                      ' . ((isset($_POST['Id'])) ? '<input name="Id" value="' . $_POST["Id"] . '" type ="hidden"/>' : '') . '
                      <label>Apellido</label>
                      <input type="text" class="form-control" id="exampleInputNombre" name="apellido" aria-describedby="apellido" placeholder="Apellido" required value="' . ((isset($_POST['Id'])) ? $_POST['apellido'] : '') . '">
                      ' . ((isset($_POST['Id'])) ? '<input name="Id" value="' . $_POST["Id"] . '" type ="hidden"/>' : '') . '
                      <label>Correo</label>
                      <input type="text" class="form-control" id="exampleInputNombre" name="correo" aria-describedby="correo" placeholder="Correo" required value="' . ((isset($_POST['Id'])) ? $_POST['correo'] : '') . '">
                      ' . ((isset($_POST['Id'])) ? '<input name="Id" value="' . $_POST["Id"] . '" type ="hidden"/>' : '') . '
                      
                      </br>
                      <label>Genero</label>
                      </br>
                      <label>Masculino</label>
                      <input type="radio" class="form-check-input" id="exampleInputGenero" name="genero1" ' . ((isset($_POST['Id'])) && $_POST['genero'] == 'M' ? 'checked' : '') . ' value="M">
                      ' . ((isset($_POST['Id'])) ? '<input name="Id" value="' . $_POST["Id"] . '" type ="hidden"/>' : '') . '
                      <label>&nbsp&nbsp&nbsp&nbsp</label>
                      <label>Femenino</label>
                      <input type="radio" class="form-check-input" id="exampleInputGenero" name="genero2" ' . ((isset($_POST['Id'])) && $_POST['genero'] == 'F' ? 'checked' : '') . ' required value="F">
                      ' . ((isset($_POST['Id'])) ? '<input name="Id" value="' . $_POST["Id"] . '" type ="hidden"/>' : '') . '
                      </br>
                      </br>


                      
                      <label>Rol</label>
                      '
                    . $html .= $this->m_crearLista("rol", "Id", "idRol", "nombre") .
                    '
                      
                      ' . ((isset($_POST['Id'])) ? '<label>Foto</label>
                      <input type="file" accept="image/png" class="form-control" id="exampleInputNombre" name="foto" aria-describedby="foto" placeholder="Foto" value="' . ((isset($_POST['Id'])) ? $_POST['foto'] : '') . '">
                      ' . ((isset($_POST['Id'])) ? '<input name="Id" value="' . $_POST["Id"] . '" type ="hidden"/>' : '') . '' : '') . '
                      </div>
                    <br/>
                    <button type="submit" class="btn btn-success" value=' . ((isset($_POST['Id'])) ? 'update' : 'insert') . ' id="accion" name="accion">Insertar</button>
                    </fieldset>
                </form>
              </div>
              ';
                break;
            case 'viewPerfil':

                $html = '
                
                <br/>
                <div style="position:relative; left: 30%; width:40%;">
                <form method="post" enctype="multipart/form-data" id="formPerfil">
                  <fieldset>
                    <div class="form-group">
                    <label>Nombre</label>
                      <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombre" placeholder="Nombre" required value="' . $_SESSION['Nombre'] . '">
                      ' . ((isset($_SESSION['Id'])) ? '<input name="Id" value="' . $_SESSION["Id"] . '" type ="hidden"/>' : '') . '
                      <label>Apellido</label>
                      <input type="text" class="form-control" id="apellido" name="apellido" aria-describedby="apellido" placeholder="Apellido" required value="' . ((isset($_SESSION['Id'])) ? $_SESSION['Apellido'] : '') . '">
                      ' . ((isset($_SESSION['Id'])) ? '<input name="Id" value="' . $_SESSION["Id"] . '" type ="hidden"/>' : '') . '
                      <label>Correo</label>
                      <input type="text" class="form-control" id="correo" name="correo" aria-describedby="correo" placeholder="Correo" required value="' . ((isset($_SESSION['Id'])) ? $_SESSION['Correo'] : '') . '">
                      ' . ((isset($_SESSION['Id'])) ? '<input name="Id" value="' . $_SESSION["Id"] . '" type ="hidden"/>' : '') . '
                      
                      <label>Password</label>
                      <input type="password" class="form-control" id="password" name="password" aria-describedby="password" placeholder="Password" required value="' . $_SESSION['Password'] . '">
                      ' . ((isset($_SESSION['Id'])) ? '<input name="Id" value="' . $_SESSION["Id"] . '" type ="hidden"/>' : '') . '
                      

                      </br>
                      <label>Genero</label>
                      </br>
                      <label>Masculino</label>
                      <input type="radio" class="form-check-input" id="genero1" name="genero" ' . ((isset($_SESSION['Id'])) && $_SESSION['Genero'] == 'M' ? 'checked' : '') . ' value="M">
                      ' . ((isset($_SESSION['Id'])) ? '<input name="Id" value="' . $_SESSION["Id"] . '" type ="hidden"/>' : '') . '
                      <label>&nbsp&nbsp&nbsp&nbsp</label>
                      <label>Femenino</label>
                      <input type="radio" class="form-check-input" id="genero2" name="genero" ' . ((isset($_SESSION['Id'])) && $_SESSION['Genero'] == 'F' ? 'checked' : '') . ' required value="F">
                      ' . ((isset($_SESSION['Id'])) ? '<input name="Id" value="' . $_SESSION["Id"] . '" type ="hidden"/>' : '') . '
                      </br>
                      </br>

                      <input name="idRol" value="' . $_SESSION["idRol"] . '" type ="hidden"/>

                      
                      ' . ((isset($_SESSION['Id'])) ? '<label>Foto</label>
                      <input type="file" accept=".jpg, .png, .jpeg" class="form-control" name="foto" aria-describedby="foto" value="' . ((isset($_SESSION['Id'])) ? $_SESSION['Foto'] : '') . '">
                      ' . ((isset($_SESSION['Id'])) ? '<input name="Id" value="' . $_SESSION["Id"] . '" type ="hidden"/>' : '') . '' : '') . '
                      </div>
                    <br/>
                    <button type="button" class="btn btn-success" value=' . ((isset($_SESSION['Id'])) ? 'updateUser' : 'insert') . ' id="accion" name="accion" onclick="usuarios(\'update\')">Guardar</button>
                    </fieldset>
                </form>
              </div>
              ';

                break;
            case 'updateUser':
                $this->m_query("update usuario set Nombre='" . $_POST['nombre'] . "', Apellido='" . $_POST['apellido'] . "', Correo='" . $_POST['correo'] . "', Genero='" . $_POST['genero'] . "', Password='" . $_POST['password'] . "' ,Id_Rol = '" . $_POST['idRol'] . "' where Id = " . $_POST['Id']);
                $_SESSION['Correo'] = $_POST['correo'];
                $_SESSION['Nombre'] = $_POST['nombre'];
                $_SESSION['Apellido'] = $_POST['apellido'];
                $_SESSION['Genero'] = $_POST['genero'];
                $_SESSION['Password'] = $_POST['password'];
                $_SESSION['nombUsuario'] = $_POST['nombre'] . " " . $_POST['apellido'];

                if ($_FILES['foto']['name'] != "") {
                    $extension = explode(".", $_FILES['foto']['name']);
                    $nombreFinal = $_SESSION['Id'] . "." . $extension[count($extension) - 1];
                    move_uploaded_file($_FILES['foto']['tmp_name'], "../images/fotos/" . $nombreFinal);
                    $cad = "UPDATE Usuario set Foto='" . $nombreFinal . "' where Id =" . $_SESSION['Id'];
                    $this->m_query($cad);
                    $_SESSION['Foto'] = $nombreFinal;
                    header("location: ../html/indexUser.php?e=10");
                } else
                    header("location: ../Html/indexUser.php?e=100");


                break;

            case 'update':
                $this->m_query("update usuario set Nombre='" . $_POST['nombre'] . "', Apellido='" . $_POST['apellido'] . "', Correo='" . $_POST['correo'] . "', Genero='" . $_POST['genero'] . "', Id_Rol = '" . $_POST['idRol'] . "' where Id = " . $_POST['Id']);
                $html = $this->listar();
                break;
            case 'list':
                $html .= $this->listar();
                break;
            default:
                $html = " accion no programada";
                break;
        }
        return $html;
    }

    private function listar()
    {
        $resp = '<div class="container"><div class="row"><table class="table table-striped table-hover ">';

        $resp .= '<tr><td colspan = "2"><form method = "post">
        <input name="accion" value="newForm" type ="hidden"/>
        <input type="image" id="insert" name="accion" width = "10%" src="../images/agregar.png"/>
        </form></td><td>ID</td><td>Foto</td><td>Correo</td><td>Nombre</td><td>Apellido</td><td>Ultimo Acceso</td>
        <td>Accesos</td><td>Genero</td><td>Id_Rol</td></tr>';
        if ($_SESSION['idRol'] == 9)
            $this->m_query("SELECT * from Usuario order by Nombre");
        else
            $this->m_query("SELECT * from Usuario where id = " . $_SESSION['Id']);
        for ($cont = 0; $cont < $this->a_numRegistros; $cont++) {
            $tupla = $this->recuRegistro();
            $resp .= '<tr><td><form method="post">
            <input name="accion" value="editForm" type ="hidden"/>
            <input name="Id" value="' . $tupla["Id"] . '" type ="hidden"/>
            <input name="foto" value="' . $tupla["Foto"] . '" type ="hidden"/>
            <input name="correo" value="' . $tupla["Correo"] . '" type ="hidden"/>
            <input name="nombre" value="' . $tupla["Nombre"] . '" type ="hidden"/>
            <input name="apellido" value="' . $tupla["Apellido"] . '" type ="hidden"/>
            <input name="ultimoAcceso" value="' . $tupla["Fecha_Ultimo_Acceso"] . '" type ="hidden"/>
            <input name="accesos" value="' . $tupla["Accesos"] . '" type ="hidden"/>
            <input name="genero" value="' . $tupla["Genero"] . '" type ="hidden"/>
            <input name="idRol" value="' . $tupla["Id_Rol"] . '" type ="hidden"/>
            <input type="image" src="../images/lapiz.png" width = "15%"/>
            </form></td><td>
            <form method="post">
            <input name="accion" value="delete" type ="hidden"/>
            <input name="Id" value="' . $tupla["Id"] . '" type ="hidden"/>
            <input type="image" src="../images/basura.png" width = "15%"/>
            </form>
            </td><td>' . $tupla["Id"] . '</td><td>' . $tupla["Foto"] . '</td><td>' . $tupla["Correo"] . '</td><td>' . $tupla["Nombre"] . '</td>
            <td>' . $tupla["Apellido"] . '</td><td>' . $tupla["Fecha_Ultimo_Acceso"] . '</td><td>' . $tupla["Accesos"] . '</td>
            <td>' . $tupla["Genero"] . '</td><td>' . $tupla["Id_Rol"] . '</td></tr>';
        }
        return $resp . '</div></div>';
    }
}
$oUsuarios = new Usuarios();