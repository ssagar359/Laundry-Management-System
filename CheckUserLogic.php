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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
session_start(); 
$email = $_REQUEST['email'];
$password = $_REQUEST['password']; 
$_SESSION['username'] =  $_REQUEST['email'];

$sqlquery = "SELECT * FROM laundry_db.users WHERE Email = '$email' and Password = '$password'";
$result = $conn->query($sqlquery);

if ($result->num_rows > 0) {
    echo '<script language="javascript">';
    echo 'alert("Login Successful");';
    echo 'window.location = "Layout.php";';
    echo '</script>';
    #header("Location:Layout.html");
} else {
    echo '<script language="javascript">';
    echo 'alert("Entered Invalid Email or Password");';
    echo 'window.location = "Login.html";';
    echo '</script>';
    #header("Location:Login.html");
}
}
?>