<?php

namespace App;

class Propiedad{

    protected static $db;
    //Definir las columnas de la base de datos para mapear el objeto
    protected static $columnasDB = ['id', 'nombre', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'id_vendedor'];

    //Errores
    protected static $errores = [];

    //Definir atributos de la clase
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

    public function guardar() : bool{

        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        
        //Insertar en la base de datos - Se crea el query para insertar los datos
        $query = "INSERT INTO propiedades (";
        $query .= join(', ', array_keys($atributos)); //Se unen las claves de los atributos
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos)); //Se unen los valores de los atributos
        $query .= "')";

        $resultado = self::$db->query($query);

        return $resultado;

    }

    //Identificar y unir los atributos de la base de datos
    public function atributos() : array{
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if($columna === 'id') continue; //No se incluye el id
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    //Sanitizar los datos antes de insertarlos en la base de datos
    public function sanitizarAtributos() : array{
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Conectar a la base de datos
    public static function setDB($database) : void{
        self::$db = $database;
    }

    //Mensajes de error
    public static function getErrores() : array{
        return self::$errores;
    }

    //Guardar la imagen
    public function setImagen($imagen) : void{
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public function validar() : array{
        $tiposErrores = [
            'nombre' => 'Debes añadir un nombre',
            'precio' => 'Debes añadir un precio',
            'imagen' => 'Debes añadir una imagen',
            'descripcion' => 'La descripción es obligatoria',
            'habitaciones' => 'Debes añadir el número de habitaciones',
            'wc' => 'Debes añadir el número de baños',
            'estacionamiento' => 'Debes añadir el número de estacionamientos',
            'id_vendedor' => 'Debes elegir un vendedor',
        ];

        //Validar que no haya campos vacíos
        foreach($tiposErrores as $tipo => $error){
            if(!$this->$tipo){
                self::$errores[] = $error;
            }
        }
        return self::$errores;
    }
}