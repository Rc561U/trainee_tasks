<?php

namespace Crud\Mvc\models;

use Crud\Mvc\core\Model;

class Authentication extends Model
{

    public function saveUser($email, $name, $password){
        $query = $this->database->prepare(
            "INSERT INTO  `test`.`authentication` (`email`,`name`,`password`) 
                    VALUES (:email, :name, :password)");
        $query->execute([
            "email" => $email,
            "name" => $name,
            "password" => $password,
        ]);

        return $query;
    }

    public function getEmail($email){
        $sth = $this->database->prepare('SELECT `email` FROM `authentication` WHERE `email` = ?');
        $sth->execute([$email]);
        return $sth->fetch(\PDO::FETCH_ASSOC)['email'] ?? false;
    }

    public function getUserDataByEmail($email)
    {
        $sth = $this->database->prepare('SELECT * FROM `authentication` WHERE `email` = ?');
        $sth->execute([$email]);
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }


}