<?php

namespace Crud\Mvc\core;

use Crud\Mvc\core\http\request\RequestInterface;
use Crud\Mvc\core\http\response\ResponseInterface;

abstract class AbstractController
{
    protected RequestInterface $request;
    protected ResponseInterface $response;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

//    abstract public function execute(): ResponseInterface;
}
