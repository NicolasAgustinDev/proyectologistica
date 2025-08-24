<?php
class controladorclientes{
    static public function ctrmostrarclientes(){
        $respuesta = modeloclientes::mdlmostrarclientes();
        return $respuesta;
    }
}
?>