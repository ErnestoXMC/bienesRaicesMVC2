<?php 

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;


class PropiedadController {

    public static function index(Router $router) {
        //Obtener todas las propiedades
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
           "propiedades" => $propiedades,
           "resultado" => $resultado,
           "vendedores" => $vendedores
        ]);
    }

    public static function crear(Router $router) {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
            $propiedad = new Propiedad($_POST['propiedad']);

            //*Subida de Imagenes
            $imagen = $_FILES['propiedad'];
            if($imagen["type"]["imagen"]){
                $extension = explode('/', $imagen["type"]["imagen"]);//Saber la extension de la imagen, da um arreglo
                $nombreImg = md5(uniqid(rand(), true)) . '.'. $extension[1];//Valor unico a la imagen y le añadimos la extension
            }

            //Realizamos un resize con intervetion image
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImg);
            }
                    
            $errores = $propiedad->validarCampos();

            if(empty($errores)){
                //Crear carpeta
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
                //Guardar la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImg);

                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
        $id = verificarId('/admin');
        
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST"){

            $args = $_POST['propiedad'];
    
            $propiedad->sincronizar($args);
    
            //Validacion
            $errores = $propiedad->validarCampos();
    
            //*Subida de Imagenes
            $imagen = $_FILES['propiedad'];
            $extension = explode('/', $imagen["type"]["imagen"]);//Saber la extension de la imagen, da um arreglo
            $nombreImg = md5(uniqid(rand(), true)) . '.'. $extension[1];
    
            //Realizamos un resize con intervetion image
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImg);
            }
            
            if(empty($errores)){
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    $image->save(CARPETA_IMAGENES . $nombreImg);
                }
                $propiedad->guardar();
            }
        }

        
        $router->render("propiedades/actualizar", [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){        
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id){
                $tipo = $_POST['tipo'];
                
                if(validarTipo($tipo)){
                    $propiedad = new Propiedad;
                    $propiedad->eliminar($id, true);
                }
            }
        }
    }

}



?>