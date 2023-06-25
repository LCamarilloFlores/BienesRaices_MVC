<?php

function conectarDB() : mysqli {
    try{
        $db = new mysqli(
        $_ENV['DB_HOST'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        $_ENV['DB_BD']);
    }
    catch(Throwable $error){
        echo 'No se conectó';
        exit;
    }

    return $db;
}