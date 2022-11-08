<?php

namespace Crud\Mvc\controllers;

use Crud\Mvc\core\AbstractController;
use Crud\Mvc\core\traits\Jwt;
use Exception;

class MainController extends AbstractController
{
    use Jwt;
    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
    }

    /**
     * @throws Exception
     */
    public function get()
    {
        $result = null;

        if($this->isAuthoritize()){
            $result['username'] = $this->payload['name'];
        }
        $result = ['template' => 'home_templates/home.html.twig', 'data' => $result];

        $this->response->setBody($result);
        return $this->response;
    }


}


