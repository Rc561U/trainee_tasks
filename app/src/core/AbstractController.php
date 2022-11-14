<?php

namespace Crud\Mvc\core;

use Crud\Mvc\core\http\request\RequestInterface;
use Crud\Mvc\core\http\response\ResponseInterface;
use Crud\Mvc\core\traits\Jwt;

abstract class AbstractController
{
    use Jwt;

    protected RequestInterface $request;
    protected ResponseInterface $response;

    public $payload;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function isAuthoritize()
    {
        if (isset($_SESSION['session']['username'])){
            $this->payload['name'] = $_SESSION['session']['username'];
            return true;
        }
        if(isset($_COOKIE["User-Token"]) && $this->is_valid($_COOKIE["User-Token"]) || $this->payload) {
            $this->payload['name'] = $this->getPayload()['name'];
            return true;
        }
        return false;

    }
}
