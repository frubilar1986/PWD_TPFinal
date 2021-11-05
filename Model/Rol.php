<?php

class Rol {

  private $idRol;
  private $rodescripcion;
  private $msjError;

  public function __construct() {
    $this->idRol = "";
    $this->rolDescrip = "";
  }

  public function setear($idRol, $RolDescrip) {
    $this->setIdRol($idRol);
    $this->setRolDescrip($RolDescrip);
  }

  public function getIdRol() {
    return $this->idRol;
  }

  public function setIdRol($idRol) {
    $this->idRol = $idRol;
  }
  public function getRolDescrip() {
    return $this->rolDescrip;
  }

  public function setRolDescrip($rolDescrip) {
    $this->rolDescrip = $rolDescrip;
  }
  public function getMsjError() {
    return $this->msjError;
  }

  public function setMsjError($msjError) {
    $this->msjError = $msjError;
  }

  public function cargar() {
    $resp = false;
    $base = new dataBase();
    $sql = "SELECT * FROM rol WHERE idrol = " . $this->getIdRol();
    if ($base->Iniciar()) {
      $res = $base->Ejecutar($sql);
      if ($res > -1) {
        if ($res > 0) {
          $row = $base->Registro();
          $this->setear($row['idrol'], $row['idrodescripcion']);
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
    $sql = "INSERT INTO rol (  rodescripcion  ) VALUES ('" . $this->getRolDescrip() . "')";

    //echo $sql;
    if ($base->Iniciar()) {
      if ($elId = $base->Ejecutar($sql)) {
        $this->setIdRol($elId);

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
    $sql = "UPDATE rol SET rodescripcion =" . $this->getRolDescrip() . " WHERE idrol = " . $this->getIdRol();
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
    $sql = "DELETE FROM rol WHERE idrol=" . $this->getIdRol();
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
    $sql = "SELECT * FROM rol ";
    if ($parametro != "") {
      $sql .= ' WHERE ' . $parametro;
    }
    // echo $sql;
    $res = $base->Ejecutar($sql);
    if ($res > -1) {
      if ($res > 0) {

        while ($row = $base->Registro()) {
          $obj = new rol();
          $obj->setear($row['idrol'], $row['rodescripcion']);

          array_push($arreglo, $obj);
        }
      }
    } else {
      // $this->setmensajeoperacion("Tabla->listar: ".$base->getError());
    }

    return $arreglo;
  }
}//fin clase rol
