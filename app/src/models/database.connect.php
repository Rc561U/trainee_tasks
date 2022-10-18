<?php

$host = 'mariadb';
$db = 'test';
$user = 'root';
$password = 'rootpass';

class Connection
{
    public static function make($host, $db, $username, $password)
    {
        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

        try {
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

            return new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}

return Connection::make($host, $db, $user, $password);
