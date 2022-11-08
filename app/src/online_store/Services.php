<?php

namespace Crud\Mvc\online_store;

use Crud\Mvc\online_store\core\AbstractService;

class Services extends AbstractService
{

    public function __construct()
    {
        parent::__construct();
    }

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

}