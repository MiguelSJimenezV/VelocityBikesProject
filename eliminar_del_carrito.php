<?php
require_once "class/Productos.php";

session_start();

$producto_id = $_POST['producto_id'];
$usuario_id = isset($_SESSION['id']) ? $_SESSION['id'] : (isset($_COOKIE['carrito_hash']) ? $_COOKIE['carrito_hash'] : null);

if ($usuario_id && $producto_id) {
    $producto = new Productos();
    if ($producto->eliminar_del_carrito($usuario_id, $producto_id)) {
        echo "Producto eliminado correctamente";
    } else {
        echo "Error al eliminar el producto";
    }
} else {
    echo "Faltan datos para eliminar el producto del carrito";
}
?>
