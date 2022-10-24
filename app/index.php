<?php

require 'vendor/autoload.php';

use \Crud\Mvc\core\App;

// load env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$test = new App();
$test->start();

