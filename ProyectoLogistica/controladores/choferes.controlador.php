<?php
require_once "../modelo/choferes.modelo.php";
class controladorchoferes{
    static public function ctrmostrarchoferes(){
        $respuesta = modelochoferes::mdlmostrarchoferes();
        return $respuesta;
    }
    static public function ctragregarchoferes($nombre,$apellido,$telefono,$licencia){
        $respuesta = modelochoferes::mdlagregarchoferes($nombre,$apellido,$telefono,$licencia);
        return $respuesta;
    }
    static public function ctrmodificarchoferes($id_chofer,$nombre,$apellido,$telefono,$licencia){
        $respuesta = modelochoferes::mdlmodificarchoferes($id_chofer,$nombre,$apellido,$telefono,$licencia);
        return $respuesta;
    }
}
?>