<?php



namespace App;

class Propiedad
{


    protected static $db;

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args = [])
    {

        // asigna el valor de args la propiedad [] a la variable local del objeto propiedad con el mismo nombre
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function save()
    {

        //Insertar en la base de datos
        $query = "INSERT INTO propiedades (titulo, precio,imagen,descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id ) VALUES
     ('$this->titulo', '$this->precio', '$this->imagen', '$this->descripcion' , '$this->habitaciones'
     , $this->wc, $this->estacionamiento, '$this->creado', $this->vendedorId );";

        $resultado = self::$db->query($query);



        debugger($resultado);
    }


    public static function setDb($database)
    {
        self::$db = $database;
    }
}
