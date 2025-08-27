<?php
require_once "../modelo/vehiculos.modelo.php";
class controladorvehiculos{
    static public function ctrmostrarvehiculos(){
        $respuesta = modelovehiculos::mdlmostrarvehiculos();
        return $respuesta;
    }
    static public function ctragregarvehiculos($patente,$tipo,$capacidad_kg){
        $respuesta = modelovehiculos::mdlagregarvehiculos($patente,$tipo,$capacidad_kg);
        return $respuesta;
    }
    static public function ctrmodificarvehiculos($id_vehiculo,$patente,$tipo,$capacidad_kg){
        $respuesta = modelovehiculos::mdlmodificarvehiculos($id_vehiculo,$patente,$tipo,$capacidad_kg);
        return $respuesta;
    }
    static public function ctreliminarvehiculos($id_vehiculo){
        $respuesta = modelovehiculos::mdleliminarvehiculos($id_vehiculo);
        return $respuesta;
    }
}
?>