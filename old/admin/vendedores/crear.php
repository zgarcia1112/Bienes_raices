<?php

require '../../includes/app.php';

use App\Vendedores;

estadoAutenticado();


$vendedor = new Vendedores();

//Arreglo con mensaje de errores
$errorres = Vendedores::getErrores();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //    Crear una nueva instancia de vendedor
    // debugger($_POST);
    $vendedor = new Vendedores($_POST['vendedor']); //$_POST['vendedor'] es un arreglo asociativo


    //valida que no aiga campos vacios
    $errores = $vendedor->validar();

    //no hay errores
    if (empty($errores)) :
        $vendedor->save();
    endif;
}

incluirTemplates('header');
?>




<main class="contenedor seccion">
    <h1>Registrar Vendedor</h1>


    <a href="/admin" class="boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form action="/admin/vendedores/crear.php" class="formulario" method="POST" enctype="multipart/form-data">

        <?php include '../../../Bienes_raices/includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value=" Guardar Vendedor" class="boton boton-verde">

    </form>

</main>


<?php
incluirTemplates("footer");
?>
<script src="../../build/js/bundle.min.js"></script>