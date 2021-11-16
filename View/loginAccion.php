<?php include_once "../config.php" ?>

<?php
$control = new LoginControl();
$sesion = $control->logear();
// mostrarArray($sesion);
?>

<?php
if ($sesion != null && $sesion->getObjUsuario() != null) {
  if ($sesion->activa() and !$sesion->getObjUsuario()->getUsDeshabilitado()) {
    echo 1;
    header("Status: 301 Moved Permanently");
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/$PROYECTO/View/paginaSegura.php");
  } elseif ($sesion->getObjUsuario()->getUsDeshabilitado()) {
    echo 2;
    header("Status: 301 Moved Permanently");
    header("Location: " . $LOGIN . "?error=2");
    $sesion->cerrar();
  }
} else {
  echo 3;
  header("Status: 301 Moved Permanently");
  header("Location: " . $LOGIN . "?error=1");
}

?>