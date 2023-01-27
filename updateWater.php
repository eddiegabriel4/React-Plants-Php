<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));

$id = $data->id;
$date = $data->date;

$con = mysqli_connect("us-cdbr-east-06.cleardb.net", "bc8c569b541e6e", "6035eb80");
mysqli_select_db($con, "heroku_fc1cb7b6edc651e");

$sql = "UPDATE actual_plants\n"
    . "SET date_last_watered = '$date'\n"
    . "WHERE id = '$id';";

$result = mysqli_query($con, $sql);

?>
