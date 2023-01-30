<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: access");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));

$first_name = $data->first_name;
$last_name = $data->last_name;
$email = $data->email;
$password = $data->password;

//secure tokens would go here, sorry you can't see it :(

if ($first_name && $last_name && $email && $password) {
    if (EmailIsAvailable($email, $con)) {
        
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "insert into users(
        first_name,
        last_name,
        email,
        password
    )
    values(
        '$first_name',
        '$last_name',
        '$email',
        '$hashed_password'
    )";

    $result = mysqli_query($con, $sql);

    if($result){
        $response = array(
        'status'=>'valid'
        );
        echo json_encode($response);
    }
    else{
        $response = array(
        'status'=>'invalid'
        );
        echo json_encode($response);
    }
}
    else {
        $response = array(
        'status'=>'email taken'
        );
        echo json_encode($response);
    }
}


function FirstNameIsAvailable($first_name, $con) {
    $sql = "SELECT first_name FROM users WHERE first_name ='$first_name'" ;

       $result = mysqli_query($con, $sql) ;
       if( mysqli_num_rows( $result ) > 0 )
       {
            return false;
       }
       return true;
}

function LastNameIsAvailable($last_name, $con) {
    $sql = "SELECT last_name FROM users WHERE last_name ='$last_name'" ;

       $result = mysqli_query($con, $sql) ;
       if( mysqli_num_rows( $result ) > 0 )
       {
            return false;
       }
       return true;
}

function EmailIsAvailable($email, $con) {
    $sql = "SELECT email FROM users WHERE email ='$email'" ;

       $result = mysqli_query($con, $sql) ;
       if( mysqli_num_rows( $result ) > 0 )
       {
            return false;
       }
       return true;
}

?>

