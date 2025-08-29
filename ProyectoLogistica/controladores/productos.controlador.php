<?php
require_once "../modelo/productos.modelo.php";
class controladorproductos {
    static public function ctrmostrarproductos(){
        $respuesta = modeloproductos::mdlmostrarproductos();
        return $respuesta;
    }
    static public function ctragregarproductos($nombre,$direccion,$telefono,$id_ruta){
        $respuesta = modeloproductos::mdlagregarproductos($nombre,$direccion,$telefono,$id_ruta);
        return $respuesta;
    }
    static public function ctrmodificarproductos($id_producto,$nombre,$direccion,$telefono,$id_ruta){
        $respuesta = modeloproductos::mdlmodificarproductos($id_producto,$nombre,$direccion,$telefono,$id_ruta);
        return $respuesta;
    }
    static public function ctreliminarproductos($id_producto){
        $respuesta = modeloproductos::mdleliminarproductos($id_producto);
        return $respuesta;
    }

}
?>