<?php $title = 'Estado de Compra';
include_once './includes/head.php'; ?>
<?php include_once "./includes/navbar.php"; ?>
<?php
/* Primero saco la/s compra/s con el idusuario */
// mostrarArray($_SESSION);
// echo $precioTotal;

if (isset(data_submitted()["compraexitosa"])) {
    if (data_submitted()["compraexitosa"]) {
?>
        <div class="bg-success text-white">Compra realizada exitosamente</div>
    <?php } else {

    ?>
        <div class="bg-danger text-white">Compra realizada exitosamente</div>

<?php
    }
}





$abmCompra = new AbmCompra();
$datos["idusuario"] = $_SESSION["idusuario"];
$arrCompras = $abmCompra->buscar($datos);
// mostrarArray($arrCompras);
/* Saco los tipo de estado */
$abmEstadoTipo = new AbmCompraEstadoTipo();
$arrEstadoTipo = $abmEstadoTipo->buscar("");
// mostrarArray($arrProductos);
$abmCompraItem = new AbmCompraItem();
?>

<h2 class="container my-5">Estado de Compra</h2>
<div class="container">
    <hr>
</div>
<?php
/* Despues saco el estado de la compra */
foreach ($arrCompras as $compra) {
    $precioTotal = 0;

    $abmCompraEstado = new AbmCompraEstado();
    $paramIdCompra["idcompra"] = $compra->getIdCompra();
    $estado = $abmCompraEstado->buscar($paramIdCompra);
    // mostrarArray($arrEstados);
    $arrItems = $abmCompraItem->buscar($paramIdCompra);
?>
    <div class="container d-flex">
        <div class="w-25">
            <h5>Identificador de Compra: <?= $compra->getIdCompra(); ?></h5>
            <p class="fw-bold">Estado Actual: <?php

                                                $idTipoEstado["idcompraestadotipo"] = $estado[0]->getObjCompraEstTipo()->getIdCompraEstTipo();
                                                $tipoEstado = $abmEstadoTipo->buscar($idTipoEstado);
                                                echo ucfirst($tipoEstado[0]->getCetDescripcion());
                                                ?></p>
            <p>Productos:
                <?php
                foreach ($arrItems as $item) {

                    echo $item->getObjProducto()->getProNombre() . " ({$item->getCiCantidad()})";
                    if (next($arrItems)) {
                        echo ", ";
                    } else echo ".";
                }
                ?>

            </p>
            <p><?php

                if ($item->getObjProducto()->getProPrecioOferta() != null) {
                    echo "Total: $" . $precioTotal += $item->getObjProducto()->getProPrecioOferta() * $item->getCiCantidad();
                } else {
                    echo "Total: $" . $precioTotal += $item->getObjProducto()->getProPrecio() * $item->getCiCantidad();
                } ?></p>

        </div>
        <div class="w-75 progreso">
            <ul class="p-0 ms-5 mt-5 d-flex">
                <div class="estado-1 d-flex flex-column">
                    <p class="mb-3 estado <?php
                                            if ($idTipoEstado["idcompraestadotipo"] == 1) { ?> estado-activo <?php } ?>text-center" style="width: 30px;">1</p>
                    <li class="w-100" style="margin: 0 120px 0 0"><?= ucfirst($arrEstadoTipo[0]->getCetDescripcion()); ?></li>
                </div>
                <div class="estado-1">
                    <p class="mb-3 estado <?php
                                            if ($idTipoEstado["idcompraestadotipo"] == 2) { ?> estado-activo <?php } ?>text-center" style="width: 30px;">2</p>
                    <li class="w-100" style="margin: 0 120px 0 0"><?= ucfirst($arrEstadoTipo[1]->getCetDescripcion()); ?></li>
                </div>
                <div class="estado-1">
                    <p class="mb-3 estado <?php
                                            if ($idTipoEstado["idcompraestadotipo"] == 3) { ?>  <?php } ?>text-center" style="width: 30px;">3</p>
                    <li class="w-100" style="margin: 0 120px 0 0"><?= ucfirst($arrEstadoTipo[2]->getCetDescripcion()); ?></li>
                </div>
                <div class="estado-1">
                    <p class="mb-3 estado <?php
                                            if ($idTipoEstado["idcompraestadotipo"] == 4) { ?> bg-danger <?php } ?>text-center" style="width: 30px;">4</p>
                    <li class="w-100" style="margin: 0 120px 0 0"><?= ucfirst($arrEstadoTipo[3]->getCetDescripcion()); ?></li>
                </div>


            </ul>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <form method="POST" action="./cancelarCompraAccion.php">
                <input class="" style="display: none;" type="number" name="idcompracancelar" for="idcompracancelar" value='<?= $compra->getIdCompra() ?>'>
                <button class="btn btn-danger" type="submit" <?php if ($idTipoEstado["idcompraestadotipo"] == 4) { ?> disabled <?php } ?>>Cancelar Compra</button>
            </form>
        </div>
    </div>

<?php
} ?>
<div class="container" style="margin-top: 100px;">
    <hr>
</div>

<?php include_once "./includes/footer.php"; ?>