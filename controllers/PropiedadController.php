<?php

namespace controllers;
use MVC\Router;
use Models\Vendedor;
use Models\Propiedad;
use Intervention\Image\ImageManagerStatic as Imagen;

class PropiedadController{
    public static function index(Router $router){
        $resultado=$_GET['resultado'] ?? null;

        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $router->render('/propiedades/admin', 
        ['propiedades'=>$propiedades,
        'resultado'=>$resultado,
        'vendedores'=>$vendedores
    ]);
    }
    public static function crear(Router $router){
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();


        if($_SERVER['REQUEST_METHOD']==="POST")
        {        
    
            $propiedad = new Propiedad($_POST['propiedad']);
    
            //Generar nombre unico
            $nombreImagen=md5(uniqid(rand(),true)) .".jpg";
    
            $imagen=$_FILES['propiedad']['tmp_name'];
            if($imagen['imagen']){
                //Realiza un resize a la imagen con intervention
                $image =  Imagen::make($imagen['imagen'])->fit(800,600);
                //Setea la imagen
                $propiedad->setImage($nombreImagen);
            }
            
            $errores = $propiedad->validar();
            //Revisar que errores[] este vacio
            if(empty($errores))
            { 
                //Crear la carpeta para subir imagenes
                crearCarpetaImagenes();
                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES.$nombreImagen);
                $propiedad->guardar();
            }
            }
    

        $router->render('/propiedades/crear',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores'=> $errores
        ]);
    }
    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        if($_SERVER['REQUEST_METHOD']==="POST")
    {
        $propiedad->sincronizar($_POST['propiedad']);
        // echo '<pre>';
        // echo var_dump($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // echo var_dump($_FILES);
        // echo '</pre>';
        //  var_dump($imagen);
        // exit;
        $errores = $propiedad->validar();
        
        $nombreImagen=md5(uniqid(rand(),true)) .".jpg";
        $imagen=$_FILES['propiedad']['tmp_name'];
        if($imagen['imagen']){
            //Realiza un resize a la imagen con intervention
            $image =  Imagen::make($imagen['imagen'])->fit(800,600);
            //Setea la imagen
            $propiedad->setImage($nombreImagen);
        }
        $propiedad->limpiaCarpetaIMG();
        //Revisar que errores[] este vacio
        if(empty($errores))
        //Guarda la imagen en el servidor
        {
            if($image){
                $image->save(CARPETA_IMAGENES.$nombreImagen);
            }
                $propiedad->guardar();
        }
        
        
    }

        $router->render('/propiedades/actualizar',[
            'propiedad'=>$propiedad,
            'vendedores'=>$vendedores,
            'errores'=>$errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $id=$_POST['id'];
            $id=filter_var($id,FILTER_VALIDATE_INT);
            $tipo= $_POST['tipo'];

        if($id&&validarTipoContenido($tipo)){
            $propiedad = Propiedad::find($id);
            $propiedad->eliminar();
           }
        }
    }


}