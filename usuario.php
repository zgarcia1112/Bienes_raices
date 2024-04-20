<?php

/**************************importar la conexion**************************/

require 'includes/config/database.php';

$instanciaBd = conectarDB();

/**************************Crear un email u password**************************/

$email = "correo@correo.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

// var_dump($passwordHash);

/**************************Query para crear el usuario**************************/

$query = "INSERT INTO usuarios (email, password) VALUES ('{$email}', '{$passwordHash}');";

// echo $query;

/**************************Agregamos el usuario a la base de datos **************************/

mysqli_query($instanciaBd, $query);
