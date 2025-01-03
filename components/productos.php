<?php


foreach ($miCatalogo as $producto) { ?>
    <div class='col-lg-6 '>
        <div class='row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-350 position-relative'>
            <div class='col-4 d-lg-block'>
                <img class='producto-imagen' src="<?php echo $producto->imagen ?>" alt='imagen'>
            </div>
            <div class='col-8 p-4 d-flex flex-column position-static'>
                <div class="micontenedor">
                    <h3 class='mb-0'><?php echo $producto->nombre ?></h3>
                    <div class='mb-1 text-body-secondary'><?php echo $producto->anio_lanzamiento ?></div>
                    <p class='card-text mb-auto'><?php echo $producto->descripcion ?></p>
                    <div class="row">
                        <div class="col-6">
                            <input type="number" id="cantidad-<?php echo $producto->id ?>" class="form-control quantity-input" name="cantidad-<?php echo $producto->id ?>" min="1" value="1">
                        </div>
                        <div class="col-6">
                            <?php
                            foreach ($misUsuarios as $usuario) {
                                if ($usuario->rol == 0) {
                                    
                            ?>
                                    <button class="btn btn-warning" type="button" id="enviarDatos" onclick="enviarDatosAlCarrito(<?php echo $producto->id ?>); incrementarContador();">
                                        <i class="fa-solid fa-cart-shopping fa-xl"></i>
                                    </button>
                            <?php }
                            }
                            ?>
                            <button class="btn p-0 m-0"><a href='./detalles.php?id=<?php echo $producto->id; ?>' class='text-light text-decoration-none btn btn-dark'>Ver más</a></button>
                        </div>
                    </div>
                </div>
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