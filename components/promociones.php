<?php
include 'class/Promociones.php';

$objetos = new Promociones();
$miCatalogo = $objetos->traer_catalogo();

?>
<section class="container">
    <h2 class="text-center mb-4">Promociones</h2>
    <div class="row">

        <?php
        foreach ($miCatalogo as $producto) {
            include 'components/promoCard.php';
        }
        ?>

    </div>
</section>