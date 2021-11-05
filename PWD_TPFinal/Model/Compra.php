<?php

class Compra {

  private $idcompra;
  private $cofecha;
  private $objusuario;
  private $msjerror;

  public function __construct() {
    $this->idcompra = '';
    $this->cofecha = '';
    $this->objusuario = null;
  }

  public function setear($idcompra, $cofecha, $objusuario) {
    $this->setIdCompra($idcompra);
    $this->setCoFecha($cofecha);
    $this->setObjUsuario($objusuario);
  }

  public function getIdCompra() {
    return  $this->idcompra;
  }
  public function setIdCompra($idcompra) {
    $this->idcompra = $idcompra;
  }

  public function getCoFecha() {
    return  $this->cofecha;
  }
  public function setCoFecha($cofecha) {
    $this->cofecha = $cofecha;
  }

  public function getObjUsuario() {
    return  $this->objusuario;
  }
  public function setObjUsuario($objusuario) {
    $this->objusuario = $objusuario;
  }

  public function getMsjError() {
    return  $this->msjerror;
  }
  public function setMsjError($msjerror) {
    $this->msjerror = $msjerror;
  }

  public function cargar() {
    $resp = false;
    $base = new dataBase();
    $sql = "SELECT * FROM compra WHERE idcompra = " . $this->getIdCompra();
    if ($base->Iniciar()) {
      $res = $base->Ejecutar($sql);
      if ($res > -1) {
        if ($res > 0) {
          $row = $base->Registro();
          $objusuario = new usuario();
          $objusuario->setIdUsuario($row['idusuario']);
          $this->setear($row['idcompra'], $row['cofecha'], $objusuario);
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
    $sql = "INSERT INTO compra ( cofecha, idusuario ) VALUES ('" . $this->getCoFecha() . "'," . $this->getObjUsuario()->getIdUsuario() . ")";

    //echo $sql;
    if ($base->Iniciar()) {
      if ($elId = $base->Ejecutar($sql)) {
        $this->setIdCompra($elId);

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
    $sql = "UPDATE compra SET cofecha = '" . $this->getCoFecha() . "', idusuario = " . $this->getObjUsuario()->getIdUsuario() . " WHERE idcompra = " . $this->getIdCompra();
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
    $sql = "DELETE FROM compra WHERE idcompra = " . $this->getIdCompra();
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
    $sql = "SELECT * FROM compra ";
    if ($parametro != "") {
      $sql .= ' WHERE ' . $parametro;
    }
    // echo $sql;
    $res = $base->Ejecutar($sql);
    if ($res > -1) {
      if ($res > 0) {

        while ($row = $base->Registro()) {
          $obj = new compra();
          $objusuario = new usuario();
          $objusuario->setIdUsuario($row['idusuario']);
          $objusuario->cargar();
          $obj->setear($row['idcompra'], $row['cofecha'], $objusuario);

          array_push($arreglo, $obj);
        }
      }
    } else {
      // $this->setmensajeoperacion("Tabla->listar: ".$base->getError());
    }

    return $arreglo;
  }
}
