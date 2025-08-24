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
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $respuesta = new choferes();
    $respuesta -> mostrarchoferes();
}
?>