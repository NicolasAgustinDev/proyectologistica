<?php
require_once("../controladores/clientes.controlador.php");
require_once("../modelo/clientes.modelo.php");
class clientes{
    public $id_cliente;
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
    public function modificarclientes(){
        $respuesta = controladorclientes::ctrmodificarclientes($this -> id_cliente,$this -> nombre,$this -> direccion,$this -> telefono, $this -> id_ruta);
        echo json_encode($respuesta);
    }
    public function eliminarclientes(){
        $respuesta = controladorclientes::ctreliminarclientes($this -> id_cliente);
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
    if($_POST["accion"]=="modificar"){
        $modificar = new clientes();
        $modificar -> id_cliente = $_POST['id_cliente'];
        $modificar -> nombre = $_POST['nombre'];
        $modificar -> direccion = $_POST['direccion'];
        $modificar -> telefono = $_POST['telefono'];
        $modificar -> id_ruta = $_POST['id_ruta'];
        $modificar -> modificarclientes();

    }
    if($_POST["accion"]=="eliminar"){
        $eliminar = new clientes();
        $eliminar -> id_cliente = $_POST['id_cliente'];
        $eliminar -> eliminarclientes();


    }
}
?>