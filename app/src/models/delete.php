<?php

$db = require_once "../models/database.connect.php";

$str_json = file_get_contents('php://input'); //($_POST doesn't work here)
$response = json_decode($str_json, true);


$user_id =$response['user_id'];
if (isset($user_id)){
    $sql = 'DELETE FROM users WHERE user_id = :user_id';

    $statement = $db->prepare($sql);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);


    if ($statement->execute()) {
        header("Location: read.php?success=successfully deleted");
        echo "user $user_id was successfully deleted";
//        echo json_encode(["status" => "User seccessfully deleted"]);
    }
    else
    {
        echo json_encode(["status" => "User has not been deleted"]);
    }

}else{
    echo "some error";
}