<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand mx-5" href="./todos_productos.php"><img src="./img/logo.jfif" alt="" style="width: 50px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./todos_productos.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./estado_compra.php">Estado de Compra</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Celulares
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="./celulares_pag.php?marca=Motorola">Motorola</a></li>
            <li><a class="dropdown-item" href="./celulares_pag.php?marca=Samsung">Samsung</a></li>
            <li><a class="dropdown-item" href="./celulares_pag.php?marca=LG">LG</a></li>
            <li><a class="dropdown-item" href="./celulares_pag.php?marca=TCL">TCL</a></li>
            <li><a class="dropdown-item" href="./celulares_pag.php?marca=Nokia">Nokia</a></li>
          </ul>
        </li>

      </ul>
      <form action="./buscarAccion.php" class="d-flex">
        <input class="form-control" type="search" name="busqueda" placeholder="Buscar celular" aria-label="Search">
        <button class="btn border w-25" type="submit"><i class="fas fa-search"></i></button>
      </form>
      <div class="d-flex mx-5">
        <a class="boton-login nav-link" href="./carrito_compra.php"><i class="fas fa-shopping-cart"></i></a>
        <a class="boton-login nav-link" href="#">Iniciar Sesion</a>
        <a class="boton-login nav-link" href="#">Registrarse</a>
      </div>
    </div>
  </div>
</nav>