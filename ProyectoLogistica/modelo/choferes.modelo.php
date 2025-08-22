<?php
require_once "conexion.php";
class modelochoferes{
    static public function mdlmostrarchoferes(){
        $st = conexion::conectar() -> prepare("SELECT *FROM choferes");
        $st -> execute();
        return $st -> fetchAll(PDO::FETCH_ASSOC);
    }
}

?>