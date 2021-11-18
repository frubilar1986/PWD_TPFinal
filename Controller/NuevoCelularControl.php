<?php
class NuevoCelularControl {

  function procesarData() {
    $data = data_submitted();

    if (isset($data['prodetalleC']) && isset($data['prodetalleD'])) {
      $data['prodetalle2'] = array_combine($data['prodetalleC'], $data['prodetalleD']);
      unset($data['prodetalleC']);
      unset($data['prodetalleD']);
      $data['prodetalle'] = array_merge($data['prodetalle'], $data['prodetalle2']);
      unset($data['prodetalle2']);
    }

    $data['prodetalle'] = json_encode($data['prodetalle']);

    return $data;
  }


  function guardarImagenes($idPro) {
    $dir = '../View/img/Productos/' . md5($idPro) . '/'; // especificamos el directorio donde se guardará el archivo (la carpeta debe estar creada)


    if (!file_exists($dir)) {
      mkdir($dir, 0777, true);
    }


    if ($_FILES['imagen']['error'] <= 0) {
      // echo "Nombre: " . $_FILES['imagen']['name'] . "<br>";
      // echo "Tipo: " . $_FILES['imagen']['type'] . "<br>";
      // echo "Tamaño: " . $_FILES['imagen']['size'] . "<br>";
      // echo "Carpeta temporal: " . $_FILES['imagen']['tmp_name'] . "<br>";
      // Intentamos copiar la imagen al servidor
      if (!copy($_FILES['imagen']['tmp_name'], $dir . $_FILES['imagen']['name'])) {
        echo "ERROR: no se pudo cargar la imagen";
      } else {
        // echo "La imagen " . $_FILES['imagen']['name'] . " se ha copiado con éxito <br>";
      }
    } else {
      echo "Error: no se pudo cargar La imagen. No se pudo acceder al imagen temporal";
    }
  }
}
