<?php

$db = require_once "../models/DbConnect.php";

$str_json = file_get_contents('php://input'); //($_POST doesn't work here)
$response = json_decode($str_json, true);

$email = $response['email'];
$id= $response['user_id'];
$result = ['status' => "ok"];

//$email = "localhost123@mail.net";
//$id = 101;


function checkEmail($email, $db)
{
    $query = $db->prepare("SELECT `email` FROM `users` WHERE `email` = ?");
    $query->bindValue(1, $email);
    $query->execute();
    global $result;

    if ($query->rowCount() > 0) {
        $result["available"] = false;
    } else {
        $result["available"] = true;
    }
}
function getEmail($id, $db)
{
    $query = $db->prepare("SELECT `email` FROM `users` WHERE `user_id` = ?");
    $query->bindValue(1, $id);
    $query->execute();
    return $query->fetch(\PDO::FETCH_ASSOC)['email'];
}


if ($email === getEmail($id, $db)) {
    $result["available"] = true;
    echo json_encode($result);
} else {
    checkEmail($email, $db);
    echo json_encode($result);
}