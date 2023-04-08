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
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$mobileno = $_REQUEST['mobileno'];
$password = $_REQUEST['password']; 
$security_question = $_REQUEST['security_question'];
$security_answer = $_REQUEST['security_answer'];

$sqlquery = "INSERT INTO laundry_db.users 
            VALUES ('$name', '$email', '$mobileno', '$password', '$security_question', '$security_answer')";

if ($conn->query($sqlquery) === TRUE) {
    echo '<script language="javascript">';
    echo 'alert("Registration is successful");';
    echo 'window.location = "Login.html";';
    echo '</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>