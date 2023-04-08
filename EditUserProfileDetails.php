<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style_Reg_Form.css">
    <title>Update User Profile</title>
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

$con=  mysqli_query($conn, "select * from laundry_db.users where email = '$username';");
$row=  mysqli_fetch_array($con);
$name = $row['full_name'];
?>
<body>
<p class="para">LMS || Update User Details</p>
    <div class="container">
        <form action="UpdateUserProfileDetails.php" name="myForm" method="POST">
            <div class="input_sec">
                <input type="text" placeholder="Full Name" value=<?php echo $name; ?>  name="name" required>
                <input tupe="email" placeholder="Email" name="email" value=<?php echo $row['email']; ?> readonly required>
                <input type="text" placeholder="Mobile Number" name="mobileno" value=<?php echo $row['mobileno']; ?> required>
                <select name="security_question" id="security_question" class = "security_question" style="width:95%;height:30px;margin:10px;">
                    <option value="Your pet name">Your pet name</option>
                    <option value="Your favourite book name">Your favourite book name</option>
                    <option value="Your Favourite place">Your Favourite place</option>
                </select>
                <input type="text" placeholder="Security Answer" name="security_answer" required>
            </div>
            <div id="btn">
                <input type="submit" value="Update">
            </div>
        </form>
    </div>
</body>
</html>