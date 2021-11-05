<?php

class CompraEstadoTipo {

  private $idCompraEstTipo;
  private $cetDescripcion;
  private $cetDetalle;
  private $msjError;

  public function __construct() {
    $this->idCompraEstTipo = '';
    $this->cetDescripcion = '';
    $this->cetDetalle = '';
  }

  public function setear($idCompraEstTipo, $cetDescripcion, $cetDetalle) {
    $this->setIdCompraEstTipo($idCompraEstTipo);
    $this->setCetDescripcion($cetDescripcion);
    $this->setCetDetalle($cetDetalle);
  }

  public function getIdCompraEstTipo() {
    return  $this->idCompraEstTipo;
  }

  public function setIdCompraEstTipo($idCompraEstTipo) {
    $this->idCompraEstTipo = $idCompraEstTipo;
  }

  public function getCetDescripcion() {
    return  $this->cetDescripcion;
  }

  public function setCetDescripcion($cetDescripcion) {
    $this->cetDescripcion = $cetDescripcion;
  }
  public function getCetDetalle() {
    return  $this->cetDetalle;
  }

  public function setCetDetalle($cetDetalle) {
    $this->cetDetalle = $cetDetalle;
  }
  public function getMsjError() {
    return  $this->msjError;
  }

  public function setMsjError($msjError) {
    $this->msjError = $msjError;
  }

  public function cargar() {
    $resp = false;
    $base = new dataBase();
    $sql = "SELECT * FROM compraestadotipo WHERE idcompraestaditipo = " . $this->getIdCompraEstTipo();
    if ($base->Iniciar()) {
      $res = $base->Ejecutar($sql);
      if ($res > -1) {
        if ($res > 0) {
          $row = $base->Registro();

          $this->setear($row['idcompraestaditipo'], $row['cetdescripcion'], $row['cetdetalle']);
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
    $sql = "INSERT INTO compraestadotipo ( idcompraestadotipo,cetdescripcion,cetdetalle ) VALUES (" . $this->getIdCompraEstTipo() . ",'" . $this->getCetDescripcion() . "','" . $this->getCetDetalle() . "')";

    //echo $sql;
    if ($base->Iniciar()) {
      if ($elId = $base->Ejecutar($sql)) {
        // $this->setIdCompraEstTipo($elId);

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
    $sql = "UPDATE compraestadotipo SET cetdescripcion = '" . $this->getCetDescripcion() . "', cetdetalle = '" . $this->getCetDetalle()() . "' WHERE idcompraestado = " . $this->getIdCompraEstTipo();
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
    $sql = "DELETE FROM compraestadotipo WHERE idcompraestadotipo= " . $this->getIdCompraEstTipo();
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
    $sql = "SELECT * FROM compraestadotipo ";
    if ($parametro != "") {
      $sql .= ' WHERE ' . $parametro;
    }
    // echo $sql;
    $res = $base->Ejecutar($sql);
    if ($res > -1) {
      if ($res > 0) {

        while ($row = $base->Registro()) {
          $obj = new compraEstadoTipo();
          $obj->setear($row['idcompraestadotipo'], $row['cetdescripcion'], $row['cetdetalle']);

          array_push($arreglo, $obj);
        }
      }
    } else {
      // $this->setmensajeoperacion("Tabla->listar: ".$base->getError());
    }

    return $arreglo;
  }
}
