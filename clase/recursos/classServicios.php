<?php

include "../html/classBaseDeDatos.php";

class Servicios extends classBaseDeDatos
{

    function ejecutar($accion)
    {
        $html = "";
        switch ($accion) {
            case 'insert':
                $this->m_query("insert into servicios set Nombre='" . $_POST['nombre'] . "', Precio='" . $_POST['precio'] . "', Descripcion='" . $_POST['descripcion']."'");
                $html = $this->listar();
                break;
            case 'delete':
                $this->m_query("DELETE from servicios where Id=" . $_POST['Id']);
                $html = $this->listar();
                break;
            case 'editForm':
            case 'newForm':
                $html = '
                <br/>
                <div style="position:relative; left: 30%; width:40%;">
                <form method="post">
                  <fieldset>
                    <div class="form-group">
                    <label>Nombre</label>
                      <input type="text" class="form-control" id="exampleInputNombre" name="nombre" aria-describedby="nombre" placeholder="Nombre" required value="' . ((isset($_POST['Id'])) ? $_POST['nombre'] : '') . '">
                      ' . ((isset($_POST['Id'])) ? '<input name="Id" value="' . $_POST["Id"] . '" type ="hidden"/>' : '') . '
                      <label>Precio</label>
                      <input type="number" min="0" step=".01" class="form-control" id="exampleInputPrecio" name="precio" aria-describedby="precio" placeholder="Precio" required value="' . ((isset($_POST['Id'])) ? $_POST['precio'] : '') . '">
                      ' . ((isset($_POST['Id'])) ? '<input name="Id" value="' . $_POST["Id"] . '" type ="hidden"/>' : '') . '
                      <label>Descripcion</label>
                      <input type="text" class="form-control" id="exampleInputDescripcion" name="descripcion" aria-describedby="descripcion" placeholder="Descripcion" required value="' . ((isset($_POST['Id'])) ? $_POST['descripcion'] : '') . '">
                      ' . ((isset($_POST['Id'])) ? '<input name="Id" value="' . $_POST["Id"] . '" type ="hidden"/>' : '') . '
                      
                     </br>
                    <button type="submit" class="btn btn-success" value=' . ((isset($_POST['Id'])) ? 'update' : 'insert') . ' id="accion" name="accion">Insertar</button>
                    </fieldset>
                </form>
              </div>
              ';
                break;

            case 'update':
                $this->m_query("update servicios set Nombre='" . $_POST['nombre'] . "', Precio=" . $_POST['precio'] . ", descripcion='" . $_POST['descripcion']."'");
                $html = $this->listar();
                break;
            case 'list':
                $html .= $this->listar();
                break;
            default:
                $html = $_REQUEST["accion"] . " accion no programada";
                break;
        }
        return $html;
    }

    private function listar()
    {
        $resp = '<div class="container"><div class="row"><table class="table table-striped table-hover ">';

        $resp .= '<tr><td colspan = "2"><form method = "post">
        <input name="accion" value="newForm" type ="hidden"/>
        <input type="image" id="insert" name="accion" width = "5%" src="../images/agregar.png"/>
        </form></td><td>ID</td><td>Nombre</td><td>Precio</td><td>Descripcion</td></tr>';
        $this->m_query("SELECT * from servicios order by Nombre");
        for ($cont = 0; $cont < $this->a_numRegistros; $cont++) {
            $tupla = $this->recuRegistro();
            $resp .= '<tr><td><form method="post">
            <input name="accion" value="editForm" type ="hidden"/>
            <input name="Id" value="' . $tupla["Id"] . '" type ="hidden"/>
            <input name="nombre" value="' . $tupla["Nombre"] . '" type ="hidden"/>
            <input name="precio" value="' . $tupla["Precio"] . '" type ="hidden"/>
            <input name="descripcion" value="' . $tupla["Descripcion"] . '" type ="hidden"/>
            <input type="image" src="../images/lapiz.png" width = "10%"/>
            </form></td><td>
            <form method="post">
            <input name="accion" value="delete" type ="hidden"/>
            <input name="Id" value="' . $tupla["Id"] . '" type ="hidden"/>
            <input type="image" src="../images/basura.png" width = "10%"/>
            </form>
            </td><td>' . $tupla["Id"] . '</td><td>' . $tupla["Nombre"] . '</td><td>' . $tupla["Precio"] . '</td><td>' . $tupla["Descripcion"] . '</td>
            </tr>';
        }
        return $resp . '</div></div>';
    }
}
$oServicios = new Servicios();
