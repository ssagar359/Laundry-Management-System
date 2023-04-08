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
$query = "select * from laundry_db.laundry_requests ";
if($username != "admin@gmail.com"){
    $query = $query."where email = '$username';";
}

$con=  mysqli_query($conn, $query);
?>
<body>
<table border="1" style="border-collapse:collapse" width="100%">
            <tr><th colspan=8 style="text-align: center; vertical-align: middle; font-weight:bold">
            Request Details:</th></tr>
            <tr><th> Request Date</th>
                    <th>Topwear</th>
                    <th>Bottom Wear</th>
                     <th>Cloth Type</th>
                    <th>Other</th>
                    <th>Service Type</th>
                    <th>Contact Person</th>
                    <th>Description</th>
                    <th>Status</th>
            </tr>
            <?php
                while($row=  mysqli_fetch_array($con))
                {
            ?>
            <tr>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['top_wear_type']; ?></td>
                <td><?php echo $row['bottom_wear_type']; ?></td>
                <td><?php echo $row['cloth_type'] ;?></td>
                <td><?php echo $row['other'] ;?></td>
                <td><?php echo $row['service_type'] ;?></td>
                <td><?php echo $row['contact_person'] ;?></td>
                <td><?php echo $row['description'] ;?></td>
                <td><?php echo $row['status'] ;?></td>
            </tr>
            <?php }?>
</table>         
</body>
</html>