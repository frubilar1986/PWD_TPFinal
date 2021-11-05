<?php

class Usuario {

  private $idUsuario;
  private $usNombre;
  private $usPass;
  private $usMail;
  private $usDeshabilitado;
  private $msjError;
  //private $;

  public function __construct() {
    $this->idUsuario = '';
    $this->usNombre = '';
    $this->usPass = '';
    $this->usMail = null;
    $this->usDeshabilitado = '';
    $this->msjError = '';
  }

  public function setear($idUsuario, $usNombre, $usPass, $usMail, $usDeshabilitado) {
    $this->setIdUsuario($idUsuario);
    $this->setUsNombre($usNombre);
    $this->setUsPass($usPass);
    $this->setUsMail($usMail);
    $this->setUsDeshabilitado($usDeshabilitado);
  }

  public function getIdUsuario() {
    return $this->idUsuario;
  }

  public function setIdUsuario($idUsuario) {
    $this->idUsuario = $idUsuario;
  }
  public function getUsNombre() {
    return $this->usNombre;
  }

  public function setUsNombre($usNombre) {
    $this->usNombre = $usNombre;
  }
  public function getUsPass() {
    return $this->usPass;
  }

  public function setUsPass($usPass) {
    $this->usPass = $usPass;
  }
  public function getUsMail() {
    return $this->usMail;
  }

  public function setUsMail($usMail) {
    $this->usMail = $usMail;
  }

  public function getUsDeshabilitado() {
    return $this->usDeshabilitado;
  }

  public function setUsDeshabilitado($usDeshabli) {
    $this->usDeshabilitado = $usDeshabli;
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
    $sql = "SELECT * FROM usuario WHERE idusuario = " . $this->getIdUsuario();
    if ($base->Iniciar()) {
      $res = $base->Ejecutar($sql);
      if ($res > -1) {
        if ($res > 0) {
          $row = $base->Registro();
          $this->setear($row['idusuario'], $row['usnomnbre'], $row['uspass'], $row['usmail'], $row['usdeshabilitado']);
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
    $sql = "INSERT INTO usuario (  usnombre, uspass, usmail, usdeshabilitado ) VALUES ('" . $this->getUsNombre() . "','" . $this->getUsPass() . "','" . $this->getUsMail() . "','" . $this->getUsDeshabilitado() . "')";

    //echo $sql;
    if ($base->Iniciar()) {
      if ($elId = $base->Ejecutar($sql)) {
        $this->setIdUsuario($elId);

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

    if ($this->getUsDeshabilitado() != 'null') {
      // echo "verdadero";
      $sql = "UPDATE usuario SET usnombre='" . $this->getUsNombre() . "', uspass='" . $this->getUsPass() . "', usmail= '" . $this->getUsMail() . "' , usdeshabilitado = '" . $this->getUsDeshabilitado() . "  WHERE idusuario = " . $this->getIdUsuario();
    } else {
      // $this->setUsDeshabilitado(null)
      //echo "Faslso";
      $sql = "UPDATE usuario SET usnombre = '" . $this->getUsNombre() . "', uspass = '" . $this->getUsPass() . "', usmail = '" . $this->getUsMail() . "', usdeshabilitado = NULL WHERE idusuario = " . $this->getIdUsuario();
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
    $sql = "DELETE FROM usuario WHERE idusuario=" . $this->getIdUsuario();
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
    $sql = "SELECT * FROM usuario ";
    if ($parametro != "") {
      $sql .= ' WHERE ' . $parametro;
    }
    // echo $sql;
    $res = $base->Ejecutar($sql);
    if ($res > -1) {
      if ($res > 0) {

        while ($row = $base->Registro()) {
          $obj = new usuario();

          $obj->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usmail'], $row['usdeshabilitado']);

          array_push($arreglo, $obj);
        }
      }
    } else {
      // $this->setmensajeoperacion("Tabla->listar: ".$base->getError());
    }

    return $arreglo;
  }
}//fin clase menu
