<?php
require '../../includes/config/database.php';
require '../../includes/funciones.php';

$auth = estadoAutenticado();

if (!$auth) {
    header('Location: /');
}

$admin = true;

//obtenemos de GET el id que pasamos de index.php y validamos que en realiaas sea un int
$idActualizar = $_GET['id'];

// Validamos que sea un od valido
$idActualizar = filter_var($idActualizar, FILTER_VALIDATE_INT);
if (!$idActualizar) {
    header('Location: /admin');
}

// Instancia de la base de datos para ocupar aca
$instBaseDatos = conectarDB();
// echo $_SERVER['REQUEST_METHOD'];
// var_dump(date("Y/m/d"));

//obtenemos los datos de la propiedad
$consultaPropiedad = "SELECT * FROM propiedades  WHERE  id =" . $idActualizar;
$resultadoPropiedadConsultada = mysqli_query($instBaseDatos, $consultaPropiedad);
$datosPropiedadConsultada = mysqli_fetch_assoc($resultadoPropiedadConsultada);



//consulta para obtener vendendores
$consultaVendedores = "select * from vendedores";
$listaVendedores = mysqli_query($instBaseDatos, $consultaVendedores);
// echo rand(); ///genera numeros de forma alateoria


//arreglo con mensaje de errores
$errores = [];

$titulo = $datosPropiedadConsultada['titulo'];

$precio = $datosPropiedadConsultada['precio'];
$descripcion = $datosPropiedadConsultada['descripcion'];
$habitaciones = $datosPropiedadConsultada['habitaciones'];
$wc = $datosPropiedadConsultada['wc'];
$estacionamiento = $datosPropiedadConsultada['estacionamiento'];
$vendedorId = $datosPropiedadConsultada['vendedores_id'];
$imagenPropiedad = $datosPropiedadConsultada['imagen'];


//$_SERVER : nos trae informacion del servidor
// $_POST : nos trae informacoin de cuando realizamos una peticion de tipo POST
// $_FILES : nos permite ver el contenido de los archivos


