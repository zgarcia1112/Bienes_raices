<?php

require 'includes/app.php';
incluirTemplates('header', $inicio = true);
?>

<main class="contenedor seccion">
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
</main>

<section class="contenedor seccion">
  <h2>Casas y Depas en Venta</h2>

  <?php
  require 'includes/templates/anuncios.php';

  ?>


  <div class="alinear-derecha">
    <a href="anuncios.php" class="boton-verde">Ver todas</a>
  </div>
</section>

<section class="imagen-contacto">
  <h2>Encuentra la casa de tus suenos</h2>
  <p>
    Llena el formulario de contacto y un asesor se pondra en contacto
    contigo a la brevedad
  </p>
  <a class="boton-amarillo" href="contacto.html">Contactanos</a>
</section>
<!--.contacto-imagen-->

<div class="contenedor seccion seccion-inferior">
  <section class="blog">
    <h3>Nustro Blog</h3>

    <article class="entrada-blog">
      <div class="imagen">
        <picture>
          <source srcset="build/img/blog1.webp" type="image/webp" />
          <source srcset="build/img/blog1.jpg" type="image/jpeg" />
          <img loading="lazy" src="build/img/blog1.jpg" alt="Entrada de blog " />
        </picture>
      </div>
      <!--.imagen-->

      <div class="texto-entrada">
        <a href="entrada.html">
          <h4>Terraza en el techo de tu casa</h4>
          <p class="informacion-meta">
            Escrito el: <span>20/10/2021</span> por <span>Admin</span>
          </p>
          <p>
            Consejo para construir una terraza en el techo de tu casa con
            los mejores materiales y ahorrando dinero
          </p>
        </a>
      </div>
      <!--.exto-entrada-->
    </article>

    <article class="entrada-blog">
      <div class="imagen">
        <picture>
          <source srcset="build/img/blog2.webp" type="image/webp" />
          <source srcset="build/img/blog2.jpg" type="image/jpeg" />
          <img loading="lazy" src="build/img/blog2.jpg" alt="Entrada de blog " />
        </picture>
      </div>
      <!--.imagen-->

      <div class="texto-entrada">
        <a href="entrada.html">
          <h4>Guia para la decoracion de tu hogar</h4>
          <p class="informacion-meta">
            Escrito el: <span>20/10/2021</span> por <span>Admin</span>
          </p>
          <p>
            Maximiza el espacio en tu hogar con esta guia, aprende a
            combinar muebles y colores para darle vida a tu espacio.
          </p>
        </a>
      </div>
      <!--.exto-entrada-->
    </article>
  </section>

  <section class="testimoniales">
    <h3>testimoniales</h3>
    <div class="testimonial">
      <blockquote>
        El personal se comporto de una excelente forma, muy buena atencion y
        la casa que me ofrecieron cumple con todas mis expectativas.
      </blockquote>
      <p>- Emmanuel Garcia Cerriteno</p>
    </div>
    <!--.testimonial-->
  </section>
</div>
<!--.testimoniales-->

<?php

incluirTemplates('footer');

?>