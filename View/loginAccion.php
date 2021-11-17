<?php include_once "../config.php" ?>

<?php
$control = new LoginControl();
$sesion = $control->logear();
// mostrarArray($sesion);
?>

<?php
if ($sesion != null && $sesion->getObjUsuario() != null) {
  if ($sesion->activa() and !$sesion->getObjUsuario()->getUsDeshabilitado()) {
    // echo "sesion activa y usuario no deshabilitado";
    header("Status: 301 Moved Permanently");
    header("Location: $INICIO");
  } elseif ($sesion->getObjUsuario()->getUsDeshabilitado()) {
    // echo "sesion activa y usuario deshabilitado";
    header("Status: 301 Moved Permanently");
    header("Location: " . $LOGIN . "?error=2");
    $sesion->cerrar();
  }
} else {
  // echo "la contrase o usuario no coinciden";
  header("Status: 301 Moved Permanently");
  header("Location: " . $LOGIN . "?error=1");
}

?>