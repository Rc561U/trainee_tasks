<?php

namespace Crud\Mvc\models;

use Crud\Mvc\core\Model;

class User extends Model
{
    public function createUser()
    {
        $query = $this->databaseConnection->prepare("INSERT INTO  `test`.`users` (`email`,`full_name`,`gender`,`status`) VALUES (:email, :full_name, :gender, :status)");
        $query->execute([
            'email' => $this->email,
            'full_name' => $this->name,
            'gender' => $this->gender,
            'status' => $this->status,
        ]);

        return $query;

    }
    public function deleteUserById($user_id)
    {
        $sql = 'DELETE FROM users WHERE user_id = :user_id';

        $statement = $this->database->prepare($sql);
        $statement->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
        return $statement->execute();


    }
    public function getUserPageById($id)
    {
        $sth = $this->database->prepare('SELECT * FROM `users` WHERE user_id = ?');
        $sth->execute([$id]);
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }


    public function updateUserById($email, $full_name, $gender, $status, $id)
    {
        $query = $this->database->prepare("UPDATE users SET email = :email, full_name = :full_name, gender = :gender, status = :status WHERE user_id = :user_id ");
        $query->execute([
            'email' => $email,
            'full_name' => $full_name,
            'gender' => $gender,
            'status' => $status,
            'user_id' => $id,
        ]);
    }

    public function readUser()
    {
        $result = $this->database->query('SELECT * FROM test.users');
        return $result;
    }




}

