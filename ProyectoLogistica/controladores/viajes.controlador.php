<?php
require_once "../modelo/viajes.modelo.php";

class controladorviajes{

    static public function ctrAgregarViaje($destino, $nombre, $apellido, $licencia){
        $tabla = "viajes";

        $datos = array(
            "destino"  => $destino,
            "nombre"   => $nombre,
            "apellido" => $apellido,
            "licencia" => $licencia
        );

        $respuesta = modeloviajes::mdlAgregarViaje($tabla, $datos);

        return $respuesta;
    }

    static public function ctrMostrarViajes(){
        $tabla = "viajes";
        $respuesta = modeloviajes::mdlMostrarViajes($tabla);
        return $respuesta;
    }
}
?>
