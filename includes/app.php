<?php


require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
require 'funciones.php';
require 'config/database.php';
$db = conectarDB();

//Conectamos a la base de datos
use Models\ActiveRecord;
ActiveRecord::setDB($db);
