<?php
require_once "conexion.php";
class modelovehiculos{
    static public function mdlmostrarvehiculos(){
        $st = conexion::conectar() -> prepare("SELECT * FROM vehiculos");
        $st -> execute();
        return $st -> fetchAll(PDO::FETCH_ASSOC);
    }
    static public function mdlagregarvehiculos($patente,$tipo,$capacidad_kg){
        $st = conexion::conectar() -> prepare("INSERT INTO vehiculos (patente,tipo,capacidad_kg) VALUES(:patente,:tipo,:capacidad_kg)");
        $st -> bindParam(":patente",$patente,PDO::PARAM_STR);
        $st -> bindParam(":tipo",$tipo,PDO::PARAM_STR);
        $st -> bindParam(":capacidad_kg",$capacidad_kg,PDO::PARAM_INT);

        if($st -> execute()){
            echo("El vehiculo fue ingresado correctamente");

        }else{
            echo("El vehiculo no fue ingresado correctamente");
        }
    }

    static public function mdlmodificarvehiculos($id_vehiculo,$patente,$tipo,$capacidad_kg){
        $st = conexion::conectar() -> prepare("UPDATE vehiculos SET patente = :patente,tipo = :tipo,capacidad_kg = :capacidad_kg WHERE id_vehiculo = :id_vehiculo");
        $st -> bindParam(":id_vehiculo",$id_vehiculo,PDO::PARAM_INT);
        $st -> bindParam(":patente",$patente,PDO::PARAM_STR);
        $st -> bindParam(":tipo",$tipo,PDO::PARAM_STR);
        $st -> bindParam(":capacidad_kg",$capacidad_kg,PDO::PARAM_INT);

        if($st -> execute()){
            echo("El vehiculo fue modificado correctamente");

        }else{
            echo("El vehiculo no fue modificado correctamente");
        }
    }
    static public function mdleliminarvehiculos($id_vehiculo){
        $st = conexion::conectar() -> prepare("DELETE FROM vehiculos WHERE id_vehiculo=:id_vehiculo");
        $st -> bindParam(":id_vehiculo",$id_vehiculo,PDO::PARAM_INT);
        if($st -> execute()){
            echo("El vehiculo fue eliminado correctamente");
        }else{
            echo("El vehiculo no fue eliminado correctamente");
        }



    }
}

?>