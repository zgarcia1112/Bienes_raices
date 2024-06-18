<?php
//Incluye un template
require '../includes/app.php';

// importar las clases
use App\Propiedad;
use App\Vendedores;

estadoAutenticado();

/*******************************************************consultar propiedades*****************************************************/

// implementar un metodo  para obtener todas las propiedades
$propiedades = Propiedad::all();
$vendedores = Vendedores::all();



// debugger($propiedades[0]->titulo);



//escribir el query
$query = "select id, titulo, precio,imagen  from propiedades ORDER BY id DESC;";


//consultar la BD
$resultadoConsulta = mysqli_query($db, $query);


// echo '<pre>';
// var_dump($_POST['id']);
// echo '</pre>';

//si en get no encuentra el parametro resulado le asigna null por default
$resultado = $_GET["resultado"] ?? null;
// var_dump($resultado);
/*******************************************************consultar propiedades*****************************************************/
/*******************************************************Eliminar propiedad*****************************************************/

if ($_SERVER['REQUEST_METHOD'] === 'POST') :

    //validar id
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    /**************************eliminar imagen conforme al id **************************/

    // $query = "SELECT imagen FROM propiedades WHERE id = {$id};";
    // $resultado =  mysqli_query($instBaseDatos, $query);
    // $dirImagenPropiedad = mysqli_fetch_assoc($resultado);
    // unlink(substr($dirImagenPropiedad['imagen'], 3));
    /**************************eliminar imagen conforme al id **************************/

    /**************************eliminar propiedad**************************/

    if ($id) :

        $tipo = $_POST['tipo'];

        if (validarTipoContenido($tipo)) {
            if ($tipo === "propiedad") {
                $propiedad = Propiedad::find($id);
                $propiedad->eliminar($id);
                $resultado = mysqli_query($instBaseDatos, $query);
            } elseif ($tipo === "vendedor") {
                $vendedores = Vendedores::find($id);
                $vendedores->eliminar($id);
            }
        }





    endif;



endif;
/*******************************************************Eliminar propiedad*****************************************************/


incluirTemplates('header');




?>
<main class="contenedor seccion">
    <h1>Administrador de bienes raices</h1>

    <?php
    $mensaje = mostrarNotificacion(intval($resultado)); //intval parcea resultado de string a int
    if ($mensaje) {
    ?><p class="alerta exito"> <?php echo sanitizarHtml($mensaje); ?></p>
    <?php } ?>


    <a href="/admin/propiedades/crear.php" class="boton-verde">Nueva propiedad</a>
    <a href="/admin/vendedores/crear.php" class="boton-amarillo">Nuevo vendedor</a>
    <h2>Propiedades</h2>
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
            <?php foreach ($propiedades as $propiedad) { ?>
                <tr>
                    <td><?php echo $propiedad->id;  ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img class="imagen-tabla" src="<?php echo '../../imagenes/' . $propiedad->imagen; ?>" alt="imagen propiedad"></td>
                    <td>$<?php echo $propiedad->precio; ?></td>
                    <td>
                        <!-- creamos un inputo hidden para enviar el id de la propiedad a eliminar -->
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a class="boton-amarillo-block" href="admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>">Actualizar</a>

                    </td>
                </tr>
            <?php } ?>
        </tbody>

    </table>

    <h2>Vendendores</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>


        <tbody>
            <?php foreach ($vendedores as $vendedor) { ?>
                <tr>
                    <td><?php echo $vendedor->id;  ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono ?></td>

                    <td>

                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a class="boton-amarillo-block" href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>">Actualizar</a>

                    </td>
                </tr>
            <?php } ?>
        </tbody>

    </table>
</main>


<?php



incluirTemplates('footer');

?>

<script src="../../build/js/bundle.min.js"></script>