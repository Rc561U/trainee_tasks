<?php

namespace Crud\Mvc\online_store;

use Crud\Mvc\online_store\core\ProductInterface;

class Application extends Services
{

    /**
     * @var array
     */
    protected array $userCart;
    /**
     * @var array
     */
    protected array $catalog;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param ProductInterface $product
     * @return void
     */
    public function addNewProduct(ProductInterface $product): void
    {
        $this->catalog[] = $product;
    }

    /**
     * @return void
     */
    public function showCatalog(): void
    {

        echo "<h1>Catalog:<br></h1>";
        $i = 0;
        foreach ($this->catalog as $product) {
            $i++;
            echo "<hr>Product number: $i<br>";
            echo $product;
            echo "<br>";
        }
    }

    /**
     * @return void
     */
    public function showUserCart(): void
    {
        echo "<h1>Cart:<br></h1>";
        if (!empty($this->userCart)) {
            foreach ($this->userCart as $product) {
                echo $product . "<br>";
            }
            echo "Total cart cost is " . $this->totalUserCartCost();
        } else {
            echo "Your cart is empty!";
        }
    }

    /**
     * @param ProductInterface $product
     * @param $service
     * @return void
     */
    public function addProductInUserCart(ProductInterface $product, $service = null): void
    {

        if (isset($service)) {
            switch ($service) {
                case "Configuration":
                    $product->setService($this->configuration);
                    break;
                case "Delivery" :
                    $product->setService($this->delivery);
                    break;
                case "Installation":
                    $product->setService($this->installation);
                    break;
                case "Warranty":
                    $product->setService($this->warranty);
                    break;
            }
//            echo 'New item successfully added into your cart!<br>';
        } else {
            echo "The following services are available to you: " . implode(", ", $this->services);
        }
        $this->userCart[] = $product;
    }

    /**
     * @return int
     */
    private function totalUserCartCost(): int
    {
        $cost = 0;
        foreach ($this->userCart as $product) {
            $cost += $product->getCost();
            $cost += $product->getServicesCost();
        }
        return $cost;
    }

    /**
     * @param $service
     * @return void
     */
    public function showService($service): void
    {
        $name = ucfirst($service);
        if (in_array($name, $this->services) && isset($this->userCart)) {
            $service = trim(strtolower($service));
            echo "Service - " . ucfirst($service) . "<br>";
            echo "Deadline: " . $this->$service->getDeadline() . "<br>";
            echo "Cost: " . $this->$service->getCost() . "<br>";
        } else {
            echo "Service '$service' is not exists or your cart is empty!";
        }
    }

    /**
     * @param ProductInterface $product
     * @param $service
     * @return void
     */
    public function addServiceToProduct(ProductInterface $product, $service):void
    {
        $service = ucfirst($service);
        $serviceLow = trim(strtolower($service));
        if (in_array($service, $this->services) && in_array($product,$this->userCart)){
            $product->setService($this->$serviceLow);
        }else{
            echo "<br>The service or product does not exist!";
        }
    }
}
