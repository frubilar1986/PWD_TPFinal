<?php $title = 'Nuevo Producto';
include_once 'includes/head.php' ?>
<?php include_once 'includes/navbar.php' ?>
<?php include_once "../config.php" ?>


<div class="container d-flex justify-content-center align-items-start text-center mt-20vh">
  <form id="formulario-nuevo-producto" novalidate class="w-100 p-4 needs-validation" enctype="multipart/form-data" action="nuevoProductoAccion.php" method="post">

    <h1 class="pb-3 text-primary">Nuevo Producto</h1>

    <div class="row g-4">
      <div class="col-md">
        <div class="form-floating mb-3">
          <input type="text" name="prodetalle[marca]" class="form-control" id="prodetalle[marca]" placeholder="Marca" required>
          <label for="prodetalle[marca]">Marca</label>
        </div>
      </div>

      <div class="col-md">
        <div class="form-floating mb-3">
          <input type="text" name="pronombre" class="form-control" id="pronombre" placeholder="Modelo" required>
          <label for="pronombre">Modelo</label>
        </div>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-md">
        <div class="form-floating mb-3">
          <input type="number" name="proprecio" class="form-control" id="proprecio" min="0" placeholder="Precio" required>
          <label for="proprecio">Precio</label>
        </div>
      </div>

      <div class="col-md">
        <div class="form-floating mb-3">
          <input type="number" name="propreciooferta" class="form-control" id="propreciooferta" min="0" placeholder="Precio Oferta">
          <label for="propreciooferta">Precio Oferta</label>
        </div>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-md">
        <div class="form-floating mb-3">
          <input type="number" name="procantstock" class="form-control" id="procantstock" min="0" placeholder="Cantidad Stock" required>
          <label for="procantstock">Cantidad Stock</label>
        </div>
      </div>
    </div>

    <div class="form-floating mb-3">
      <textarea class="form-control" name="prodetalle[desc1]" placeholder="Sinopsis" id="prodetalle[desc1]" style="height: 100px; resize: none;" required></textarea>
      <label for="prodetalle[desc1]">Primer descripción</label>
    </div>

    <div class="form-floating mb-3">
      <textarea class="form-control" name="prodetalle[desc2]" placeholder="Sinopsis" id="prodetalle[desc2]" style="height: 100px; resize: none;" required></textarea>
      <label for="prodetalle[desc2]">Segunda descripción</label>
    </div>


    <div class="form-group mb-3">
      <label for="imagen" class="form-label">
        <h5>Imagenes del Producto</h5>
      </label><br>
      <input type="file" name="imagen[]" class="form-control" id="imagen" accept="image/*" multiple required>
      <small class="form-text text-muted">(maximo 20M)</small>
    </div>


    <div class="form-group">
      <label for="imagen" class="form-label">
        <h5>Caracteristicas Técnicas</h5>
      </label><br>
      <input type="text" name="prodetalle[Camara Principal]" class="form-control mb-3" id="prodetalle[Camara Principal]" placeholder="Cámara Principal" required>
      <input type="text" name="prodetalle[Display]" class="form-control mb-3" id="display" placeholder="Display" required>
      <input type="text" name="prodetalle[Procesador]" class="form-control mb-3" id="procesador" placeholder="Procesador" required>
      <input type="text" name="prodetalle[Celular Liberado]" class="form-control mb-3" id="liberado" placeholder="Liberado" required>
    </div>


    <div class="form-group mt-4" id="masCaracteristicas">
      <label for="imagen" class="form-label">
        <div class="d-flex">
          <h5 class="mt-2 mx-3">Mas Caracteristicas</h5>
          <button type="button" class="btn btn-outline-primary mb-3" onclick="agregarCaracteristica()">+</button>
        </div>
      </label><br>
    </div>

    <div class="container d-flex justify-content-end">
      <button type="submit" class="btn btn-primary m-2">Enviar</button>
      <button type="reset" class="btn btn-danger m-2">Borrar</button>
    </div>
  </form>


</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="js/addCaracteristica.js"></script>
<script src="js/validation.js"></script>

<?php include_once 'includes/footer.php' ?>