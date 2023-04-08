<?php
    if (!isset($_SESSION)) { session_start(); }
    $_SESSION = array(); 
    session_destroy(); 
    header("Location: Login.html"); // Or wherever you want to redirect
    exit();
?>