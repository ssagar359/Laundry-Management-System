<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LayOut</title>
</head>
<?php
session_start();
$username =  $_SESSION['username']
?>
<frameset rows="6%,*" border="0">
    <frame name="fr1" src="HeadBar.html" style="background-color: rgba(26, 21, 21, 0.84);">
        <frameset cols="15%,*">
            <frame name="fr2" src="link_page.html" style="background-color: rgba(0, 0, 0, 0.897);">
                <frameset rows="90%,*">
                    <frame name="fr3" class="Frame3" style="background: url('laundry_back2.jpg') no-repeat center center/cover;"noresize>
                        <frame name="fr4" src="copyRight.html" style="background-color: #eee;">
                </frameset>
        </frameset>
</frameset>

</html>