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
}
?>