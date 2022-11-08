<?php

namespace Crud\Mvc\online_store\core;

use Crud\Mvc\online_store\services\Configuration;
use Crud\Mvc\online_store\services\Delivery;
use Crud\Mvc\online_store\services\Installation;
use Crud\Mvc\online_store\services\Warranty;

abstract class AbstractService
{
    protected Configuration $configuration;
    protected Delivery $delivery;
    protected Installation $installation;
    protected Warranty $warranty;
    protected array $services;

    public function __construct()
    {
        $this->configuration = new Configuration();
        $this->delivery = new Delivery();
        $this->installation = new Installation();
        $this->warranty = new Warranty();
        $this->services = [$this->configuration, $this->delivery, $this->installation, $this->warranty]; //
    }


    public function __toString(): string
    {
        $classPath = explode("\\", get_class($this));
        return end($classPath);
    }

    public function setConfiguration($deadline, $cost): void
    {
        $this->configuration->setDeadline($deadline);
        $this->configuration->setCost($cost);
    }

    public function setDelivery($deadline, $cost): void
    {
        $this->delivery->setDeadline($deadline);
        $this->delivery->setCost($cost);
    }

    public function setInstallation($deadline, $cost): void
    {
        $this->installation->setDeadline($deadline);
        $this->installation->setCost($cost);
    }

    public function setWarranty($deadline, $cost): void
    {
        $this->warranty->setDeadline($deadline);
        $this->warranty->setCost($cost);
    }

}