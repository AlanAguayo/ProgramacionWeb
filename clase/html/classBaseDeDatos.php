<?php
class classBaseDeDatos {
    var $a_conexion;
    var $a_numRegistros;
    var $a_registros;
    var $a_error;
    function m_conecta(){
       $this->a_conexion=mysqli_connect("localhost","empresa","3312","empresaservicios");
    }
    function m_desconecta(){
        mysqli_close($this->a_conexion);
    }
    function m_imprLista(){

    }
    function m_query($consulta){
        $this->a_error=false;
        $this->m_conecta();
        $this->a_registros=mysqli_query($this->a_conexion,$consulta);
        if(mysqli_error($this->a_conexion)>"")
            $this->a_error=true;

        if(strpos(strtoupper($consulta), "SELECT") !==false)
        $this->a_numRegistros=mysqli_num_rows($this->a_registros); 
        //else
        //$this->a_numRegistros=mysqli_affected_rows(); 

        $this->m_desconecta();
    }

function m_obtenerRegistro($query){
    $this->m_query($query);
    return mysqli_fetch_object($this->a_registros);
}

function m_obtenerRegistroArreglo($query){
    $this->m_query($query);
    return mysqli_fetch_array($this->a_registros);
}

function recuRegistro(){
    return mysqli_fetch_array($this->a_registros);
}

function m_crearLista($tabla, $PK, $nombCampo, $ordenaPor){
    $result = "";
    $cad = "SELECT * from ".$tabla." order by ".$ordenaPor;
    $this->m_query($cad);
    $result .= '<select class = "form-control" name="'.$nombCampo.'">';
    foreach($this->a_registros as $registro){
        $result.='<option value="'.$registro[$PK].'" '.'>'.$registro[$ordenaPor].'</option>';
    }
    $result.="</select>";
    return $result;
}
function m_crearListaUpdate($tabla, $PK, $nombCampo, $ordenaPor, $ordenado){
    $result = "";
    $ordenado;
    $cad = "SELECT * from ".$tabla." order by ".$ordenaPor;
    $this->m_query($cad);
    $result .= '<select class = "form-control" name="'.$nombCampo.'">';
    foreach($this->a_registros as $registro){
        $result.='<option '.(($registro[$PK] == $ordenado)?"selected":"").' value="'.$registro[$PK].'" '.'>'.$registro[$ordenaPor].'</option>';
    }
    $result.="</select>";
    return $result;
}

function m_crearListaUser($tabla, $PK, $nombCampo, $ordenaPor, $nombCampo2){
    $result = "";
    $cad = "SELECT * from ".$tabla." order by ".$ordenaPor;
    $this->m_query($cad);
    $result .= '<select class = "form-control" name="'.$nombCampo.'">';
    foreach($this->a_registros as $registro){
        $result.='<option value="'.$registro[$PK].'" '. ((isset($_POST['Id'])) && $_POST[$nombCampo] == $registro[$PK] ? 'selected' : '') .'>'.$registro[$ordenaPor].' '.$registro[$nombCampo2].'</option>';
    }
    $result.="</select>";
    return $result;

}


}
$oBD=new classBaseDeDatos();              
?>