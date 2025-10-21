<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelo/productos.modelo.php";

class productos {
    public $id_producto;
    public $producto;
    public $descripcion;
    public $stock;
    public $precio;

    public function mostrarproductos(){
        $respuesta = controladorproductos::ctrmostrarproductos();
        echo json_encode($respuesta);
    }
    public function agregarproductos(){
        $respuesta = controladorproductos::ctragregarproductos($this -> producto,$this -> descripcion,$this -> stock,$this -> precio);
        echo json_encode($respuesta);
    }
    public function modificarproductos(){
        $respuesta = controladorproductos::ctrmodificarproductos($this -> id_producto,$this -> producto,$this -> descripcion,$this -> stock,$this -> precio);
        echo json_encode($respuesta);
    }
    public function eliminarproductos(){
        $respuesta = controladorproductos::ctreliminarproductos($this -> id_producto);
        echo json_encode($respuesta);
    }
}

if(!isset($_POST["accion"])){
    $respuesta = new productos();
    $respuesta -> mostrarproductos();
}else{
    if($_POST["accion"]=="registrar"){
        $registrar = new productos();
        $registrar -> producto = $_POST["producto"];
        $registrar -> descripcion = $_POST["descripcion"];
        $registrar -> stock = $_POST["stock"];
        $registrar -> precio = $_POST["precio"];
        $registrar -> agregarproductos();
    }
    if($_POST["accion"]=="modificar"){
        $modificar = new productos();
        $modificar -> id_producto = $_POST["id_producto"];
        $modificar -> producto = $_POST["producto"];
        $modificar -> descripcion = $_POST["descripcion"];
        $modificar -> stock = $_POST["stock"];
        $modificar -> precio = $_POST["precio"];
        $modificar -> modificarproductos();
    }
    if($_POST["accion"]=="eliminar"){
        $eliminar = new productos();
        $eliminar -> id_producto = $_POST["id_producto"];
        $eliminar -> eliminarproductos();
    }
}
?>