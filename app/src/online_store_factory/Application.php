<?php

namespace Crud\Mvc\online_store_factory;

use Crud\Mvc\online_store_factory\core\products\ProductInterface;
use Crud\Mvc\online_store_factory\core\products\StaticProductFactory;

class Application extends Services
{

    protected array $userCart;
    protected array $catalog;
    protected string $productsPath;


    /**
     * @param $class
     * @param $values
     * @return void
     * @throws \Exception
     */
    public function addNewProduct($class, $values): void
    {
        $this->catalog[] = StaticProductFactory::build($class, $values);
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
     * @param $productId
     * @param null $serviceName
     * @return void
     */
    public function addProductInUserCart($productId, $serviceName = null): void
    {
        $product = $this->getProductById($productId, $this->catalog);
        $CloneProductToCart = clone $product;
        if (isset($serviceName) && $product) {
            foreach ($this->services as $service) {
                $class = $this->getClassBasename($service);
                if (ucfirst($class) === ucfirst($serviceName)) {
                    $CloneProductToCart->setService($service);
                    $this->userCart[] = $CloneProductToCart;
                }
            }
        } elseif ($this->getProductById($productId, $this->catalog)) {
            $this->userCart[] = $CloneProductToCart;
        }

    }

    private function getProductById(int $int, $arr): bool|ProductInterface
    {
        if (!array_key_exists($int - 1, $arr)) {
            return false;
        }
        return $arr[$int - 1];
    }

    /**
     * @param int $productId
     * @param string $service
     * @return void
     */
    public function addServiceToProduct(int $productId, string $service): void
    {
        $this->getIdProductError($productId, $this->userCart);
        $product = $this->getProductById($productId, $this->userCart);
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

    private function getIdProductError(int $int, $arr)
    {
        if (!$this->getProductById($int, $arr)) {
            die("Product or service is not exists");
        }
    }

    /**
     * @param int $int
     * @return void
     */
    public function showProduct(int $int): void
    {
        $product = $this->getProductById($int, $this->catalog);
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
}

