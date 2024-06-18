<?php

require 'app.php';

//Función para incluir templates
function incluirTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL . "/$nombre.php";
}

?>