<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'db.php';
include_once 'Student.php';

$database = new Database();
$db = $database->getConnection();
$student = new Student($db);

// Search word eka saha page eka gannawa
$search_keyword = isset($_GET['search']) ? $_GET['search'] : "";
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Eka pitakata pennana gaana (5k damu balanna lesi nisa)
$records_per_page = 5;
$offset = ($records_per_page * $page) - $records_per_page;

$result = $student->read($search_keyword, $offset, $records_per_page);
$total_rows = $student->countAll($search_keyword);

$students_arr = array();
$students_arr["records"] = array();
$students_arr["paging"] = array();

if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
        array_push($students_arr["records"], $row);
    }
}

// Pagination array eka hadima
$total_pages = ceil($total_rows / $records_per_page);
$students_arr["paging"] = array(
    "total_records" => $total_rows,
    "total_pages" => $total_pages,
    "current_page" => $page
);

http_response_code(200);
echo json_encode($students_arr);
?>