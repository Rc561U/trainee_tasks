<?php

namespace Crud\Mvc\online_store_factory\core\services;

use Crud\Mvc\online_store_factory\services\Configuration;
use Crud\Mvc\online_store_factory\services\Delivery;
use Crud\Mvc\online_store_factory\services\Installation;
use Crud\Mvc\online_store_factory\services\Warranty;

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

    public function getServiceName()
    {
        return $this->prepareStrToReturn();
    }

    private function prepareStrToReturn()
    {
        $classPath = explode("\\", get_class($this));
        return end($classPath);
    }


}