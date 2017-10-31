<?php
error_reporting(0);
session_start();

$servername = "localhost";

$username = "root";

$password = "";

date_default_timezone_set('Asia/Kolkata');
try {
    $conn = new PDO("mysql:host=$servername;dbname=hohorideg", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

    if(!isset($_SESSION['admin']))
    {
    	$_SESSION['success_message'] = "Please Login to Admin...";
    	echo "<script>window.location.href= 'login.php';</script>";
    	exit;
    }
?>