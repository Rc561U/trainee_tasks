<?php

namespace Crud\Mvc\core;


class Model
{
    private string $host = 'mariadb';
    private string $db = 'test';
    private string $user = 'root';
    private string $password = 'rootpass';

    public object $database;


    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=UTF8";

        try {
            $options = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];

            $this->database = new \PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function make()
    {
        return $this->database;
    }
}