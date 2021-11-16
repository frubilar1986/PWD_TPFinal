<?php

header('Content-Type: text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate ");

/////////////////////////////
// CONFIGURACION APP//
/////////////////////////////

$PROYECTO = 'TPFinal-PWD';

//variable que almacena el directorio del proyecto
$ROOT = $_SERVER['DOCUMENT_ROOT'] . "/$PROYECTO/";
$LOGIN = "login.php";
$INICIO = "todos_productos.php";

include_once($ROOT . 'Util/funciones.php');

$GLOBALS['ROOT'] = $ROOT;

$sesion = new Session();

