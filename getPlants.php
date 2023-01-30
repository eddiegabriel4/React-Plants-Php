<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//secure tokens would go here, sorry you can't see it :(

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

