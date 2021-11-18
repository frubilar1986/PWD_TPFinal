<?php
include_once '../config.php';

$title = 'Busqueda';
include_once './includes/head.php';
include_once "./includes/navbar.php";

$ambProducto = new AbmProducto();

$control = new NuevoCelularControl();
$data = $control->procesarData();


if ($ambProducto->alta($data)) {
  $producto = $ambProducto->buscar(['pronombre' => $data['pronombre']])[0];
  $control->guardarImagenes($producto->getIdProducto());
?>
  <div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Modificacion correcta</h4>
    <a class="btn btn-primary" href="./producto_pag.php?id=<?= $producto->getIdProducto() ?>&nombrecel=<?= $producto->getProNombre() ?>" role="button">Ver Producto</a>
  </div>
<?php } else { ?>

  <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">No se puedo agregar el celular, revisar los datos ingresados</h4>
  </div>
<?php } ?>

<div class="text-center mt-5">
  <a class='btn btn-primary' href="nuevoCelular.php" role='button'>Agregar otro celular</a>
</div>

<?php


include_once "./includes/footer.php";
