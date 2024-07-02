<?php

namespace App;

class Propiedad{

    protected static $db;
    //Definir las columnas de la base de datos para mapear el objeto
    protected static $columnasDB = ['id', 'nombre', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'id_vendedor'];
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

        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        
        //Insertar en la base de datos - Se crea el query para insertar los datos
        $query = "INSERT INTO propiedades (";
        $query .= join(', ', array_keys($atributos)); //Se unen las claves de los atributos
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos)); //Se unen los valores de los atributos
        $query .= "')";

        $resultado = self::$db->query($query);

    }

    //Identificar y unir los atributos de la base de datos
    public function atributos(){
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if($columna === 'id') continue; //No se incluye el id
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    //Sanitizar los datos antes de insertarlos en la base de datos
    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Conectar a la base de datos
    public static function setDB($database){
        self::$db = $database;
    }
}