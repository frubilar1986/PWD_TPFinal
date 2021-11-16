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
    $condiciones['usnombre'] = $nombreUsuario;
    $condiciones['uspass'] = $psw;

    $abmUsuario = new AbmUsuario();
    $colUsuarios = $abmUsuario->buscar($condiciones);

    if (count($colUsuarios) > 0) {
      $usuario = $colUsuarios[0];
      $this->setObjUsuario($usuario);
      $_SESSION['idusuario'] = $usuario->getIdUsuario();
    }
  }

  /**
   * @return Usuario
   */
  public function getObjUsuario() {
    if ($this->objUsuario == null && isset($_SESSION['idusuario'])) {
      $abmUsuario = new AbmUsuario();
      $condiciones['idusuario'] = $_SESSION['idusuario'];
      $usuario = $abmUsuario->buscar($condiciones)[0];

      $this->setObjUsuario($usuario);
    }

    return $this->objUsuario;
  }
  public function setObjUsuario($objUsuario) {
    $this->objUsuario = $objUsuario;
  }

  public function getColRoles() {
    if (!$this->colRoles) {
      $this->setColRoles($this->getObjUsuario()->getColRoles());
    }

    return $this->colRoles;
  }
  public function setColRoles($colRoles) {
    $this->colRoles = $colRoles;
  }

  public function validar() {
    return ($this->getObjUsuario() != null) ? true : false;
  }

  static public function activa() {
    return (isset($_SESSION['idusuario'])) ? true : false;
  }

  public function cerrar() {
    var_dump($this->getObjUsuario());
    if ($this->getObjUsuario()) {
      session_unset();
      session_destroy();
      $this->objUsuario = null;
      $this->colRoles = null;
    }
  }
}
