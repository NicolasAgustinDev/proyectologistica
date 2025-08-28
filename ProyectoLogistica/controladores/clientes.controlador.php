<?php
class controladorclientes{
    static public function ctrmostrarclientes(){
        $respuesta = modeloclientes::mdlmostrarclientes();
        return $respuesta;
    }
    static public function ctragregarclientes($nombre,$direccion,$telefono,$id_ruta){
        $respuesta = modeloclientes::mdlagregarclientes($nombre,$direccion,$telefono,$id_ruta);
        return $respuesta;
    }
    static public function ctrmodificarclientes($id_cliente,$nombre,$direccion,$telefono,$id_ruta){
        $respuesta = modeloclientes::mdlmodificarclientes($id_cliente,$nombre,$direccion,$telefono,$id_ruta);
        return $respuesta;
    }
    static public function ctreliminarclientes($id_cliente){
        $respuesta = modeloclientes::mdleliminarclientes($id_cliente);
        return $respuesta;
    }
}
?>