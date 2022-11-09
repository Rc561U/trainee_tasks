<?php

namespace Crud\Mvc\online_store_builder\core\service;

class ServiceBuilder implements ServiceBuilderInterface
{
    private ServiceInterface $service;

    public function __construct($name)
    {
        $this->create($name);
    }

    public function create(string $className): ServiceBuilderInterface
    {
        $className = "Crud\Mvc\online_store_builder\services\\".$className;
        $this->service = new $className();
        return $this;
    }

    public function setDeadline(string $deadline): ServiceBuilderInterface
    {
        $this->service->setDeadline($deadline);
        return $this;
    }

    public function setCost(int $cost): ServiceBuilderInterface
    {
        $this->service->setCost($cost);
        return $this;
    }

    public function getService(): ServiceInterface
    {
        return $this->service;
    }
}