<?php

namespace Controllers;

use MVC\Router;
use Models\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{

    public static function index(Router $router){
        $propiedades = Propiedad::some(3);
        $inicio = true;
        $router->render('/paginas/index',[
            'propiedades'=>$propiedades,
            'inicio'=>$inicio
        ]
        );
    }
    public static function nosotros(Router $router){
        $router->render('/paginas/nosotros',[]);
    }
    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();
        $router->render('/paginas/propiedades',[
        'propiedades'=>$propiedades
        ]);
    }
    public static function propiedad(Router $router){
        $id=validarORedireccionar('/propiedades');
        $resultado = Propiedad::find($id);
        $router->render('/paginas/propiedad',[
            'resultado' => $resultado
    ]);
        
    }
    public static function blog(Router $router){
        $router->render('/paginas/blog',[]);
    }
    public static function entrada(Router $router){
        $router->render('/paginas/entrada',[]);
    }
    public static function contacto(Router $router){
        $mensaje = null;
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            $respuestas = $_POST['contacto'];
            //Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'e47191c9728a31';
            $mail->Password = '7b1f4cdceaa6e8';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Configurar el contenido del email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com','Bienesraices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            //Habilitar el HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p> Tienes un Nuevo Mensaje</p>';
            $contenido .= PaginasController::convierteDatosHTML($respuestas);
            $contenido .= '</html>';
            $mail->Body = $contenido;
            $mail->AltBody = "Tienes un nuevo mensaje.".PaginasController::convierteDatosText($respuestas);
            //Enviar el email
            if($mail->send()){
                $mensaje = "Mensaje enviado correctamente";
            }
            else{
                $mensaje = "El mensaje no se pudo enviar";
            }

        }
        $router->render('/paginas/contacto',['mensaje'=>$mensaje]);
    }

    public static function convierteDatosHTML($arreglo){
        $texto = "<ul>";
        foreach($arreglo as  $key => $value){
            $texto .= $value!==''? "<li><b>".ucfirst($key). "</b>: ". $value . "</li><br>": '';
        }
        return $texto;
    }
    public static function convierteDatosText($arreglo){
        $texto = "    ";
        foreach($arreglo as  $key => $value){
            $texto .= $value!==''?ucfirst($key). ": ". $value . ",      ":'';
        }
        return $texto;
    }
    
    

}