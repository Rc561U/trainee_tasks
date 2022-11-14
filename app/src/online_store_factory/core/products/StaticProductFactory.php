<?php

namespace Crud\Mvc\online_store_factory\core\products;

use Crud\Mvc\online_store_factory\core\StaticFactoryInterface;
use Crud\Mvc\online_store_factory\products\CellPhone;
use Crud\Mvc\online_store_factory\products\Fridge;
use Crud\Mvc\online_store_factory\products\Laptop;
use Crud\Mvc\online_store_factory\products\Tv;
use Exception;

class StaticProductFactory implements StaticFactoryInterface
{
    /**
     * @throws Exception
     */
    public static function build(string $type, array $data): ProductInterface
    {
        return match ($type) {
            'CellPhone' => new CellPhone($data),
            'Fridge' => new Fridge($data),
            'Laptop' => new laptop($data),
            'Tv' => new Tv($data),
            default => throw new Exception("Class $type is not exists"),
        };
    }
}