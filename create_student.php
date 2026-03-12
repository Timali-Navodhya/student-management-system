<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

include_once 'db.php';
include_once 'Student.php';

$database = new Database();
$db = $database->getConnection();
$student = new Student($db);

if(!empty($_POST['full_name']) && !empty($_POST['email'])){
    
    $student->full_name = $_POST['full_name'];
    $student->email = $_POST['email'];
    $student->phone = $_POST['phone'];
    $student->address = $_POST['address'];

    $student_id = $student->create(); 

    if($student_id){
        // isset() eka damme photo nathuwa save karaddi ena warning eka nawaththanna
        if(isset($_FILES['images']) && !empty($_FILES['images']['name'][0])){
            $upload_dir = "uploads/";
            
            foreach($_FILES['images']['name'] as $key => $val){
                $filename = basename($_FILES['images']['name'][$key]);
                $target_filepath = $upload_dir . time() . "_" . $filename; 
                
                if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], $target_filepath)){
                    $query = "INSERT INTO student_images (student_id, image_path) VALUES (?, ?)";
                    $stmt = $db->prepare($query);
                    $stmt->bind_param("is", $student_id, $target_filepath);
                    $stmt->execute();
                }
            }
        }
        http_response_code(201);
        echo json_encode(array("message" => "Student saved successfully.", "status" => "success"));
    } else {
        http_response_code(503);
        // Duplicate email aawoth kiyanna
        echo json_encode(array("message" => "Unable to save. The Email Address might already exist.", "status" => "error"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Incomplete data. Name and Email are required.", "status" => "error"));
}
?>