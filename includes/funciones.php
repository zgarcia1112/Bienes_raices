<?php



define('TEMPLATES_URL', __DIR__  . '/templates/');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');




function incluirTemplates(string $nombre, bool $inicio = false)
{

    include TEMPLATES_URL . $nombre . ".php";
}


function estadoAutenticado()
{

    session_start();



    if (!$_SESSION['login']) {

        header('Location: /');
    }
}


function debugger($bug)
{
    echo '<pre>';
    var_dump($bug);
    echo '</pre>';
    exit;
}
