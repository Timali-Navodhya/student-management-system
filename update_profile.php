<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once 'db.php';
include_once 'User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->id) && !empty($data->name) && !empty($data->email)){
    $user->id = $data->id;
    $user->name = $data->name;
    $user->email = $data->email;
    $user->password = !empty($data->password) ? $data->password : ""; 

    if($user->update()){
        http_response_code(200);
        echo json_encode(array("message" => "Profile updated successfully.", "status" => "success"));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update profile.", "status" => "error"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Incomplete data.", "status" => "error"));
}
?>