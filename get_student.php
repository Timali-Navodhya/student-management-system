<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'db.php';
include_once 'Student.php';

$database = new Database();
$db = $database->getConnection();
$student = new Student($db);

$student->id = isset($_GET['id']) ? $_GET['id'] : die();
$student->readOne();

if($student->full_name != null){
    
    // Lamayage photos tika ganna aluth query eka
    $image_query = "SELECT image_path FROM student_images WHERE student_id = ?";
    $img_stmt = $db->prepare($image_query);
    $img_stmt->bind_param("i", $student->id);
    $img_stmt->execute();
    $img_result = $img_stmt->get_result();
    
    $images = array();
    while($row = $img_result->fetch_assoc()) {
        array_push($images, $row['image_path']);
    }

    $student_arr = array(
        "id" =>  $student->id,
        "full_name" => $student->full_name,
        "email" => $student->email,
        "phone" => $student->phone,
        "address" => $student->address,
        "images" => $images // Photos array eka JSON ekata ekathu kara
    );
    http_response_code(200);
    echo json_encode($student_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Student not found."));
}
?>