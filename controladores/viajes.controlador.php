<?php
require_once "../modelo/viajes.modelo.php";

class controladorviajes{
    static public function ctrmostrarpedidos(){
        $respuesta = modeloviajes::mdlmostrarpedidos();
        return $respuesta;
    }
    static public function ctrviajes($id_ruta,$id_vehiculo,$id_chofer,$fecha_salida){
        $respuesta = modeloviajes::mdlagregarviaje($id_ruta,$id_vehiculo,$id_chofer,$fecha_salida);
        return $respuesta;
    }
    static public function ctrdetalleviaje($id_viaje,$id_pedido){
        $respuesta = modeloviajes::mdlagregardetalleviaje($id_viaje,$id_pedido);
        return $respuesta; 
    }
}
?>
