<?php
require_once "class/Productos.php";

// Crear una instancia de la clase Productos
$productos = new Productos();


if (isset($_POST['id'])) {
    // Obtener el ID del producto a eliminar
    $id = $_POST['id'];  

    $productos = new Productos();
    if ($productos->eliminarProducto($id)) {
      // Eliminación exitosa
      echo "success";
    } else {
      // Ocurrió un error durante la eliminación
      echo "error";
    }
  }

?>