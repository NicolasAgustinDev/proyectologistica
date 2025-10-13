<?php
require_once "../modelo/asignaciones.modelo.php";

class ControladorAsignaciones {

    static public function ctrAgregarAsignacion($id_viaje, $nombre, $apellido, $licencia, $patente, $fecha_asignada ) {
        $tabla = "asignaciones";
        $datos = [
            "id_viaje" => $id_viaje,
            "nombre_chofer" => $nombre,
            "apellido_chofer" => $apellido,
            "licencia" => $licencia,
            "patente" => $patente,
            "fecha_asignada"=>$fecha_asignada
            
        ];
        return MdlAsignaciones::mdlAgregarAsignacion($tabla, $datos);
    }

    static public function ctrMostrarAsignaciones() {
        return MdlAsignaciones::mdlMostrarAsignaciones("asignaciones");
    }
}
?>
