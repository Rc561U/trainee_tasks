<?php

namespace Crud\Mvc\core\http;


use Crud\Mvc\controllers\UserController;
use Crud\Mvc\core\exception\RouterException;
use Crud\Mvc\core\http\request\RequestCreator;
use Crud\Mvc\core\http\request\RequestInterface;
use Crud\Mvc\core\http\response\JsonResponse;
use Crud\Mvc\core\http\response\ResponseInterface;
use Crud\Mvc\core\http\response\ResponseProcessor;

use \Crud\Mvc\controllers\UserApiController;

class Router
{

//    private RequestInterface $request;
    private ResponseProcessor $responseProcessor;
    private object $request;
    private array $routes;

    private string $currentController;
    private string $currentMethod;
    private string $currentAction;
    private  $currentUserid;


    public function __construct()
    {
        $res = new RequestCreator();
        $this->request = $res->create();

        $this->responseProcessor = new ResponseProcessor();

    }


    public function run(): void
    {
        $this->mapRequest();
    }


    /**
     * @throws RouterException
     */
    private function mapRequest()
    {

        $this->validateRouter();
        $controller = $this->getController($this->currentController);
        $control = explode("\\", $controller);
//        echo end($control);
        if (end($control) == "UserApiController"){
            $this->apiProcessor($controller);
        } else {
            $this->htmlProcessor($controller);
        }

    }
    private function htmlProcessor($controller){
        $controllerClass = new $controller();
        $action = $this->currentAction;
        $this->getUserId();
        $method = $this->request->getMethod();
        if ($method == "POST"){
            $action = $action."Post";
            if (isset($this->currentUserid)) {
                $id = $this->currentUserid;
                $controllerClass->$action($id);
            } else {
                $controllerClass->$action();
            }
        } else {
            if (isset($this->currentUserid)) {
                $controllerClass->$action($this->currentUserid);
            } else {
                $controllerClass->$action();
            }
        }

    }

    private function apiProcessor($controller){

        $response = $this->createResponseObject();
        $this->getApiUserId($this->currentMethod, $this->request->getUri());
        $controllerClass = new $controller($this->request, $response);

        $action = $this->currentAction;
        if (isset($this->currentUserid)) {
            $response = $controllerClass->$action($this->currentUserid);
        } else {
            $response = $controllerClass->$action();
        }
        $this->responseProcessor->process($response);
    }

    private function createResponseObject(): ResponseInterface
    {
        return new JsonResponse();
    }

    /**
     * @throws RouterException
     */
    private function getController(string $currentController): string
    {
        return "\Crud\Mvc\controllers\\$currentController";
    }

    public function setRoute(string $method, string $uri, string $controller): void
    {
        $this->routes[] = ["method" => $method, "uri" => $uri, "controller" => $controller];
    }

    public function validateRouter()
    {
        $currentUri = $this->request->getUri();
        $action = explode("?", $currentUri);
        $action = trim($action[0], '/');
        foreach ($this->routes as $router) {
            if ($router['uri'] == $currentUri && $router['method'] == $this->request->getMethod()) {
                $this->currentController = $router['controller'];
                $this->currentMethod = $router['method'];
                return true;

            } elseif (preg_match("/^api\/v1\/user\/[0-9]+$/", $currentUri) &&
                $router['method'] == $this->request->getMethod())
            {
                $this->currentController = $router['controller'];
                $this->currentMethod = $router['method'];
                return true;

            } elseif (method_exists(UserController::class, $action)){
                $this->currentController = $router['controller'];
                $this->currentMethod = $router['method'];
                $this->currentAction = $action;
            } else {
                $error = new UserController();
                $error->error();
                exit();
            }

        }
        return false;
//        throw new RouterException('No controller for this route');
    }

    private function getApiUserId($method, $uri)
    {
        $splitedUri = explode('/', $uri);
        $this->currentAction = $method . ucfirst($splitedUri[2]);
        if (count($splitedUri) == 4) {
            $this->currentUserid = $splitedUri[3];
        } elseif (count($splitedUri) == 3) {
            $this->currentUserid = null;
        }
    }
    private function getUserId()
    {
        $params = $this->request->getParams();
        $inputData = $this->request->getPost();
        if (isset($params["id"]))
        {
            $this->currentUserid = $this->request->getParams()["id"];
        }
        if (isset($inputData["id"]))
        {
            $this->currentUserid = $inputData["id"];
        }
    }


}
