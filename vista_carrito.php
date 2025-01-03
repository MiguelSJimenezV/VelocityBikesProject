<!DOCTYPE html>
<html lang="es" data-bs-theme="auto">

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
    session_start();
    require 'components/navbar.php';
    require_once "class/Productos.php";


    // Crear una instancia de la clase Productos
    $carrito = new Productos();

    // Verificar si el usuario está logueado o si es un usuario temporal
    $usuario_id = isset($_SESSION['id']) ? $_SESSION['id'] : (isset($_COOKIE['carrito_hash']) ? $_COOKIE['carrito_hash'] : null);

    // Si no hay un usuario_id, redirigir al catálogo (o a otra página adecuada)
    if (!$usuario_id) {
        header("Location: prods.php");
        exit();
    }

    // Obtener los productos del carrito del usuario
    $miCarrito = $carrito->traer_carrito($usuario_id);
    ?>

    <div class="container mt-5 ">
        <h2 class="mb-4 text-center">Carrito de Compras</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Código</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Precio Total</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalAPagar = 0;
                $totalProducto = 0;
                foreach ($miCarrito as $producto) {
                    $precioTotalProducto = $producto->precio * $producto->cantidad;
                    $totalAPagar += $precioTotalProducto;

                    $cantidadProducto = $producto->cantidad;
                    $totalProducto += $cantidadProducto;

                ?>
                    <tr>
                        <td><?php echo $producto->id; ?></td>
                        <td><?php echo $producto->nombre; ?></td>
                        <td><?php echo $producto->categoria; ?></td>
                        <td><?php echo $producto->cantidad; ?></td>
                        <td>$<?php echo number_format($producto->precio, 2); ?></td>
                        <td>$<?php echo number_format($precioTotalProducto, 2); ?></td>
                        <td>
                            <button class="btn eliminar-btn" onclick="eliminarProducto(<?php echo $producto->id; ?>)"><span class="material-icons">delete</span></button>
                        </td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="6" class="text-end"><strong>Total a Pagar:</strong></td>
                    <td><strong>$<?php echo number_format($totalAPagar, 2); ?></strong></td>

                </tr>
            </tbody>
        </table>
        <p id="prod" data-contador="<?php echo number_format($totalProducto); ?>"></p>

        <div class="text-center my-4">
            <a href="./prods.php" class="btn btn-warning">Seguir comprando</a>

            <a href="./finalizar_compra.php" class="btn btn-warning">Finalizar Compra</a>
        </div>

    </div>

    <?php
    require 'components/footer.php';
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let cantidad = document.getElementById('prod').getAttribute('data-contador');

            let cantidadComoNumero = parseFloat(cantidad);;

            let contadorBoton = document.getElementById('contador');
            contadorBoton.innerHTML = cantidadComoNumero;
        });

        function eliminarProducto(producto_id) {
            let data = {
                producto_id: producto_id
            };

            $.ajax({
                url: 'eliminar_del_carrito.php',
                method: 'POST',
                data: data,
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function() {
                    console.log('Algo salió mal');
                }
            });
        }
    </script>
</body>

</html>