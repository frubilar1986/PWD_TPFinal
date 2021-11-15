<?php $title = 'Celulares Nokia';
include_once './includes/head.php'; ?>
<?php include_once "./includes/navbar.php"; ?>

<?php
$controlProducto = new AbmProducto();
$arrProductos = $controlProducto->buscar("");
// mostrarArray($arrProductos);
?>



<div id="seccion-productos" class="container productos d-flex ">
    <div class="container d-flex flex-wrap justify-content-center">
    <?php
    foreach ($arrProductos as $producto) {
        if ($producto->getProCantStock() > 0) {
            $detallesProAct = json_decode($producto->getProDetalle(), true);
            if($detallesProAct["marca"] == "Nokia") {

            
            $dirImgAct = md5($producto->getIdProducto());
            $arrImagenesAct = scandir($ROOT . "view/img/Productos/" . $dirImgAct);

    ?>
            <div data-item="<?= $detallesProAct["marca"]?>" class="sombra-caja border item-box m-5 d-flex flex-column align-items-center justify-content-around" style="width: 282px; height: 559px">
                <h5><?= $producto->getProNombre() ?></h5>
                <a href="./producto_pag.php?id=<?=$producto->getIdProducto()?>">
                    <img src="./img/Productos/<?=$dirImgAct.'/'.$arrImagenesAct[2]?>" alt="" style="width: 250px;">
                </a>
                <h5>$<?= $producto->getProPrecio() ?></h5>
            </div>
    <?php }}
    } ?>
    </div>
<!--     <div class="item-box" data-item="web"><img src="./img/html5.png" alt=""></div>
    <div class="item-box" data-item="web"><img src="./img/css.png" alt=""></div>
    <div class="item-box" data-item="android"><img src="./img/android.png" alt=""></div>
    <div class="item-box" data-item="Motorola"><img src="./img/android.png" alt=""></div> -->

</div>
<?php include_once "./includes/footer.php"; ?>
<script src="./js/filtroCursos.js"></script>