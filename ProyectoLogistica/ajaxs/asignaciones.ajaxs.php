<?php
require_once "../controladores/asignaciones.controlador.php";
require_once("../modelo/asignaciones.modelo.php");

class AjaxAsignaciones {
    public $id_viaje;
    public $nombre;
    public $apellido;
    public $licencia;
    public $patente;
    public $fecha_asignada;
     

    public function ajaxAgregarAsignacion() {
        $respuesta = ControladorAsignaciones::ctrAgregarAsignacion(
            $this->id_viaje,
            $this->nombre,
            $this->apellido,
            $this->licencia,
            $this->patente,
            $this->fecha_asignada
           
        );
        echo json_encode($respuesta);
    }
}

if (isset($_POST["id_viaje"])) {
    $asig = new AjaxAsignaciones();
    $asig->id_viaje = $_POST["id_viaje"];
    $asig->nombre = $_POST["nombre"];
    $asig->apellido = $_POST["apellido"];
    $asig->licencia = $_POST["licencia"];
    $asig->patente = $_POST["patente"];
    $asig->fecha_asignada = $_POST["fecha_asignada"];
    
    
    

    $asig->ajaxAgregarAsignacion();
    header('Content-Type: application/json');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

}
?>
