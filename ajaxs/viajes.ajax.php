<?php
require_once("../controladores/viajes.controlador.php");
require_once("../modelo/viajes.modelo.php");

class Viajes{
    public $id_viaje;
    public $id_ruta;
    public $id_vehiculo;
    public $id_chofer;
    public $fecha_salida;
    public $fecha_llegada;
    public $observaciones;
    public $id_pedido;

    public function mostrarpedidos(){
        $respuesta = controladorviajes::ctrmostrarpedidos();
        echo json_encode($respuesta);
    }
    public function agregarviaje(){
        $respuesta = controladorviajes::ctrviajes($this -> id_ruta,$this -> id_vehiculo,$this -> id_chofer,$this -> fecha_salida);
        echo json_encode($respuesta);
    }
    public function agregardetalleviaje(){
        $respuesta = controladorviajes::ctrdetalleviaje($this -> id_viaje,$this -> id_pedido);
        echo json_encode($respuesta);
    }
}

if($_SERVER["REQUEST_METHOD"] === "GET"){
    $respuesta = new Viajes;
    $respuesta-> mostrarpedidos();
    exit;
}
// ✅ Si la solicitud es POST (crear o detallar viaje)
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_GET["detalle"]) && $_GET["detalle"] == 1) {
        $guardar = new Viajes;
        $guardar->id_viaje = $_POST["id_viaje"];
        $guardar->id_pedido = $_POST["id_pedido"];
        $guardar->agregardetalleviaje();

    } else {
        // 🚀 Validar que las claves existan
        $guardar = new Viajes;
        $guardar->id_ruta = $_POST["id_ruta"] ?? null;
        $guardar->id_vehiculo = $_POST["id_vehiculo"] ?? null;
        $guardar->id_chofer = $_POST["id_chofer"] ?? null;
        $guardar->fecha_salida = $_POST["fecha_salida"] ?? null;

        // 🚨 Si falta alguno, no intentes insertarlo
        if (!$guardar->id_ruta || !$guardar->id_vehiculo || !$guardar->id_chofer || !$guardar->fecha_salida) {
            echo json_encode(["error" => "Faltan datos para crear el viaje"]);
            exit;
        }

        $guardar->agregarviaje();
    }
}
?>
