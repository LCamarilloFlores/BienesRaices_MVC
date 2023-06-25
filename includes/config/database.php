<?php

function conectarDB() : mysqli {
    try{
        $db = new mysqli('localhost','root','asd123','bienesraices_crud');
    }
    catch(Throwable $error){
        echo 'No se conectó';
        exit;
    }

    return $db;
}