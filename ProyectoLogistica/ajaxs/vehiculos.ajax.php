<?php
require_once("../controladores/vehiculos.controlador.php");
require_once("../modelo/vehiculos.modelo.php");
class vehiculos{
    public $id_vehiculo;
    public $patente;
    public $tipo;
    public $capacidad_kg;

    public function mostrarvehiculos(){
        $respuesta = controladorvehiculos::ctrmostrarvehiculos();
        echo json_encode($respuesta);
    }
    public function agregarvehiculos(){
        $respuesta = controladorvehiculos::ctragregarvehiculos($this -> patente,$this -> tipo,$this -> capacidad_kg);
        echo json_encode($respuesta);
    }
    public function modificarvehiculos(){
        $respuesta = controladorvehiculos::ctrmodificarvehiculos($this -> id_vehiculo,$this -> patente,$this -> tipo,$this -> capacidad_kg);
        echo json_encode($respuesta);
    }
    public function eliminarvehiculos(){
        $respuesta = controladorvehiculos::ctreliminarvehiculos($this -> id_vehiculo);
        echo json_encode($respuesta);
    }
}
if(!isset($_POST["accion"])){
    $respuesta = new vehiculos();
    $respuesta -> mostrarvehiculos();
}else{
    if($_POST["accion"]=="registrar"){
        $registrar = new vehiculos();
        $registrar -> patente = $_POST["patente"];
        $registrar -> tipo = $_POST["tipo"];
        $registrar -> capacidad_kg = $_POST["capacidad_kg"];
        $registrar -> agregarvehiculos();
    }
    if($_POST["accion"]=="modificar"){
        $modificar = new vehiculos();
        $modificar -> id_vehiculo = $_POST["id_vehiculo"];
        $modificar -> patente = $_POST["patente"];
        $modificar -> tipo = $_POST["tipo"];
        $modificar -> capacidad_kg = $_POST["capacidad_kg"];
        $modificar -> modificarvehiculos();
    }
    if($_POST["accion"]=="eliminar"){
        $eliminar = new vehiculos();
        $eliminar -> id_vehiculo = $_POST["id_vehiculo"];
        $eliminar -> eliminarvehiculos();

    }
}
?>