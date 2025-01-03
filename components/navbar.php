
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">VelocityBikes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./prods.php">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./contact.php">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./vista_carrito.php"><i class="fas fa-cart-shopping"></i>
                            <span class="contador text-white" id="contador">
                                <?php echo isset($_SESSION['contador']) ? $_SESSION['contador'] : 0; ?>
                            </span>
                        </a>

                    </li>
                    <?php if (isset($_SESSION['id'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./logout.php">Cerrar sesión</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./login.php">iniciar sesión</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let cantidad = document.getElementById('prod').getAttribute('data-contador');

        let cantidadComoNumero = parseFloat(cantidad);;

        let contadorBoton = document.getElementById('contador');
        contadorBoton.innerHTML = cantidadComoNumero;
    });
</script>