<?php
session_start();
require_once "class/Productos.php";
require_once "class/Usuarios.php";
$productos = new Productos();

if (!$_SESSION['rol'] == 0) {
    header('location: index.php');
    exit();
  }



// Obtener el ID de usuario desde la sesión
$usuario_id = $_SESSION['id'];

// Obtener la dirección del usuario desde la base de datos
$conexion = new Conexion();
$db = $conexion->getConexion();
$stmt = $db->prepare('SELECT direccion FROM usuarios WHERE id = :id');
$stmt->execute(['id' => $usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo 'Error al obtener la información del usuario.';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar los datos del formulario
    $metodo_pago = $_POST['metodo_pago'];
    $direccion = $_POST['direccion'];
    $envio = $_POST['envio'];
    $total = 0;

    // Obtener los productos en el carrito junto con sus precios
    $stmtCarrito = $db->prepare('
        SELECT cp.usuario_id, cp.producto_id, cp.cantidad, p.precio 
        FROM carrito_producto cp 
        JOIN productos p ON cp.producto_id = p.id 
        WHERE cp.usuario_id = :usuario_id
    ');
    $stmtCarrito->execute(['usuario_id' => $usuario_id]);
    $carrito_producto = $stmtCarrito->fetchAll(PDO::FETCH_ASSOC);

    if (empty($carrito_producto)) {
        echo 'El carrito está vacío.';
        exit;
    }

    // Calcular el monto total del pedido
    foreach ($carrito_producto as $producto) {
        $total += $producto['cantidad'] * $producto['precio'];
    }

    // Insertar el pedido y obtener el ID del pedido insertado
    $queryPedido = "INSERT INTO pedidos (usuario_id, fecha, metodo_pago, direccion, envio, total) 
                    VALUES (:usuario_id, NOW(), :metodo_pago, :direccion, :envio, :total)";
    $stmtPedido = $db->prepare($queryPedido);
    $stmtPedido->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmtPedido->bindParam(':metodo_pago', $metodo_pago, PDO::PARAM_STR);
    $stmtPedido->bindParam(':direccion', $direccion, PDO::PARAM_STR);
    $stmtPedido->bindParam(':envio', $envio, PDO::PARAM_STR);
    $stmtPedido->bindParam(':total', $total, PDO::PARAM_STR);
    $stmtPedido->execute();

    // Obtener el ID del pedido insertado
    $pedido_id = $db->lastInsertId();

    // Insertar los detalles del pedido
    foreach ($carrito_producto as $producto) {
        $queryDetalle = "INSERT INTO detalles_pedido (pedido_id, usuario_id, producto_id, cantidad, precio_unitario) 
                         VALUES (:pedido_id, :usuario_id, :producto_id, :cantidad, :precio_unitario)";
        $stmtDetalle = $db->prepare($queryDetalle);
        $stmtDetalle->bindParam(':pedido_id', $pedido_id, PDO::PARAM_INT);
        $stmtDetalle->bindParam(':usuario_id', $producto['usuario_id'], PDO::PARAM_INT);
        $stmtDetalle->bindParam(':producto_id', $producto['producto_id'], PDO::PARAM_INT);
        $stmtDetalle->bindParam(':cantidad', $producto['cantidad'], PDO::PARAM_INT);
        $stmtDetalle->bindParam(':precio_unitario', $producto['precio'], PDO::PARAM_STR);
        $stmtDetalle->execute();
    }

    // Vaciar el carrito del usuario después de completar la compra
    $stmtVaciarCarrito = $db->prepare("DELETE FROM carrito_producto WHERE usuario_id = :usuario_id");
    $stmtVaciarCarrito->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmtVaciarCarrito->execute();

    // Redirigir a una página de confirmación o éxito
    header('location: compra_finalizada.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/blog/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link rel="stylesheet" href="./assets/css/mod.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />



    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->

    <title>Velocity Bikes</title>
</head>

<body>

    <?php
    require 'components/navbar.php';

    ?>


    <section class="px-5 my-2 text-light">
        <div class="container mt-5 text-center bg-dark p-5 justify-content-center">
        <h2 class="mb-4 text-center">Datos de Facturacion</h2>
        <p>Porfavor, Complete con sus datos</p>
        </div>

        <div class="container mt-2 text-center bg-dark p-5 d-flex justify-content-center">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="w-50">
                <div class="mb-3">
                    <label for="metodo_pago" class="form-label">Método de Pago:</label>
                    <select class="form-select" id="metodo_pago" name="metodo_pago" required>
                        <option value="efectivo">Efectivo al recibir</option>
                        <option value="tarjeta">Tarjeta de Crédito - Verificacion Previa</option>

                    </select>
                </div>

                <div class="mb-3">
                    <label for="envio" class="form-label">¿Desea envío?</label>
                    <select class="form-select" id="envio" name="envio" required>
                        <option value="si">Sí</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección de Envío:</label> <br>
                    <textarea class="form-control" id="direccion" name="direccion" rows="3" required><?php echo $usuario['direccion']; ?></textarea>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-warning">Finalizar Compra</button>
                </div>
            </form>
        </div>


    </section>

    <?php
    require 'components/footer.php';

    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>