<?php include_once "../config.php" ?>

<?php
/* Si no existe un id compra significa que sigo en el carrito actual entonces lo manejo con un id random. Una vez que confirmo la compra dejo $_SESSION["idCarrito"] vacio? */

/* Debo guardar en $_SESSION el arreglo con todos los productos que voy a tener en el carrito con sus id y cantidades  */
class CarritoControl
{

	public function agregarProducto($param)
	{
		if (isset($param["idProducto"])) {
			if (!isset($_SESSION["carrito"])) {
				$_SESSION["carrito"] = [];
			}
			$existeProd = false;
			$i = 0;
			$carrito = $_SESSION["carrito"];
			// mostrarArray($carrito);
			if ($carrito != []) {

				do {
					if ($carrito[$i]["idProducto"] == $param["idProducto"]) {
						$existeProd = true;
					}
					$i++;
				} while ($i < count($carrito) && $existeProd == false);
			}
			if (!$existeProd) {
				if (!isset($param["cantidadProducto"])) {
					$param["cantidadProducto"] = 1;
				}
				array_push($_SESSION["carrito"], $param);
				// echo "arr sesion abajo: ";
				// mostrarArray($_SESSION);
			}
		}
		return $existeProd;
	}

	public function eliminarProducto($param)
	{
		if (isset($param["idProducto"])) {
			$encontreProducto = false;
			$arrNuevo = [];
			$carrito = $_SESSION["carrito"];
			$i = 0;
			do {
				if ($carrito[$i]["idProducto"] == $param["idProducto"]) {
					$encontreProducto = true;
					unset($carrito[$i]);
				}
				$i++;
			} while ($i < count($carrito) && $encontreProducto == false);
			$arrNuevo = array_merge($carrito, $arrNuevo);
			unset($_SESSION["carrito"]);
			$_SESSION["carrito"] = $arrNuevo;
		}
		return $encontreProducto;
	}

	public function modificarCantidadProducto($param)
	{
		if (isset($param["idProducto"]) && isset($param["cantidadProducto"])) {
			$encontreProducto = false;
			$arrNuevo = [];
			$carrito = $_SESSION["carrito"];
			$i = 0;
			do {
				if ($carrito[$i]["idProducto"] == $param["idProducto"]) {
					$encontreProducto = true;
					$carrito[$i]["cantidadProducto"] = $param["cantidadProducto"];
					// mostrarArray($carrito);
				}
				$i++;
			} while ($i < count($carrito) && $encontreProducto == false);
			$arrNuevo = array_merge($carrito, $arrNuevo);
			$_SESSION["carrito"] = $arrNuevo;

		}
	}

	public function crearCompra()
	{
		/* Cuando le doy a "comprar" una vez ya este el carrito definido, creo una compra */
	}

	public function crearCompraItem()
	{
		/* Con un foreach recorro todo el arreglo y creo cada compra item */
	}
	/*   public function agregarProducto() {
    $data = data_submitted();
  } */

	/*   public function productosCarrito() {
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

    
		return $productos;
	}*/
}
