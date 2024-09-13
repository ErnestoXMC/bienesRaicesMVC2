<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{

    public static function index(Router $router){
        $propiedades = Propiedad::getPropiedades(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router){
        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);

    }

    public static function propiedad(Router $router){
        $id = verificarId('/');
        
        $propiedad = Propiedad::find($id);
        
        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);

    }

    public static function blog(Router $router){
        $router->render('paginas/blog');
    }
    
    public static function entrada(Router $router){
        $router->render('paginas/entrada');
    }

    public static function contacto(Router $router){
        $mensaje = null;
        $resultado = null;
        if($_SERVER["REQUEST_METHOD"] === "POST"){

            $respuestas = $_POST["contacto"];

            //Creando una instancia de phpMAiler
            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->SMTPSecure = "tls";
            $mail->Port = $_ENV['EMAIL_PORT'];

            //Configurar el contenido del email
            //Quien me envia el mensaje
            $mail->setFrom('admin@bienesraices.com');
            //Para quien es el mensaje y desde que pagina viene
            $mail->addAddress('ernestop@gmail.com', 'BienesRaices.com');
            $mail->Subject = "Tienes Un Nuevo Mensaje";

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";

            //Definir el contenido que se va a enviar
            $contenido = "<html>";
            $contenido.= "<p>Enviado desde BienesRaices.com</p>";
            $contenido .= "<p>Nombre: " . $respuestas["nombre"] . "</p>";
            if($respuestas["contacto"] === "telefono"){
                $contenido.= "<p>Eligió ser contactado por Teléfono</p>";
                $contenido .= "<p>Teléfono: " . $respuestas["telefono"] . "</p>";
                $contenido .= "<p>Fecha: " . $respuestas["fecha"] . "</p>";
                $contenido .= "<p>Hora: " . $respuestas["hora"] . "</p>";

            }else{
                $contenido.= "<p>Eligió ser contactado por Enail</p>";
                $contenido .= "<p>Email: " . $respuestas["email"] . "</p>";
            }
            $contenido .= "<p>Mensaje: " . $respuestas["mensaje"] . "</p>";
            $contenido .= "<p>Tipo: " . $respuestas["tipo"] . "</p>";
            $contenido .= "<p>Precio o Presupuesto: $" . $respuestas["precio"] . "</p>";
            $contenido .= "</html>";

            $mail->Body = $contenido;
            $mail->AltBody = "Esto es un texto alternativo sin HTML";

            //Enviar Email
            if($mail->send()){
                $mensaje =  "Mensaje Enviado Correctamente";
                $resultado = 1;
            }else{
                $mensaje =  "El mensaje no se pudo enviar";
                $resultado = 2;
            }
           
        }
        $router->render("paginas/contacto", [
            "resultado" => $resultado,
            "mensaje" => $mensaje
        ]);
    }

}
?>