<?php
require_once("../controladores/viajes.controlador.php");
require_once("../modelo/viajes.modelo.php");

class AjaxViajes{

    public $destino;
    public $carga;
    public $cliente;
    public $fecha_salida;

    public function ajaxAgregarViaje(){
        $respuesta = controladorviajes::ctrAgregarViaje(
            $this->destino,
            $this->carga,
            $this->cliente,
            $this->fecha_salida
        );

        echo json_encode($respuesta);
    }
}

if(isset($_POST["destino"])){
    $viaje = new AjaxViajes();
    $viaje->destino  = $_POST["destino"];
    $viaje->carga   = $_POST["carga"]; 
    $viaje->cliente = $_POST["cliente"]; 
    $viaje->fecha_salida = $_POST["fecha_salida"];
    $viaje->ajaxAgregarViaje();
}
?>
