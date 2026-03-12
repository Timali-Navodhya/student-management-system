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

if(!empty($data->email) && !empty($data->password)){
    $user->email = $data->email;
    $user->password = $data->password;

    if($user->login()){
        $user_arr = array(
            "status" => "success",
            "message" => "Successful login.",
            "id" => $user->id,
            "name" => $user->name,
            "role" => $user->role
        );
        http_response_code(200);
        echo json_encode($user_arr);
    } else {
        http_response_code(401);
        echo json_encode(array("message" => "Login failed. Incorrect email or password.", "status" => "error"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Incomplete data.", "status" => "error"));
}
?>