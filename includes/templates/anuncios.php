<?php

/**************************Importar la conexion a la BD**************************/

$instanciaBD = conectarDB();

/**************************Consltar**************************/
$query = "SELECT * FROM propiedades LIMIT {$limite} ;";

/**************************Obtener resultados**************************/
$resultado = mysqli_query($instanciaBD, $query);



?>


<div class="contenedor-anuncios">


    <?php while ($propiedad = mysqli_fetch_assoc($resultado)) : ?>
        <div class="anuncio">

            <img class="imagen-anuncio" loading="lazy" src="<?php echo $propiedad['imagen'] ?>" alt="anuncio" />


            <div class="contenido-anuncio">
                <h3><?php echo $propiedad['titulo'] ?></h3>
                <p class="descripcion-anuncio">
                    <?php echo $propiedad['descripcion'] ?>
                </p>
                <p class="precio">$<?php echo $propiedad['precio'] ?></p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="iconos wc" />
                        <p><?php echo $propiedad['wc'] ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="iconos estacionamiento" />
                        <p><?php echo $propiedad['estacionamiento'] ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="iconos habitaciones" />
                        <p><?php echo $propiedad['habitaciones'] ?></p>
                    </li>
                </ul>

                <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Ver Propiedad</a>
            </div>
            <!--.contenido-anuncio-->
        </div>
        <!--.anuncio-->

    <?php endwhile;  ?>
</div> <!--.contenedor-anuncios-->


<?php
/**************************Cerrar la conexion**************************/

?>