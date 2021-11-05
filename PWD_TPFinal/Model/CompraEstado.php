<?php

class CompraEstado {

  private $idCompraEstado;
  private $objCompra;
  private $objCompraEstTipo;
  private $ceFechaIni;
  private $ceFechaFin;
  private $msjError;

  public function __construct() {
    $this->idCompraEstado = '';
    $this->objCompra = '';
    $this->objCompraEstTipo = '';
    $this->ceFechaIni = '';
    $this->ceFechaFin = '';
  }

  public function setear($idCompraEstado, $objCompra, $objCompraEstTipo, $ceFechaIni, $ceFechaFin) {
    $this->setIdCompraEstado($idCompraEstado);
    $this->setObjCompra($objCompra);
    $this->setObjCompraEstTipo($objCompraEstTipo);
    $this->setCeFechaini($ceFechaIni);
    $this->setCeFechaFin($ceFechaFin);
  }

  public function getIdCompraEstado() {
    return  $this->idCompraEstado;
  }

  public function setIdCompraEstado($idCompraEstado) {
    $this->idCompraEstado = $idCompraEstado;
  }

  public function getObjCompra() {
    return  $this->objCompra;
  }

  public function setObjCompra($objCompra) {
    $this->objCompra = $objCompra;
  }
  public function getObjCompraEstTipo() {
    return  $this->objCompraEstTipo;
  }

  public function setObjCompraEstTipo($objCompraEstTipo) {
    $this->objCompraEstTipo = $objCompraEstTipo;
  }

  public function getCeFechaIni() {
    return  $this->ceFechaIni;
  }

  public function setCeFechaIni($ceFechaIni) {
    $this->ceFechaIni = $ceFechaIni;
  }
  public function getCeFechaFin() {
    return  $this->ceFechaFin;
  }

  public function setCeFechaFin($ceFechaFin) {
    $this->ceFechaFin = $ceFechaFin;
  }

  public function getMsjError() {
    return  $this->msjError;
  }

  public function setMsjError($msjError) {
    $this->msjError = $msjError;
  }


  //Metodos de comportamiento con la base de datos
  //------------------------------------------------

  public function cargar() {
    $resp = false;
    $base = new dataBase();
    $sql = "SELECT * FROM compraEstado WHERE idcompraestado = " . $this->getIdCompraEstado();
    if ($base->Iniciar()) {
      $res = $base->Ejecutar($sql);
      if ($res > -1) {
        if ($res > 0) {
          $row = $base->Registro();
          // $objCompEstado = new compraEstado();
          $objCompra = new compra();
          $objCompra->setIdCompra($row['idcompra']);
          $objCompra->cargar();
          $objCompraEstadoTipo = new compraEstadoTipo();
          $objCompraEstadoTipo->setIdCompraEstTipo($row['compraestadotipo']);
          $objCompraEstadoTipo->cargar();
          $this->setear($row['idcompraestado'], $objCompra, $objCompraEstadoTipo, $row['cefechaini'], $row['cefechafin']);
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
    $sql = "INSERT INTO compraestado ( idcompra, idcompraestadotipo, cefechaini, cefechafin ) VALUES (" . $this->getObjCompra()->getIdCompra() . "," . $this->getObjCompraEstTipo()->getIdCompraEstTipo() . ",'" . $this->getCeFechaIni() . "','" . $this->getCeFechaFin() . "')";

    //echo $sql;
    if ($base->Iniciar()) {
      if ($elId = $base->Ejecutar($sql)) {
        $this->setIdCompraEstado($elId);

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
    $sql = "UPDATE compraestado SET idcompra = " . $this->getObjCompra()->getIdCompra() . ", idcompraestado = " . $this->getObjCompraEstTipo()->getIdCompraEstTipo() . " , cefechaini = '" . $this->getCeFechaIni() . "', cefechafin = '" . $this->getCeFechaFin() . "' WHERE idcompraestado = " . $this->getIdCompraEstado();
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
    $sql = "DELETE FROM compraestado WHERE idcompraestado = " . $this->getIdCompraEstado();
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
    $sql = "SELECT * FROM compraestado ";
    if ($parametro != "") {
      $sql .= ' WHERE ' . $parametro;
    }
    // echo $sql;
    $res = $base->Ejecutar($sql);
    if ($res > -1) {
      if ($res > 0) {

        while ($row = $base->Registro()) {
          $obj = new compraEstado();
          $objCompra = new compra();
          $objCompra->setIdCompra($row['idcompra']);
          $objCompra->cargar();
          $objCompraEstTipo = new compraEstadoTipo();
          $objCompraEstTipo->setIdCompraEstTipo($row['idcompraestadotipo']);
          $objCompraEstTipo->cargar();

          $obj->setear($row['idcompra'], $objCompra, $objCompraEstTipo, $row['cefechaini'], $row['cefechafin']);

          array_push($arreglo, $obj);
        }
      }
    } else {
      // $this->setmensajeoperacion("Tabla->listar: ".$base->getError());
    }

    return $arreglo;
  }
}//fin clase compra
