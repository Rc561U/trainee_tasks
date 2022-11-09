<?php

namespace Crud\Mvc\online_store_builder\products;

use Crud\Mvc\online_store_builder\core\product\AbstractProduct;

class Fridge extends AbstractProduct
{
    public function __construct($name, $manufactures, $release, $cost)
    {
        parent::__construct($name, $manufactures, $release, $cost);

    }
}