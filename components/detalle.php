<?php
include 'class/Productos.php';
$idProducto = $_GET["id"];

$objetos = new Productos();
$miDetalle = $objetos->traer_detalle($idProducto);

if ($miDetalle) {
?>

    <div class="container">
        <div class="p-3">
            <div class='col-lg-12 h-100'>
                <div class='row border rounded shadow-sm'>
                    <div class='col-4 d-lg-block'>
                        <img class='producto-imagen' src="<?php echo $miDetalle->imagen ?>" alt='imagen'>
                    </div>
                    <div class='col-8'>
                        <div class="p-5">
                            <h3 class='mb-0'><?php echo $miDetalle->nombre ?></h3>
                            <div class='mt-2 text-body-secondary'>Año: <?php echo $miDetalle->anio_lanzamiento ?></div>
                            <div class='mt-2 text-body-secondary'>Talles Disponibles: <?php echo $miDetalle->talle_disponible ?></div>
                            <div class='mt-2 text-body-secondary'>Colores: <?php echo $miDetalle->color_disponible ?></div>
                            <div class='mt-2 text-body-secondary'>Material: <?php echo $miDetalle->material ?></div>
                            <p class='card-text mt-3'><?php echo $miDetalle->descripcion_larga ?></p>
                            <div class='mt-2 h4 bold'>Precio: $<?php echo $miDetalle->precio ?> USD</div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="cantidad-<?php echo $miDetalle->id ?>" class="form-label">Cantidad:</label>
                                    <input type="number" id="cantidad-<?php echo $miDetalle->id ?>" class="form-control quantity-input" name="cantidad-<?php echo $miDetalle->id ?>" min="1" value="1">
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-warning" type="button" id="enviarDatos" onclick="enviarDatosAlCarrito(<?php echo $miDetalle->id ?>)">
                                        <i class="fa-solid fa-cart-shopping fa-xl"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else {

?>
    <div class="container py-5">
        <div class='col-lg-12 '>
            <div class='row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-350 position-relative'>
                <h2 class="p-5 text-center">Producto no Encontrado</h2>
            </div>
        </div>
    </div>

<?php
}
?>


<style>
    .micontenedor {
        display: flex;
        flex-direction: column;
        align-items: baseline;
        justify-content: center;
        width: auto;
        height: 220px;

    }
</style>

<script>
    let contador = 0;

    function enviarDatosAlCarrito(producto_id) {

        let cantidad = document.getElementById('cantidad-' + producto_id).value;
        console.log(cantidad)
        let data = {
            producto_id: producto_id,
            cantidad: cantidad
        };
        let cantidadComoNumero = parseInt(cantidad);
        let contadorBoton = document.getElementById('contador');
        contador += cantidadComoNumero; // Sumar al contador global
        contadorBoton.innerHTML = contador;

        $.ajax({
            url: 'carrito.php',
            method: 'POST',
            data: data,
            success: function(response) {
                console.log(response);


                console.log("linea 98:" + contador)
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