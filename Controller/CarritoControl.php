<?php include_once "../config.php" ?>

<?php

class CarritoControl {

  public function agregarProducto() {
    $data = data_submitted();
  }

  public function productosCarrito() {
    $carrito = [
      ['pro' => 2, 'cant' => 2],
      ['pro' => 5, 'cant' => 5],
      ['pro' => 5, 'cant' => 2],
      ['pro' => 2, 'cant' => 1],
      ['pro' => 4, 'cant' => 2],
      ['pro' => 8, 'cant' => 3],
      ['pro' => 5, 'cant' => 2],
    ];

    $productos = [];
    $abmProducto = new AbmProducto();

    foreach ($carrito as $producto) {
      $condicion['idproducto'] = $producto['pro'];
      array_push($productos, $abmProducto->buscar($condicion)[0]);
    }

    // var_dump($productos);
    return $productos;
  }
}
