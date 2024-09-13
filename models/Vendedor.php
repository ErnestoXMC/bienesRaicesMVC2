<?php 

namespace Model;

class Vendedor extends ActiveRecord{

    protected static $tabla = "vendedores";
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];


    //*Atributos
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }
    public function validarCampos(){

        if(!$this->nombre){
            self::$errores[] = "El Nombre es obligatorio";
        }
        if(!$this->apellido){
            self::$errores[] = "El Apellido es obligatorio";
        }
        if(!$this->telefono){
            self::$errores[] = "El telefono es obligatorio";
        }
        if($this->telefono && !preg_match('/[0-9]{9}/', $this->telefono)){
            self::$errores[] = "Formato del telefono no valido";
        }
        $telefonoCadena = strval($this->telefono);
        $longitudTelefono = strlen($telefonoCadena);
        if($longitudTelefono > 9 && $this->telefono){
            self::$errores[] = "El telefono no debe superar los 9 digitos";
        }

        return self::$errores;
    }

}



?>