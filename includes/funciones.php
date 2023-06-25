<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');


function crearCarpetaImagenes(){
        if(!is_dir(CARPETA_IMAGENES)){
            mkdir(CARPETA_IMAGENES);
        }
}
function incluirTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL . "/{$nombre}.php";
}

function debuguea($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function estaAutenticado(){
    session_start();

    if(!($_SESSION['login'])){
        header("location: /");
    }
}

//Escapa / Sanitiza el HTML
function s($html): string{
    $s=htmlspecialchars($html);
    return $s;
}

function muestraNotificacion($codigo){
    $mensaje = '';
    switch($codigo){
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
            case 2:
                $mensaje = 'Actualizado Correctamente';
                break;
                case 3:
                    $mensaje = 'Eliminado Correctamente';
                    break;
                    default:
                    $mensaje= false;
                    break;
    }
    return $mensaje;
}

function validarTipoContenido($tipo){
    $tipos = ['vendedor','propiedad'];
    return in_array($tipo,$tipos);
}

function validarORedireccionar(string $url){
    $id=$_GET['id'];
    $id=filter_var($id,FILTER_VALIDATE_INT);

    IF(!$id){
        header("Location: {$url}");
    }
    return $id;
}