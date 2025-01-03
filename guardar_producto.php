<?php
require_once "class/Productos.php";
$productos = new Productos();

  // Obtener los datos del formulario
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];
  $marca = $_POST['marca'];
  $anio_lanzamiento = $_POST['anio_lanzamiento'];
  $descripcion = $_POST['descripcion'];
  $descripcion_larga = $_POST['descripcion_larga'];
  $material = $_POST['material'];
  $talle_disponible = $_POST['talle_disponible'];
  $color_disponible = $_POST['color_disponible'];
  $cantidad_disponible = $_POST['cantidad_disponible'];
  $imagen = $_POST['imagen'];
  $categoria = $_POST['categoria'];
  $precio = $_POST['precio'];
  

  // Crear una instancia de la clase Productos


  // Llamar a la función guardarProducto() para insertar el producto en la base de datos
  if ($productos->actualizar_producto($id, $nombre, $marca, $anio_lanzamiento, $descripcion, $descripcion_larga, $material, $talle_disponible, $color_disponible, $cantidad_disponible, $imagen, $categoria, $precio)) {
    // el insert se realizó correctamente
    echo "success";
  } else {
    // Ocurrió un error durante la inserción
    echo "error";
  }

?>