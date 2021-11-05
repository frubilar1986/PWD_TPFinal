<?php

class AbmProducto {

  /**
   * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
   * @param array $param
   * @return Producto
   */
  private function cargarObjeto($param) {
    $obj = null;

    if (
      array_key_exists('idproducto', $param) &&
      array_key_exists('pronombre', $param) &&
      array_key_exists('prodetalle', $param) &&
      array_key_exists('procantstock', $param)
    ) {
      $obj = new Producto();

      $obj->setear($param['idproducto'], $param['pronombre'], $param['prodetalle'], $param['procantstock']);
    }
    return $obj;
  }

  /**
   * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
   * @param array $param
   * @return Producto
   */
  private function cargarObjetoConClave($param) {
    $obj = null;

    if (isset($param['idproducto'])) {
      $obj = new Producto();
      $obj->setear($param['idproducto'], null, null, null);
    }
    return $obj;
  }


  /**
   * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
   * @param array $param
   * @return boolean
   */

  private function seteadosCamposClaves($param) {
    $resp = false;
    if (isset($param['idproducto']))
      $resp = true;
    return $resp;
  }

  /**
   * Permite ingresar un registro en la base de datos
   * @param array $param
   * @return boolean
   */
  public function alta($param) {
    $resp = false;
    $param['id'] = null;
    $obj = $this->cargarObjeto($param);

    if ($obj != null && $obj->insertar()) {
      $resp = true;
    }
    return $resp;
  }
  /**
   * permite eliminar un objeto 
   * @param array $param
   * @return boolean
   */
  public function baja($param) {
    $resp = false;
    if ($this->seteadosCamposClaves($param)) {
      $obj = $this->cargarObjetoConClave($param);
      if ($obj != null && $obj->eliminar()) {
        $resp = true;
      }
    }

    return $resp;
  }

  /**
   * permite modificar un objeto
   * @param array $param
   * @return boolean
   */
  public function modificacion($param) {
    $resp = false;
    if ($this->seteadosCamposClaves($param)) {
      $obj = $this->cargarObjeto($param);
      if ($obj != null && $obj->modificar()) {
        $resp = true;
      }
    }
    return $resp;
  }

  /**
   * permite buscar un objeto
   * @param array $param
   * @return array
   */
  public function buscar($param) {
    $where = " true ";
    if ($param != null) {
      if (isset($param['idproducto']))
        $where .= " and idproducto  = {$param['idproducto']}";
      if (isset($param['pronombre']))
        $where .= " and pronombre = '{$param['pronombre']}'";
      if (isset($param['prodetalle']))
        $where .= " and prodetalle = '{$param['prodetalle']}'";
      if (isset($param['procantstock']))
        $where .= " and procantstock = '{$param['procantstock']}'";
    }

    $arreglo = Producto::listar($where);
    return $arreglo;
  }
}
