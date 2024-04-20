<?php

require 'includes/funciones.php';
incluirTemplates('header');
?>
<main class="contenedor seccion contenido-centrado">
  <h1>Casa en venta frente al bosque</h1>

  <picture>
    <source srcset="build/img/destacada.webp" type="image/webp" />
    <source srcset="build/img/destacada.jpg" type="image/jpeg" />
    <img loading="lazy" src="bulid/img/destacada.jpg" alt="imagen de la propiedad" />

    <p class="informacion-meta">
      Escrito el: <span>20/10/2021</span> por <span>Admin</span>
    </p>

    <div class="resumen-propiedad">
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum
        expedita odit voluptatum quaerat, consequuntur, veritatis soluta
        nemo, eius officia aliquid eveniet non aliquam ducimus nam molestias
        consectetur rem? Rem, voluptatem.
      </p>
      <p>
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente
        fugit libero harum! Iste libero temporibus quae possimus illo dolore
        eos sed! Impedit commodi quas fuga porro, asperiores nam optio
        possimus?
      </p>
    </div>
    <!--.resumen-propiedad-->
  </picture>
</main>

<?php

incluirTemplates('footer');

?>