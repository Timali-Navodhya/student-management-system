<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once 'db.php';
include_once 'Student.php';

$database = new Database();
$db = $database->getConnection();
$student = new Student($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->id) && !empty($data->full_name) && !empty($data->email)) {
    $student->id = $data->id;
    $student->full_name = $data->full_name;
    $student->email = $data->email;
    $student->phone = $data->phone;
    $student->address = $data->address;

    if($student->update()){
        http_response_code(200);
        echo json_encode(array("message" => "Student updated successfully.", "status" => "success"));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update student.", "status" => "error"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Incomplete data.", "status" => "error"));
}
?>