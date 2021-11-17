<?php $title = 'Estado de Compra';
include_once './includes/head.php'; ?>
<?php include_once "./includes/navbar.php"; ?>

<h2 class="container my-5">Estado de Compra</h2>
<div class="container"><hr></div>
<div class="container d-flex">
    <div class="w-25">
        <h5>[NUM COMPRA]</h5>
        <p>[ESTADO ACTUAL]</p>
        <p>[LISTA PRODUCTOS COMPRADOS]</p>
        <p>[PRECIO TOTAL PRODUCTOS COMPRADOS]</p>

    </div>
    <div class="w-75 progreso">
        <h5>Estado</h5>
        <ul class="p-0 mt-5 d-flex">
            <div class="estado-1 d-flex flex-column">
                <p class="mb-3 estado estado-realizado text-center" style="width: 30px;">1</p>
                <li class="w-100" style="margin: 0 120px 0 0">[ESTADO 1]</li>
            </div>
            <div class="estado-1">
                <p class="mb-3 estado estado-activo text-center" style="width: 30px;">2</p>
                <li class="w-100" style="margin: 0 120px 0 0">[ESTADO 2]</li>
            </div>
            <div class="estado-1">
                <p class="mb-3 estado estado-espera text-center" style="width: 30px;">3</p>
                <li class="w-100" style="margin: 0 120px 0 0">[ESTADO 3]</li>
            </div>
            <div class="estado-1">
                <p class="mb-3 estado estado-espera text-center" style="width: 30px;">4</p>
                <li class="w-100" style="margin: 0 120px 0 0">[ESTADO 4]</li>
            </div>



        </ul>
    </div>
</div>
<div class="container" style="margin-top: 100px;"><hr></div>
<div class="container d-flex">
    <div class="w-25">
        <h5>[NUM COMPRA]</h5>
        <p>[ESTADO ACTUAL]</p>
        <p>[LISTA PRODUCTOS COMPRADOS]</p>
        <p>[PRECIO TOTAL PRODUCTOS COMPRADOS]</p>

    </div>
    <div class="w-75 progreso">
        <h5>Estado</h5>
        <ul class="p-0 mt-5 d-flex">
            <div class="estado-1 d-flex flex-column">
                <p class="mb-3 estado estado-realizado text-center" style="width: 30px;">1</p>
                <li class="w-100" style="margin: 0 120px 0 0">[ESTADO 1]</li>
            </div>
            <div class="estado-1">
                <p class="mb-3 estado estado-activo text-center" style="width: 30px;">2</p>
                <li class="w-100" style="margin: 0 120px 0 0">[ESTADO 2]</li>
            </div>
            <div class="estado-1">
                <p class="mb-3 estado estado-espera text-center" style="width: 30px;">3</p>
                <li class="w-100" style="margin: 0 120px 0 0">[ESTADO 3]</li>
            </div>
            <div class="estado-1">
                <p class="mb-3 estado estado-espera text-center" style="width: 30px;">4</p>
                <li class="w-100" style="margin: 0 120px 0 0">[ESTADO 4]</li>
            </div>



        </ul>
    </div>
</div>

<?php include_once "./includes/footer.php"; ?>