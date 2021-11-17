<?php $title = 'Busqueda';
include_once './includes/head.php'; ?>
<?php include_once "./includes/navbar.php"; ?>

<?php
$arr = [];
$data = data_submitted();
$nombre["busqueda"] = $data["busqueda"];
// mostrarArray($data);

$objAbmProducto = new AbmProducto();
$arr = $objAbmProducto->buscar($nombre);

/* $sql = "SELECT * FROM producto";
if ($data != "") {
    $sql .= " WHERE pronombre LIKE '%{$data["busqueda"]}%'";
}
// echo $sql;
$res = $base->Ejecutar($sql);
if ($res > -1) {
    if ($res > 0) {
        while ($row = $base->Registro()) {
            $obj = new Producto();

            $obj->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock'], $row['proprecio'], $row['propreciooferta']);

            array_push($arr, $obj);
        }
    }
} */
// mostrarArray($arr);
if($arr != null) {
?>

<div id="seccion-productos" class="container productos d-flex ">
    <div class="container d-flex flex-wrap justify-content-center">
        <?php
        foreach ($arr as $producto) {
            if ($producto->getProCantStock() > 0) {
                $detallesProAct = json_decode($producto->getProDetalle(), true);
                $dirImgAct = md5($producto->getIdProducto());
                $arrImagenesAct = scandir($ROOT . "view/img/Productos/" . $dirImgAct);

        ?>
                <div data-item="<?= $detallesProAct["marca"] ?>" class="sombra-caja border item-box m-5 d-flex flex-column align-items-center justify-content-around" style="width: 282px; height: 559px">
                    <h5><?= $producto->getProNombre() ?></h5>
                    <a href="./producto_pag.php?id=<?= $producto->getIdProducto() ?>&nombrecel=<?= $producto->getProNombre() ?>">
                        <img src="./img/Productos/<?= $dirImgAct . '/' . $arrImagenesAct[2] ?>" alt="" style="width: 250px;">
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
<?php } else {
    echo "<p class='container fs-3 mt-5 mb-0'>No se encontro el celular buscado.</p>";
    } ?>
<?php include_once "./includes/footer.php"; ?>