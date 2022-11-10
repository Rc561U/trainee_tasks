<?php

namespace Crud\Mvc\online_store_factory;

use Crud\Mvc\online_store_factory\core\products\ProductInterface;

class Application extends Services
{

    protected array $userCart;
    protected array $catalog;
    protected string $productsPath;


    /**
     * @param $class
     * @param $values
     * @return void
     */
    public function addNewProduct($class, $values)
    {
        $path = $this->productsPath;
        if (class_exists($path . $class)) {
            $class = $path . $class;
            $this->catalog[] = new $class($values);
        } else {
            echo "Class $class is  not exist";
        }
    }

    /**
     * @return void
     */
    public function showCatalog(): void
    {
        if (!isset($this->catalog)) {
            die("Catalog is empty!");
        }
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
     * @param $productId
     * @param null $serviceName
     * @return void
     */
    public function addProductInUserCart($productId, $serviceName = null)
    {
        if (isset($serviceName) && $this->getProduct($productId)) {
            foreach ($this->services as $service) {
                $class = explode('\\', get_class($service)); ///// replace
                $class = end($class);
                if (ucfirst($class) === ucfirst($serviceName)) {
                    $product = $this->getProduct($productId);
                    $product->setService($service);
                    $this->userCart[] = $product;
                }
            }
        } elseif ($this->getProduct($productId)) {
            $this->userCart[] = $this->getProduct($productId);
        } else {
            die("Product or service not found!");
        }

    }



    /**
     * @param int $productId
     * @param string $service
     * @return void
     */
    public function addServiceToProduct(int $productId, string $service): void
    {
        $product = $this->getProduct($productId);
        $productServices = $product->getService();
        $path = $this->servicesPath;
        $definedServices = $this->services;

        if (class_exists($path . $service)) {
            foreach ($definedServices as $definedService) {
                $definedServiceName = $definedService->getServiceName();
                if (!in_array($definedService, $productServices) && $definedServiceName === $service) {
                    $product->setService($definedService);
                }
            }
        }
    }


    /**
     * @param int $int
     * @return void
     */
    public function showProduct(int $int): void
    {
        $product = $this->getProduct($int);
        echo "<h1>Product:</h1><br>";
        if ($product) {
            echo $product;
        } else {
            echo "Product not found";
        }
    }

    /**
     * @param $path
     * @return void
     */
    public function setServicesPath($path): void
    {
        $this->servicesPath = $path;
    }

    /**
     * @param $path
     * @return void
     */
    public function setProductsPath($path): void
    {
        $this->productsPath = $path;
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
     * @param int $int
     * @return string|ProductInterface
     */
    private function getProduct(int $int): string|ProductInterface
    {
        if (!array_key_exists($int - 1, $this->catalog)) {
            return false;
        }
        return $this->catalog[$int - 1];
    }
}

