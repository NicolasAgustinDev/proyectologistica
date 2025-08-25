<?php
require_once "conexion.php";
class modelochoferes{
    static public function mdlmostrarchoferes(){
        $st = conexion::conectar() -> prepare("SELECT *FROM choferes");
        $st -> execute();
        return $st -> fetchAll(PDO::FETCH_ASSOC);
    }

    static public function mdlagregarchoferes($nombre,$apellido,$telefono,$licencia){
        $st = conexion::conectar() -> prepare("INSERT INTO choferes(nombre,apellido,telefono,licencia)VALUES(:nombre,:apellido,:telefono,:licencia)");
        $st -> bindParam(":nombre",$nombre,PDO::PARAM_STR); 
        $st -> bindParam(":apellido",$apellido,PDO::PARAM_STR); 
        $st -> bindParam(":telefono",$telefono,PDO::PARAM_INT); 
        $st -> bindParam(":licencia",$licencia,PDO::PARAM_STR); 

        if($st -> execute()){
            echo "El chofer fue ingresado correctamente";
        }else{
            echo "El chofer no se pudo ingresar";
        }
    }
    static public function mdlmodificarchoferes($id_chofer,$nombre,$apellido,$telefono,$licencia){
        $st = conexion::conectar() -> prepare("UPDATE choferes SET nombre=:nombre ,apellido=:apellido,telefono=:telefono,licencia=:licencia WHERE id_chofer=:id_chofer");
        $st -> bindParam(":id_chofer",$id_chofer,PDO::PARAM_INT);
        $st -> bindParam(":nombre",$nombre,PDO::PARAM_STR); 
        $st -> bindParam(":apellido",$apellido,PDO::PARAM_STR); 
        $st -> bindParam(":telefono",$telefono,PDO::PARAM_INT); 
        $st -> bindParam(":licencia",$licencia,PDO::PARAM_STR); 

        if($st -> execute()){
            echo "El chofer fue actualizado correctamente";
        }else{
            echo "El chofer no se pudo actualizar";
        }
    }
}

?>