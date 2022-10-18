<?php

namespace Crud\Mvc\core;

use Crud\Mvc\controllers\UserController;

class App
{
    private $config = [];
    public object $db;
    public array $routes;
    public $uri;
    public $action;
    public $id;

    function __construct()
    {
        $this->uri = $_SERVER["REQUEST_URI"];
        $this->isActionExists();
        $this->id = $_GET['id'] ?? "";
    }

    public function route($action, $callback)
    {

        $action = trim($action, '/');
        $this->routes[$action] = $callback;

    }

    public function dispatch($action)
    {
        $action = trim($action, '/');
        $callback = $this->routes[$action];

        echo call_user_func($callback);
    }

    public function isActionExists()
    {
        $action = $this->uri;
        $action = explode("?", $action);
        $action = trim($action[0], '/');

        if (method_exists(UserController::class, $action)) {
            $this->action = $action;
        } else {
            $this->action = null;;;
        }
    }

    public function getURI()
    {
        return $_SERVER["REQUEST_URI"];
    }

    public function start()
    {
        $action = $this->action;
        try {
            switch ($action) {
                case $action == "read":
                    $start = new UserController();
                    $start->$action();
                    break;

                case $action == "create":
                    $start = new UserController();
                    $start->$action();
                    break;

                case $action == "update":
                    $start = new UserController();
                    $start->$action($this->id);
                    break;

                case $action == "delete":
                    $start = new UserController();
                    $start->$action($this->id);
//                    header("Location: read");

            }
        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }


    }


}