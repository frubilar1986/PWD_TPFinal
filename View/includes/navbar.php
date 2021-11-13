<?php  $title = 'Navbar';
include_once 'head.php' ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">LOGO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            Productos
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="../cursos_programacion.php">Programacion</a></li>
                            <li><a class="dropdown-item" href="#">Diseño Grafico</a></li>
                            <li><a class="dropdown-item" href="#">Etc</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Ver Todos los Productos</a>
                </li>

            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" style="width: 600px;">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
        <div class="d-flex mx-5">
            <a class="boton-login nav-link" href="#">Iniciar Sesion</a>
            <a class="boton-login nav-link" href="#">Registrarse</a>
        </div>
    </div>
</nav>

<!-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="" class="d-block w-100 bg-dark" alt="" style="height: 500px">
        </div>
        <div class="carousel-item">
            <img src="" class="d-block w-100 bg-dark" alt="" style="height: 500px">
        </div>
        <div class="carousel-item">
            <img src="" class="d-block w-100 bg-dark" alt="" style="height: 500px">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="my-5 container">
    <h2>Principales</h2>
    <div class="row">
        <div class="col bg-primary border" style="height: 350px; width: 100px">
            <h3>1</h3>
            Column
        </div>
        <div class="col bg-primary border" style="height: 350px; width: 100px">
            <h3>2</h3>
            Column
        </div>
        <div class="col bg-primary border" style="height: 350px; width: 100px">
            <h3>3</h3>
            Column
        </div>
    </div>
    <div class="row">
        <div class="col bg-primary border" style="height: 350px; width: 100px">
            <h3>4</h3>
            Column
        </div>
        <div class="col bg-primary border" style="height: 350px; width: 100px">
            <h3>5</h3>
            Column
        </div>
        <div class="col bg-primary border" style="height: 350px; width: 100px">
            <h3>6</h3>
            Column
        </div>
    </div>
</div> -->
<?php /* include_once 'footer.php' */ ?>