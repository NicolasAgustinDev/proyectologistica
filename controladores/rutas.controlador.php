<?php
require_once "../modelo/rutas.modelo.php";
class controladorrutas{
    static public function ctrmostrarrutas(){
        $respuesta = modelorutas::mdlrutas();
        return $respuesta;
    }
}

?>