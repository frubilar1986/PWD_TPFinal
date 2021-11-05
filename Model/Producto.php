<?php

class Producto {

  private $idProducto;
  private $proNombre;
  private $proDetalle;
  private $proCantStock;
  private $msjError;

  public function __construct() {
    $this->idProducto = '';
    $this->proNombre = '';
    $this->proDetalle = '';
    $this->proCantStock = '';
  }

  public function setear($idProducto, $proNombre, $proDetalle, $proCantStock) {
    $this->setIdProducto($idProducto);
    $this->setPronombre($proNombre);
    $this->setproDetalle($proDetalle);
    $this->setProCantStock($proCantStock);
  }

  public function getIdProducto() {
    return  $this->idProducto;
  }

  public function setIdProducto($idProducto) {
    $this->idProducto = $idProducto;
  }

  public function getProNombre() {
    return  $this->proNombre;
  }

  public function setProNombre($proNombre) {
    $this->proNombre = $proNombre;
  }
  public function getProDetalle() {
    return  $this->proDetalle;
  }

  public function setProDetalle($proDetalle) {
    $this->proDetalle = $proDetalle;
  }
  public function getProCantStock() {
    return  $this->proCantStock;
  }

  public function setProCantStock($proCantStock) {
    $this->proCantStock = $proCantStock;
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
    $sql = "SELECT * FROM producto WHERE idproducto = " . $this->getIdProducto();
    if ($base->Iniciar()) {
      $res = $base->Ejecutar($sql);
      if ($res > -1) {
        if ($res > 0) {
          $row = $base->Registro();
          //$objUsuario = new producto();
          // $objUsuario->setIdProducto($row['idproducto']);
          $this->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock']);
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
    $sql = "INSERT INTO producto ( pronombre, prodetalle,procantstock ) VALUES ('" . $this->getProNombre() . "','" . $this->getProDetalle() . "'," . $this->getProCantStock() . ")";

    //echo $sql;
    if ($base->Iniciar()) {
      if ($elId = $base->Ejecutar($sql)) {
        $this->setIdProducto($elId);

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
    $sql = "UPDATE producto SET pronombre = '" . $this->getProNombre() . "', prodetalle = '" . $this->getProDetalle() . "', procantstock = " . $this->getProCantStock() . " WHERE idproducto = " . $this->getIdProducto();
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
    $sql = "DELETE FROM producto WHERE idproducto= " . $this->getIdProducto();
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
    $sql = "SELECT * FROM producto ";
    if ($parametro != "") {
      $sql .= ' WHERE ' . $parametro;
    }
    // echo $sql;
    $res = $base->Ejecutar($sql);
    if ($res > -1) {
      if ($res > 0) {

        while ($row = $base->Registro()) {
          $obj = new producto();

          $obj->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock']);

          array_push($arreglo, $obj);
        }
      }
    } else {
      // $this->setmensajeoperacion("Tabla->listar: ".$base->getError());
    }

    return $arreglo;
  }
}//fin clase compra
