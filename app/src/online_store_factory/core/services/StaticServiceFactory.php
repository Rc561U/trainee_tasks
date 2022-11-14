<?php

namespace Crud\Mvc\online_store_factory\core\services;

use Crud\Mvc\online_store_factory\core\StaticFactoryInterface;
use Crud\Mvc\online_store_factory\services\Configuration;
use Crud\Mvc\online_store_factory\services\Delivery;
use Crud\Mvc\online_store_factory\services\Installation;
use Crud\Mvc\online_store_factory\services\Warranty;
use Exception;

class StaticServiceFactory implements StaticFactoryInterface
{
    /**
     * @throws Exception
     */
    public static function build(string $type, array $data): ServiceInterface
    {
        return match ($type) {
            'Configuration' => new Configuration($data),
            'Delivery' => new Delivery($data),
            'Installation' => new Installation($data),
            'Warranty' => new Warranty($data),
            default => throw new Exception("Class $type is not exists"),
        };
    }
}