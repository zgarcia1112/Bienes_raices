<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';


$db = conectarDB();  //la funcion retorna la instancia de BD

use App\ActiveRecord;
// este codigo esta en app porque solo se instancia 1 vez y se puede ocupar en otras partes
ActiveRecord::getDb($db);  // metodo estatico de Propiedad que recibe como parametro la instancia a la BD
