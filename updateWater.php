<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));

$id = $data->id;
$date = $data->date;



$sql = "UPDATE actual_plants\n"
    . "SET date_last_watered = '$date'\n"
    . "WHERE id = '$id';";

$result = mysqli_query($con, $sql);

?>
