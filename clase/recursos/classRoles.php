<?php

include "../html/classBaseDeDatos.php";

class Roles extends classBaseDeDatos
{

    function ejecutar($accion)
    {
        $html = "";
        switch ($accion) {
            case 'insert':
                $this->m_query("INSERT INTO rol (nombre) VALUES ('" . $_POST['nombre'] . "')");
                $html = $this->listar();
                break;
            case 'delete':
                $this->m_query("DELETE from rol where Id=" . $_POST['Id']);
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
                      <input type="text" class="form-control" id="exampleInputNombre" name="nombre" aria-describedby="nombre" placeholder="Nombre de rol" required value="'.((isset($_POST['Id'])) ? $_POST['nombre'] : '').'">
                      '.((isset($_POST['Id'])) ? '<input name="Id" value="' . $_POST["Id"] . '" type ="hidden"/>' : '').'
                      
                      </div>
                    <br/>
                    <button type="submit" class="btn btn-success" value='.((isset($_POST['Id'])) ? 'update' : 'insert').' id="accion" name="accion">Insertar</button>
                    </fieldset>
                </form>
              </div>
              ';
                break;
            case 'update':
                $this->m_query("update rol set nombre = ('" . $_POST['nombre'] . "') where Id = ".$_POST['Id']);
                $html = $this->listar();
                break;
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
        </form></td><td>ID</td><td>Nombre</td></tr>';
        $this->m_query("SELECT * from rol order by nombre");
        for ($cont = 0; $cont < $this->a_numRegistros; $cont++) {
            $tupla = $this->recuRegistro();
            $resp .= '<tr><td><form method="post">
            <input name="accion" value="editForm" type ="hidden"/>
            <input name="Id" value="' . $tupla["Id"] . '" type ="hidden"/>
            <input name="nombre" value="' . $tupla["nombre"] . '" type ="hidden"/>
            <input type="image" src="../images/lapiz.png" width = "10%"/>
            </form></td><td>
            <form method="post">
            <input name="accion" value="delete" type ="hidden"/>
            <input name="Id" value="' . $tupla["Id"] . '" type ="hidden"/>
            <input type="image" src="../images/basura.png" width = "10%"/>
            </form>
            </td><td>' . $tupla["Id"] . '</td><td>' . $tupla["nombre"] . '</td></tr>';
        }
        return $resp . '</div></div>';
    }
}
$oRoles = new Roles();
