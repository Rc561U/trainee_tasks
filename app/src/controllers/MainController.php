<?php

namespace Crud\Mvc\controllers;

use Crud\Mvc\core\Controller;

class MainController extends Controller
{
    public function get()
    {
//        require_once "src/views/header.php";
        require_once "src/views/main/home.php";
//        require_once "src/views/footer.php";
    }
}