<?php

namespace Crud\Mvc\models;

use Crud\Mvc\core\Model;
use Exception;
use PDO;

class Authentication extends Model
{

    public function saveUser($email, $first_name, $last_name, $password)
    {
        try {
            $query = $this->database->prepare(
                "INSERT INTO  `test`.`authentication` (`email`,`first_name`, `last_name`, `password`) 
                    VALUES (:email, :first_name, :last_name, :password)");
            $query->execute([
                "email" => $email,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "password" => $password,
            ]);
            return $query;
        } catch (Exception $e) {
            return false;
        }

    }

    public function getEmail($email)
    {
        $sth = $this->database->prepare('SELECT `email` FROM `authentication` WHERE `email` = ?');
        $sth->execute([$email]);
        return $sth->fetch(PDO::FETCH_ASSOC)['email'] ?? false;
    }

    public function getUserDataByEmail($email)
    {
        $sth = $this->database->prepare('SELECT * FROM `authentication` WHERE `email` = ?');
        $sth->execute([$email]);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }


}