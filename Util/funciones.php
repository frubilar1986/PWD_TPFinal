
<?php
/* Funcion que submite al arreglo get o post y lo coloca en un arreglo
asociativo; Util para que el proyecto no dependa de si es post o get */
 function datos_submitidos(){
    // echo " dentro de datos_submitidos ";
    $arreglo = array();
    if (!empty($_POST)) { //si No esta vacio en method post
        // code...
       // print_r($_POST);
        $arreglo = $_POST;
    }elseif(!empty($_GET)){ 
        $arreglo = $_GET;
    }
    if (count($arreglo)) {
        // code... si existen campos vacios, carga null en el arreglo asoci
        foreach($arreglo as $clave => $valor){
            if ($valor == "") {               
                $arreglo[$clave] = 'null';
                //echo "hay null";
            }
        }
    }
   // print_r($arreglo);
    return $arreglo; 
}
/***
 * Establecer zona horaria argentina para carga en BD
 */
ini_set("date.timezone", "America/Argentina/Buenos_Aires");


/**
 * Funcion para mostrar de forma estructurada un arreglo 
 * @param array
 */
 function mostrarArray($arreglo){
    echo "<pre>";
    print_r($arreglo);
    echo "</pre>";
}

/* Funcion para poner a disponibilidad los objetos dentro del proyecto */

spl_autoload_register(function($clase){
    //echo "carga de de clase ".$clase."<br>";
    $directorios = array(
        $GLOBALS['ROOT'].'modelo/',
       // $GLOBALS['ROOT'].'modelo/ejemplo/', //omr para ejercicio PDO ejemplo
        $GLOBALS['ROOT'].'control/',
       
    );

  
        
    //print_r($directorios);
    foreach($directorios as $directorio){
        if(file_exists($directorio.$clase.".php")){
            //echo "aqui se incluye" .$directorio.$clase .".php";
            require_once($directorio.$clase.".php");
            
           // include_once($directorio.$clase.".php");
            return;
        }
    }

})
?>