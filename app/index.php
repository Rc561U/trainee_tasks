<?php

require 'vendor/autoload.php';

session_start();


use Crud\Mvc\core\http\Router;

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

// Task 15
$router->setRoute("GET", "upload", "UploadController");
$router->setRoute("POST", "upload", "UploadController");
$router->setRoute("GET", "api/v1/uploads", "UserApiController");
$router->setRoute("POST", "api/v1/uploads", "UserApiController");
$router->setRoute("GET", "api/v1/files", "UserApiController");


// Task 16-17
$router->setRoute("GET", "registration", "AuthenticationController");
$router->setRoute("POST", "registration", "AuthenticationController");
$router->setRoute("GET", "login", "AuthenticationController");
$router->setRoute("POST", "login", "AuthenticationController");
$router->setRoute("GET", "destroy", "AuthenticationController");


$router->run();

