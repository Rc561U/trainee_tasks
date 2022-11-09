<?php

namespace Crud\Mvc\online_store_builder\core\product;

class ProductBuilder implements ProductBuilderInterface
{
    private ProductInterface $product;

    public function __construct($name)
    {
        $this->create($name);
    }

    public function create($className): ProductBuilderInterface
    {
        $className = "Crud\Mvc\online_store_builder\product\\".$className;
        $this->product = new $className();
        return $this;
    }


    public function setName(string $name): ProductBuilderInterface
    {
        $this->product->setName($name);
        return $this;
    }

    public function setReleaseDate(string $release): ProductBuilderInterface
    {
        $this->product->setReleaseDate($release);
        return $this;
    }

    public function setManufactures(string $manufactures): ProductBuilderInterface
    {
        $this->product->setManufactures($manufactures);
        return $this;
    }

    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    public function setCost(int $cost): ProductBuilderInterface
    {
        $this->product->setCost($cost);
        return $this;
    }
}