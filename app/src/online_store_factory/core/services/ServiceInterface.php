<?php

namespace Crud\Mvc\online_store_factory\core\services;

interface ServiceInterface
{
    /**
     * @param string $deadline
     * @return void
     */
    public function setDeadline(string $deadline):void;

    /**
     * @return string
     */
    public function getDeadline():string;

    /**
     * @param int $cost
     * @return void
     */
    public function setCost(int $cost):void;

    /**
     * @return int
     */
    public function getCost():int;

}