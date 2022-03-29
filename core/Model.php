<?php

namespace Core;

use \Doctrine\DBAL\DriverManager;

abstract class Model
{
    protected static function getDB()
    {
        static $conn = null;

        $connectionParams = [
            'dbname' => constant('DB_NAME'),
            'user' => constant('DB_USER'),
            'password' => constant('DB_PASS'),
            'host' => constant('DB_HOST'),
            'driver' => constant('DB_DRIVER'),
        ];
        
        $conn = DriverManager::getConnection($connectionParams);
        

        return $conn;
    }
}