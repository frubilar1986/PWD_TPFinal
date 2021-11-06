<?php
class Session {
  private $objUsuario;
  private $colRoles;

  public function __construct() {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
      $this->objUsuario = null;
      $this->colRoles = null;
    }
  }

  public function iniciar($nombreUsuario, $psw) {
    $_SESSION['usnombre'] = $nombreUsuario;
    $_SESSION['uspass'] = $psw;
  }

  /**
   * Si el usuario esta logeado, devuelve el objeto correspondiente a su id
   * Devuelve null si no esta logeado
   * 
   * @return Usuario
   */
  public function getObjUsuario() {
    if ($this->activa()) {
      $objUsuario = new Usuario();
      $objUsuario->setIdUsuario($_SESSION['idusuario']);
      $objUsuario->cargar();
    } else {
      $objUsuario = null;
    }

    $this->setObjUsuario($objUsuario);

    return $this->objUsuario;
  }
  public function setObjUsuario($objUsuario) {
    $this->objUsuario = $objUsuario;
  }

  ///////// Cambiar y usar el objeto usuario y el metodo get col que tiene 
  public function getColRoles() {
    $condicionRol['idusuario'] = $_SESSION['idusuario'];
    $ambUsuarioRol = new AbmUsuarioRol();
    $colRolesUsuario = $ambUsuarioRol->buscar($condicionRol);

    $rol = [];
    $colRoles = [];
    foreach ($colRolesUsuario as $rolUsuario) {
      $rol = $rolUsuario->getObjRol();
      array_push($colRoles, $rol);
    }
    $this->setColRoles($colRoles);
    return $this->colRoles;
  }
  public function setColRoles($colRoles) {
    $this->colRoles = $colRoles;
  }

  public function validar() {
    $resp = false;

    $condiciones['usnombre'] = $_SESSION['usnombre'];
    $condiciones['uspass'] = $_SESSION['uspass'];

    $abmUsuario = new AbmUsuario();
    $colUsuarios = $abmUsuario->buscar($condiciones); // ver de manejar error de usuario y pass por separado

    unset($_SESSION['usnombre']);
    unset($_SESSION['uspass']);

    if (count($colUsuarios) > 0) {
      $_SESSION['idusuario'] = $colUsuarios[0]->getIdUsuario();
      $_SESSION['activa'] = 1;
      $resp = true;
    }

    return $resp;
  }

  static public function activa() {
    $resp = false;

    if (isset($_SESSION['activa'])) {
      $resp = true;
    }

    return $resp;
  }

  public function cerrar() {
    if (isset($_SESSION['activa'])) {
      session_unset();
      session_destroy();
      $this->objUsuario = null;
      $this->colRoles = null;
    }
  }
}
