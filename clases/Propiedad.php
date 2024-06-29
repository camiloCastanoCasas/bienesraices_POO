<?php

namespace App;

class Propiedad{

    protected static $db;
    public $id;
    public $nombre;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $id_vendedor;

    public function __construct($args = []){
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->id_vendedor = $args['id_vendedor'] ?? '';
    }

    public function guardar(){
        //Insertar en la base de datos
        $query = "INSERT INTO propiedades (nombre, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, id_vendedor) VALUES ('$this->nombre', '$this->precio', '$this->imagen' , '$this->descripcion', '$this->habitaciones', '$this->wc', '$this->estacionamiento', '$this->creado', '$this->id_vendedor')";

        $resultado = self::$db->query($query);

        debug($resultado);
    }

    //Conectar a la base de datos
    public static function setDB($database){
        self::$db = $database;
    }
}