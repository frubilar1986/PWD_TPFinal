<?php $title = 'Cursos Programacion';
include_once './includes/head.php'; ?>
<?php include_once "./includes/navbar.php"; ?>

<div id="filter-list" class="container">
    <ul class="d-flex">
        <li class="list" data-filter="todo">Todo</li>
        <li class="list px-5" data-filter="web">Web</li>
        <li class="list" data-filter="android">Android</li>
    </ul>
</div>
<div id="seccion-productos" class="productos d-flex">
    <div class="item-box" data-item="web"><img src="./img/html5.png" alt=""></div>
    <div class="item-box" data-item="web"><img src="./img/css.png" alt=""></div>
    <div class="item-box" data-item="android"><img src="./img/android.png" alt=""></div>
</div>
<?php include_once "./includes/footer.php"; ?>
<script src="./js/filtroCursos.js"></script>