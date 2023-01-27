<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$con = mysqli_connect("us-cdbr-east-06.cleardb.net", "bc8c569b541e6e", "6035eb80");
mysqli_select_db($con, "heroku_fc1cb7b6edc651e");

$data = json_decode(file_get_contents("php://input"));

$user_id = $data->user_id;

$sqli = "SELECT ap.*\n"

    . "FROM actual_plants ap\n"

    . "JOIN UserPlants up ON ap.id = up.PlantID\n"

    . "JOIN users u ON up.UserID = u.id\n"

    . "WHERE u.id = '$user_id';";


$result = mysqli_query($con, $sqli);

$rows = resultToArray($result);

echo json_encode($rows);


function resultToArray($result) {
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}


?>

