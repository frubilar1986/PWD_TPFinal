<?php $title = 'Inicio';
include_once './includes/head.php'; ?>
<?php include_once "./includes/navbar.php"; ?>

<?php
$controlProducto = new AbmProducto();
$arrProductos = $controlProducto->buscar("");
?>

<div class="container mb-5">
  <h2 class="mt-5">Tienda DDR</h2>
  <h4 class="">Somos una tienda online de venta de celulares, con grandes ofertas y descuentos.</h4>
  <p>Para contactarte con nosotros, podes hacerlo con nuestro email (tienda@ddr.com) o con nuestro telefono: +54 (299) 5748291</p>
</div>

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

<div id="seccion-productos" class="container productos d-flex flex-wrap">
  <div class="container d-flex flex-wrap justify-content-center">
    <?php
    $soyAdmin = true;
    if ($soyAdmin) {

    ?>
      <div class="sombra-caja border item-box m-5 d-flex flex-column align-items-center justify-content-center" style="width: 282px; height: 559px">
        <h5 class="mb-5">Agregar Celular</h5>
        <a href="./nuevoProducto.php">
          <i class="bi bi-plus-circle" style="font-size: 8rem;"></i>
        </a>
      <?php } ?>
      </div>
      <?php
      foreach ($arrProductos as $producto) {
        if (($producto->getProCantStock() >= 0 && $soyAdmin) ||  $producto->getProCantStock() > 0) {
          $detallesProAct = json_decode($producto->getProDetalle(), true);
          $dirImgAct = md5($producto->getIdProducto());
          $arrImagenesAct = scandir("{$ROOT}View/img/Productos/{$dirImgAct}");

      ?>
          <div data-item="<?= $detallesProAct["marca"] ?>" class="sombra-caja border item-box m-5 py-4 d-flex flex-column align-items-center justify-content-around" style="width: 282px; height: 559px">
            <h3><?= $producto->getProNombre() ?></h3>
            <a href="./producto_pag.php?id=<?= $producto->getIdProducto() ?>&nombrecel=<?= $producto->getProNombre() ?>">
              <img src="./img/Productos/<?= "{$dirImgAct}/{$arrImagenesAct[2]}" ?>" alt="" style="width: 250px;">
            </a>
            <?php
            if ($producto->getProCantStock() == 0) { ?>
              <p class='fw-bold text-danger'>Producto sin stock</span></p>
            <?php } else if ($producto->getProPrecioOferta() != null) { ?>
              <p class="text-nowrap">
                <span class='text-muted text-decoration-line-through'>$<?= $producto->getProPrecio() ?></span>
                <span class='fs-4'>$<?= $producto->getProPrecioOferta() ?></span>
              </p>
            <?php } else { ?>
              <p class='fs-4'>$<?= $producto->getProPrecio() ?> </p>
            <?php } ?>

            <?php if ($soyAdmin) { ?>
              <div class="d-flex">
                <a href="./producto_pag.php?id=<?= $producto->getIdProducto() ?>" class="  btn btn-primary mx-1 mb-2">Editar</a>
                <a href="./producto_pag.php?id=<?= $producto->getIdProducto() ?>" class=" btn btn-danger mx-1 mb-2">Eliminar</a>
              </div>
            <?php } ?>
          </div>
      <?php }
      } ?>
  </div>
</div>
<?php include_once "./includes/footer.php"; ?>
<script src="./js/filtroCursos.js"></script>