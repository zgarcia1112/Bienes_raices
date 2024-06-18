<?php

require 'includes/app.php';
incluirTemplates('header');
?>

<main class="contenedor seccion">
  <h1>Casas y Depas en Venta</h1>

  <?php
  $limite = 24;

  include 'includes/templates/anuncios.php';

  ?>

</main>


<?php

incluirTemplates('footer');

?>