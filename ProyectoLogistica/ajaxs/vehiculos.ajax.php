<?php
require_once("../controladores/vehiculos.controlador.php");
require_once("../modelo/vehiculos.modelo.php");
class vehiculos{
    public $id;
    public $patente;
    public $tipo;
    public $capacidad_kg;

    public function mostrarvehiculos(){
        $respuesta = controladorvehiculos::ctrmostrarvehiculos();
        echo json_encode($respuesta);
    }
}
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $respuesta = new vehiculos();
    $respuesta -> mostrarvehiculos();
}
?>