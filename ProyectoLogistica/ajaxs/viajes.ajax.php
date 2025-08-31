<?php
require_once("../controladores/viajes.controlador.php");
require_once("../modelo/viajes.modelo.php");

class Viajes{

    public $destino;
    public $nombre;
    public $apellido;
    public $licencia;

    public function AgregarViaje(){
        $respuesta = controladorviajes::ctrAgregarViaje(
            $this->destino,
            $this->nombre,
            $this->apellido,
            $this->licencia
        );

        echo json_encode($respuesta);
    }
}

if(isset($_POST["destino"])){
    $viaje = new Viajes();
    $viaje->destino  = $_POST["destino"];
    $viaje->nombre   = $_POST["nombre"]; 
    $viaje->apellido = $_POST["apellido"]; 
    $viaje->licencia = $_POST["licencia"];
    $viaje->ajaxAgregarViaje();
}
?>
