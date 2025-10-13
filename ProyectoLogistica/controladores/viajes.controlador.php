<?php
require_once "../modelo/viajes.modelo.php";

class ControladorViajes{

    static public function ctrAgregarViaje($destino, $carga, $cliente, $fecha_salida){
        $tabla = "viajes";

        $datos = [
            "destino"  => $destino,
            "carga"   => $carga,
            "cliente" => $cliente,
            "fecha_salida" => $fecha_salida
        ];

        $respuesta = ModeloViajes::ModeloAgregarViaje($tabla, $datos);

        return $respuesta;
    }
}

 
?>
