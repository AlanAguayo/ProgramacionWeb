<?php

include "../html/classBaseDeDatos.php";

class Facturas extends classBaseDeDatos
{

    function ejecutar($accion)
    {
        $html = "";
        switch ($accion) {
            case 'insert':
                $this->m_query("insert into factura set Id_Contrato=" . $_POST['idContrato'] . ", Fecha_Emision='" . $_POST['fechaEmision'] . "', Fecha_Limite_Pago='" . $_POST['fechaLimite'] . "', Costo=" . $_POST['costo'] . ", Estatus = '" . $_POST['estatus'] . "'");
                $html = $this->listar();
                break;
            case 'delete':
                $this->m_query("DELETE from factura where Id=" . $_POST['Id']);
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
                    <label>Contrato</label>
                      '
                    . $html .= $this->m_crearLista("contrato", "Id", "idContrato", "Fecha") .
                    '
                    <label>Fecha Emision</label>
                      <input type="date" class="form-control" id="exampleInputNombre" name="fechaEmision" aria-describedby="fecha" placeholder="Fecha" required value="' . ((isset($_POST['Id'])) ? $_POST['fechaEmision'] : '') . '">
                      ' . ((isset($_POST['Id'])) ? '<input name="Id" value="' . $_POST["Id"] . '" type ="hidden"/>' : '') . '

                      <label>Fecha Limite</label>
                      <input type="date" class="form-control" id="exampleInputNombre" name="fechaLimite" aria-describedby="fecha" placeholder="Fecha" required value="' . ((isset($_POST['Id'])) ? $_POST['fechaLimite'] : '') . '">
                      ' . ((isset($_POST['Id'])) ? '<input name="Id" value="' . $_POST["Id"] . '" type ="hidden"/>' : '') . '

                      <label>Costo</label>
                      <input type="number" min="0" step=".01" class="form-control" id="exampleInputNombre" name="costo" aria-describedby="costo" placeholder="costo" required value="' . ((isset($_POST['Id'])) ? $_POST['costo'] : '') . '">
                      ' . ((isset($_POST['Id'])) ? '<input name="Id" value="' . $_POST["Id"] . '" type ="hidden"/>' : '') . '
                      
                      
                      <label>Estatus</label>
                      <input type="text" class="form-control" id="exampleInputNombre" name="estatus" aria-describedby="estatus" placeholder="estatus" required value="' . ((isset($_POST['Id'])) ? $_POST['estatus'] : '') . '">
                      ' . ((isset($_POST['Id'])) ? '<input name="Id" value="' . $_POST["Id"] . '" type ="hidden"/>' : '') . '
                      
                    
                      
                      
                      </div>
                    <br/>
                    <button type="submit" class="btn btn-success" value=' . ((isset($_POST['Id'])) ? 'update' : 'insert') . ' id="accion" name="accion">Insertar</button>
                    </fieldset>
                </form>
              </div>
              ';
                break;

            case 'update':
                $this->m_query("update factura set Id_Contrato=" . $_POST['idContrato'] . ", Fecha_Emision='" . $_POST['fechaEmision'] . "', Fecha_Limite_Pago='" . $_POST['fechaLimite'] . "', Costo=" . $_POST['costo'] . ", Estatus = '" . $_POST['estatus'] . "'");
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
        <input type="image" id="insert" name="accion" width = "10%" src="../images/agregar.png"/>
        </form></td><td>ID</td><td>IdContrato</td><td>Fecha Emision</td><td>Fecha Limite</td><td>Costo</td><td>Estatus</td></tr>';
        $this->m_query("SELECT * from factura order by Id_Contrato");
        for ($cont = 0; $cont < $this->a_numRegistros; $cont++) {
            $tupla = $this->recuRegistro();
            $resp .= '<tr><td><form method="post">
            <input name="accion" value="editForm" type ="hidden"/>
            <input name="Id" value="' . $tupla["Id"] . '" type ="hidden"/>
            <input name="idContrato" value="' . $tupla["Id_Contrato"] . '" type ="hidden"/>
            <input name="fechaEmision" value="' . $tupla["Fecha_Emision"] . '" type ="hidden"/>
            <input name="fechaLimite" value="' . $tupla["Fecha_Limite_Pago"] . '" type ="hidden"/>
            <input name="costo" value="' . $tupla["Costo"] . '" type ="hidden"/>
            <input name="estatus" value="' . $tupla["Estatus"] . '" type ="hidden"/>
            <input type="image" src="../images/lapiz.png" width = "15%"/>
            </form></td><td>
            <form method="post">
            <input name="accion" value="delete" type ="hidden"/>
            <input name="Id" value="' . $tupla["Id"] . '" type ="hidden"/>
            <input type="image" src="../images/basura.png" width = "15%"/>
            </form>
            </td><td>' . $tupla["Id"] . '</td><td>' . $tupla["Id_Contrato"] . '</td><td>' . $tupla["Fecha_Emision"] . '</td><td>' . $tupla["Fecha_Limite_Pago"] . '</td>
            <td>' . $tupla["Costo"] . '</td><td>' . $tupla["Estatus"] . '</td></tr>';
        }
        return $resp . '</div></div>';
    }
}
$oFacturas = new Facturas();
