<?php

namespace Model;

class ActiveRecord {
    //*Atributo static
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    protected static $errores = [];


    //Conexion a la base de datos
    public static function setDB($database){
        self::$db = $database;
    }

    //Obtener los errores
    public static function getErrores(): array{
        return static::$errores;
    }
    

    //Validar los atributos
    public function validarCampos(){
        static::$errores;
        return static::$errores;
    }
    
    //Almacenar en la variable imagen
    public function setImagen($imagen) {
        //Verificamos que exista una propiedad para hacer la actualizacion
        if($this->id){
           $this->borrarImagen();
        }

        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen(){
        $existeImagen = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeImagen){
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }
    public function borrarImagenEliminar($imagen){
        $existeImg = file_exists(CARPETA_IMAGENES . $imagen);
        if($existeImg){
            unlink(CARPETA_IMAGENES . $imagen);
        }
    }


    //Convertir nuestros datos en un arreglo //*guardar
    public function atributos(): array{
        $atributos = [];
        foreach(static::$columnasDB as $columna){
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
    //Sanitizar los datos //*guardar
    public function sanitizarDatos(): array{
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            if($key === 'id') continue;
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }
    //Inserta los campos a la base de datos
    public function guardar(){
        if(!is_null($this->id)){
            $this->actualizar();
        }else{
            $this->crear();
        }
    }
    //Inserta los campos a la base de datos
    public function crear(){

        $atributosSanitizados = $this->sanitizarDatos();
        
        $keys = join(', ', array_keys($atributosSanitizados));
        $values = join("', '", array_values($atributosSanitizados));
        
        $query = " INSERT INTO " . static::$tabla . "( ";
        $query .= $keys;
        $query .= " ) VALUES ('";
        $query .= $values;
        $query .= " ')";

        $resultado = self::$db->query($query);

        if($resultado){
            header("location: /admin?resultado=1");
        }    
    }
    public function actualizar(){
        $atributosSanitizados = $this->sanitizarDatos();

        $arreglo = [];
        foreach($atributosSanitizados as $key => $value){
            $arreglo[] = "{$key} = '{$value}'";
        }
        
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .= join(', ', $arreglo);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id). "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);
        
        if($resultado){
            header("location: /admin?resultado=2");
        }
    }

    //Encontrar un registro mediante su id
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";

        $resultado = self::consultarDB($query);

        return array_shift($resultado);

    }
    //Sincroniza el objeto en memoria con el objeto de la BD
    public function sincronizar($args = []){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }

    //Obtenemos un arreglo de objetos
    public static function all(){
        //creamos la consulta
        $query = "SELECT * FROM " . static::$tabla;

        //Llamamos nuestro metodo
        $resultado = self::consultarDB($query);

        return $resultado;
    }
    //Obtenemos una cantidad de propiedades
    public static function getPropiedades($cantidad){
        //creamos la consulta
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        
        //Llamamos nuestro metodo
        $resultado = self::consultarDB($query);

        return $resultado;
    }
    //Consultamos a la base de datos //*all
    public static function consultarDB($query) {
        //Consultar la BD
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }

        //Liberar la memoria
        $resultado->free();

        //Retornar los resultados
        return $array;
    }
    //Convertimos el arreglo en un objeto //*all
    public static function crearObjeto($registro){
        //Creamos un objeto de nuestra clase
        $objeto = new static;
        
        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
    public static function findImage($id){
        $query = "SELECT imagen FROM " . static::$tabla . " WHERE id = {$id}";

        $resultado = self::consultarDB($query);
        
        return array_shift($resultado);
    }
    public function eliminar($id, $eliminarImagen = false){
        if($eliminarImagen){
            $this->borrarImagenEliminar($this->findImage($id)->imagen ?? null);
        }
        
        $query = "DELETE FROM " . static::$tabla . " WHERE id = {$id}";
        $resultado = self::$db->query($query);
        if($resultado){
            header("location: /admin?resultado=3");
        }
    }
}



?>
