<?php

class CompraItem {

  private $idCompraItem;
  private $objProducto;
  private $objCompra;
  private $ciCantidad;
  private $msjError;

  public function __construct() {

    $this->idCompraItem = "";
    $this->objProducto = "";
    $this->objCompra = "";
    $this->ciCantidad = "";
  }

  public function setear($idCompraItem, $objProducto, $objCompra, $ciCantidad) {
    $this->setIdCompraItem($idCompraItem);
    $this->setObjProducto($objProducto);
    $this->setObjCompra($objCompra);
    $this->setciCantidad($ciCantidad);
  }

  public function getIdCompraItem() {
    return $this->idCompraItem;
  }

  public function setIdCompraItem($idCompraItem) {
    $this->idCompraItem = $idCompraItem;
  }
  public function getObjProducto() {
    return $this->objProducto;
  }

  public function setObjProducto($objProducto) {
    $this->objProducto = $objProducto;
  }
  public function getObjCompra() {
    return $this->objCompra;
  }

  public function setObjCompra($objCompra) {
    $this->objCompra = $objCompra;
  }
  public function getciCantidad() {
    return $this->ciCantidad;
  }

  public function setciCantidad($ciCantidad) {
    $this->ciCantidad = $ciCantidad;
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
    $sql = "SELECT * FROM compraitem WHERE idcompraitem = " . $this->getIdCompraItem();
    if ($base->Iniciar()) {
      $res = $base->Ejecutar($sql);
      if ($res > -1) {
        if ($res > 0) {
          $row = $base->Registro();
          $objProducto = new producto();
          $objProducto->setIdProducto($row['idproducto']);
          $objProducto->cargar();
          $objCompra = new compra;
          $objCompra->setIdCompra($row['idcompra']);
          $objCompra->cargar();
          $this->setear($row['idcompraitem'], $objProducto, $objCompra, $row['cicantidad']);
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
    $sql = "INSERT INTO compraitem ( idproducto,idcompra, cicantidad ) VALUES (" . $this->getObjProducto()->getIdProducto() . "," . $this->getObjCompra()->getIdCompra() . ")";

    //echo $sql;
    if ($base->Iniciar()) {
      if ($elId = $base->Ejecutar($sql)) {
        $this->setIdCompraItem($elId);

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
    $sql = "UPDATE compraitem SET idproducto = " . $this->getObjProducto()->getIdProducto() . ", idcompra = " . $this->getObjCompra()->getIdcompra() . " WHERE idcompraitem = " . $this->getIdCompraItem();
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
    $sql = "DELETE FROM compraitem WHERE idcompraitem= " . $this->getIdCompraItem();
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
    $sql = "SELECT * FROM compraitem ";
    if ($parametro != "") {
      $sql .= ' WHERE ' . $parametro;
    }
    // echo $sql;
    $res = $base->Ejecutar($sql);
    if ($res > -1) {
      if ($res > 0) {

        while ($row = $base->Registro()) {
          $obj = new compraItem();
          $objCompra = new compra();
          $objCompra->setIdCompra($row['idcompra']);
          $objCompra->cargar();
          $objProducto = new producto();
          $objProducto->setIdProducto($row['idproducto']);
          $objProducto->cargar();
          $obj->setear($row['idcompraItem'], $objProducto, $objCompra, $row['cofecha']);

          array_push($arreglo, $obj);
        }
      }
    } else {
      // $this->setmensajeoperacion("Tabla->listar: ".$base->getError());
    }

    return $arreglo;
  }
}
