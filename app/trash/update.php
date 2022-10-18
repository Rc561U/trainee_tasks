<?php

$id =  $_GET['id'];

$test = new \Crud\Mvc\controllers\UserController();
$test = $test->update($id);
print_r($test);