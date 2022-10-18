<?php

$db = require_once "database.connect.php";

$email = $_POST['email'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$status = $_POST['status'];

if (isset($email) && isset($name) && isset($gender) && isset($status)) {
    $query = $db->prepare("INSERT INTO  `test`.`users` (`email`,`full_name`,`gender`,`status`) VALUES (:email, :full_name, :gender, :status)");
    $query->execute([
        'email' => $email,
        'full_name' => $name,
        'gender' => $gender,
        'status' => $status,
    ]);
    if( $query->rowCount() > 0 ) {
        echo json_encode(["status" => "New user seccessfully created"]);
    }
    else {
        echo json_encode(["status" => "Something went wrong"]);
    }
}

