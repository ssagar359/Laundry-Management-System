<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style_Dashbord.css">
    <title>Dashbord</title>
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

$query = "SELECT SUM(CASE WHEN status = 'New' THEN 1 ELSE 0 END) AS New,
SUM(CASE WHEN status = 'Accept' THEN 1 ELSE 0 END) AS Accept,
SUM(CASE WHEN status = 'InProcess' THEN 1 ELSE 0 END) AS InProcess,
SUM(CASE WHEN status = 'Finish' THEN 1 ELSE 0 END) AS Finish
FROM laundry_db.laundry_requests ";

if($username != "admin@gmail.com"){
    $query = $query."where email= '$username' ;";
}

$con=  mysqli_query($conn, $query);
$row=  mysqli_fetch_array($con);
$new_requests = $row['New'];
$accept_requests = $row['Accept'];
$inprocess_requests = $row['InProcess'];
$finish_requests = $row['Finish'];
?>
<body>
    <div id="head">
        <p><span style="color:#33b5e5;">Dashbord</span>/Overview</p>
    </div>
    <section>
        <div class="flex">
            <div class="box" id="box-1">
                <div><?php echo $new_requests; ?> New Request</div>
                <hr/>
                <div>
                    <a href="ViewLaundaryStatusDetails.php?status=New">View details ></a>
                </div>
            </div>
            <div class="box" id="box-2"> 
                <div><?php echo $accept_requests; ?> Accept</div>
                <hr/>
                <div>
                    <a href="ViewLaundaryStatusDetails.php?status=Accept">View details ></a>
                </div>
            </div>
            <div class="box" id="box-3">
                <div><?php echo $inprocess_requests; ?> InProcess</div>
                <hr/>
                <div>
                    <a href="ViewLaundaryStatusDetails.php?status=InProcess">View details ></a>
                </div>
            </div>
            <div class="box" id="box-4">
                <div><?php echo $finish_requests; ?> Finished</div>
                <hr/>
                <div>
                    <a href="ViewLaundaryStatusDetails.php?status=Finish">View details ></a>
                </div>
            </div>
        </div>
    </section>
    <div class="price">
        <h1>Laundry Price (Per Unit)</h1>
    </div>
    <section class="table_sec">
        <table border="1" cellspacing="10" cellpadding="0" align="center">
            <tr>
                <td  class="bold">Top Wear Laundry Price</td>
                <td>12</td>
            </tr>
            <tr>
                <td class="bold">Bootom Wear Laundry Price</td>
                <td>22</td>
            </tr>
            <tr>
                <td class="bold">Woolen cloth Laundry Price</td>
                <td>20</td>
            </tr>
            <tr>
                <td class="bold">Other</td>
                <td>Other Price Depend upon cloth variety (Other then three category )</td>
            </tr>
        </table>
    </section>
</body>
</html>