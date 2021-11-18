<?php
if (array_key_exists("nombrecel", $_GET)) {
  $title =  $_GET["nombrecel"];
} else $title = "Celular";
include_once './includes/head.php'; ?>
<?php include_once "./includes/navbar.php"; ?>

<?php
$controlProducto = new AbmProducto();

if (array_key_exists("id", $_GET) && $_GET["id"] != null) {
  $param["idproducto"] = $_GET["id"];
  $producto = $controlProducto->buscar($param);

  $detallesPro = json_decode($producto[0]->getProDetalle(), true);
  $dirImg = md5($_GET["id"]);
  $arrImagenes = scandir($ROOT . "view/img/Productos/" . $dirImg);
?>

  <div id="contenido-principal" class="container mt-5 d-flex border">
    <div class="w-100 m-3">
      <div id="producto" class="w-75 me-5">
        <p>Celulares <?= $detallesPro["marca"]; ?> <span class="text-black-50">/</span> <?= $producto[0]->getProNombre() ?> </p>
        <div class="d-flex w-100">
          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="width: 250px; height: 366px">

            <div class="carousel-inner active">
              <!-- CARGO PRIMER IMAGEN "MANUALMENTE" PARA QUE TENGA LA CLASE ACTIVE -->
              <div class="carousel-item active">
                <img src="./img/Productos/<?= $dirImg . '/' . $arrImagenes[2] ?>" class="d-block w-100" alt="">
              </div>
              <?php
              /* HAGO UN DO WHILE QUE RECORRA TODO EL DIR DE IMAGENES Y LAS USE TODAS */
              $i = 3;
              do {
              ?>
                <div class="carousel-item">
                  <img src="./img/Productos/<?= $dirImg . '/' . $arrImagenes[$i] ?>" class="d-block w-100" alt="">
                </div>
              <?php
                $i++;
              } while ($i < count($arrImagenes));
              ?>
            </div>

            <div class="carousel-indicators mt-4" style="position: relative; ">
              <?php
              $j = 2;
              do {
              ?>

                <img data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $j - 2 ?>" class="active border px-2" aria-current="true" aria-label="Slide <?= $j - 1 ?>" src="./img/Productos/<?= $dirImg . '/' . $arrImagenes[$j] ?>" alt="" style="width: 53px; height: 82px;">

              <?php
                $j++;
              } while ($j < count($arrImagenes));
              ?>

            </div>
          </div>
          <div id="informacion-producto" class="ms-5 d-flex flex-column justify-content-start align-items-start ">
            <div id="informacion" class="w-50">
              <h4><?= $producto[0]->getProNombre() ?></h4>
              <!-- PRECIO PRODUCTO -->
              <?php
              if ($producto[0]->getProPrecioOferta() != null) {
                echo "<p class='fw-bold'><del>\${$producto[0]->getProPrecio()}</del> <span class='fs-4'>\${$producto[0]->getProPrecioOferta()}</span></p>";
              } else {
                echo "<p class='fw-bold fs-4'>\${$producto[0]->getProPrecio()} </p>";
              }
              ?>
              <div class="d-flex">
                <p class="me-5 text-success"><i class="fas fa-check fa-xs text-success"></i> Envio Gratis</p>
                <!-- ¿HAY STOCK? -->
                <?php
                if ($producto[0]->getProCantStock() > 0) {
                  echo '<p class="text-success"><i class="fas fa-check fa-xs text-success"></i> Hay stock </p>';
                } else {
                  echo '<p class="text-danger"><i class="fas fa-times fa-xs text-danger"></i> No hay stock </p>';
                }

                ?>
              </div>
              <a class="btn btn-primary mt-4" href="carrito_compra.php?id=<?= $producto[0]->getIdProducto(); ?>" role="button">Agregar al Carrito</a>
              <hr>
            </div>
            <div id="producto-descripcion" class="my-5 w-100">
              <div>
                <p class="uppercase">Descripción</p>
                <p><?= $detallesPro["desc1"]; ?></p>
                <p><?= $detallesPro["desc2"]; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container border" style="margin-top: 100px;">
        <div id="caracteristicas-tecnicas" class="m-3">
          <h4>Caracteristicas Técnicas</h4>
          <hr />
          <div class="d-flex">
            <div class="general d-flex flex-column" style="width: 40%;">
              <div id="camara-info" class="d-flex border align-items-center my-2">
                <img src="./img/camara.png" alt="" class="fondo-desc-color p-2">
                <div class="ms-3">
                  <p class="m-0">Cámara principal</p>
                  <p class="m-0 fw-bold"><?= $detallesPro["Camara principal"]; ?></p>
                </div>
              </div>
              <div id="display-info" class="d-flex border align-items-center my-2">
                <img src="./img/display.png" alt="" class="fondo-desc-color p-2">
                <div class="ms-3">
                  <p class="m-0">Display</p>
                  <p class="m-0 fw-bold"><?= $detallesPro["Display"]; ?></p>
                </div>
              </div>
              <div id="procesador-info" class="d-flex border align-items-center my-2">
                <img src="./img/procesador.png" alt="" class="fondo-desc-color p-2">
                <div class="ms-3">
                  <p class="m-0">Procesador</p>
                  <p class="m-0 fw-bold"><?= $detallesPro["Procesador"]; ?></p>
                </div>
              </div>
              <div id="liberado-info" class="d-flex border align-items-center my-2">
                <img src="./img/liberado.png" alt="" class="fondo-desc-color p-2">
                <div class="ms-3">
                  <p class="m-0">Celular Liberado</p>
                  <p class="m-0 fw-bold"><?= $detallesPro["Celular Liberado"]; ?></p>
                </div>
              </div>
            </div>
            <div class="ms-5" style="width: 60%;">
              <ul class="d-flex flex-column flex-wrap" style="height: 70%;">
                <?php if (array_key_exists("Modelo", $detallesPro)) { ?> <li class="bullet fw-light">Modelo: <?= $detallesPro['Modelo'] ?></li> <?php } ?>
                <?php if (array_key_exists("Camara Frontal", $detallesPro)) { ?> <li class="bullet fw-light">Cámara frontal: <?= $detallesPro['Camara frontal'] ?></li> <?php } ?>
                <?php if (array_key_exists("Sistema Operativo", $detallesPro)) { ?> <li class="bullet fw-light">Sistema Operativo: <?= $detallesPro['Sistema Operativo'] ?></li> <?php } ?>
                <?php if (array_key_exists("Tipo de SIM", $detallesPro)) { ?> <li class="bullet fw-light">Tipo de SIM: <?= $detallesPro['Tipo de SIM'] ?></li> <?php } ?>
                <?php if (array_key_exists("Red", $detallesPro)) { ?> <li class="bullet fw-light">Red: <?= $detallesPro['Red'] ?></li> <?php } ?>
                <?php if (array_key_exists("Frecuencia 2G", $detallesPro)) { ?> <li class="bullet fw-light">Frecuencia 2G: <?= $detallesPro['Frecuencia 2G']; ?> </li> <?php } ?>
                <?php if (array_key_exists("Frecuencia 3G", $detallesPro)) { ?> <li class="bullet fw-light">Frecuencia 3G: <?= $detallesPro['Frecuencia 3G'] ?></li> <?php } ?>
                <?php if (array_key_exists("Frecuencia 4G", $detallesPro)) { ?> <li class="bullet fw-light">Frecuencia 4G: <?= $detallesPro['Frecuencia 4G'] ?></li> <?php } ?>
                <?php if (array_key_exists("Bateria", $detallesPro)) { ?> <li class="bullet fw-light">Bateria: <?= $detallesPro['Bateria'] ?></li> <?php } ?>
                <?php if (array_key_exists("Memoria RAM", $detallesPro)) { ?> <li class="bullet fw-light">Memoria RAM: <?= $detallesPro['Memoria RAM'] ?></li> <?php } ?>
                <?php if (array_key_exists("Memoria Interna", $detallesPro)) { ?> <li class="bullet fw-light">Memoria Interna: <?= $detallesPro['Memoria Interna'] ?></li> <?php } ?>
                <?php if (array_key_exists("Memoria Externa", $detallesPro)) { ?> <li class="bullet fw-light">Memoria Externa: <?= $detallesPro['Memoria Externa'] ?></li> <?php } ?>
                <?php if (array_key_exists("Peso", $detallesPro)) { ?> <li class="bullet fw-light">Peso: <?= $detallesPro['Peso'] ?></li> <?php } ?>
                <?php if (array_key_exists("Dimension del equipo", $detallesPro)) { ?> <li class="bullet fw-light">Dimensión del equipo: <?= $detallesPro['Dimension del equipo'] ?></li> <?php } ?>
                <?php if (array_key_exists("NFC", $detallesPro)) { ?> <li class="bullet fw-light">NFC: <?= $detallesPro['NFC'] ?></li> <?php } ?>
                <?php if (array_key_exists("Auriculares Incluidos", $detallesPro)) { ?> <li class="bullet fw-light">Auriculares incluidos: <?= $detallesPro['Auriculares Incluidos'] ?></li> <?php } ?>
                <?php if (array_key_exists("Cargador Incluido", $detallesPro)) { ?> <li class="bullet fw-light">Cargador Incluido: <?= $detallesPro['Cargador Incluido'] ?></li> <?php } ?>
                <?php if (array_key_exists("Cable USB Incluido", $detallesPro)) { ?> <li class="bullet fw-light">Cable USB incluido: <?= $detallesPro['Cable USB Incluido'] ?></li> <?php } ?>
                <?php if (array_key_exists("Cover Incluido", $detallesPro)) { ?> <li class="bullet fw-light">Cover Incluido: <?= $detallesPro['Cover Incluido'] ?></li> <?php } ?>
                <?php if (array_key_exists("Otros Accesorios Incluidos", $detallesPro)) { ?> <li class="bullet fw-light">Otros accesorios incluidos: <?= $detallesPro['Otros Accesorios Incluidos'] ?></li> <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>


<?php } else {
  echo "<p class='container fs-3 mt-5'>No se encontro el celular buscado.</p>";
} ?>

<?php include_once "./includes/footer.php"; ?>