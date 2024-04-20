<?php

/**************************Validamos si id contiene algo de lo contrario los regresamos al home**************************/



require 'includes/app.php';
incluirTemplates('header');




/**************************obtenemos el id de get**************************/
$idPropiedad = $_GET['id'];

if (!$idPropiedad) {
  header('Location: /');
}


/**************************Importar la conexion a la BD**************************/
$instanciaBD = conectarDB();

/**************************Consltar**************************/
$query = "SELECT * FROM propiedades where id = {$idPropiedad} ;";

/**************************Obtener resultados**************************/
$resultado = mysqli_query($instanciaBD, $query);


/**************************Validamos si resultado tiene un id existente en la base de datos **************************/

if (!$resultado->num_rows) {
  header('Location: /');
}



$propiedad = mysqli_fetch_assoc($resultado);




?>
<main class="contenedor seccion contenido-centrado">
  <h1>Casa en venta frente al bosque</h1>

  <img loading="lazy" class="imagen-anuncio-unico" src="<?php echo $propiedad['imagen']; ?>" alt="anuncio" />

  <div class="unico resumen-propiedad ">
    <p class="precio">$<?php echo $propiedad['precio']; ?></p>

    <ul class="iconos-caracteristicas">
      <li>
        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="iconos wc" />
        <p><?php echo $propiedad['wc']; ?></p>
      </li>
      <li>
        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="iconos estacionamiento" />
        <p><?php echo $propiedad['estacionamiento']; ?></p>
      </li>
      <li>
        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="iconos habitaciones" />
        <p><?php echo $propiedad['habitaciones']; ?></p>
      </li>
    </ul>
    <p class="descripcion-anuncio">
      <?php echo $propiedad['descripcion']; ?>
    </p>

  </div>


</main>


<?php

incluirTemplates('footer');

?>