<?php
    include_once("../../config.php");
    $datos=data_submitted();
    if (isset($datos['usnombre']) && isset($datos['uspass'])){
        $datos['uspass'] = md5($datos['uspass']);
        $abmUsuario = new abmUsuario();
        
        $resp=$abmUsuario->alta($datos);
    }else{
        $resp=false;
        $retorno['msjError']="error al crear usuario";
    }
    $retorno['respuesta']=$resp;
    echo json_encode($retorno);
?>