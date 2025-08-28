<?php
require_once "conexion.php";
class modelorutas{
    static public function mdlrutas(){
        $st = conexion::conectar() -> prepare("SELECT id_ruta, ruta FROM  rutas");
        $st -> execute();
        return $st -> fetchAll(PDO::FETCH_ASSOC);
    }
}
?>