<?php
require_once "conexion.php";
class modelovehiculos{
    static public function mdlmostrarvehiculos(){
        $st = conexion::conectar() -> prepare("SELECT * FROM vehiculos");
        $st -> execute();
        return $st -> fetchAll(PDO::FETCH_ASSOC);
    }
}

?>