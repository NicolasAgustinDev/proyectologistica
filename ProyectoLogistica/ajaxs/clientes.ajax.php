<?php
require_once("../controladores/clientes.controlador.php");
require_once("../modelo/clientes.modelo.php");
class clientes{
    public $id;
    public $nombre;
    public $direccion;
    public $telefono;
    public $ruta;

    public function mostrarclientes(){
        $respuesta = controladorclientes::ctrmostrarclientes();
        echo json_encode($respuesta);
    }
    
}
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $respuesta = new clientes();
    $respuesta -> mostrarclientes();
}
?>