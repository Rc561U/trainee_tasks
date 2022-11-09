<?php

require 'vendor/autoload.php';

use Crud\Mvc\online_store_builder\Application;


$app = new Application();

$app->addNewProduct("Laptop", ['HP', 'China', '13/01/2022', 3200]);
$app->addNewProduct("Tv", ['LG', 'South korea', '18/09/2012', 4433]);
$app->addNewProduct("Fridge", ['Aston', 'Germany', '31/01/2024', 5000]);
$app->addNewProduct("CellPhone", ['samsung', 'south korea', '01/05/2021', 1000]);

$app->addNewService("Delivery", ["12/02/2023", 123]);
$app->addNewService("Warranty", ["12/02/2023", 3230]);
$app->addNewService("Installation", ["12/02/2023", 430]);
$app->addNewService("Configuration", ["12/02/2023", 987]);


////// show catalog
//$app->showCatalog();

////// show available services
//$app->showAllServices();
//echo $app->showProduct(4);
////// add product into user cart
$app->addProductInUserCart($app->showProduct(4)); // add product without service and advise to select appropriate service
$app->addProductInUserCart($app->showProduct(2)); // add product without service and advise to select appropriate service
//$app->addProductInUserCart($product4, "Delivery");
//$app->addServiceToProduct($product4, "Warranty");
//
//
////// show user cart
$app->showUserCart();

//// show if the service exists
//$app->showService("Warranty");

//// show any product
//echo $product3;
