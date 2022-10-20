<?php

namespace Crud\Mvc\core;

trait DatabaseConnect
{
    private string $host = 'mariadb';
    private string $db = 'test';
    private string $user = 'root';
    private string $password = 'rootpass';


    public function connect()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=UTF8";

        try {
            $options = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];

            return $this->connect = new \PDO($dsn, $this->user, $this->password, $options);
        } catch (\PDOException $error) {
            throw new DbException('No connection with database');
        }
    }
}