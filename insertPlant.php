<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));

$common_name = $data->common_name;
$scientific_name = $data->scientific_name;
$family = $data->family;
$img_url = $data->img_url;
$date = $data->date;

$con = mysqli_connect("localhost:3306", "root", "");
mysqli_select_db($con, "plants");


$sql = "insert into actual_plants(
        common_name,
        scientific_name,
        plant_family,
        img_url,
        date_last_watered
        )
        
        values(
        '$common_name',
        '$scientific_name',
        '$family',
        '$img_url',
        '$date'
        )";

        $result = mysqli_query($con, $sql);

        if ($result) {
            $id = mysqli_insert_id($con);
            echo json_encode($id);
        }

?>
