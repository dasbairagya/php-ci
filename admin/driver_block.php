<?php 
include 'connect.php';
	if(isset($_GET['block_driver']))
	{
		$data = $_GET['block_driver'];
         $stmt = $conn->prepare("UPDATE driver SET status='1'  WHERE id='$data' ");
            $stmt -> execute();
            echo "<script>window.location.href = 'driver_details.php';</script>";
	}

	if(isset($_GET['unblock_driver']))
	{
		$data = $_GET['unblock_driver'];
         $stmt = $conn->prepare("UPDATE driver SET status='0'  WHERE id='$data' ");
            $stmt -> execute();
            echo "<script>window.location.href = 'driver_details.php';</script>";
	}

    
?>