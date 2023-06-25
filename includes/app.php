<?php


require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';
$db = conectarDB();

//Conectamos a la base de datos
use Models\ActiveRecord;
ActiveRecord::setDB($db);
