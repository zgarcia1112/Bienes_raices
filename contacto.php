<?php

require 'includes/funciones.php';
incluirTemplates('header');
?>

<main class="contenedor seccion">
  <h1>Contacto</h1>
  <picture>
    <source srcset="build/img/destacada3.webp" type="image/webp" />
    <source srcset="build/img/destacada3.jpg" type="image/jpeg" />
    <img width="200" height="300" loading="lazy" src="build/img/destacada3.jpg" alt="jpeg" />
  </picture>

  <h2>Llene el formulario de Contacto</h2>
  <form class="formulario">
    <fieldset>
      <legend>Informacion personal</legend>

      <label for="nombre">Nombre:</label>
      <input type="text" placeholder="Tu nombre" id="nombre" />

      <label for="email">E-mail:</label>
      <input type="email" placeholder="Tu email" id="email" />

      <label for="telefono">telefono:</label>
      <input type="tel" placeholder="Tu telefono" id="telefono" />

      <label for="mensaje">mensaje:</label>
      <textarea id="mensaje"></textarea>
    </fieldset>

    <fieldset>
      <legend>Informacio sobre la Propiedad</legend>

      <label for="opciones">Vende o compra:</label>
      <select id="opciones">
        <option value="" disabled selected>--Selecciona--</option>
        <option value="Compra">Compra</option>
        <option value="Vende">Vende</option>
      </select>

      <label for="Presupuesto">Presupuesto o precio:</label>
      <input type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto" />
    </fieldset>

    <fieldset>
      <legend>Contacto</legend>
      <p>Como desea ser contactado:</p>

      <div class="forma-contacto">
        <label for="contactar-telefono">Telefono</label>
        <input name="contacto" type="radio" value="telefono" id="contactar-telefono" />

        <label for="contactar-email">E-mail</label>
        <input name="contacto" type="radio" value="email" id="contactar-email" />
      </div>

      <p>si eligio telefono, elija la fecha y la hora</p>

      <label for="fecha">Fecha:</label>
      <input type="date" placeholder="Tu Fecha" id="fecha" />

      <label for="hora">Hora:</label>
      <input type="time" placeholder="Tu Hora" id="hora" min="09:00" max="18:00" />
    </fieldset>
    <input type="submit" value="Enviar" class="boton-verde" />
  </form>
</main>


<?php

incluirTemplates('footer');

?>