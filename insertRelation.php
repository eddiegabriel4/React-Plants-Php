<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
header("HTTP/1.1 200 OK");
die();
}

$data = json_decode(file_get_contents("php://input"));

$user_id = $data->user_id;
$plant_id = $data->plant_id;

$con = mysqli_connect("us-cdbr-east-06.cleardb.net", "bc8c569b541e6e", "6035eb80");
mysqli_select_db($con, "heroku_fc1cb7b6edc651e");


$sql = "insert into userplants(
        UserID,
        PlantID
        )
        
        values(
        '$user_id',
        '$plant_id'
        )";

        $result = mysqli_query($con, $sql);

?>
