<?php
include_once '../config.php';

$title = 'Busqueda';
include_once './includes/head.php';
include_once "./includes/navbar.php";

$ambProducto = new AbmProducto();

$control = new NuevoProductoControl();
$data = $control->procesarData();
$exito = $control->agregarProducto($data);


if ($exito === true) {
  $producto = $ambProducto->buscar(['pronombre' => $data['pronombre']])[0];
  $control->guardarImagenes($producto->getIdProducto());
?>
  <div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Se agregó el producto</h4>
    <a class="btn btn-primary" href="./producto_pag.php?id=<?= $producto->getIdProducto() ?>&nombrecel=<?= $producto->getProNombre() ?>" role="button">Ver Producto</a>
  </div>

<?php } elseif ($exito !== false) { ?>
  <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading"><?= $exito ?></h4>
  </div>
<?php } else { ?>
  <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">No se puedo agregar el producto, revisar los datos ingresados</h4>
  </div>
<?php } ?>

<div class="text-center mt-5">
  <a class='btn btn-primary' href="nuevoProducto.php" role='button'>Agregar otro producto</a>
</div>



<?php include_once "./includes/footer.php";
