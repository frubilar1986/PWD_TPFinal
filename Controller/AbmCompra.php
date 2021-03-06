<?php

class AbmCompra {

  /**
   * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
   * Retorna null si no se cargo el objeto
   * @param array $datos
   * @return Compra
   */
  private function cargarObjeto($datos) {
    $obj = null;

    if (array_key_exists('idcompra', $datos) and array_key_exists('cofecha', $datos) and array_key_exists('idUsuario', $datos)) {
      $obj = new Compra();
      $objUsuario = new Usuario();
      $objUsuario->cargar();
      $obj->setear($datos['idcompra'], $datos['cofecha'], $objUsuario);
    }

    return $obj;
  }

  /**
   * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
   * @param array $datos
   * @return Compra
   */
  private function cargarObjetoConClave($datos) {
    $obj = null;

    if (isset($datos['idcompra'])) {
      $obj = new Compra();
      $obj->setear($datos['idcompra'], null, null);
    }
    return $obj;
  }


  /**
   * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
   * @param array $datos
   * @return boolean
   */

  private function seteadosCamposClaves($datos) {
    $resp = false;
    if (isset($datos['idcompra']))
      $resp = true;
    return $resp;
  }

  /**
   * 
   * @param array $datos
   */
  public function alta($datos) {
    $resp = false;
    $datos['idcompra'] = null;
    $obj = $this->cargarObjeto($datos);

    if ($obj != null and $obj->insertar()) {
      $resp = true;
    }
    return $resp;
  }

  /**
   * permite eliminar un objeto 
   * @param array $datos
   * @return boolean
   */
  public function baja($datos) {
    $resp = false;
    if ($this->seteadosCamposClaves($datos)) {
      $obj = $this->cargarObjetoConClave($datos);
      if ($obj != null and $obj->eliminar()) {
        $resp = true;
      }
    }

    return $resp;
  }

  /**
   * permite modificar un objeto
   * @param array $datos
   * @return boolean
   */
  public function modificacion($datos) {
    $resp = false;
    if ($this->seteadosCamposClaves($datos)) {
      $obj = $this->cargarObjeto($datos);
      if ($obj != null and $obj->modificar()) {
        $resp = true;
      }
    }
    return $resp;
  }

  /**
   * permite buscar un objeto
   * @param array $datos
   * @return array
   */
  public function buscar($datos) {
    $where = " true ";
    if ($datos <> NULL) {
      if (isset($datos['idcompra']))
        $where .= " and idcompra  = {$datos['idcompra']}";
      if (isset($datos['cofecha']))
        $where .= " and cofecha = '{$datos['cofecha']}'";
      if (isset($datos['idusuario']))
        $where .= " and idusuario = {$datos['idusuario']}";
    }

    return Compra::listar($where);
  }
}
