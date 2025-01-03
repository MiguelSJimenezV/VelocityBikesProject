<?php
require_once "class/Productos.php";
session_start(); // Iniciar la sesión

// Crear una instancia de la clase Productos
$carrito = new Productos();

// Obtener los datos del formulario y sanitizarlos
$id = filter_input(INPUT_POST, 'producto_id', FILTER_SANITIZE_NUMBER_INT);
$cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_SANITIZE_NUMBER_INT);

function generarUnHash() {
    return uniqid(); // Generar un hash único
}

if (isset($_SESSION['id'])) {
    $usuario_id = $_SESSION['id'];
} else {
    if (isset($_COOKIE['carrito_hash'])) {
        $usuario_id = $_COOKIE['carrito_hash'];
    } else {
        $usuario_id = generarUnHash();
        setcookie('carrito_hash', $usuario_id, time() + 3600, '/'); // Caduca en una hora
    }
}

// Verificar si el producto ya está en el carrito
$producto_en_carrito = $carrito->buscarProductoEnCarrito($id, $usuario_id);

if ($producto_en_carrito) {
    // Si el producto ya está en el carrito, actualizar la cantidad
    $nueva_cantidad = $producto_en_carrito['cantidad'] + $cantidad;
    if ($carrito->actualizarCantidadEnCarrito($id, $nueva_cantidad, $usuario_id)) {
        echo json_encode(['status' => 'success', 'message' => 'Cantidad actualizada en el carrito']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar la cantidad en el carrito']);
    }
} else {
    // Si el producto no está en el carrito, agregarlo
    if ($carrito->guardarEnCarrito($id, $cantidad, $usuario_id)) {
        echo json_encode(['status' => 'success', 'message' => 'Producto agregado correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al agregar el producto']);
    }
}
?>
