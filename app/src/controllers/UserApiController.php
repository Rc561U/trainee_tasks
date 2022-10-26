<?php

namespace Crud\Mvc\controllers;

use Crud\Mvc\core\http\request\RequestInterface;
use Crud\Mvc\core\http\response\ResponseInterface;
use Crud\Mvc\core\traits\Validator;
use Crud\Mvc\models\User;

class UserApiController extends AbstractController
{
    use Validator;

    public object $database;
    private array $success;
    private array $error;


    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->database = new User();
        $this->success = ["status" => "true", "response" => null];
        $this->error = ["status" => "false", "response" => null];
    }

    public function getUsers(): ResponseInterface
    {

        $result = $this->database->readUserApi();
        $this->response->setBody($this->success["response"] = $result);
        return $this->response;
    }

    public function getUser($user_id)
    {
        if ($this->isUserExists($user_id)) {
            $result = $this->database->getUserPageById($user_id);
            $this->response->setBody($this->success["response"] = $result);
        }
        return $this->response;
    }

    public function patchUser($user_id)
    {
        $inputData = ($this->request->getJsonRequest());
        if ($this->isUserExists($user_id)) {
            if (!$this->database->getEmail($inputData["email"]) || $this->database->getEmailById($user_id) === $inputData["email"]) {
                $this->database->updateUserById($inputData["email"], $inputData["name"], $inputData["gender"], $inputData["status"], $user_id);
                $this->success["response"] = "User has been successfully updated";
                $this->response->setBody($this->success);
            } else {
                $this->error["response"] = "Email already exists";
                $this->response->setBody($this->error);
            }
        }
        return $this->response;
    }

    public function deleteUser($user_id)
    {
        if ($this->isUserExists($user_id)) {
            $this->database->deleteUserById($user_id);
            $this->success["response"] = "User has been successfully deleted";
            $this->response->setBody($this->success);
        }
        return $this->response;
    }

    public function postUser()
    {
        $inputData = $this->request->getPost();
        $email = $inputData["email"];
        $name = $inputData["name"];
        $gender = $inputData["gender"];
        $status = $inputData["status"];

        if ($this->isUserDataValid($email, $name, $gender, $status)) {
            $lastId = $this->database->createUserApi($email, $name, $gender, $status);
            $this->success["response"] = "New user successfully created";
            $this->success["id"] = $lastId;
            $this->response->setBody($this->success);
            $this->response->setCode(201);
        }
        return $this->response;
    }

    private function isUserExists($user_id)
    {
        if (!$this->getUserById($user_id)) {
            $this->error["response"] = "User is not exists";
            $this->response->setCode(404);
            $this->response->setBody($this->error);
            return false;
        }
        return true;
    }

    private function isUserDataValid($email, $name, $gender, $status, $user_id = null)
    {
        $validator = $this->validate($email, $name, $gender, $status);
        if (count($validator)) {
            $this->error["errors"] = $validator;
            $this->response->setCode(400);
            $this->response->setBody($this->error);
            return false;
        }
        return true;

    }

    public function postValidate()
    {
        $jsonRequest = ($this->request->getJsonRequest());
        if (!isset($jsonRequest["user_id"]))
        {
            if($this->database->getEmail($jsonRequest["email"]))
            {
                $this->response->setBody(["available" => false]);
            }
            else {
                $this->response->setBody(["available" => true]);
            }
        }
        else
        {
            $oldEmail = $this->database->getEmailById($jsonRequest["user_id"]);
            $newEmail = $jsonRequest["email"];
            if ($oldEmail === $newEmail || !$this->database->getEmail($newEmail))
            {
                $this->response->setBody(["available" => true]);
            }
            else{
                $this->response->setBody(["available" => false]);
            }
        }
        return $this->response;
    }




//    private function isUserDataValid($email, $name, $gender, $status, $user_id = null)
//    {
//        $validator = $this->validate($email, $name, $gender, $status);
//        if ($user_id)
//        {
//            if ()
//
//        }else{
//
//        }
//    }

}