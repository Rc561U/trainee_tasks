<?php

require 'vendor/autoload.php';

use Crud\Mvc\online_store\Application;
use Crud\Mvc\online_store\products\CellPhone;
use Crud\Mvc\online_store\products\Fridge;
use Crud\Mvc\online_store\products\Laptop;
use Crud\Mvc\online_store\products\Tv;

$product1 = new CellPhone('nokia', 'finland', '20/04/2022', 500);
$product2 = new CellPhone('samsung', 'south korea', '01/05/2021', 1000);
$product3 = new Fridge('Aston', 'Germany', '31/01/2024', 5000);
$product4 = new Fridge('LG', 'South korea', '01/05/2022', 3210);
$product5 = new Laptop('HP', 'China', '13/01/2022', 3200);
$product6 = new Laptop('Acer', 'China', '02/01/2022', 2900);
$product7 = new Tv('Samsung', 'South korea', '02/01/2022', 3333);
$product8 = new Tv('LG', 'South korea', '18/09/2012', 4433);

$app = new Application();

$app->addNewProduct($product1);
$app->addNewProduct($product2);
$app->addNewProduct($product3);
$app->addNewProduct($product4);
$app->addNewProduct($product5);
$app->addNewProduct($product6);
$app->addNewProduct($product7);
$app->addNewProduct($product8);

$app->setConfiguration("12/02/2023", 320);
$app->setDelivery("21/04/2023", 123);
$app->setWarranty("11/12/2025", 400);
$app->setInstallation("15/01/2022", 1200);

//// show catalog
$app->showCatalog();

//// show available services
$app->showAllServices();

//// add product into user cart
$app->addProductInUserCart($product1); // add product without service and advise to select appropriate service
$app->addProductInUserCart($product4, "Delivery");
$app->addServiceToProduct($product4, "Warranty");


//// show user cart
$app->showUserCart();

//// show if the service exists
//$app->showService("Warranty");

//// show any product
//echo $product3;
