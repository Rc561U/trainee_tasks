<?php

namespace Crud\Mvc\online_store_builder\core\product;


use Crud\Mvc\online_store_builder\core\service\ServiceInterface;

abstract class AbstractProduct
{

    protected array $services;

    /**
     * @return int
     */
    public function getServicesCost(): int
    {
        $servicesCost = 0;
        foreach ($this->services as $service){
            $servicesCost += $service->getCost();
        }
        return $servicesCost;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $className = explode("\\",get_class($this));
        $className = end($className);
        if (isset($this->services)){
            $services = implode(', ', $this->services);
        }else{
            $services = "Not defined";
        }
        return "Product type: $className<br>
                Product name: $this->name<br>
                Manufactured: $this->manufactures<br>
                Release: $this->release<br>
                Cost: $this->cost$<br>
                Services: $services<br>";
    }



}
