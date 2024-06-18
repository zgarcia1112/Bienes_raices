<?php


namespace App;


class ActiveRecord
{
    //base de datos - inicializacion
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    protected static $errores = [];



    //definimos la conexion a la base de datos
    public static function getDb($database)
    {
        self::$db = $database;
    }


    //identifica y une los atributos de la base de datos 
    public function atributos()
    {

        $atributos = [];


        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;  //identifica la columna de id no hace nada y continua con el foreach
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    //funcion encargada de actualizar o crear un nuevo registro, cual fuere el caso
    public function save()
    {
        if (!is_null($this->id)) { //valida si el objeto propiedad trae un id y lo actualiza, si esta vacio crea un nuevo registro
            // actualizar 
            $this->update();
        } else {
            // crear nuevo registro
            $this->create();
        }
    }

    //se sanitizan la entrada de datos y actualiza una propiedad
    public function update()
    {
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}= '{$value}'";
        }
        //join convierte un arreglo en un string 
        $query = "Update " . static::$tabla . " SET ";
        $query .= join(', ', $valores); // :titulo= 'casa', precio= '1212122.00', imagen= '../../imagenes/d9d4d2f8588ed563467e4a7ea69afce4.jpg', descripcion= '  tellus vestibulum luctus. aliquet Suspendisse a malesuada tellus vel eu dolor, Lorem scelerisque. risus nisi tristique. vel diam, amet ante massa tellus adipiscing dolor risus nisi ut sit non risus. sit sit Morbi nisi consectetur Nulla lacinia. consectetur vestibulum    ', habitaciones= '9', wc= '2', estacionamiento= '1', creado= '2024-05-06', vendedores_id= '1'"
        $query .= " where id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " limit 1;";



        $resultado = self::$db->query($query);

        if ($resultado) {
            header('Location:/admin?resultado=2');
        }
    }

    //sanitizamos la entrada de los multiples datos del usaurio  y guadamos la propiedad en la base de datos en la base de datos 
    public function create()
    {

        $atributos = $this->sanitizarAtributos();

        // debugger($atributos);

        //Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos)); //accedemos solamente a las llaves del arreglo
        $query .= " ) VALUES (' ";
        $query .=   join("' ,'", array_values($atributos));  //acedemos solamente a los valores del arreglo
        $query .= " ');";

        $resultado = self::$db->query($query);

        if ($resultado) {
            header('Location:/admin?resultado=1');
        }
    }

    /**************Eliminar propiedad**************/

    public function eliminar()
    {

        // se sanitiza el id por si el usuario coloca algun codigo malicioso
        $query = "delete from " . static::$tabla . " where id = " . self::$db->escape_string($this->id) . " limit 1;"; // se coloca el limit para que solo elimine 1 registro

        $resultado = self::$db->query($query);

        if ($resultado) {

            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }

    //sanitizamos la etrada de datos para poder validar que estos no tengan inyecciones a SQL
    public function sanitizarAtributos(): array
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        //accedemos al nombre de la propiedad y el valor
        foreach ($atributos as $key => $valor) {
            //sanitizamos el contenido de atributos por si este tuviera sql injection
            $sanitizado[$key]  = self::$db->escape_string($valor);
        }
        return $sanitizado;
    }


    // Subir archivos
    public function setImage($imagen)
    {
        //elimina la imagen previa
        if (!is_null($this->id)) {
            //comprobamos si existe el archivo
            //file_exist valida si un archivo existe y retorna true o false
            $this->borrarImagen();
        }

        //asignar al atributo de imagen en nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    /**************Eliminar imagen**************/

    public function borrarImagen()
    {


        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);  //:true o false

        //si el archivo existe lo elimina.
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }


    // Validaciones  - enviamos el arreglo 
    public static function getErrores(): array
    {

        return static::$errores;
    }


    // valida que los atributos del objeto propiedad no se encuentren vacios
    public function validar(): array
    {


        static::$errores = [];
        return static::$errores;
    }





    /*******************************************************Lista todas las propiedades*****************************************************/
    //self hace referencia a la clase local
    // static hace referencia el metodo de la clase. como en este caso que en el que $tabla se sobrescribe en las clases vendedores y propiedades.
    public static function all()
    {

        $query = "select * from " . static::$tabla . " ORDER BY id DESC; ";
        return self::consultarSql($query);
    }


    /**************Obtiene cierto numero de registros**************/

    public static function get($numRegistros)
    {
        $query = "select * from " . static::$tabla . " ORDER by id ASC limit " . $numRegistros . " ;";
        return self::consultarSql($query);
    }




    /*******************************************************Busca un registro por su id*****************************************************/

    // este metodo es estatico porque no se require una nueva instancia de Propiedad al actualizar una propiedad
    public static function find($id)
    {

        $query = "SELECT * FROM " . static::$tabla . "  WHERE  id =" . $id;
        //resultado contiene un arreglo con 1 elemento de tipo objeto(Propiedad).
        $resultado = self::consultarSql($query);
        return array_shift($resultado); //array shif retorna solo el primer elemento de un arreglo
    }



    // metodo encargado de retornar un arreglo con multiples objetos de la clase propiedad
    public static function consultarSql($query)
    {
        //consultamos la base de datos

        $resultado = self::$db->query($query);

        //iterar los resultaods
        while ($registro = $resultado->fetch_assoc()) {

            $array[] = static::crearObjeto($registro);
        }

        //liberar la memoria
        $resultado->free();

        //retornar los resultados  - array = multiples objetos de propiedad.
        return $array;
    }



    //este metodo es protected porque solo se ocupa en esta clase.
    // recibe un arreglo y lo convierte en un objeto de tipo propiedad.
    protected static function crearObjeto($registro)
    {
        $objeto = new static; //crea un objeto de la clase que se esta heredando.

        foreach ($registro as $key => $valor) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $valor;
            }
        }

        return $objeto;
    }

    //sincroniza el objeto en memoria con los cambios realizados por el usuario
    //dudaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa

    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
