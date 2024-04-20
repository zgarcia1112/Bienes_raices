<?php
require '../../includes/app.php';

use App\Propiedad;



estadoAutenticado();

// debugger($_SESSION);

$admin = true;


$instBaseDatos = conectarDB();
// echo $_SERVER['REQUEST_METHOD'];
// var_dump(date("Y/m/d"));

//consulta para obtener vendendores
$consultaVendedores = "select * from vendedores";
$listaVendedores = mysqli_query($instBaseDatos, $consultaVendedores);
// echo rand(); ///genera numeros de forma alateoria


//arreglo con mensaje de errores
$errores = [];

$titulo = "";
$precio = "";
$descripcion = "";
$habitaciones = '';
$wc = "";
$estacionamiento = '';
$vendedorId = '';


//$_SERVER : nos trae informacion del servidor
// $_POST : nos trae informacoin de cuando realizamos una peticion de tipo POST
// $_FILES : nos permite ver el contenido de los archivos


//ejecuta el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $propiedad = new Propiedad($_POST);

    $propiedad->save();


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
    (!$imagen['name']) ? $errores[] = "Debes cargar la imagen *" : "";

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

        ///  genera un nombre unico de forma aleatoria
        $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

        // echo '<pre>';
        // var_dump($nombreImagen);
        // echo '</pre>';
        $direccionImagen = $carpetaImagenes . $nombreImagen;

        //subir la imagen
        move_uploaded_file($imagen['tmp_name'], $direccionImagen);



        ///crea una carpeta con el nombre indicado en la ruta indicada




        $resultado = mysqli_query($instBaseDatos, $query);
        // echo ($resultado) ? 'insertado correctamente' : "no existoso";
        if ($resultado) {
            header('Location:/admin?resultado=1');
        }
    }
}







incluirTemplates('header');



?>
<main class="contenedor seccion">
    <h1>Crear</h1>


    <a href="/admin" class="boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>


    <?php endforeach; ?>

    <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
        <legend>Informacion General</legend>

        <fieldset>
            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value=<?php echo $titulo; ?>>

            <label for="precio">Precio</label>
            <input type="number" id="titulo" name="precio" placeholder="Precio Propiedad" value=<?php echo $precio; ?>>

            <label for="imagen"> Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen" value="<?php echo $imagen; ?>">


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
            <select name="vendedorId">
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

        <input type="submit" value=" Crear propiedad" class="boton boton-verde">

    </form>

</main>


<?php

incluirTemplates('footer');


?>
<script src="../../build/js/bundle.min.js"></script>