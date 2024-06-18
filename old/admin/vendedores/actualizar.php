<?php

require '../../includes/app.php';

use App\Vendedores;

estadoAutenticado();

// debugger($_POST);
//validar que sea un id valido

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
// debugger($id);
// if (!$id) {

//     header('Location: /admin');
// }


//obtener el arreglo del vendedor desde la BD
$vendedor = Vendedores::find($id);



//Arreglo con mensaje de errores
$errores = Vendedores::getErrores();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // debugger($_POST);
    //asignar los valores
    $args = $_POST['vendedor'];


    //sincroniza el objeto en memoria con lo que el usuario escribio
    $vendedor->sincronizar($args);




    //validacion de campos
    $errores  = $vendedor->validar();

    //si errores se encontra vacio se procede a actualizar el vendedor
    if (empty($errores)) {

        $vendedor->save();
    }
}

incluirTemplates('header');
?>




<main class="contenedor seccion">
    <h1>Actualizar Vendedor</h1>


    <a href="/admin" class="boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>


    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">

        <?php include '../../../Bienes_raices/includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Actualizar vendedor" class="boton boton-verde">

    </form>

</main>


<?php
incluirTemplates("footer");
?>

<script src="../../build/js/bundle.min.js"></script>