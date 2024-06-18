<?php

use App\Propiedad;
use App\Vendedores;
use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';
estadoAutenticado();



//obtenemos de GET el id que pasamos de index.php y validamos que en realiaas sea un int
$idActualizar = $_GET['id'];

// Validamos que sea un od valido
$idActualizar = filter_var($idActualizar, FILTER_VALIDATE_INT);
if (!$idActualizar) {
    header('Location: /admin');
}

// Instancia de la base de datos para ocupar aca

// echo $_SERVER['REQUEST_METHOD'];
// var_dump(date("Y/m/d"));

//obtenemos los datos de la propiedad
$propiedad = Propiedad::find($idActualizar);


//consulta para obtener todos los vendendores
$vendedores = Vendedores::all();

// debugger($propiedad);

//arreglo con mensaje de errores
$errores = Propiedad::getErrores();

//$_SERVER : nos trae informacion del servidor
// $_POST : nos trae informacoin de cuando realizamos una peticion de tipo POST
// $_FILES : nos permite ver el contenido de los archivos


//ejecuta el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $args = $_POST['propiedad'];

    $propiedad->sincronizar($args);


    // // debugger($propiedad);
    // //asignamos files hacia una variable
    // $imagen = $_FILES['imagen'];
    //valida que no aiga campos vacios en el formulario
    $errores = $propiedad->validar();

    /******************************************************* /** validacion subida de archivos  ******************************************************/

    ///  genera un nombre unico de forma aleatoria
    $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

    //Setear la imagen
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        ///Realiza un resize a la imagen con la libreria intervention
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImage($nombreImagen);
    }


    ///revisamos que errores no tenga nada, para poder continuar con el registro en la base de datos 
    if (empty($errores)) {
        //almacenar la imagen
        if ($_FILES['propiedad']['tmp_name']['imagen']) :
            $image->save(CARPETA_IMAGENES . $propiedad->imagen);
        endif;

        $propiedad->save();

        // echo ($resultado) ? 'insertado correctamente' : "no existoso";

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

        <?php include '../../includes/templates/formulario_propiedades.php'; ?>
        <input type="submit" value=" Actualizar propiedad" class="boton boton-verde">

    </form>

</main>


<?php

incluirTemplates('footer');


?>
<script src="../../build/js/bundle.min.js"></script>