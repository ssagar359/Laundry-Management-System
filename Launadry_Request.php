<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style_Laundry_req.css">
    <title>Laundry Request</title>
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

$con=  mysqli_query($conn, "select mobileno from laundry_db.users where email = '$username';");
$row=  mysqli_fetch_array($con);
?>
<body>
    <div id="head">
        <p><span style="color:#33b5e5;">Dashbord</span>/Overview</p>
    </div>
    <div class="container">
        <form action="GatherLaundryData.php" name="myform" method="GET">
            <input type="date" name="date" required>&nbsp;
            <input type="text"  name="top_wear_type" placeholder="Topwear(Tshirt,Top,Shirt)" required>
            <br>
            <input type="text" name="bottom_wear_type" style="width:1051px;" placeholder="Bottomwear(Lower,Jeans,Leggins)" required>
            <br>
            <input type="text" name="cloth_type" style="width:1051px;" placeholder="Woolen Cloth" required>
            <br>
            <input type="text" name="other" style="width:1051px;" placeholder="Other">
            <br>
            <select name="service_type" style="width:1051px;" id="Laundry_Ser">
                <option value="Dry cleaning services">Dry cleaning services </option>
                <option value="Fluff and fold laundry services">Fluff and fold laundry services</option>
                <option value="Commercial laundry services">Commercial laundry services</option>
                <option value="Pickup laundry services">Pickup laundry services</option>
            </select>
            <br>
            <input type="text" name="contact_person" value=<?php echo $row['mobileno']; ?> style="width:1051px;" placeholder="Contact Person" required>
            <br>
            <input type="text" name="description"  style="width:1051px;" placeholder="Description(if any)">
            <input type="submit"  style="width:1051px;" Value="Submit" class="Sub">
        </form>
    </div>
</body>
</html>