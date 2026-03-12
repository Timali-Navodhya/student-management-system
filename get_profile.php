<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'db.php';
include_once 'User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$user->id = isset($_GET['id']) ? $_GET['id'] : die();

if($user->readOne()){
    $user_arr = array(
        "id" => $user->id,
        "name" => $user->name,
        "email" => $user->email,
        "role" => $user->role
    );
    http_response_code(200);
    echo json_encode($user_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "User not found."));
}
?>