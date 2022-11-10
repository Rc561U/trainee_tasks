<?php

namespace Crud\Mvc\online_store_builder;

use Crud\Mvc\online_store_builder\core\product\ProductInterface;
use Crud\Mvc\online_store_builder\core\service\AbstractService;
use Crud\Mvc\online_store_builder\core\service\ServiceBuilder;

class Services
{
    protected array $services;

    /**
     * @return void
     */
    public function showAllServices():void
    {
        echo "<h1>Available services:</h1><br>";
        $i=0;
        foreach ($this->services as $service)
        {
            $i++;
            echo $this->getServiceString($service);
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

    public function showService($service){

        if (in_array($service,$this->services))
        {
            foreach ($this->services as $savedServices){
                if ($service == $this->getClassBasename($savedServices))
                {
                    echo $this->getServiceString($savedServices);
                }
            }
        }
        else{
            echo "Service not found";
        }
    }

    private function getClassBasename($service){
        return basename(str_replace('\\', '/', get_class($service)));
    }

    private function getServiceString($service){
        return "Service Name: $service<br>Deadline:$service->deadline<br>Cost:$service->cost<br>";
    }




}