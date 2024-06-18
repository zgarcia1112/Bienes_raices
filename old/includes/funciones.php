<?php



define('TEMPLATES_URL', __DIR__  . '/templates/');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '../../imagenes/');




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


//escapa el html

function sanitizarHtml($html): string
{

    $sanitizado = htmlspecialchars($html);

    return $sanitizado;
}


//validar tipo de contenido
function validarTipoContenido($tipo)
{
    $tipos = ["vendedor", "propiedad"];

    return in_array($tipo, $tipos);
}

//muestra mensajes 

function mostrarNotificacion($codigo)
{
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado correctamente';
            break;

        case 2:
            $mensaje = 'Actualizado correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado correctamente';
            break;
        default;
            $mensaje = false;
            break;
    }

    return $mensaje;
}
