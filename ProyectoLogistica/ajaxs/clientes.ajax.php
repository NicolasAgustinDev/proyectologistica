<?php
require_once("../controladores/clientes.controlador.php");
require_once("../modelo/clientes.modelo.php");
class clientes{
    public $id;
    public $nombre;
    public $direccion;
    public $telefono;
    public $id_ruta;

    public function mostrarclientes(){
        $respuesta = controladorclientes::ctrmostrarclientes();
        echo json_encode($respuesta);
    }
    public function agregarclientes(){
        $respuesta = controladorclientes::ctragregarclientes($this -> nombre,$this -> direccion,$this -> telefono, $this -> id_ruta);
        echo json_encode($respuesta);
    }
    
}
if(!isset($_POST["accion"])){
    $respuesta = new clientes();
    $respuesta -> mostrarclientes();
}else{
    if($_POST["accion"]=="registrar"){
        $registrar = new clientes();
        $registrar -> nombre = $_POST['nombre'];
        $registrar -> direccion = $_POST['direccion'];
        $registrar -> telefono = $_POST['telefono'];
        $registrar -> id_ruta = $_POST['id_ruta'];
        $registrar -> agregarclientes();
    }
}
?>