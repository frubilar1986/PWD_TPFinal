<?php $title = 'Eliminar Producto del Carrito';
include_once './includes/head.php'; ?>

<?php
if (isset($_GET["id"])) {
    $control = new CarritoControl();
    $param["idProducto"] = $_GET["id"];
    $resp = $control->eliminarProducto($param);
    header('Location: http://localhost/PWD_TPFinal/View/carrito_compra.php');
    exit;
}

?>
