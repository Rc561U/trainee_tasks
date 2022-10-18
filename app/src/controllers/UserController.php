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

    public function create()
    {
        $this->render("create.php");

    }

    public function delete($user_id)
    {
        $result = $this->database->deleteUserById($user_id);
    }
}

