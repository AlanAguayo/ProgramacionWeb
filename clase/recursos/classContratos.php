<?php

include "../html/classBaseDeDatos.php";
class Contratos extends classBaseDeDatos
{

  function ejecutar($accion)
  {
    $html = "";
    switch ($accion) {
      case 'insert':
        if ($_SESSION['idRol'] == 9)
          $this->m_query("insert into contrato set Fecha='" . $_POST['fecha'] . "', Estatus='" . $_POST['estatus'] . "', IdUsuarios=" . $_POST['idUsuario'] . ", IdServicios=" . $_POST['idServicio']);
        if ($_SESSION['idRol'] == 2)
        $this->m_query("insert into contrato set Fecha='" . date('d/m/y') . "', Estatus='Activo', IdUsuarios=" . $_SESSION['Id'] . ", IdServicios=" . $_POST['idServicio']);
          $html = $this->listar();
        break;
      case 'delete':
        $this->m_query("DELETE from contrato where Id=" . $_POST['Id']);
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
                    <label>Fecha</label>
                      <input type="date" class="form-control" id="exampleInputNombre" name="fecha" aria-describedby="fecha" placeholder="Fecha" required value="' . ((isset($_POST['Id'])) ? $_POST['fecha'] : '') . '">
                      ' . ((isset($_POST['Id'])) ? '<input name="Id" value="' . $_POST["Id"] . '" type ="hidden"/>' : '') . '
                      <label>Estatus</label>
                      <input type="text" class="form-control" id="exampleInputNombre" name="estatus" aria-describedby="estatus" placeholder="estatus" required value="' . ((isset($_POST['Id'])) ? $_POST['estatus'] : '') . '">
                      ' . ((isset($_POST['Id'])) ? '<input name="Id" value="' . $_POST["Id"] . '" type ="hidden"/>' : '') . '
                      <label>Usuario</label>
                      ' .
          $html .= $this->m_crearLista("usuario", "Id", "idUsuario", "Nombre");

        $html .= '
                    <label>Servicio</label>
                      ';
        $html .= $this->m_crearLista("servicios", "Id", "idServicio", "Nombre") . '
                     
                      </div>
                    <br/>
                    <button type="submit" class="btn btn-success" value=' . ((isset($_POST['Id'])) ? 'update' : 'insert') . ' id="accion" name="accion">Insertar</button>
                    </fieldset>
                </form>
              </div>
              ';
        break;

      case 'update':
        $this->m_query("update contrato set Fecha='" . $_POST['fecha'] . "', Estatus='" . $_POST['estatus'] . "', IdUsuarios=" . $_POST['idUsuario'] . ", IdServicios=" . $_POST['idServicio']);
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
    $resp = '
        <div class="container"><div class="row">';
    if ($_SESSION['idRol'] == 2)
      $resp .= '<div class="col-md-5">';
    $resp .= '<table class="table table-striped table-hover ">';

    $resp .= '<tr><td colspan = "2"><form method = "post">
        <input name="accion" value="newForm" type ="hidden"/>';
    if ($_SESSION['idRol'] == 9)
      $resp .= '<input type="image" id="insert" name="accion" width = "5%" src="../images/agregar.png"/>';
    $resp .= '</form></td><td>ID</td><td>Fecha</td><td>Estatus</td>';
    if ($_SESSION['idRol'] == 9) 
    $resp .='<td>IdUsuario</td>';
    $resp .='<td>IdServicios</td></tr>';
    if ($_SESSION['idRol'] == 2)
      $this->m_query("SELECT * from contrato c join servicios s on s.Id = c.IdServicios where c.IdUsuarios =" . $_SESSION['Id']);
    if ($_SESSION['idRol'] == 9)
      $this->m_query("SELECT * from contrato ");
    for ($cont = 0; $cont < $this->a_numRegistros; $cont++) {
      $tupla = $this->recuRegistro();
      $resp .= '<tr><td><form method="post">
            <input name="accion" value="editForm" type ="hidden"/>
            <input name="Id" value="' . $tupla["Id"] . '" type ="hidden"/>
            <input name="fecha" value="' . $tupla["Fecha"] . '" type ="hidden"/>
            <input name="estatus" value="' . $tupla["Estatus"] . '" type ="hidden"/>';
            if ($_SESSION['idRol'] == 9) 
            $resp.='<input name="idUsuario" value="' . $tupla["IdUsuarios"] . '" type ="hidden"/>';
            $resp.='<input name="idServicio" value="' . $tupla["IdServicios"] . '" type ="hidden"/>';
      if ($_SESSION['idRol'] == 9)
        $resp .= '<input type="image" src="../images/lapiz.png" width = "10%"/>';
      $resp .= '</form></td><td>
            <form method="post">
            <input name="accion" value="delete" type ="hidden"/>
            <input name="Id" value="' . $tupla["Id"] . '" type ="hidden"/>';
      if ($_SESSION['idRol'] == 9)
        $resp .= '<input type="image" src="../images/basura.png" width = "10%"/>';
      $resp .= '</form>
            </td><td>' . $tupla["Id"] . '</td><td>' . $tupla["Fecha"] . '</td><td>' . $tupla["Estatus"] . '</td>';
            
            if ($_SESSION['idRol'] == 9) 
            $resp.='<td>' . $tupla["IdUsuarios"] . '</td>';
            $resp.='<td>' . $tupla["IdServicios"] . '</td></tr>';
    }

    $resp .= '</table></div>';

    if ($_SESSION['idRol'] == 2) {
      $resp .= '<div class="col-md-7">
        <div style="position:relative; left: 30%; width:40%;">
                <form method="post">
                  <fieldset>
                    <div class="form-group">
                    
                    <label>Servicio</label>
                      ';
      $resp .= $this->m_crearLista("servicios", "Id", "idServicio", "Nombre");
      $resp .= '
                     
                      </div>
                    <br/>
                    <button type="submit" class="btn btn-success" value=' . ((isset($_POST['Id'])) ? 'update' : 'insert') . ' id="accion" name="accion">Registrar</button>
                    </fieldset>
                </form>
              </div>
              </div>
              </div>
        </div>';
    }
    return $resp;
  }
}
$oContratos = new Contratos();
