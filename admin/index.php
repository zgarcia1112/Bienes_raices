<?php




//Incluye un template
require '../includes/funciones.php';
//importar la conexion
require '../includes/config/database.php';

$auth = estadoAutenticado();

if (!$auth) {
    header('Location: /');
}

/*******************************************************consultar propiedades*****************************************************/

$instBaseDatos = conectarDB();

//escribir el query
$query = "select id, titulo, precio,imagen  from propiedades ORDER BY id DESC;";


//consultar la BD
$resultadoConsulta = mysqli_query($instBaseDatos, $query);


// echo '<pre>';
// var_dump($_POST['id']);
// echo '</pre>';

//si en get no encuentra el parametro resulado le asigna null por default
$resultado = $_GET["resultado"] ?? null;
// var_dump($resultado);
/*******************************************************consultar propiedades*****************************************************/
/*******************************************************Eliminar propiedad*****************************************************/

if ($_SERVER['REQUEST_METHOD'] === 'POST') :
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    /**************************eliminar imagen conforme al id **************************/

    $query = "SELECT imagen FROM propiedades WHERE id = {$id};";
    $resultado =  mysqli_query($instBaseDatos, $query);
    $dirImagenPropiedad = mysqli_fetch_assoc($resultado);
    unlink(substr($dirImagenPropiedad['imagen'], 3));
    /**************************eliminar imagen conforme al id **************************/

    /**************************eliminar propiedad**************************/

    if ($id) :

        $query = "delete from propiedades where id = {$id};";
        $resultado = mysqli_query($instBaseDatos, $query);


        if ($resultado) {
            header('location: /admin?resultado=3');
        }




    endif;



endif;
/*******************************************************Eliminar propiedad*****************************************************/


incluirTemplates('header');




?>
<main class="contenedor seccion">
    <h1>Administrador de bienes raices</h1>

    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php endif; ?>
    <?php if (intval($resultado) === 2) : ?>
        <p class="alerta exito">Anuncio Actualizado correctamente</p>

    <?php endif; ?>

    <?php if (intval($resultado) === 3) : ?>
        <p class="alerta exito">Anuncio Eliminado </p>

    <?php endif; ?>

    <a href="/admin/propiedades/crear.php" class="boton-verde">Nueva propiedad</a>



    <table class="propiedades">
        <thead>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>


        <tbody>
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                <tr>
                    <td><?php echo $propiedad['id'];  ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td><img class="imagen-tabla" src="<?php echo $propiedad['imagen'] ?>" alt="imagen propiedad"></td>
                    <td>$<?php echo $propiedad['precio']; ?></td>
                    <td>
                        <!-- creamos un inputo hidden para enviar el id de la propiedad a eliminar -->
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a class="boton-amarillo-block" href="admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>">Actualizar</a>

                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>

    </table>
</main>


<?php

mysqli_close($instBaseDatos);

incluirTemplates('footer');

?>