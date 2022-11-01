<?php

require 'vendor/autoload.php';

use \Crud\Mvc\core\App;
use Crud\Mvc\core\http\request\RequestCreator;
use \Crud\Mvc\controllers\UserApiController;
use \Crud\Mvc\core\http\Router;

// load env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();

// Task 13
$router->setRoute("GET", "read", "UserController");
$router->setRoute("GET", "update", "UserController");
$router->setRoute("GET", "create", "UserController");
$router->setRoute("GET", "delete", "UserController");

// Task 14
$router->setRoute("GET", "", "MainController");
$router->setRoute("GET", "api/v1/users", "UserApiController");
$router->setRoute("GET", "api/v1/user/{id}", "UserApiController");
$router->setRoute("PATCH", "api/v1/user/{id}", "UserApiController");
$router->setRoute("DELETE", "api/v1/user/{id}", "UserApiController");
$router->setRoute("POST", "api/v1/user", "UserApiController");
$router->setRoute("POST", "api/v1/validate", "UserApiController");

$router->run();


