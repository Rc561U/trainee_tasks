<?php

$id =  $_GET['id'];

$test = new \Crud\Mvc\controllers\UserController();
$test = $test->delete($id);
header("Location: read");