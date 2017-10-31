<?php
error_reporting(0);
session_start();

$servername = "localhost";

$username = "hohorc8i_hohoric";

$password = "hohoric@123#";

date_default_timezone_set('Asia/Kolkata');
try {
    $conn = new PDO("mysql:host=$servername;dbname=hohorc8i_hohorich", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

   
?>