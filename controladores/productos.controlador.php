<?php
require_once "../modelo/productos.modelo.php";
class controladorproductos {
    static public function ctrmostrarproductos(){
        $respuesta = modeloproductos::mdlmostrarproductos();
        return $respuesta;
    }
    static public function ctragregarproductos($producto,$descripcion,$stock,$precio){
        $respuesta = modeloproductos::mdlagregarproductos($producto,$descripcion,$stock,$precio);
        return $respuesta;
    }
    static public function ctrmodificarproductos($id_producto,$producto,$descripcion,$stock,$precio){
        $respuesta = modeloproductos::mdlmodificarproductos($id_producto,$producto,$descripcion,$stock,$precio);
        return $respuesta;
    }
    static public function ctreliminarproductos($id_producto){
        $respuesta = modeloproductos::mdleliminarproductos($id_producto);
        return $respuesta;
    }

}
?>