<?php

namespace Crud\Mvc\online_store_builder\core\service;

use Crud\Mvc\online_store_builder\services\Configuration;
use Crud\Mvc\online_store_builder\services\Delivery;
use Crud\Mvc\online_store_builder\services\Installation;
use Crud\Mvc\online_store_builder\services\Warranty;

abstract class AbstractService
{


    public function __toString(): string
    {
        $classPath = explode("\\", get_class($this));
        return end($classPath);
    }


}