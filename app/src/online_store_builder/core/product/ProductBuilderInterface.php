<?php

namespace Crud\Mvc\online_store_builder\core\product;

interface ProductBuilderInterface
{
    public function create(string $className):ProductBuilderInterface;
    public function setName(string $name):ProductBuilderInterface;
    public function setReleaseDate(string $release):ProductBuilderInterface;
    public function setManufactures(string $manufactures):ProductBuilderInterface;
    public function setCost(int $cost):ProductBuilderInterface;
    public function getProduct():ProductInterface;
}