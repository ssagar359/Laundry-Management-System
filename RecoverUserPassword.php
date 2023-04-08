<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Status</title>
    <style>
        body{
            background-color:#ddd;
        }
    </style>
</head>
<?php
$servername = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'laundry_db';
 
// Create connection
$conn = new mysqli($servername,
    $username, $password, $dbname);
 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: "
        . $conn->connect_error);
}

$username = $_REQUEST['email'];
$security_question = $_REQUEST['security_question'];
$security_answer = $_REQUEST['security_answer'];
$new_password = $_REQUEST['password'];

$sqlquery = "SELECT * FROM laundry_db.users WHERE email = '$username' and security_question = '$security_question' and security_answer = '$security_answer'";
$result = $conn->query($sqlquery);
if (mysqli_num_rows($result) > 0) {
    $pwdquery = "update laundry_db.users set password= '$new_password' WHERE email = '$username'";
    $conn->query($pwdquery);
    echo '<script language="javascript">';
    echo 'alert("Password changed successfully");';
    echo 'window.location = "Login.html";';
    echo '</script>';
} else {
    echo '<script language="javascript">';
    echo 'alert("Enter valid Security Question and Answer");';
    echo 'window.location = "RecoverUserPassword.html";';
    echo '</script>';
}

?>