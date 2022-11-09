<?php

namespace Crud\Mvc\online_store_builder\core\service;

interface ServiceBuilderInterface
{
    public function create(string $className):ServiceBuilderInterface;
    public function setDeadline(string $deadline):ServiceBuilderInterface;
    public function setCost(int $cost):ServiceBuilderInterface;
    public function getService():ServiceInterface;
}