<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'C:\xampp\htdocs\LMS\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\LMS\PHPMailer\src\Exception.php';
require 'C:\xampp\htdocs\LMS\PHPMailer\src\SMTP.php';

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

$request_status = $_REQUEST['rquest_status'];
$request_no = $_REQUEST['request_no'];

//Get Laundry Details
$query = "select * from laundry_db.laundry_requests WHERE ID='$request_no'; ";
$con=  mysqli_query($conn, $query);
$row=  mysqli_fetch_array($con);
$original_status = $row['status'];
$request_user = $row['email'];

$sqlquery = "update laundry_db.laundry_requests set status='$request_status' where ID='$request_no'; ";

mysqli_query($conn,$sqlquery);
if (mysqli_affected_rows($conn) >0) {
   
    //Send Email
    $mail = new PHPMailer(true);

        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPSecure = false;
        $mail->SMTPAutoTLS = false;
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'salasagar81@gmail.com';                     //SMTP username
        $mail->Password   = 'avmjyczztzjqqdhu';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('salasagar81@gmail.com', 'Admin');
        $mail->addAddress($request_user, 'Sagar');    

        //Content
        #$mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Laundry status changed from $original_status to $request_status";
        $mail->Body    = "Laundry status changed from $original_status to $request_status";

        $mail->send();

        echo '<script language="javascript">';
        echo 'alert("Updated successful and sent mail to user");';
        echo 'window.location = "Dashborad.php";';
        echo '</script>';
} else {
    echo '<script language="javascript">';
        echo 'alert("Updated successful");';
        echo 'window.location = "Dashborad.php";';
        echo '</script>';
}
?>