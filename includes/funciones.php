<?php

//DIR sirve para obtener la ruta del archivo actual y concatenarla con la carpeta que se necesita.
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');

//Función para incluir templates
function incluirTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL . "/$nombre.php";
}

//Función para verificar si el usuario está autenticado
function autenticado() : void{
    session_start();

    if(!$_SESSION['login']){
        header('Location: /');
    }
}

//Función helper 
function debug($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

?>