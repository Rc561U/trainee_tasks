<?php

namespace Crud\Mvc\controllers;

use Crud\Mvc\core\Controller;
use Crud\Mvc\core\http\request\RequestCreator;
use Crud\Mvc\core\traits\Validator;
use Crud\Mvc\models\User;

class UserController extends Controller
{
    use Validator;

    private mixed $request;
    public object $database;

    public function __construct()
    {
        $this->database = new User();
        $this->request = new RequestCreator();
        $this->request = $this->request->create();
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

    public function updatePost(int $user_id)
    {
        $inputData = $this->request->getPost();
        $this->database->updateUserById($inputData["email"], $inputData["name"], $inputData["gender"], $inputData["status"], $user_id);
        header("Location: read?update=User data successfully updated!");
    }

    public function createPost()
    {
        echo 12321;
        $inputData = $this->request->getPost();
        $email = $inputData["email"] ?? null;
        $name = $inputData["name"] ?? null;
        $gender = $inputData["gender"] ?? null;
        $status = $inputData["status"] ?? null;

        $createValidation = $this->validate($email, $name, $gender, $status);
        if (!count($createValidation)) {
            $this->database->createUser($email, $name, $gender, $status);
            header("Location: read?create=New user successfully created!");
        } else {
            $this->validationError();
        }
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
