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
        * {
        box-sizing: border-box;
      }
      .  {
        display: flex;
        justify-content: left;
      }
      .openButton {
        border: none;
        border-radius: 5px;
        background-color: #1c87c9;
        color: white;
        padding: 14px 20px;
        cursor: pointer;
        position: relative;
      }
      .StatusPopup {
        position: relative;
        text-align: center;
        width: 100%;
      }
      .formPopup {
        display: none;
        position: fixed;
        left: 45%;
        top: 5%;
        transform: translate(-50%, 5%);
        border: 3px solid #999999;
        z-index: 9;
      }
      .formContainer {
        max-width: 300px;
        padding: 20px;
        background-color: #fff;
      }
      .formContainer input[type=text],
      .formContainer input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 20px 0;
        border: none;
        background: #eee;
      }
      .formContainer input[type=text]:focus,
      .formContainer input[type=password]:focus {
        background-color: #ddd;
        outline: none;
      }
      .formContainer .btn {
        padding: 12px 20px;
        border: none;
        background-color: #8ebf42;
        color: #fff;
        cursor: pointer;
        width: 100%;
        margin-bottom: 15px;
        opacity: 0.8;
      }
      .formContainer .cancel {
        background-color: #cc0000;
      }
      .formContainer .btn:hover,
      .openButton:hover {
        opacity: 1;
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
$status = $_GET['status'];
$query = "select * from laundry_db.laundry_requests WHERE status='$status' ";

if($username != "admin@gmail.com"){
    $query = $query." and email = '$username';";
}

$con=  mysqli_query($conn, $query);
?>
<body>
<table border="1" style="border-collapse:collapse" width="100%">
            <tr><th colspan=8 style="text-align: center; vertical-align: middle; font-weight:bold">
            Request Details:</th></tr>
            <tr>                        <?php if($username == "admin@gmail.com"){ ?><th> Request No</th><?php }?>
                    <th> User</th>
                    <th> Request Date</th>
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
            <?php if($username == "admin@gmail.com"){ ?><td style="text-align:center;">
                <button class="openButton" id="request_no" onclick="openForm(this)"><?php echo $row['ID']; ?></button></td><?php } ?>
            <td><?php echo $row['email']; ?></td>
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

<div class="StatusPopup">
      <div class="formPopup" id="popupForm">
        <form action="UpdateLaundryStatus.php" class="formContainer" name = "request_form">
          <h2>Laundry Request Status</h2>
          <label for="request_no" style="float:left">
            <strong>Request No.</strong>
          </label>
          <br>
          <input type="text" name="request_no" readonly>
          <label for="status" style="float:left">
            <strong>Status</strong>
          </label>
          <select name="rquest_status" id="nothing">
                <option value="New">New Request</option>
                <option value="Accept">Accept</option>
                <option value="InProcess">InProcess</option>
                <option value="Finish">Finished</option>
            </select>
          <button type="submit" class="btn">Update</button>
          <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
      </div>
    </div>
    <script>
      function openForm(request) {
        //alert(request.innerText)
        document.request_form.request_no.value = request.innerText;
        document.getElementById("popupForm").style.display = "block";
      }
      function closeForm() {
        document.getElementById("popupForm").style.display = "none";
      }
    </script>
</body>
</html>