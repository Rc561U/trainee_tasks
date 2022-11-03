<?php

namespace Crud\Mvc\core\http;


use Crud\Mvc\controllers\UserController;
use Crud\Mvc\core\exception\RouterException;
use Crud\Mvc\core\http\request\RequestCreator;
use Crud\Mvc\core\http\response\HtmlResponse;
use Crud\Mvc\core\http\response\JsonResponse;
use Crud\Mvc\core\http\response\ResponseInterface;
use Crud\Mvc\core\http\response\ResponseProcessor;

class Router
{

//    private RequestInterface $request;
    private ResponseProcessor $responseProcessor;
    private object $request;
    private array $routes;

    private string $currentController;
    private string $currentMethod;
    private string $currentAction;
    private $currentUserid;


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
    private function mapRequest(): void
    {

        $this->validateRouter();
        $controller = $this->getController($this->currentController);
        $control = explode("\\", $controller);
        if (end($control) == "UserApiController") {
            $this->apiProcessor($controller);
        } elseif (end($control) === "UserController") {
            $this->htmlProcessor($controller);
        } elseif (end($control) === "UploadController") {
            $this->MainProcessor($controller);
        } elseif (end($control) === "AuthenticationController") {
            $this->MainProcessor($controller);
        } elseif (end($control) === "MainController") {
            $this->MainProcessor($controller);
        }
    }

    private function htmlProcessor($controller): void
    {
        $controllerClass = new $controller();
        $action = $this->currentAction ?? "get"; // for homepage
        $this->getUserId();
        $method = $this->request->getMethod();
        if ($method == "POST") {
            $action = $action . "Post";
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


    private function MainProcessor($controller): void
    {
        $response = $this->createResponseObject('html');
        $controllerClass = new $controller($this->request, $response);
        $action = $this->request->getUri();
        if ($action) {
            $response = $controllerClass->$action();
        } else {
            $response = $controllerClass->get(); // Main page
        }
        $this->responseProcessor->process($response);
    }

    private function apiProcessor($controller): void
    {

        $response = $this->createResponseObject('json');
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

    private function createResponseObject($type): ResponseInterface
    {
        return match ($type) {
            'json' => new JsonResponse(),
            'html' => new HtmlResponse(),
        };
    }


    private function getController(string $currentController): string
    {
        return "\Crud\Mvc\controllers\\$currentController";
    }

    public function setRoute(string $method, string $uri, string $controller): void
    {
        $this->routes[] = ["method" => $method, "uri" => $uri, "controller" => $controller];
    }

    public function validateRouter(): bool
    {
        $currentUri = $this->request->getUri();

        $action = explode("?", $currentUri);
        $action = trim($action[0], '/');
        foreach ($this->routes as $router) {

            if (method_exists(UserController::class, $action)) {
                $this->currentController = "UserController"; //$router['controller'];
                $this->currentMethod = $router['method'];
                $this->currentAction = $action;
                return true;

            } elseif ($this->validateUserApiUri($currentUri, $router['uri']) &&
                $router['method'] == $this->request->getMethod()) {
                $this->currentController = $router['controller'];
                $this->currentMethod = $router['method'];
                return true;

            } elseif ($router['uri'] == $currentUri && $router['method'] == $this->request->getMethod()) {
                $this->currentController = $router['controller'];
                $this->currentMethod = $router['method'];
                return true;
            }
        }

        $error = new UserController();
        $error->error();
        exit();
        //throw new RouterException('No controller for this route');
    }

    private function validateUserApiUri($uri, $savedUri): bool
    {
        return preg_match("/^api\/v1\/user\/[0-9]+$/", $uri) && $savedUri == "api/v1/user/{id}";
    }

    private function getApiUserId($method, $uri): void
    {
        $splitedUri = explode('/', $uri);
        $this->currentAction = $method . ucfirst($splitedUri[2]);
        if (count($splitedUri) == 4) {
            $this->currentUserid = $splitedUri[3];
        } elseif (count($splitedUri) == 3) {
            $this->currentUserid = null;
        }
    }

    private function getUserId(): void
    {
        $params = $this->request->getParams();
        $inputData = $this->request->getPost();
        if (isset($params["id"])) {
            $this->currentUserid = $this->request->getParams()["id"];
        }
        if (isset($inputData["id"])) {
            $this->currentUserid = $inputData["id"];
        }
    }


}
