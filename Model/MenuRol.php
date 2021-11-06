<?php

class MenuRol {

  private $idmenu;
  private $objrol;
  private $msjerror;

  public function __construct() {
    $this->idmenu = null;
    $this->objrol = null;
  }

  public function setear($idmenu, $objrol) {
    $this->setIdMenu($idmenu);
    $this->setObjRol($objrol);
  }

  public function getIdMenu() {
    return $this->idmenu;
  }
  public function setIdMenu($idmenu) {
    $this->idmenu = $idmenu;
  }

  /**
   * @return Rol
   */
  public function getObjRol() {
    return $this->objrol;
  }
  public function setObjRol($objrol) {
    $this->objrol = $objrol;
  }

  public function getMsjError() {
    return $this->msjerror;
  }
  public function setMsjError($msjerror) {
    $this->msjerror = $msjerror;
  }

  public function cargar() {
    $resp = false;
    $base = new DataBase();
    $sql = "SELECT * FROM menurol WHERE idmenu = {$this->getIdMenu()}";
    if ($base->Iniciar()) {
      $res = $base->Ejecutar($sql);
      if ($res > -1) {
        if ($res > 0) {
          $row = $base->Registro();
          $this->setear($row['idmenu'], $row['idrol']);
        }
      }
    } else {
      $this->setMsjError("Tabla->listar: {$base->getError()}");
    }
    return $resp;
  }

  public function insertar() {
    $resp = false;
    $base = new DataBase();
    $sql = "INSERT INTO menurol (idmenu, idrol) VALUES ({$this->getIdMenu()},{$this->getObjRol()->getIdRol()})";

    if ($base->Iniciar()) {
      if ($id = $base->Ejecutar($sql)) {
        $this->setIdMenu($id);

        $resp = true;
      } else {
        $this->setMsjError("Tabla->insertar: {$base->getError()[2]}");
      }
    } else {
      $this->setMsjError("Tabla->insertar: {$base->getError()[2]}");
    }
    return $resp;
  }

  public function modificar() {
    $resp = false;
    $base = new DataBase();
    $sql = "UPDATE menurol SET idrol = {$this->getObjRol()->getIdRol()} WHERE idmenu = {$this->getIdMenu()}";
    if ($base->Iniciar()) {
      if ($base->Ejecutar($sql)) {
        $resp = true;
      } else {
        $this->setMsjError("Tabla->modificar: {$base->getError()}");
      }
    } else {
      $this->setMsjError("Tabla->modificar: {$base->getError()}");
    }
    return $resp;
  }

  public function eliminar() {
    $resp = false;
    $base = new DataBase();
    $sql = "DELETE FROM menurol WHERE idmenu={$this->getIdMenu()}";
    if ($base->Iniciar()) {
      if ($base->Ejecutar($sql)) {
        return true;
      } else {
        $this->setMsjError("Tabla->eliminar: {$base->getError()}");
      }
    } else {
      $this->setMsjError("Tabla->eliminar: {$base->getError()}");
    }
    return $resp;
  }

  public static function listar($parametro = "") {
    $arreglo = array();
    $base = new DataBase();
    $sql = "SELECT * FROM menurol ";
    if ($parametro != "") {
      $sql .= " WHERE {$parametro}";
    }
    $res = $base->Ejecutar($sql);
    if ($res > -1) {
      if ($res > 0) {

        while ($row = $base->Registro()) {
          $obj = new MenuRol();

          $objRol = new Rol();
          $objRol->setIdRol($row['idrol']);
          $objRol->cargar();

          $obj->setear($row['idmenu'], $objRol);

          array_push($arreglo, $obj);
        }
      }
    }

    return $arreglo;
  }
}
