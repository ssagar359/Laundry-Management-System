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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
session_start();
// particular user
$username =  $_SESSION['username'];

$date = $_REQUEST['date'];
$top_wear_type = $_REQUEST['top_wear_type'];
$bottom_wear_type = $_REQUEST['bottom_wear_type'];
$cloth_type = $_REQUEST['cloth_type']; 
$other = $_REQUEST['other'];
$service_type = $_REQUEST['service_type'];
$contact_person = $_REQUEST['contact_person'];
$description = $_REQUEST['description'];

$sqlquery = "INSERT INTO laundry_db.laundry_requests(date, top_wear_type, bottom_wear_type, cloth_type, other,
            service_type, contact_person, description, email) 
            VALUES ('$date', '$top_wear_type', '$bottom_wear_type', '$cloth_type', '$other', '$service_type',
            '$contact_person', '$description', '$username')";


if ($conn->query($sqlquery) === TRUE) {
    echo '<script language="javascript">';
    echo 'alert("Request submitted successfully");';
    echo 'window.location = "Launadry_Request.php";';
    echo '</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>