<?php

namespace Crud\Mvc\models;

use Crud\Mvc\core\Model;

class User extends Model
{
    public function createUserApi($email, $full_name, $gender, $status)
    {
        $query = $this->database->prepare("INSERT INTO  `test`.`users` (`email`,`full_name`,`gender`,`status`) VALUES (:email, :full_name, :gender, :status)");
        $query->execute([
            'email' => $email,
            'full_name' => $full_name,
            'gender' => $gender,
            'status' => $status,
        ]);
        return $this->database->lastInsertId();

    }

    public function createUser($email, $full_name, $gender, $status)
    {
        $query = $this->database->prepare("INSERT INTO  `test`.`users` (`email`,`full_name`,`gender`,`status`) VALUES (:email, :full_name, :gender, :status)");
        $query->execute([
            'email' => $email,
            'full_name' => $full_name,
            'gender' => $gender,
            'status' => $status,
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

    public function readUserApi()
    {
        $result = $this->database->query('SELECT * FROM test.users');
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function readUser()
    {
        return $this->database->query('SELECT * FROM test.users');
    }

    public function getEmailById($id)
    {
        $sth = $this->database->prepare('SELECT `email` FROM `users` WHERE user_id = ?');
        $sth->execute([$id]);
        return $sth->fetch(\PDO::FETCH_ASSOC)['email'] ?? false;
    }

    public function getEmail($email)
    {
        $sth = $this->database->prepare('SELECT `email` FROM `users` WHERE `email` = ?');
        $sth->execute([$email]);
        return $sth->fetch(\PDO::FETCH_ASSOC)['email'] ?? false;
    }

    public function getUserById($id)
    {
        $sth = $this->database->prepare('SELECT * FROM `users` WHERE user_id = ?');
        $sth->execute([$id]);
        return $sth->fetch(\PDO::FETCH_ASSOC) ?? false;
    }

    public function isEmailExists($id)
    {
        $sth = $this->database->prepare('SELECT `email` FROM `users` WHERE user_id = ?');
        $sth->execute([$id]);
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

    public function saveUploadFile($name, $size, $meta_data, $path, $weight, $height, $created_date = null,)
    {
        $query = $this->database->prepare("INSERT INTO  `test`.`uploads` (`name`,`size`,`mime`,`path`, `created_date`, `weight`, `height` ) VALUES (:name, :size,:mime,:path, :created_date, :weight, :height)");
        $query->execute([
            "name" => $name,
            "size" => $size,
            "mime" => $meta_data,
            "path" => $path,
            "created_date" => $created_date,
            "weight" => $weight,
            "height" => $height
        ]);

        return $query;
    }

    public function getUploads()
    {
        $result = $this->database->query('SELECT * FROM test.uploads');
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function setExample($data)
    {
        $query = $this->database->prepare("INSERT INTO  `test`.`example` (`docs`) VALUES (:arr)");
        $query->execute([
            "arr" => $data
        ]);
    }

    public function getExample()
    {
        $result = $this->database->query('SELECT * FROM test.example');
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}

