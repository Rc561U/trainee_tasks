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

    public function saveUserToken($id,$token,$expired)
    {
        $query = $this->database->prepare(
            "INSERT INTO  `test`.`tokens` (`user_id`,`token`, `expired_date`) 
                    VALUES (:user_id, :token, :expired_date)");
        $query->execute([
            "user_id" => $id,
            "token" => $token,
            "expired_date" => $expired,
        ]);
        return $query;
    }

    public function gelLastInsertId()
    {
       $result = $this->database->query(' SELECT MAX( `id` ) FROM `authentication`');
       $result = $result->fetch(\PDO::FETCH_ASSOC);
       return $result["MAX( `id` )"];
    }


    public function saveBlockedUser($ip, $expired_date)
    {
        $query = $this->database->prepare(
            "INSERT INTO  `test`.`black_list` (`ip`,`expired_date` ) 
                VALUES (:ip, :expired_date)");
        $query->execute([
            "ip" => $ip,
            "expired_date" => $expired_date,
        ]);
        return $query;
    }

    public function getLastBannedUserIp($ip)
    {
        $query = $this->database->prepare("select * from black_list where ip = :ip ORDER BY id DESC LIMIT 1");
        $query->execute([
            "ip" => $ip,
        ]);
        return $query->fetch(\PDO::FETCH_ASSOC);


    }

}