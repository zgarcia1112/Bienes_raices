<?php
require '../../includes/app.php';


use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;
use App\Vendedores;


estadoAutenticado();





$instBaseDatos = conectarDB();
// echo $_SERVER['REQUEST_METHOD'];
// var_dump(date("Y/m/d"));

$propiedad = new Propiedad;

// Consulta para obtener vendedores todos los vendendores con activerecord

$vendedores = Vendedores::all();

// debugger($vendedores);


//consulta para obtener vendendores -- forma sin active record
// $consultaVendedores = "select * from vendedores";
// $listaVendedores = mysqli_query($instBaseDatos, $consultaVendedores);
// echo rand(); ///genera numeros de forma alateoria
// debugger(mysqli_fetch_assoc($listaVendedores));

//arreglo con mensaje de errores
$errores = Propiedad::getErrores();


//$_SERVER : nos trae informacion del servidor
// $_POST : nos trae informacoin de cuando realizamos una peticion de tipo POST
// $_FILES : nos permite ver el contenido de los archivos


//ejecuta el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // crea una instancia de propiedad
    $propiedad = new Propiedad($_POST['propiedad']);



    /** Subida de archivos  */

    ///  genera un nombre unico de forma aleatoria
    $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';



    //Setear la imagen
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        ///Realiza un resize a la imagen con la libreria intervention
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImage($nombreImagen);
    }


    // debugger($propiedad->imagen);

    $errores = $propiedad->validar();



    // exit; //detiene la ejecucion del codigo


    /**************forma de sanitizar un codigo de una forma no oiendtada a objetos **************/

    // $titulo = mysqli_real_escape_string($instBaseDatos, $_POST['titulo']);
    // $precio = mysqli_real_escape_string($instBaseDatos, $_POST['precio']);
    // $descripcion = mysqli_real_escape_string($instBaseDatos, $_POST['descripcion']);
    // $habitaciones = mysqli_real_escape_string($instBaseDatos, $_POST['habitaciones']);
    // $wc = mysqli_real_escape_string($instBaseDatos, $_POST['wc']);
    // $estacionamiento = mysqli_real_escape_string($instBaseDatos, $_POST['estacionamiento']);
    // $vendedores_id = mysqli_real_escape_string($instBaseDatos, $_POST['vendedor']);
    // $fechaHoy = date("Y/m/d");

    ///revisamos que errores no tenga nada, para poder continuar con el registro en la base de datos 
    if (empty($errores)) {

        //validamos que la carpeta que queremos crear no exista= retorna un true si existe
        // CARPETA_IMAGENES constante creada en funciones
        if (!is_dir(CARPETA_IMAGENES)) : mkdir(CARPETA_IMAGENES);
        endif;


        /**************Subida de archivos **************/
        //subir la imagen
        // move_uploaded_file($imagen['tmp_name'], $direccionImagen); //este codigo se ocupa cuando se queiro subir la imagen de forma manual
        //guarda la imagen en el servidor
        $image->save(CARPETA_IMAGENES  . $propiedad->imagen);


        //guarda en la base de datos 
        $propiedad->save();

        // debugger($resultado);
        //mensaje exito o error

    }
}







incluirTemplates('header');



?>
<main class="contenedor seccion">
    <h1>Crear Propiedad</h1>


    <a href="/admin" class="boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>


    <?php endforeach; ?>

    <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">

        <?php include '../../../Bienes_raices/includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" value=" Crear propiedad" class="boton boton-verde">

    </form>

</main>


<?php

incluirTemplates('footer');


?>
<script src="../../build/js/bundle.min.js"></script>