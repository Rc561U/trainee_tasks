<?php

namespace Crud\Mvc\online_store_builder;

use Crud\Mvc\online_store_builder\core\product\ProductBuilder;
use Crud\Mvc\online_store_builder\core\product\ProductInterface;

class Application extends Services
{

    protected array $userCart;
    protected array $catalog;

    /**
     * @param string $class
     * @param array $value
     * @return void
     */
    public function addNewProduct(string $class, array $value): void
    {
        list($name, $manufactures, $release, $cost) = $value;
        $builder = new ProductBuilder($class);
        $product = $builder->setName($name)
            ->setManufactures($manufactures)
            ->setReleaseDate($release)
            ->setCost($cost)
            ->getProduct();
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
            print_r($product);
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
            echo "Total cart cost is " . $this->totalUserCartCost()."$";
        } else {
            echo "Your cart is empty!";
        }
    }



    public function addProductInUserCart($productId, $serviceName = null)
    {
        if (isset($serviceName) && $this->getProduct($productId)) {
            foreach ($this->services as $service) {
                $class = explode('\\', get_class($service));
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

    public function getProduct(int $int): string|ProductInterface
    {
        if (!array_key_exists($int - 1, $this->catalog)) {
            return false;
        }
        return $this->catalog[$int - 1];
    }

    /**
     * @param ProductInterface $product
     * @param $service
     * @return void
     */
    public function addServiceToProduct(ProductInterface $product, $service): void
    {
        $service = ucfirst($service);
        $serviceLow = trim(strtolower($service));
        if (in_array($service, $this->services) && in_array($product, $this->userCart)) {
            $product->setService($this->$serviceLow);
        } else {
            echo "<br>The service or product does not exist!";
        }
    }


}
