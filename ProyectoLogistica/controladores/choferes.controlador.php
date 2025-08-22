<?php
class controladorchoferes{
    static public function ctrmostrarchoferes(){
        $respuesta = modelochoferes::mdlmostrarchoferes();
        return $respuesta;
    }
}
?>