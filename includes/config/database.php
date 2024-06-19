<?php

//Establecer zona horaria de Colombia
date_default_timezone_set('America/Bogota');

// Conexión a la base de datos
function conectarDB() : mysqli{
    $db = mysqli_connect('localhost', 'root', '0000', 'bienesraices_crud');
    
    if(!$db){
        echo "Error al conectar a la base de datos";
        exit;
    }

    return $db;
}


?>