//ejecuta el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';

    // echo '<pre>';
    // var_dump($_FILES);
    // echo '</pre>';

    // exit;
    // exit; //detiene la ejecucion del codigo

    $titulo = mysqli_real_escape_string($instBaseDatos, $_POST['titulo']);
    $precio = mysqli_real_escape_string($instBaseDatos, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($instBaseDatos, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($instBaseDatos, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($instBaseDatos, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($instBaseDatos, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($instBaseDatos, $_POST['vendedor']);
    $fechaHoy = date("Y/m/d");
    //asignamos files hacia una variable
    $imagen = $_FILES['imagen'];

    //validar formulario y guardar error en array si fuera el caso

    if (!$titulo) {
        $errores[] = "Debes anadir un titulo *";
    }

    if (!$precio) {
        $errores[] = "Debes anadir un precio *";
    }

    if (strlen($descripcion) < 50) {
        $errores[] = "la descripcion es obligatoria y debe tenes almenos 50 caracteres *";
    }

    if (!$habitaciones) {
        $errores[] = "Debes anadir las habitaciones *";
    }

    if (!$wc) {
        $errores[] = "Debes anadir los banos *";
    }

    if (!$estacionamiento) {
        $errores[] = "Debes anadir los estacionamientos *";
    }

    if (!$vendedorId) {
        $errores[] = "Debes anadir un vendedor *";
    }

    // if (!$imagen['name']) {
    //     $errores  = "Debes cargar la imagen";
    // }
    // (!$imagen['name']) ? $errores[] = "Debes cargar la imagen *" : ""; //la imagen ya no es obligatoria porque como tal ya tiene una imagen pre cargada

    if ($imagen['error'] === 1) :  $errores[] = "estas anadiendo una imagen con un tamano de mas de 2mb";
    endif;

    //validar por tamano la imagen (1mb maximo)
    $medidaMaximaImagen = 1000 * 1000;
    ($imagen['size'] > $medidaMaximaImagen) ? $errores[] = "La imagen es muy pesada" : "";





    ///revisamos que errores no tenga nada, para poder continuar con el registro en la base de datos 
    if (empty($errores)) {
        /** Subida de archivos  */

        //crear carpeta
        $carpetaImagenes = "../../imagenes/";

        //validamos que la carpeta que queremos crear no exista= retorna un true si existe
        if (!is_dir($carpetaImagenes)) : mkdir($carpetaImagenes);
        endif;


        /**************************validamos el arreglo imagen contiene algo, si lo tiene eliminamos la imagen anterior con el metodo unlink**************************/


        if ($imagen['name']) :   ///si la imagen tiene un contenido lo interpreta como "true"
            ///si existe una imagen nueva eliminamos la imagen previa
            unlink($datosPropiedadConsultada['imagen']);
            ///  genera un nombre unico de forma aleatoria
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';


            $direccionImagen = $carpetaImagenes . $nombreImagen;

            //subir la imagen
            move_uploaded_file($imagen['tmp_name'], $direccionImagen);

        else :
            $direccionImagen = $datosPropiedadConsultada['imagen'];

        endif;



        /*******************************************************sube una nueva imagen al servidor*****************************************************/





        /*******************************************************sube una nueva imagen al servidor*****************************************************/

        // ///crea una carpeta con el nombre indicado en la ruta indicada


        //Insertar en la base de datos
        $query = "UPDATE propiedades SET titulo = '{$titulo}', precio = '{$precio}',imagen = '{$direccionImagen}', descripcion = '{$descripcion}', habitaciones = {$habitaciones}, wc = {$wc}, estacionamiento = '{$estacionamiento}', creado = '{$fechaHoy}', vendedores_id = {$vendedorId} where id = {$idActualizar};";


        // echo $query;

        // exit;

        $resultado = mysqli_query($instBaseDatos, $query);
        // echo ($resultado) ? 'insertado correctamente' : "no existoso";
        if ($resultado) {
            header('Location:/admin?resultado=2');
        }
    }
}







incluirTemplates('header');



?>
<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>


    <a href="/admin" class="boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>


    <?php endforeach; ?>
    <!--si el form no cuenta con un action envia el formulario del metodo post o get a este mismo archivo -->
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <legend>Informacion General</legend>

        <fieldset>
            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio</label>
            <input type="number" id="titulo" name="precio" placeholder="Precio Propiedad" value=<?php echo $precio; ?>>

            <label for="imagen"> Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen" value="<?php echo $imagen; ?>">

            <img src=" <?php echo $imagenPropiedad ?>" class="imagen-small" alt="imagen propiedad">


            <label for="descripcion">Descripcion:</label>
            <textarea id="descripcion" name="descripcion" placeholder="Descricion Propiedad"><?php echo $descripcion; ?> </textarea>
        </fieldset>
        <fieldset>

            <legend>Informacion de la propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value=<?php echo $habitaciones; ?>>

            <label for="wc">Banos:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value=<?php echo $wc; ?>>

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value=<?php echo $estacionamiento; ?>>

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedor">
                <option value="">--Selecciona--</option>

                <?php
                while ($vendedor = mysqli_fetch_assoc($listaVendedores)) : ?>

                    <option <?php echo $vendedorId === $vendedor["id"] ? "selected" : " " ?> value="<?php echo $vendedor['id'] ?>">
                        <?php echo $vendedor["nombre"] . " " . $vendedor["apellido"] ?></option>

                <?php endwhile; ?>
                <!-- <option value="0">Juan</option>
                <option value="1">karen</option>
                <option value="2">Emmanuel</option> -->
            </select>
        </fieldset>

        <input type="submit" value=" Actualizar propiedad" class="boton boton-verde">

    </form>

</main>


<?php

incluirTemplates('footer');


?>
<script src="../../build/js/bundle.min.js"></script>