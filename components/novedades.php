<?php
include 'class/Productos.php';

$objetos = new Productos();
$miCatalogo = $objetos->traer_catalogo();
?>
<section class="container py-4">
  <h2 class="text-center mb-4">Novedades</h2>
  <div class="row">
    <?php
    foreach ($miCatalogo as $producto) {
      include 'components/minimalCards.php';
    }
    ?>

  </div>
</section>