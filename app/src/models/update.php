<?php

$db = require_once "database.connect.php";
$email = $_POST['email'];
$full_name = $_POST['name'];
$gender = $_POST['gender'];
$status = $_POST['status'];
$id = $_POST['id'];

if (isset($email) && isset($full_name) && isset($gender) && isset($status)) {
    $query = $db->prepare("UPDATE users SET email = :email, full_name = :full_name, gender = :gender, status = :status WHERE user_id = :user_id ");
    $query->execute([
        'email' => $email,
        'full_name' => $full_name,
        'gender' => $gender,
        'status' => $status,
        'user_id' => $id,
    ]);
    header("Location: ../view/read.php?success=successfully updated");
//    echo 'user data successfully updated';
} else {
    echo 'user data was not update';
}
