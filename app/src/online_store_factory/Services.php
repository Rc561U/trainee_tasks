<?php

namespace Crud\Mvc\online_store_factory;

class Services
{
    protected string $servicesPath;


    /**
     * @return void
     */
    public function showAllServices(): void
    {
        if (!isset($this->services)) {
            die("Services catalog is empty!");
        }
        echo "<h1>Available services:</h1><br>";
        $i = 0;
        foreach ($this->services as $service) {
            $i++;
            echo "$i. $service<br>Deadline:$service->deadline<br>Cost:$service->cost<br>";
            echo "<br>";
        }
    }

    /**
     * @param $service
     * @param $values
     * @return void
     */
    public function addService($service, $values): void
    {
        $path = "Crud\Mvc\online_store_factory\services\\";
        if (class_exists($path . $service)) {
            $class = $path . $service;
            $this->services[] = new $class($values);
        } else {
            echo "Service is  not exist!";
        }

    }

    /**
     * @param $service
     * @return void
     */
    public function showService($service): void
    {

        if (in_array($service, $this->services)) {
            foreach ($this->services as $savedServices) {
                if ($service == $this->getClassBasename($savedServices)) {
                    echo $this->getServiceString($savedServices);
                }
            }
        } else {
            echo "Service not found";
        }
    }

    /**
     * @param $service
     * @return string
     */
    protected function getClassBasename($service): string
    {
        return basename(str_replace('\\', '/', get_class($service)));
    }

    /**
     * @param $service
     * @return string
     */
    private function getServiceString($service): string
    {
        return "<br><h1>Service</h1><br>Service Name: $service<br>Deadline:$service->deadline<br>Cost:$service->cost<br>";
    }
}