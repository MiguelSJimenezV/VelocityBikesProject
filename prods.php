<!DOCTYPE html>
<html lang="es" data-bs-theme="auto">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->

    <title>Velocity Bikes</title>
</head>

<body>
    <?php
    session_start();

    // Verificar si el usuario está logueado
    if (!isset($_SESSION['id'])) {
        // Si no está logueado, redirigir a login.php
        header("Location: login.php");
        exit();
    }
    
    


    require 'components/navbar.php';
    include 'class/Productos.php';
    include 'class/Usuarios.php';

    $usuario = new Usuarios();
    $misUsuarios = $usuario->traer_usuarios();


    $objetos = new Productos();
    $miCatalogo = $objetos->traer_catalogo();
 
   /*  if($usuario->) */
    ?>

    <div class="container py-3">
        <h2>Lista de productos</h2>

        <div class='row mb-2 py-3'>
            <?php
            include 'components/productos.php';

            ?>
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

        let contador = 0;

        function enviarDatosAlCarrito(producto_id) {

            let cantidad = document.getElementById('cantidad-' + producto_id).value;
            let data = {
                producto_id: producto_id,
                cantidad: cantidad
            };
            let cantidadComoNumero = parseInt(cantidad);
            let contadorBoton = document.getElementById('contador');
            contador += cantidadComoNumero;
            contadorBoton.innerHTML = contador;

            $.ajax({
                url: 'carrito.php',
                method: 'POST',
                data: data,
                success: function(response) {
                    console.log(response);


                    console.log(contador)
                    console.log(contadorBoton)

                    $('#mensaje-agregado-ok').addClass('mensaje-visible').text("Producto agregado correctamente al carrito.");
                    setTimeout(function() {
                        $('#mensaje-agregado-ok').removeClass('mensaje-visible');
                    }, 3000); // Oculta el mensaje después de 3 segundos
                },
                error: function() {
                    console.log('Algo salió mal');
                }
            });
        }
    </script>
    <script>
        function incrementarContador() {
            // Crear una solicitud AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "incrementar.php", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Actualizar el contador en la página
                    document.getElementById("contador").innerText = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>

</body>

</html>