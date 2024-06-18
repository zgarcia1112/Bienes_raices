<?php

require 'includes/funciones.php';
incluirTemplates('header');
?>

<main class="contenedor seccion">
  <h1>Conoce sobre Nosotros</h1>

  <div class="contenido-nosotros">
    <div class="imagen">
      <picture>
        <source srcset="build/img/nosotros.webp" type="image/webp" />
        <source srcset="build/img/nosotros.jpg" type="image/jpeg" />
        <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre nosotros" />
      </picture>
    </div>
    <!--.imagen-->
    <div class="texto-nosotros">
      <blockquote>25 anos de experiencia</blockquote>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo
        inventore, perferendis minus fuga culpa temporibus laborum nam ad,
        harum fugit iusto rerum debitis accusantium explicabo cum unde.
        Voluptatum, tempore culpa Lorem ipsum dolor sit amet consectetur
        adipisicing elit. Dolores autem vero, nam distinctio, reiciendis
        temporibus similique qui quia omnis rerum obcaecati excepturi
        repudiandae quasi quidem earum maxime incidunt alias architecto?
        Lorem ipsum dolor sit amet consectetur adipisicing elit.
        Perspiciatis esse temporibus dolorem doloremque quae impedit cumque,
        vero odit dolore alias placeat architecto eius! Magni expedita
        exercitationem quam veniam adipisci qui.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod libero
        eum quibusdam reprehenderit pariatur totam beatae, cum accusamus
        quae enim ipsa possimus laboriosam, sed quam eaque, rerum ducimus
        quis incidunt. Lorem, ipsum dolor sit amet consectetur adipisicing
        elit. Saepe nesciunt, blanditiis nemo aliquam, dicta eligendi
        provident consectetur illo quis neque sint reprehenderit ab eius.
        Autem ea iure consequatur velit commodi?
      </p>
    </div>
    <!--.texto-nosotros-->
  </div>
  <!--.contenido-nosotros-->
</main>

<section class="contenedor seccion">
  <h1>Mas sobre Nosotros</h1>

  <div class="iconos-nosotros">
    <div class="icono">
      <img src="build/img/icono1.svg" alt="Seguridad" loading="lazy" />
      <h3>Seguridad</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi
        laboriosam praesentium porro, officia, laborum sequi expedita
      </p>
    </div>
    <!--.icono-->

    <div class="icono">
      <img src="build/img/icono2.svg" alt="precio" loading="lazy" />
      <h3>Precio</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi
        laboriosam praesentium porro, officia, laborum sequi expedita
      </p>
    </div>
    <!--.icono-->

    <div class="icono">
      <img src="build/img/icono3.svg" alt="tiempo" loading="lazy" />
      <h3>Tiempo</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi
        laboriosam praesentium porro, officia, laborum sequi expedita
      </p>
    </div>
    <!--.icono-->
  </div>
  <!--.iconos-nosotros-->
</section>



<?php

incluirTemplates('footer');

?>