<?php

namespace Crud\Mvc\core;

use Crud\Mvc\controllers\UserController;

class App
{
    use Validator;


    public string $uri;
    public string $action;
    public string $id;
    public mixed $requestMethod;

    private object $controller;

    function __construct()
    {
        $this->uri = $_SERVER["REQUEST_URI"];
        $this->id = $_GET['id'] ?? "";
        $this->requestMethod = $_SERVER["REQUEST_METHOD"];
        $this->isActionExists();

        $this->controller = new UserController();
    }

    // check if action exists in UserController class
    public function isActionExists(): void
    {
        $action = $this->uri;
        $action = explode("?", $action);
        $action = trim($action[0], '/');

        if (method_exists(UserController::class, $action)) {
            $this->action = $action;
        } else {
            $this->action = false;
        }
    }

    public function start(): void
    {
        $action = $this->action;
        $method = $this->requestMethod;

        if ($method === "GET" && $action) {
            switch ($action) {
                case $action == "create":
                case $action == "read":
                    $start = $this->controller;
                    $start->$action();
                    break;

                case $action == "delete":
                case $action == "update":
                    $start = $this->controller;
                    $start->$action($this->id);
                    break;
                default:
                    $start = $this->controller;
                    $start->error();
                    break;

            }
        } elseif ($method === "POST" && $action) {
            $this->postUserData();
        } else {
            $start = $this->controller;
            $start->error();
        }
    }

    public function postUserData(): void
    {
        $email = $_POST['email'];
        $full_name = $_POST['name'];
        $gender = $_POST['gender'] ?? "";
        $status = $_POST['status'] ?? "";
        $id = $_POST['id'] ?? "";

        $result = $this->controller;
        if ($this->action === 'create') {
            $validationResult = $this->validate($email, $full_name, $gender, $status);
        } elseif ($this->action === 'update') {
            $validationResult = $this->validate($email, $full_name, $gender, $status, $id);
        }


        if ($this->action === "update" && $validationResult) {
            $result->updatePost($email, $full_name, $gender, $status, $id);
        } elseif ($this->action === "create" && $validationResult) {
            $result->createPost($email, $full_name, $gender, $status);
        } else {
            if ($validationResult)
            {
                $start = $this->controller;
                $start->error();
            }
            else {
                $this->controller->validationError();
            }


        }
    }

}