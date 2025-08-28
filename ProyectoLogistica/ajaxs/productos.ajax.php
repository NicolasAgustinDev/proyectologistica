<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelo/productos.modelo.php";

class productos {
    public function mostrarproductos(){
        $respuesta = controladorproductos::ctrmostrarproductos();
        echo json_encode($respuesta);
    }
    public function agregarproductos(){
        $respuesta = controladorproductos::ctrmostrarproductos();
        echo json_encode($respuesta);
    }
}

if(!isset($_POST["accion"])){
    $respuesta = new productos();
    $respuesta -> mostrarproductos();
}
?>