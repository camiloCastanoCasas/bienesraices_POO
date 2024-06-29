<?php 

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//conectar a la base de datos
$database = conectarDB();

use App\Propiedad;

Propiedad::setDB($database);
?>