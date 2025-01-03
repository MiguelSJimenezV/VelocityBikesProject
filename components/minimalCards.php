<div class="col-md-3 p-3">
  <div class="card h-100">
    <img src="<?php echo $producto->imagen ?>" class="card-img-top" alt="Productos">
    <div class="card-body">
      <h5 class="card-title"><?php echo $producto->nombre ?></h5>
      <p class="card-text"><?php echo $producto->marca ?></p>
      <p class="card-text"><?php echo $producto->descripcion ?></p>
      <p class="card-text"><strong>Precio:</strong> $79.50</p>
      <a href="./detalles.php?id=<?php echo $producto->id; ?>" class="btn btn-dark">Ver Detalles</a>
    </div>
  </div>
</div>