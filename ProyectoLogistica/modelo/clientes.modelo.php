<?php
require_once "conexion.php";
class modeloclientes{
    static public function mdlmostrarclientes(){
        $st = conexion::conectar() -> prepare("SELECT * FROM clientes");
        $st -> execute();
        return $st -> fetchAll(PDO::FETCH_ASSOC);
    }
}

?>