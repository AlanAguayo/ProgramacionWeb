<?php

include "../html/classBaseDeDatos.php";

class Promociones extends classBaseDeDatos
{

    function ejecutar($accion)
    {
        $html = "";
        switch ($accion) {
            case 'insert':
                $cad = "insert into promocion set";
                foreach ($_POST as $key => $value)
                    if ($key != "accion")
                        $cad .= " " . $key . " = '" . $value . "', ";
                $cad = substr($cad, 0, -2);
                $this->m_query($cad);
                $html = $this->listar();
                break;
            case 'delete':
                $this->m_query("DELETE from promocion where Id=" . $_POST['Id']);
                $html = $this->listar();
                break;
            case 'editForm':
                $registro = $this->m_obtenerRegistroArreglo("select * from promocion where Id=".$_POST['Id']);
            case 'newForm':
                $html = '
                <br/>
                <div style="position:relative; left: 30%; width:40%;">
                <form method="post" id="promocion">
                  <fieldset>
                    <div class="form-group">
                    <label>Nombre</label>
                      <input type="text" class="form-control" id="Nombre" name="nombre" aria-describedby="nombre" placeholder="Nombre" required value="' . ((isset($registro)) ? $registro['Nombre'] : "") . '">
                      ' . ((isset($registro)) ? '<input name="Id" value="' . $registro["Id"] . '" type ="hidden"/>' : '') . '
                      <label>Porcentaje</label>
                      <input type="number" min="0" max="100" class="form-control" id="Porcentaje" name="porcentaje" aria-describedby="porcentaje" placeholder="Porcentaje" required value="' . ((isset($registro)) ? $registro['Porcentaje'] : '') . '">
                      ' . ((isset($registro)) ? '<input name="Id" value="' . $registro["Id"] . '" type ="hidden"/>' : '') . '
                      <label>Servicio</label>
                      ';
                     if(isset($registro))
                    $html .= $this->m_crearListaUpdate("servicios", "Id", "IdServicio", "Nombre", $registro['IdServicio']);
                    else
                    $html .= $this->m_crearLista("servicios", "Id", "IdServicio", "Nombre");
                    
                    $html.='
     
                      </div>
                    <br/>
                    <input type ="hidden" name = "Id" value ="'.((isset($registro)) ? $registro['Id'] : '') .'">
                    <button type="button" class="btn btn-success" value=' . ((isset($registro)) ? 'update' : 'insert') . ' id="accion" name="accion" onclick="promocion('. ((isset($registro)) ? '\'update\'' : '\'insert\'') .')">' . ((isset($registro)) ? 'Actualizar' : 'Insertar') . '</button>
                    </fieldset>
                </form>
              </div>
              ';
                break;

            case 'update':
                $this->m_query("update promocion set Nombre='" . $_POST['nombre'] . "', Porcentaje='" . $_POST['porcentaje'] . "', IdServicio='" . $_POST['IdServicio'] . "' where Id = " . $_POST['Id']);
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

        $resp .= '<tr><td colspan = "2">
        <img width = "5%" src="../images/agregar.png" onclick="promocion(\'newForm\')">
    </td><td>ID</td><td>Nombre</td><td>Porcentaje</td><td>IdServicio</td></tr>';
        $this->m_query("SELECT * from Promocion order by Nombre");
        for ($cont = 0; $cont < $this->a_numRegistros; $cont++) {
            $tupla = $this->recuRegistro();
            $resp .= '<tr><td>
            <img src="../images/lapiz.png" width = "10%" onclick="promocion(\'editForm\','.$tupla['Id'].')">
            </td><td>
            <img src="../images/basura.png" width = "10%" onclick="promocion(\'delete\','.$tupla['Id'].')">
            </td><td>' . $tupla["Id"] . '</td><td>' . $tupla["Nombre"] . '</td><td>' . $tupla["Porcentaje"] . '</td><td>' . $tupla["IdServicio"] . '</td></tr>';
        }
        return $resp . '</table></div></div>';
    }
}
$oPromociones = new Promociones();
if (isset($_REQUEST["accion"]))
    echo $oPromociones->ejecutar($_REQUEST["accion"]);
