<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController{

    public static function login(Router $router){
        $errores = Admin::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //Creamos un nuevo objeto
            $auth = new Admin($_POST);
            //validamos los campos
            $errores = $auth->validarCampos();

            if(empty($errores)){
                //Verificar si el usuario existe
                $resultado = $auth->verificarEmail();
                if(!$resultado){
                    $errores = Admin::getErrores();
                }else{
                    //Verificar el password
                    $autenticado = $auth->verificarPassword($resultado);
                    if($autenticado){
                        //Autenticar Usuario
                        $auth->autenticar();
                    }else{
                        $errores = Admin::getErrores();
                    }

                }
            }
        }   
        $router->render("auth/login", [
            "errores" => $errores
        ]);
    }

    public static function logout(){
        session_start();
        $_SESSION = [];
        header("Location: /");
    }
}
