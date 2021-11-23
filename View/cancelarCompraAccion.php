<?php $title = 'Estado de Compra';
include_once './includes/head.php'; ?>
<?php include_once "./includes/navbar.php"; ?>

<?php
// mostrarArray($_POST);
$resp = false;
// mostrarArray(data_submitted());
$abmCompraEstado = new AbmCompraEstado();
$paramIdCompra["idcompra"] = data_submitted()["idcompracancelar"];
$compraEstado = $abmCompraEstado->buscar($paramIdCompra)[0];

$datos = [
    "idcompraestado" => $compraEstado->getIdCompraEstado(),
    "idcompra" => $_POST["idcompracancelar"],
    "idcompraestadotipo" => 4,
    "cefechaini" => $compraEstado->getCeFechaIni(),
    "cefechafin" =>  fecha(),
];

$resp = $abmCompraEstado->modificacion($datos);
header('Location: http://localhost/PWD_TPFinal/View/estado_compra.php');

// echo $resp;
// mostrarArray(($compraEstado));
?>