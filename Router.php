<?php

namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];

    //Obtenemos la url y le asignamos una funcion
    public function get($url, $fn): void {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn): void {
        $this->rutasPOST[$url] = $fn;
    }

    //Valida que las rutas existan
    public function comprobarRutas(){
        session_start();
        $auth = $_SESSION['login'] ?? null;

        //arreglo de rutas protegidas
        $rutasProtegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        //En caso no haya una ruta pone "/" 
        $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        //Siempre va a ser GET por defecto
        $metodo = $_SERVER["REQUEST_METHOD"];

        if($metodo === "GET"){
            $fn = $this->rutasGET[$urlActual] ?? null;

        }else{
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }
        //Proteccion de rutas
        if(in_array($urlActual, $rutasProtegidas) && !$auth){
            header("Location: /");
        }
        //Si la url existe y hay una funcion asociada
        if($fn){
            //Le pasamos la funcion y el mismo objeto
            call_user_func($fn, $this);
        }else{
            echo "pagina no encontrada";
        }
    }

    //Mostrar las vistas
    public function render($view, $datos = []){
        foreach($datos as $key => $value){
            $$key = $value;
        }
        //inicio del buffer, area de espera = espacio en memoria
        ob_start();
        include __DIR__ . '/views/' . $view .'.php';
        //Captura la salida del buffer, lo asigna al contenido y libera la memoria
        $contenido = ob_get_clean();
        include __DIR__ . '/views/layout.php'; 
    }


}

