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

if(!empty($data->id)) {
    $student->id = $data->id;
    
    if($student->delete()){
        http_response_code(200);
        echo json_encode(array("message" => "Student deleted successfully.", "status" => "success"));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete student.", "status" => "error"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Incomplete data. Student ID is missing.", "status" => "error"));
}
?>