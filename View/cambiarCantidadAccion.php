<?php $title = 'Cambiar Cantidad';
include_once './includes/head.php'; ?>
<?php include_once "./includes/navbar.php"; ?>

<?php
/* mostrarArray($_GET);
    mostrarArray($_SESSION); */
if (isset($_GET["idProd"]) && isset($_GET["cantidadProd"])) {
/*     mostrarArray($_GET);
    mostrarArray($_SESSION); */
/*     echo isset($_GET["id"]);
    echo isset($_GET["cantidad"]); */
    $control = new CarritoControl();
    $param["idProducto"] = $_GET["idProd"];
    $param["cantidadProducto"] = $_GET["cantidadProd"];
    $resp = $control->modificarCantidadProducto($param);
    header('Location: http://localhost/PWD_TPFinal/View/carrito_compra.php');
    exit;
}

?>