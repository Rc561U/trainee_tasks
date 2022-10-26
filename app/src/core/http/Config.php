<?php

namespace Crud\Mvc\core\http;



use Crud\Mvc\core\http\request\RequestCreatorInterface;

class Config
{
    private string $routesPath;
    private string $notFoundController;
    private RequestCreatorInterface $requestCreator;
    private string $controllerNamespace;

    /**
     * @param RequestCreatorInterface $requestCreator
     * @param string $routesPath
     * @param string $controllerNamespace
     * @param string $notFoundController
     */
    public function __construct(
        RequestCreatorInterface $requestCreator,
        string $routesPath,
        string $controllerNamespace,
        string $notFoundController
    ) {
        $this->routesPath = $routesPath;
        $this->controllerNamespace = $controllerNamespace;
        $this->notFoundController = $notFoundController;
        $this->requestCreator = $requestCreator;
    }

    /**
     * @return RequestCreatorInterface
     */
    public function getRequestCreator(): RequestCreatorInterface
    {
        return $this->requestCreator;
    }

    /**
     * @param RequestCreatorInterface $requestCreator
     */
    public function setRequestCreator(RequestCreatorInterface $requestCreator): void
    {
        $this->requestCreator = $requestCreator;
    }

    /**
     * @return string
     */
    public function getRoutesPath(): string
    {
        return $this->routesPath;
    }

    /**
     * @param string $routesPath
     */
    public function setRoutesPath(string $routesPath): void
    {
        $this->routesPath = $routesPath;
    }

    /**
     * @return string
     */
    public function getControllerNamespace(): string
    {
        return $this->controllerNamespace;
    }

    /**
     * @param string $controllerNamespace
     */
    public function setControllerNamespace(string $controllerNamespace): void
    {
        $this->controllerNamespace = $controllerNamespace;
    }

    /**
     * @return string
     */
    public function getNotFoundController(): string
    {
        return $this->notFoundController;
    }

    /**
     * @param string $notFoundController
     */
    public function setNotFoundController(string $notFoundController): void
    {
        $this->notFoundController = $notFoundController;
    }
}
