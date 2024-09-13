<?php


define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER["DOCUMENT_ROOT"] . '/imagenes/');


function incluirTemplates(string $nombre, bool $inicio = false){
    include TEMPLATES_URL . "/$nombre.php";
}

function verificarAutenticacion(): void{
    session_start();
    if(!$_SESSION['login']){
        header('Location: /');
    }
}

function cerrarSesion(){
    define('MAX_INACTIVITY_TIME', 600);
    session_start();
    if (isset($_SESSION['actividad']) && (time() - $_SESSION['actividad']) > MAX_INACTIVITY_TIME) {
        // Si el tiempo de inactividad ha excedido, destruye la sesión y redirige al usuario a la página de inicio de sesión
        session_unset();
        session_destroy();
        header('location: /');
        exit;
    } else {
        // Si el tiempo de inactividad no ha excedido, actualiza el tiempo de la última actividad
        $_SESSION['actividad'] = time();
    }
}

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function sanitizar($dato): string{
    $sanitizado = htmlspecialchars($dato);
    return $sanitizado;
}

//Validacion de tipo a eliminar
function validarTipo($tipo){
    $tipos = ['propiedad', 'vendedor'];
    return in_array($tipo, $tipos);
}

//Mostrar Notificaciones
function mostrarNotificacion($codigo){
    $mensaje = '';
    switch($codigo){
        case 1;
            $mensaje = "Creado Correctamente";
            break;
        case 2;
           $mensaje = "Actualizado Correctamente";
           break;
        case 3;
           $mensaje = "Eliminado Correctamente";
           break;
        default;
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function truncateText($text, $maxLength, $var) : string{
    if (strlen($text) > $maxLength && $var) {
        return substr($text, 0, $maxLength) . '...';
    }elseif(strlen($text) > $maxLength && !$var){
        return substr($text, 0, $maxLength) . '...' . '<a href="/propiedades">Ver Más</a>';
    }
     else {
        return $text;
    }
}

function verificarId(string $url): int{
    $id = $_GET['id'];
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: $url");
    }
    return $id;
}