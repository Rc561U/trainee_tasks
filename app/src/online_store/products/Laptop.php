<?php

namespace Crud\Mvc\online_store\products;

use Crud\Mvc\online_store\core\AbstractProduct;

class Laptop extends AbstractProduct
{
    public function __construct($name, $manufactures, $release, $cost)
    {
        parent::__construct($name, $manufactures, $release, $cost);

    }
}