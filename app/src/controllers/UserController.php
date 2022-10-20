<?php

namespace Crud\Mvc\controllers;

use Crud\Mvc\core\Controller;
use Crud\Mvc\models\User;

class UserController extends Controller
{
    public object $database;

    public function __construct()
    {
        $this->database = new User();
    }

    public function read()
    {
        $result = $this->database->readUser();
        $this->render("read.php", $result);
    }

    public function update($user_id)
    {
        $result = $this->database->getUserPageById($user_id);
        $this->render("update.php", $result);
    }

    public function updatePost($email, $full_name, $gender, $status, $id)
    {
        $this->database->updateUserById($email, $full_name, $gender, $status, $id);
        header("Location: read?update=User data successfully updated!");
    }

    public function createPost($email, $full_name, $gender, $status)
    {
        $this->database->createUser($email, $full_name, $gender, $status);
        header("Location: read?create=New user successfully created!");
    }

    public function create()
    {
        $this->render("create.php");

    }

    public function delete($user_id)
    {
        $this->database->deleteUserById($user_id);
        header("Location: read?delete=User has been deleted!");
    }

    public function error()
    {
        $this->render("error.php");
    }

    public function validationError()
    {
        $this->render('validationError.php');
    }
}

