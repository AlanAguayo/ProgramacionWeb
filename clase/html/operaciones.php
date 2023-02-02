<?php
class Operaciones{
    function __construct(){

    }
    function procesa($cual){
        $resul='';
        switch($cual){
            case "sumar":
                $resul=$_REQUEST['datoA']+$_REQUEST['datoB'];
                break;
                case "mostNumeros":
                    if($_REQUEST['datoA']<$_REQUEST['datoB'])
                    for(;$_REQUEST['datoA']<$_REQUEST['datoB'];$_REQUEST['datoA']++)
                    $resul.=$_REQUEST['datoA'].", ";
                    
                else
                for(;$_REQUEST['datoA']>$_REQUEST['datoB'];$_REQUEST['datoA']--)
                    $resul.=$_REQUEST['datoA'].", ";
                
                break;
                default:$resul=$cual." No esta programado";
            }
        return $resul;
    }
}

$oOperaciones = new Operaciones();
if($_REQUEST['accion'])
echo $oOperaciones->procesa($_REQUEST['accion']);