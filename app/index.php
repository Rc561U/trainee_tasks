<?php

require 'vendor/autoload.php';

use Crud\Mvc\online_store_factory\Application;

$app = new Application();

$app->setServicesPath("Crud\Mvc\online_store_factory\services\\");
$app->setProductsPath("Crud\Mvc\online_store_factory\products\\");

$app->addNewProduct('CellPhone', ['nokia', 'finland', '20/04/2022', 500]);
$app->addNewProduct('CellPhone', ['samsung', 'south korea', '01/05/2021', 1000]);
$app->addNewProduct('Fridge', ['Aston', 'Germany', '31/01/2024', 5000]);
$app->addNewProduct('Fridge', ['LG', 'South korea', '01/05/2022', 3210]);
$app->addNewProduct('Laptop', ['HP', 'China', '13/01/2022', 3200]);
$app->addNewProduct('Laptop', ['Acer', 'China', '02/01/2022', 2900]);
$app->addNewProduct('Tv', ['Samsung', 'South korea', '02/01/2022', 3333]);
$app->addNewProduct('Tv', ['LG', 'South korea', '18/09/2012', 4433]);


$app->addService("Configuration", ["12/02/2023", 320]);
$app->addService("Delivery", ["12/02/2023", 320]);
$app->addService("Warranty", ["12/02/2023", 320]);
$app->addService("Installation", ["12/02/2023", 320]);

////// show catalog
$app->showCatalog();

////// show available services
$app->showAllServices();

////// add products into user cart
$app->addProductInUserCart(1); // add products without service and advise to select appropriate service
$app->addProductInUserCart(2);

$app->showProduct(2);

//// add service to existed product
$app->addServiceToProduct(1, "Configuration");
$app->addServiceToProduct(2, "Warranty");

////// show user cart
$app->showUserCart();
//
////// show if the service exists
$app->showService("Warranty");
//// show info about product

$app->showCatalog();
