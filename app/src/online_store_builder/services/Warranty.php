<?php

namespace Crud\Mvc\online_store_builder\services;

use Crud\Mvc\online_store_builder\core\service\ServiceInterface;

class Warranty implements ServiceInterface
{
    /**
     * @var string
     */
    public string $deadline;
    /**
     * @var int
     */
    public int $cost;


    public function __toString(): string
    {
        $classPath = explode("\\",get_class($this));
        return end($classPath);
    }


    /**
     * @param string $deadline
     * @return void
     */
    public function setDeadline(string $deadline): void
    {
        $this->deadline = $deadline;
    }

    /**
     * @return string
     */
    public function getDeadline(): string
    {
        return $this->deadline;
    }

    /**
     * @param int $cost
     * @return void
     */
    public function setCost(int $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return int
     */
    public function getCost(): int
    {
        return $this->cost;
    }
}