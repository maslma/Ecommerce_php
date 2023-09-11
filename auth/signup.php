<?php

include "../connect.php";

$username = filterRequest("username");
$phone = filterRequest("phone");
$email = filterRequest("email");
$password = sha1($_POST["password"]);
$verfiycode = rand(10000 , 99999);

$stmt = $con->prepare("SELECT * FROM users WHERE  users_phone = ? OR users_email = ? ");
$stmt->execute(array($email, $phone));
$count = $stmt->rowCount();
if ($count > 0) {
    printFailure("PHONE OR EMAIL");
} else {

    $data = array(
        "users_name" => $username,
        "users_phone" =>  $phone,
        "users_email" => $email,
        "users_password" => $password,
        "users_verifycode" =>$verfiycode ,
    );
    sendEmail($email , "Verfiy Code Ecommerce" , "Verfiy Code $verfiycode") ; 
    insertData("users" , $data) ; 
}