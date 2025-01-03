<div class="col-md-6">
    <div class="card mb-4">
        <div class="card-body">
            <h3 class="card-title"><?php echo $producto->titulo ?></h3>
            <p class="card-text"><?php echo $producto->descripcion ?></p>
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Obtener Codigo
            </button>
        </div>
    </div>

</div>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Codigo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="card-text"><?php echo $producto->codigo ?></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning"><a class="nav-link" href="./prods.php">Ver productos</a></button>

            </div>
        </div>
    </div>
</div>