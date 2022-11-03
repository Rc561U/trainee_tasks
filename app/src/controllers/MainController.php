<?php

namespace Crud\Mvc\controllers;

use Crud\Mvc\core\AbstractController;
use Crud\Mvc\core\Controller;
use Crud\Mvc\models\Authentication;

class MainController extends AbstractController
{
    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
    }

    public function get()
    {
        $result = null;
        if (!empty($_SESSION)){
            $result = $_SESSION['session'];
        }
        $result = ['template' => 'home_templates/home.html.twig', 'data' => $result];
        $this->response->setBody($result);
        return $this->response;
    }
}


