<?php

namespace Crud\Mvc\core\traits;

use PDO;

trait DatabaseConnect
{
    public function connect()
    {
        $host = $_SERVER['HOST'];
        $db = $_SERVER['DB'];
        $user = $_SERVER['USER_NAME'];
        $password = $_SERVER['PASSWORD'];

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
        try {
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

            return $this->connect = new PDO($dsn, $user, $password, $options);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }
}