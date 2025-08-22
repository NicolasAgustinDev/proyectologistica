<?php
require_once("../controladores/choferes.controlador.php");
require_once("../modelo/choferes.modelo.php");
class choferes{
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $licencia;

    public function mostrarchoferes(){
        $respuesta = controladorchoferes::ctrmostrarchoferes();
        echo json_encode($respuesta);
    }
}
if(!isset($_method=="POST")){
    $respuesta = new choferes();
    $respuesta -> mostrarchoferes();
}

?>