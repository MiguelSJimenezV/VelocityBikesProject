<?php
require_once "class/Productos.php";

// Crear una instancia de la clase Productos
$productos = new Productos();

// Obtener los datos enviados desde el formulario
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

// Llamar a la función guardarProducto() para insertar el producto en la base de datos

if ($productos->guardarProducto($id, $nombre, $marca, $anio_lanzamiento, $descripcion, $descripcion_larga, $material, $talle_disponible, $color_disponible, $cantidad_disponible, $imagen, $categoria, $precio)) {
   // El update se realizó correctamente
   echo "Producto guardado correctamente";
} else {
   // Ocurrió un error durante la operación 
   echo "Error al guardar el producto";
}

?>