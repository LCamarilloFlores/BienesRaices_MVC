<?php

namespace controllers;
use MVC\Router;
use Models\Vendedor;

class VendedorController{
    
    public static function crear(Router $router){
        $vendedor = new Vendedor;


        if($_SERVER['REQUEST_METHOD']==="POST")
        {        
    
            $vendedor = new Vendedor($_POST['vendedor']);
    
            
            $errores = $vendedor->validar();
            //Revisar que errores[] este vacio
            if(empty($errores))
            { 
                $vendedor->guardar();
            }
            }
    

        $router->render('/vendedores/crear',[
            'vendedor' => $vendedor,
            'errores'=> $errores
        ]);
    }
    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();
        if($_SERVER['REQUEST_METHOD']==="POST")
    {

        $args=$_POST['vendedor'];
        $vendedor->sincronizar($args);
        // echo '<pre>';
        // echo var_dump($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // echo var_dump($_FILES);
        // echo '</pre>';
        //  var_dump($imagen);
        // exit;
        
        $errores = $vendedor->validar();
        //Revisar que errores[] este vacio
        if(empty($errores))
        {
                $vendedor->guardar();
        }
        
        
    }

        $router->render('/vendedores/actualizar',[
            'vendedor'=>$vendedor,
            'errores'=>$errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $id=$_POST['id'];
            $id=filter_var($id,FILTER_VALIDATE_INT);
            $tipo= $_POST['tipo'];

        if($id&&validarTipoContenido($tipo)){
            $vendedor = Vendedor::find($id);
            $vendedor->eliminar();
           }
        }
    }


}