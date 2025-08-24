<?php
class controladorvehiculos{
    static public function ctrmostrarvehiculos(){
        $respuesta = modelovehiculos::mdlmostrarvehiculos();
        return $respuesta;
    }
}
?>