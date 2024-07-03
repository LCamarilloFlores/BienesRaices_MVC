<?php

function conectarDB(): mysqli
{
    try {
        $db = new mysqli(
            'srv872.hstgr.io:3306',
            'u530132658_bienesadmin',
            'bNLASG0102$',
            'u530132658_bienesraices'
        );
    } catch (Throwable $error) {
        echo 'No se conectó';
        exit;
    }

    return $db;
}
