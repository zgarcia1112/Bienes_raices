<?php

/**************************Exporta BD**************************/
require 'includes/app.php';

$instanBD = conectarDB();
/**************************autenticar usuario**************************/
// echo $_SERVER['REQUEST_METHOD'];
// exit;
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';


    $email = mysqli_real_escape_string($instanBD, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));

    var_dump($email);
    $password = mysqli_real_escape_string($instanBD, $_POST['password']);

    (!$email) ? $errores[] = "El email es obligatorio o no es valido *" : "";
    (!$password) ? $errores[] = "El password es obligatorio *" : "";


    if (empty($errores)) :
        /**************************Revisamos si el usuario existe**************************/
        $query = "select * from usuarios where email = '{$email}'";
        $resultado = mysqli_query($instanBD, $query);

        echo '<pre>';
        var_dump($resultado);
        echo '</pre>';

        if ($resultado->num_rows) {
            /**************************Si el usuario existe revisamos que el password sea correcto**************************/
            $usuario = mysqli_fetch_assoc($resultado);

            /**************************con password_verify validamos si el password es correocto**************************/
            $auth = password_verify($password, $usuario['password']);

            if ($auth) {
                //si auth es true el usuario esta autenticado
                session_start();

                //llenar el arreglo de la sesion  -- en la super global $_SESSION podemos agregar informacion
                $_SESSION['usuario'] = $usuario['email'];
                // $_SESSION['hola'] = 'Hola';    ------------EJEMPLO DE USO DE LA VARIBALE
                $_SESSION['login'] = true;

                header('Location: /admin');
            } else {
                //si auth es false el usuario no esta autenticado
                $errores[] = 'El password es incorrecto';
            }
        } else {
            $errores[] = "Tu correo no existe, Registrate";
        }



    endif;
}




/**************************Incluye el header**************************/

incluirTemplates('header');
?>
<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>


    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>


            <label for="email">E-mail*:</label>
            <input type="email" name="email" placeholder="Tu email" id="email" required />

            <label for="password">Password*:</label>
            <input type="password" name="password" placeholder="Tu password" id="password" required />


        </fieldset>
        <input type="submit" value="Iniciar Sesion" class="boton-verde contenido-centrado">

    </form>
</main>


<?php

incluirTemplates('footer');

?>