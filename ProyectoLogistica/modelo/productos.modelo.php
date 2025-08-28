<?php
require_once "conexion.php";
class modeloproductos{
    static public function mdlmostrarproductos(){
        $st = conexion::conectar() -> prepare("SELECT * FROM productos");
        $st -> execute();
        return $st -> fetchAll(PDO::FETCH_ASSOC);
    }
    static public function mdlagregarproductos($nombre,$descripcion,$stock,$precio){

    }
}
?>