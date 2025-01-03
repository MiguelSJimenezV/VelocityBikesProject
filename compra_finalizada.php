<?php
session_start();


// Después de que se muestre el mensaje de éxito, también puedes limpiar la sesión si es necesario

// Eliminar la sesión del carrito temporal si se usó una
if (isset($_COOKIE['carrito_hash'])) {
    unset($_COOKIE['carrito_hash']);
    setcookie('carrito_hash', null, -1, '/');
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

<?php
require 'components/navbar.php';

?>

<body>

    <section>
        <div class="container p-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="d-flex justify-content-center mb-3">
                        <img src="./assets/img/success.png" alt="Success img" width="20%">
                    </div>
                    <div class="message-box">
                        <h2 class="text-center mb-4">Hemos recibido tu pedido con éxito.</h2>
                        <p>Estaremos verificando los detalles de tu pago y nos comunicaremos contigo pronto para confirmar.</p>
                        <p>Para cualquier consulta o ayuda adicional, no dudes en llamarnos al <strong>VelocityBikes@soporte.com.ar</strong>.</p>
                        <p>Estamos aquí para asistirte.</p>
                        <a href="./prods.php" class="btn btn-warning">Seguir comprando</a>
                        <a href="logout.php" class="btn btn-warning ">Cerrar sesión</a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <?php require 'components/footer.php';
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>