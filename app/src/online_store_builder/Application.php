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
        list($name,$manufactures,$release,$cost) = $value;
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
            print_r( $product);
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

    public function showProduct(int $int): string | ProductInterface
    {
        if (!array_key_exists($int-1,$this->catalog))
        {
            return "Product not found";
        }
            return $this->catalog[$int-1];
    }



}
