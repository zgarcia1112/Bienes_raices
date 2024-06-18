<?php
function conectarDB(): mysqli //tipo de dato que retorna esta funcion
{
    // recuerda la sintaxis en la conexion a la base de datos es diferente cuando se trabaja con objetos.
    $db = new mysqli('localhost', 'root', 'root', 'bienesraices_crud');

    // $seRealizoConexion = $db  ? 'conectado' :  'revisar conexion';
    // echo $seRealizoConexion;

    if (!$db) {
        echo 'Error no se pudo conectar';
        exit;
    }

    return $db;
}
