<?php

class UsuarioRol {

  private $objIdUsuario;
  private $objIdRol;
  private $msjError;

  public function __construct() {
    $this->objIdUsuario = null;
    $this->objIdRol = "";
  }

  public function setear($objIdUsuario, $objIdRol) {
    $this->setObjIdUsuario($objIdUsuario);
    $this->setObjIdRol($objIdRol);
  }

  public function getObjIdUsuario() {
    return $this->objIdUsuario;
  }

  public function setObjIdUsuario($idusuario) {
    $this->objIdUsuario = $idusuario;
  }
  public function getObjIdRol() {
    return $this->objIdRol;
  }

  public function setObjIdRol($objIdRol) {
    $this->objIdRol = $objIdRol;
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
    $sql = "SELECT * FROM usuariorol WHERE idusuario = " . $this->getObjIdUsuario()->getIdUsuario();
    if ($base->Iniciar()) {
      $res = $base->Ejecutar($sql);
      if ($res > -1) {
        if ($res > 0) {
          $row = $base->Registro();
          $this->setear($row['idusuario'], $row['idrol']);
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
    $sql = "INSERT INTO usuariorol (  idusuario,idrol  ) VALUES (" . $this->getObjIdUsuario()->getIdusuario() . "," . $this->getObjIdRol()->getIdRol() . ")";

    //echo $sql;
    if ($base->Iniciar()) {
      if ($elId = $base->Ejecutar($sql)) {
        $this->setObjIdRol($elId);

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
    $sql = "UPDATE usuariorol SET idrol =" . $this->getobjIdRol()->getIdRol() . " WHERE idusuario = " . $this->getObjIdUsuario()->getIdUsuario();
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
    $sql = "DELETE FROM usuariorol WHERE idusuario = " . $this->getObjIdUsuario()->getIdUsuario();
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
    $sql = "SELECT * FROM usuariorol ";
    if ($parametro != "") {
      $sql .= ' WHERE ' . $parametro;
    }
    // echo $sql;
    $res = $base->Ejecutar($sql);
    if ($res > -1) {
      if ($res > 0) {

        while ($row = $base->Registro()) {
          $obj = new usuariorol();
          $obj->setear($row['idusuario'], $row['idrol']);

          array_push($arreglo, $obj);
        }
      }
    } else {
      // $this->setmensajeoperacion("Tabla->listar: ".$base->getError());
    }

    return $arreglo;
  }
}//fin clase rol
