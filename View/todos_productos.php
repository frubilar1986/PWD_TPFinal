<?php $title = 'Inicio';
include_once './includes/head.php'; ?>
<?php include_once "./includes/navbar.php"; ?>

<?php
$controlProducto = new AbmProducto();
$arrProductos = $controlProducto->buscar("");
// mostrarArray($arrProductos);
?>

<div id="filter-list" class="mt-3 w-100 d-flex align-items-center justify-content-center">
    <ul class="d-flex w-100 justify-content-center">
        <li class="list lindo-hover active" data-filter="todo">Todo</li>
        <li class="list lindo-hover" data-filter="Motorola">Motorola</li>
        <li class="list lindo-hover" data-filter="LG">LG</li>
        <li class="list lindo-hover" data-filter="TCL">TCL</li>
        <li class="list lindo-hover" data-filter="Nokia">Nokia</li>
        <li class="list lindo-hover" data-filter="Samsung">Samsung</li>
    </ul>
</div>

<div id="seccion-productos" class="container productos d-flex ">
    <div class="container d-flex flex-wrap justify-content-center">
    <?php
    foreach ($arrProductos as $producto) {
        if ($producto->getProCantStock() > 0) {
            $detallesProAct = json_decode($producto->getProDetalle(), true);
            $dirImgAct = md5($producto->getIdProducto());
            $arrImagenesAct = scandir($ROOT . "view/img/Productos/" . $dirImgAct);

    ?>
            <div data-item="<?= $detallesProAct["marca"]?>" class="sombra-caja border item-box m-5 d-flex flex-column align-items-center justify-content-around" style="width: 282px; height: 559px">
                <h5><?= $producto->getProNombre() ?></h5>
                <a href="./producto_pag.php?id=<?=$producto->getIdProducto()?>">
                    <img src="./img/Productos/<?=$dirImgAct.'/'.$arrImagenesAct[2]?>" alt="" style="width: 250px;">
                </a>
                <?php
                        if ($producto->getProPrecioOferta() != null) {
                            echo "<p class='fw-bold'><del>\${$producto->getProPrecio()}</del> <span class='fs-4'>\${$producto->getProPrecioOferta()}</span></p>";
                        } else {
                            echo "<p class='fw-bold fs-4'>\${$producto->getProPrecio()} </p>";
                        }
                        ?>
            </div>
    <?php }
    } ?>
    </div>
<!--     <div class="item-box" data-item="web"><img src="./img/html5.png" alt=""></div>
    <div class="item-box" data-item="web"><img src="./img/css.png" alt=""></div>
    <div class="item-box" data-item="android"><img src="./img/android.png" alt=""></div>
    <div class="item-box" data-item="Motorola"><img src="./img/android.png" alt=""></div> -->

</div>
<?php include_once "./includes/footer.php"; ?>
<script src="./js/filtroCursos.js"></script>