<?php

namespace Crud\Mvc\online_store_factory\services;

use Crud\Mvc\online_store_factory\core\services\AbstractService;
use Crud\Mvc\online_store_factory\core\services\ServiceInterface;

class Installation extends AbstractService implements ServiceInterface
{

    public string $deadline;
    public int $cost;

    /**
     * @return string
     */
    public function getDeadline(): string
    {
        return $this->deadline;
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
     * @return int
     */
    public function getCost(): int
    {
        return $this->cost;
    }

    /**
     * @param int $cost
     * @return void
     */
    public function setCost(int $cost): void
    {
        $this->cost = $cost;
    }
}