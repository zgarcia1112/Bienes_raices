<?php

namespace App;

class Vendedores extends ActiveRecord
{
    protected static $tabla = "vendedores";

    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    //args recibe el post de crear
    public function __construct($args = [])
    {

        // debugger($args);
        // asigna el valor de args la propiedad [] a la variable local del objeto propiedad con el mismo nombre
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar(): array
    {
        if (!$this->nombre) {
            self::$errores[] = "DEbes anadir el nombre del vendedor *";
        }

        if (!$this->apellido) {
            self::$errores[] = "Debes anadir el apellido del vendedor *";
        }

        // valida que el campo telefono tenga algo
        if (!$this->telefono) {
            self::$errores[] = "debes anadir el telefono del vendedor *";
        }


        //[0-9] solo acepta numero de 0 al 9, {10} - solo debe tener 10 digitos, y luego le pasa el telefono a evaluar 
        if (!preg_match('/[0-9]{10}/', $this->telefono)) { //preg_match - busca un patron dentro de un texto - en internet dan varias expreciones 
            self::$errores[] = 'Telefono sin formato valido';
        }

        return self::$errores;
    }
}
