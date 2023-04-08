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
session_start();
$username =  $_SESSION['username'];
$password =  $_REQUEST['password'];
$new_password = $_REQUEST['new_password'];

$sqlquery = "update laundry_db.users set password= '$new_password' WHERE email = '$username' and password='$password'";
mysqli_query($conn,$sqlquery);
if (mysqli_affected_rows($conn) >0) {
    echo '<script language="javascript">';
    echo 'alert("Password changed successfully");';
    echo 'window.location = "UserProfile.html";';
    echo '</script>';

} else {
    echo '<script language="javascript">';
    echo 'alert("Enter correct old password");';
    echo 'window.location = "UserChangePassword.html";';
    echo '</script>';
}

?>