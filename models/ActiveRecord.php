<?php

namespace Models;

class ActiveRecord{

    protected static $tabla = '';
    protected static $db;
    public $id;
    protected static $columnasDB = [];
    
    //Errores
    protected static $errores = [];


    

    //Definir la conexion a la base de datos
    public static function setDB($database){
        self::$db = $database;
    }

    
    public function crear(){

        //Sanitizar los datos
        $datos = $this->sanitizarDatos();
        
        $string = join(" , ",array_keys($datos));
        $valores = "'". join("' , '",array_values($datos)). "'";
        //Insertar en la base de datos
        $query = "INSERT INTO ".static::$tabla." ( {$string} ) VALUES ( {$valores} )";
        $resultado = self::$db->query($query);
        if($resultado){
            header("Location: /admin?resultado=1");
        }
    }

    //Eliminar propiedad
    public function eliminar(){
        $query = "DELETE FROM ".static::$tabla." WHERE id=".self::$db->escape_string($this->id)." LIMIT 1;";
        $resultado = self::$db->query($query);
     //   $this->eliminaImagen();
        if($resultado){
            header("Location: /admin?resultado=3");
        }
    }

    public function limpiaCarpetaIMG(){
        $archivos = $this->listarArchivos(CARPETA_IMAGENES);
        
        foreach($archivos as $value){
            if(!$this->existeEnLaBD($value)){
                unlink(CARPETA_IMAGENES.$value);
            }
        }

}

public function existeEnLaBD($archivo){
    $query = "SELECT imagen FROM ".static::$tabla;
    $imagenes = self::$db->query($query);
    foreach($imagenes as $value){
        if($archivo===$value['imagen']){
            return true;
        }
    }
    return false;
}

public function listarArchivos($directorio){
    $archivos = [];
    $carpeta = opendir($directorio);
    if($carpeta){
            $i=0;
            while(($archivo = readdir($carpeta))!==FALSE){
                if($archivo==="."||$archivo===".."){
                    continue;
                }
                $archivos[$i] = $archivo;
                $i++;
                } 
            }   

    return $archivos;
}
    
    public function actualizar(){

        //Sanitizar los datos
        $datos = $this->sanitizarDatos();
        $valores = [];
        foreach($datos as $key => $value){
            $valores[] = "{$key} = '{$value}'";
        }

        $string = join(" , ",array_values($valores));
        //Insertar en la base de datos
        $query = "UPDATE ".static::$tabla." SET  {$string} WHERE id = '".self::$db->escape_string($this->id)."' LIMIT 1";
        $resultado = self::$db->query($query);
        if($resultado){
            header("Location: /admin?resultado=2");            
        }
    }

    public function atributos(){
        $atributos=[];
        foreach(static::$columnasDB as $columna):
            if($columna==='id') continue;
            $atributos[$columna] = $this->$columna; 
        endforeach;
        return $atributos;
    }
    public function sanitizarDatos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key=>$value):
            $sanitizado[$key] = static::$db->escape_string($value);
        endforeach;
        
        return $sanitizado;
    }

    public static function getErrores(){
        return static::$errores;
    }

    //Subuda de archivos
    
    //Lista todas las propiedades
    public static function all(){
        $query = "SELECT * FROM ".static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    //Lista una cantidad de resultados
    public static function some($cantidad){
        $query = "SELECT * FROM ".static::$tabla." LIMIT ".$cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    //Busca una propiedad por su id
    public static function find($id){
        $query = "SELECT * FROM ".static::$tabla." WHERE id={$id} LIMIT 1";
        $resultado = self::consultarSQL($query);
        return $resultado[0];
    }
    
    public function guardar(){
        if(!is_null($this->id))
        {
            $this->actualizar();
        }
        else{
            $this->crear();
        }
    }

    public static function consultarSQL($query){
        //Consultar la base de datos
        $resultado = self::$db->query($query);
        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()):
            $array[] = static::crearObjeto($registro);
        endwhile;
        //Liberar la memoria
        $resultado->free();
        //Devolver los resultados
        return $array;
    }

    public function validar(){
        static::$errores = [];
        return static::$errores;
    }

    protected static function crearObjeto($registro){
        $objeto = new static;
        foreach($registro as $key=>$value):
            if(property_exists($objeto,$key)):
                $objeto->$key = $value;
            endif;
        endforeach;
        return $objeto;

    }
    
    //Sincronizar el objeto en memoria con los datos ingresados por el usuario
    public function sincronizar($args=[]){
        foreach($args as $key => $value ){
            if(property_exists($this,$key) && !is_null($value)){
                $this->$key = $value;    
            }
        }

    }
}