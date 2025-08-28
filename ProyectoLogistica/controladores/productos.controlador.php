<?php
require_once "../modelo/productos.modelo.php";
class controladorproductos {
    static public function ctrmostrarproductos(){
        $respuesta = modeloproductos::mdlmostrarproductos();
        return $respuesta;
    }
    static public function ctragregarproductos(){
        $respuesta = modeloproductos::mdlagregarproductos();
        return $respuesta;
    }
}
?>