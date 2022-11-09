<?php

namespace Crud\Mvc\online_store_builder;

use Crud\Mvc\online_store_builder\core\product\ProductInterface;
use Crud\Mvc\online_store_builder\core\service\AbstractService;
use Crud\Mvc\online_store_builder\core\service\ServiceBuilder;

class Services extends AbstractService
{
    protected array $services;

    /**
     * @return void
     */
    public function showAllServices():void
    {
        echo "Available services:<br>";
        $i=0;
        foreach ($this->services as $service)
        {
            $i++;
            echo "$i. $service<br>Deadline:$service->deadline<br>Cost:$service->cost<br>";
            echo "<br>";
        }
    }

    public function addNewService(string $class, array $values): void
    {
        list($deadline,$cost) = $values;
        $builder = new ServiceBuilder($class);
        $service = $builder->setDeadline($deadline)
            ->setCost($cost)
            ->getService();
        $this->services[] = $service;
    }





}