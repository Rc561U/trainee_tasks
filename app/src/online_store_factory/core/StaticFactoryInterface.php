<?php

namespace Crud\Mvc\online_store_factory\core;

interface StaticFactoryInterface
{
    /**
     * @param string $type
     * @param array $data
     * @return mixed
     */
    public static function build(string $type, array $data): mixed;
}