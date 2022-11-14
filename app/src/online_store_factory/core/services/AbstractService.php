<?php

namespace Crud\Mvc\online_store_factory\core\services;

abstract class AbstractService
{
    protected string $deadline;
    protected int $cost;
    protected array $services;

    public function __construct($array)
    {
        list($deadline, $cost) = $array;
        $this->deadline = $deadline;
        $this->cost = $cost;
    }


    public function __toString(): string
    {
        return $this->prepareStrToReturn();
    }

    private function prepareStrToReturn()
    {
        $classPath = explode("\\", get_class($this));
        return end($classPath);
    }

    public function getServiceName()
    {
        return $this->prepareStrToReturn();
    }


}