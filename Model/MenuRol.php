<?php

class MenuRol {

  private $idMenu;
  private $objIdRol;
  private $msjError;

  public function __construct() {
    $this->idMenu = "";
    $this->objIdRol = null;
  }

  public function setear($idMenu, $objidRol) {
    $this->setIdMenu($idMenu);
    $this->setobjIdRol($objidRol);
  }

  public function getIdMenu() {
    return $this->idMenu;
  }

  public function setIdMenu($idMenu) {
    $this->idMenu = $idMenu;
  }
  public function getobjIdRol() {
    return $this->objIdRol;
  }

  public function setobjIdRol($objidRol) {
    $this->objIdRol = $objidRol;
  }
  public function getMsjError() {
    return $this->msjError;
  }

  public function setMsjError($msjError) {
    $this->msjError = $msjError;
  }

  //Metodos de comportamiento con la base de datos
  //------------------------------------------------

  public function cargar() {
    $resp = false;
    $base = new dataBase();
    $sql = "SELECT * FROM menuRol WHERE idmenu = " . $this->getIdMenu();
    if ($base->Iniciar()) {
      $res = $base->Ejecutar($sql);
      if ($res > -1) {
        if ($res > 0) {
          $row = $base->Registro();
          $this->setear($row['idmenu'], $row['idrol']);
        }
      }
    } else {
      $this->setMsjError("Tabla->listar: " . $base->getError());
    }
    return $resp;
  }

  public function insertar() {
    $resp = false;
    $base = new dataBase();
    $sql = "INSERT INTO menurol (  idmenu, idrol  ) VALUES (" . $this->getIdMenu() . "," . $this->getobjIdRol()->getIdRol() . ")";

    //echo $sql;
    if ($base->Iniciar()) {
      if ($elId = $base->Ejecutar($sql)) {
        $this->setIdMenu($elId);

        $resp = true;
      } else {
        $this->setMsjError("Tabla->insertar: " . $base->getError()[2]);
      }
    } else {
      $this->setMsjError("Tabla->insertar: " . $base->getError()[2]);
    }
    return $resp;
  }


  public function modificar() {
    $resp = false;
    $base = new dataBase();
    $sql = "UPDATE menurol SET idrol = " . $this->getobjIdRol()->getIdRol() . " WHERE idmenu = " . $this->getIdMenu();
    //echo $sql;
    if ($base->Iniciar()) {

      if ($base->Ejecutar($sql)) {

        $resp = true;
      } else {
        $this->setMsjError("Tabla->modificar: " .  $base->getError());
      }
    } else {
      $this->setMsjError("Tabla->modificar: " . $base->getError());
    }
    return $resp;
  }


  public function eliminar() {
    $resp = false;
    $base = new dataBase();
    $sql = "DELETE FROM menurol WHERE idmenu=" . $this->getIdMenu();
    if ($base->Iniciar()) {
      if ($base->Ejecutar($sql)) {
        return true;
      } else {
        $this->setMsjError("Tabla->eliminar: " . $base->getError());
      }
    } else {
      $this->setMsjError("Tabla->eliminar: " . $base->getError());
    }
    return $resp;
  }


  public static function listar($parametro = "") {
    $arreglo = array();
    $base = new dataBase();
    $sql = "SELECT * FROM menurol ";
    if ($parametro != "") {
      $sql .= ' WHERE ' . $parametro;
    }
    // echo $sql;
    $res = $base->Ejecutar($sql);
    if ($res > -1) {
      if ($res > 0) {

        while ($row = $base->Registro()) {
          $obj = new menuRol();
          $objRol = new rol();
          $objRol->setIdRol($row['idrol']);
          $objRol->cargar();
          $obj->setear($row['idmenu'], $objRol);

          array_push($arreglo, $obj);
        }
      }
    } else {
      // $this->setmensajeoperacion("Tabla->listar: ".$base->getError());
    }

    return $arreglo;
  }
}//fin clase menu rol
