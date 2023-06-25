<?php
namespace Models;

class Propiedad extends ActiveRecord{
    protected static $tabla = 'propiedades';   
    protected static $columnasDB = ['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamientos','creado','vendedores_id'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamientos;
    public $creado;
    public $vendedores_id;
    public function __construct($args=[]){
        $this->id= $args['id'] ??  null ;
        $this->titulo= $args['titulo'] ??  '' ;
        $this->precio= $args['precio'] ??  '' ;
        $this->imagen= $args['imagen'] ?? '' ;
        $this->descripcion= $args['descripcion'] ??  '' ;
        $this->habitaciones= $args['habitaciones'] ??  '' ;
        $this->wc= $args['wc'] ??  '' ;
        $this->estacionamientos= $args['estacionamientos'] ??  '' ;
        $this->creado= $args['creado'] = date('Y/m/d') ;
        $this->vendedores_id= $args['vendedores_id'] ??  '' ;
    }

    public function setImage($imagen){
        //Asignamos a la variable imagen el nombre de la imagen
        if(!is_null($this->id)){
           $this->eliminaImagen();
        }
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public function eliminaImagen(){
        $existeArchivo=file_exists(CARPETA_IMAGENES.$this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES.$this->imagen);
        }
    }
    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "Debes añadir un titulo";
        }
        
        if(!$this->precio){
            self::$errores[] = "Debes añadir un precio";
        }
        if($this->precio > 99999999)
        {
            self::$errores[]="El precio no puede ser mayor a 99999999";
        }
        if(!$this->imagen){
            self::$errores[] = "Es obligatorio seleccionar una imagen para el anuncio de la propiedad.";
        }
        if(strlen($this->descripcion)<50){
            self::$errores[] = "La descripcion es obligatoria y debe tener al menos 50 caractéres";
        }
        if(!$this->habitaciones){
            self::$errores[] = "El número de habitaciones es obligatorio";
        }
        if(!$this->wc){
            self::$errores[] = "El número de baños es obligatorio";
        }
        if(!$this->estacionamientos){
            self::$errores[] = "El número de estacionamientos es obligatorio";
        }
        if(!$this->habitaciones){
            self::$errores[] = "El número de habitaciones es obligatorio";
        }
        if(!$this->vendedores_id){
            self::$errores[] = "Elija un vendedor";
        }
        return self::$errores;

    }
}