<?php $title = 'Mi Carrito';
include_once './includes/head.php'; ?>
<?php include_once "./includes/navbar.php"; ?>
<div class="container border mt-5">
    <div class="m-3">
        <p class="fs-3 mt-3">Carrito ([CANTIDAD PRODUCTOS])</p>
        <div class="compra d-flex justify-content-between mt-5">
            <div class="d-flex">
                <img src="./img/Productos/a87ff679a2f3e71d9181a67b7542122c/70008165.jpg" style="height: 100px;" alt="">
                <div class="d-flex flex-column">
                    <p class="fw-bold">[NOMBRE PRODUCTO]</p>
                    <p class="text-success">Envio Gratis</p>
                    <a href="#">Eliminar</a>
                </div>
            </div>
            <div id="input-cantidad" class="d-flex border input-cantidad" style="height: 50px;">
                <button id="boton-menos" class="h-100 px-0"><i class="fas fa-minus"></i></button>
                <input id="cantidad-carrito" type="number" class="w-100 px-0 text-center" value="1" placeholder="1"> 
                <button id="boton-mas" class="h-100 px-"><i class="fas fa-plus"></i></button>
            </div>
            <div class="precio">
                <p>$<span id="precio-compra" class="precio-compra">10000</span></p>
            </div>
        </div>
<!--         <div class="compra d-flex justify-content-between mt-5">
            <div class="d-flex">
                <img src="./img/Productos/a87ff679a2f3e71d9181a67b7542122c/70008165.jpg" style="height: 100px;" alt="">
                <div class="d-flex flex-column">
                    <p class="fw-bold">[NOMBRE PRODUCTO]</p>
                    <p class="text-success">Envio Gratis</p>
                    <a href="#">Eliminar</a>
                </div>
            </div>
            <div id="input-cantidad" class="d-flex border input-cantidad" style="height: 50px;">
                <button id="boton-menos" class="h-100 px-0"><i class="fas fa-minus"></i></button>
                <input id="cantidad-carrito" type="number" class="w-100 px-0 text-center" value="1" placeholder="1"> 
                <button id="boton-mas" class="h-100 px-"><i class="fas fa-plus"></i></button>
            </div>
            <div class="precio">
                <p >9999</p>
            </div>
        </div> -->
    </div>

</div>
<?php include_once './includes/footer.php' ?>
<script defer src="./js/sumarCarrito.js"></script>
