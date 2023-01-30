<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



$data = json_decode(file_get_contents("php://input"));

$email = $data->email;
$password = $data->password;

if ($email && $password) {
    if (userExists($email, $con)) {
        $compare_hash = password_hash($password, PASSWORD_DEFAULT);
        $sqli = "SELECT * FROM users WHERE email ='$email'";
        $result = mysqli_query($con, $sqli);
        
        $rs = mysqli_fetch_array($result);
        
        $check = $rs["password"];
        
        if(password_verify($password, $check)) {
            $outp = "";
            $outp .= '{"user_id":"' . $rs["id"] . '",';
            $outp .= '"email":"' . $rs["email"] . '",';
            $outp .= '"first_name":"' . $rs["first_name"] . '",';
            $outp .= '"last_name":"' . $rs["last_name"] . '",';
            $outp .= '"Status":"' . "GOOD" . '"}';
            echo $outp;
        }
        else {
            $response = array(
            'status'=>'wrong password');
            echo json_encode($response);
        }
        
        
        
    }
    
    
    else {
        $response = array(
        'status'=>'no user found');
        echo json_encode($response);
    }
}




function userExists($email, $con) {
    $sql = "SELECT email FROM users WHERE email ='$email'" ;

       $result = mysqli_query($con, $sql) ;
       if( mysqli_num_rows( $result ) > 0 )
       {
            return true;
       }
       return false;
}


?>

