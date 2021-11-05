<?php

class Menu {

  private $idMenu;
  private $meNombre;
  private $meDescripcion;
  private $objsMeIdPadre;
  private $meDeshabilitado;
  private $msjError;
  //private $;

  public function __construct() {
    $this->idMenu = '';
    $this->meNombre = '';
    $this->meDescripcion = '';
    $this->objsMeIdPadre = null;
    $this->meDeshabilitado = '';
    $this->msjError = '';
  }

  public function setear($idMenu, $meNombre, $meDescrip, $objsMeIdPadre, $meDeshabilitado) {
    $this->setIdMenu($idMenu);
    $this->setMeNombre($meNombre);
    $this->setMeDescripcion($meDescrip);
    $this->setObjsMeIdPadre($objsMeIdPadre);
    $this->setMeDeshabilitado($meDeshabilitado);
  }

  public function getIdMenu() {
    return $this->idMenu;
  }

  public function setIdMenu($idMenu) {
    $this->idMenu = $idMenu;
  }
  public function getMeNombre() {
    return $this->meNombre;
  }

  public function setMeNombre($meNombre) {
    $this->meNombre = $meNombre;
  }
  public function getMeDescripcion() {
    return $this->meDescripcion;
  }

  public function setMeDescripcion($meDescrip) {
    $this->meDescripcion = $meDescrip;
  }
  public function getObjsMeIdPadre() {
    //ver mapeo Obj
    return $this->meIdPadre;
  }

  public function setObjsMeIdPadre($idPadre) {
    $this->meIdPadre = $idPadre;
  }
  public function getMeDeshabilitado() {
    return $this->meDeshabilitado;
  }

  public function setMeDeshabilitado($meDeshabli) {
    $this->meDeshabilitado = $meDeshabli;
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
    $sql = "SELECT * FROM menu WHERE idmenu = " . $this->getIdMenu();
    if ($base->Iniciar()) {
      $res = $base->Ejecutar($sql);
      if ($res > -1) {
        if ($res > 0) {
          $row = $base->Registro();
          $this->setear($row['idmenu'], $row['menomnbre'], $row['medescripcion'], $row['idpadre'], $row['medeshabilitado']);
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
    $sql = "INSERT INTO menu ( menombre,medescripcion, idpadre,medeshabilitado) VALUES ('" . $this->getMeNombre() . "','" . $this->getMeDescripcion() . "'," . $this->getObjsMeIdPadre()->getIdMenu() . ",'" . $this->getMeDeshabilitado() . "')";

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

    if ($this->getMeDeshabilitado() != 'null') {
      // echo "verdadero";
      $sql = "UPDATE menu SET menombre='" . $this->getMeNombre() . "', medescripcion='" . $this->getMeDescripcion() . "', idpadre=" . $this->getObjsMeIdPadre()->getIdMenu() . ", medeshabilitado = '" . $this->getMeDeshabilitado() . "  WHERE idmenu = " . $this->getIdMenu();
    } else {
      // $this->setUsDeshabilitado(null)
      //echo "Faslso";
      $sql = "UPDATE menu SET menombre = '" . $this->getMeNombre() . "', medescripcion = '" . $this->getMeDescripcion() . "', idpadre = " . $this->getObjsMeIdPadre()->getIdMenu() . ", medeshabilitado = NULL WHERE idmenu = " . $this->getIdMenu();
    }
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
    $sql = "DELETE FROM menu WHERE idmenu=" . $this->getIdMenu();
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
    $sql = "SELECT * FROM menu ";
    if ($parametro != "") {
      $sql .= ' WHERE ' . $parametro;
    }
    // echo $sql;
    $res = $base->Ejecutar($sql);
    if ($res > -1) {
      if ($res > 0) {

        while ($row = $base->Registro()) {
          $obj = new menu();
          $objMenuPadre = new menu();
          //if $row['idpadre'] == ''? obj = null ??????
          $objMenuPadre->setIdMenu($row['idpadre']);
          $objMenuPadre->cargar();
          $obj->setear($row['idmenu'], $row['menombre'], $row['medescripcion'], $objMenuPadre, $row['medeshabilitado']);

          array_push($arreglo, $obj);
        }
      }
    } else {
      // $this->setmensajeoperacion("Tabla->listar: ".$base->getError());
    }

    return $arreglo;
  }
}//fin clase menu
