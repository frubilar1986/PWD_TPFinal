<?php $title = 'Template Producto';
include_once './includes/head.php'; ?>
<?php include_once "./includes/navbar.php"; ?>

<div id="contenido-principal" class="container mt-5 d-flex">
    <div class="w-75 me-5">
        <div class="bg-primary">
            <p>Categoria Main -> Subcategoria</p>
            <h4>Nombre Curso</h4>
            <p>Descripcion del curso</p>
        </div>
        <div class="border mt-5">
            <h4 class="p-3">Lo que aprenderas</h4>
            <div class="d-flex flex-wrap p-3" >
                <p class="w-50"><i class="pe-2 fas fa-check fa-xs"></i>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil iure ullam cum assumenda.</p>
                <p class=""><i class="pe-2 fas fa-check fa-xs"></i>Lorem ipsum dolor sit amet.</p>
                <p class="w-50"><i class="pe-2 fas fa-check fa-xs"></i>Lorem ipsum dolor sit, amet consectetur adipisicing.</p>
                <p class="w-50"><i class="pe-2 fas fa-check fa-xs"></i>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium harum ea.</p>
                <p class="w-50"><i class="pe-2 fas fa-check fa-xs"></i>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsa, enim.</p>
                <p class="w-50"><i class="pe-2 fas fa-check fa-xs"></i>6</p>
                <p class="w-50"><i class="pe-2 fas fa-check fa-xs"></i>7</p>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column text-center">
        <img src="./img/android.png" alt="Instructor" style="border-radius: 50%;">
        <p>Comprar ahora</p>
    </div>
    <p></p>
</div>
<section id="requisitos">
    <div class="container">
        <h4>Requisitos</h4>
        <p>Para poder realizar el curso, se necesita tener una computadora y conexion a internet estable para poder ver el curso en buena calidad. [Ademas, ... (requisitos dependiendo del curso especifico])</p>
    </div>
</section>
<section id="instructor">
    <div class="container">
        <h4>Instructor</h4>
        <div class="d-flex">
            <img src="./img/avatar.jfif" alt="" class="border" style="border-radius: 50%; height: 150px">
            <div class="">
                <p class="mb-0">Nombre: NOMBRE</p>
                <p class="mb-0">Apellido: APELLIDO</p>
                <p class="mb-0">Cursos: CANT CURSOS</p>
            </div>
        </div>
        <p>DESCRIPCION DEL INSTRUCTOR</p>
    </div>
</section>


<?php  include_once "./includes/footer.php"; ?>
