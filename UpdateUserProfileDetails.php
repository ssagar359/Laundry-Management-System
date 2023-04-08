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
$security_question = $_REQUEST['security_question'];
$security_answer = $_REQUEST['security_answer'];

$sqlquery = "update laundry_db.users set full_name='$name', mobileno='$mobileno', security_question='$security_question', security_answer='$security_answer'
            where email = '$email'";

mysqli_query($conn,$sqlquery);
if (mysqli_affected_rows($conn) >0) {
    echo '<script language="javascript">';
    echo 'alert("Updated successful");';
    echo 'window.location = "EditUserProfileDetails.php";';
    echo '</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>