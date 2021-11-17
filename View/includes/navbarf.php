<?php 
include_once "../config.php";

$roles = null;
if ($sesion->getObjUsuario() != null) {
  $roles = $sesion->getObjUsuario()->getColRoles();
}


if ($sesion->activa()) {
  $abmMenuRol = new AbmMenuRol;
  $menuRol = $abmMenuRol->buscar(['idrol' => $_SESSION['rol']]);

  $abmMenu = new AbmMenu;
  $menues = $abmMenu->buscar(['idmenu' => $_SESSION['rol']]);
  
  $subMenues = $abmMenu->buscar(['idpadre' => $menues[0]->getIdMenu()]);
}

var_dump($_SESSION);
?>



<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">LOGO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">


      
        <li class="nav-item">
          <?php if (isset($menues)) { ?>
            <div class="dropdown">
              <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $menues[0]->getMeNombre() ?>
              </a>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <?php foreach ($subMenues as $menu) {

                  echo "<li><a class='dropdown-item' href='" . $menu->getMeNombre() . ".php'>" . $menu->getMeNombre() . "</a></li>";
                } ?>
              </ul>
            </div>
          <?php } ?>
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
      <?php if ($sesion->activa()) { ?>
        <i class="fas fa-user-check text-success"></i><?php echo $_SESSION['usnombre']; ?> &nbsp;&nbsp;&nbsp;
        <a class="btn btn-danger" href="verificaLog.php?accion=cerrar"><i class="fas fa-times-circle"></i></a> &nbsp;&nbsp;&nbsp;
        <?php
        $roles = $sesion->getColRoles();
        if ($roles != null && count($roles) > 1) {  ?>
          <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              Roles de sistema
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <?php foreach ($roles as $rol) {
                echo  "<li><a class='dropdown-item' href='verificaLog.php?tipoRol=" . $rol->getIdRol() . "'>" . $rol->getRoDescripcion() . "</a></li>";
              } ?>
            </ul>
          </div>
        <?php }
      } else { ?>
        <a class="boton-login nav-link" href="login.php">Iniciar Sesion</a>
        <a class="boton-login nav-link" href="#">Registrarse</a>
      <?php } ?>

    </div>
  </div>
</nav>