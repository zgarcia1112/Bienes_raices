<?php



namespace App;

class Propiedad extends ActiveRecord
{
    protected static $tabla = "propiedades";
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;


    //args recibe el post de crear
    public function __construct($args = [])
    {

        // debugger($args);
        // asigna el valor de args la propiedad [] a la variable local del objeto propiedad con el mismo nombre
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }

    public function validar(): array
    {
        //validar formulario y guardar error en array si fuera el caso

        if (!$this->titulo) {
            self::$errores[] = "Debes anadir un titulo *";
        }

        if (!$this->precio) {
            self::$errores[] = "Debes anadir un precio *";
        }

        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "la descripcion es obligatoria y debe tenes almenos 50 caracteres *";
        }

        if (!$this->habitaciones) {
            self::$errores[] = "Debes anadir las habitaciones *";
        }

        if (!$this->wc) {
            self::$errores[] = "Debes anadir los banos *";
        }

        if (!$this->estacionamiento) {
            self::$errores[] = "Debes anadir los estacionamientos *";
        }

        if (!$this->vendedores_id) {
            self::$errores[] = "Debes anadir un vendedor *";
        }

        // // if (!$imagen['name']) {
        // //     self::$errores  = "Debes cargar la imagen";
        // // }
        if (!$this->imagen) {
            self::$errores[] = "Debes cargar la imagen * s";
        }


        return self::$errores;
    }
}
