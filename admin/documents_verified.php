<?php 
include 'connect.php';
	if(isset($_GET['accept']))
	{
		$data = $_GET['accept'];
         $stmt = $conn->prepare("UPDATE ride_user_register SET user_docs='1'  WHERE user_reg_id='$data' ");
            $stmt -> execute();
            echo "<script>window.location.href = 'user_details.php';</script>";
	}

        if(isset($_GET['hold']))
	{
		$data = $_GET['hold'];
         $stmt = $conn->prepare("UPDATE ride_user_register SET user_docs='3'  WHERE user_reg_id='$data' ");
            $stmt -> execute();
            echo "<script>window.location.href = 'offer-your-ride.php';</script>";
	}
        
    if(isset($_GET['reject']))
	{
         $data = $_GET['reject'];
         $stmt = $conn->prepare("UPDATE ride_user_register SET user_reason= 'Your documents not perfect', user_docs='2'  WHERE user_reg_id='$data' ");
            $stmt -> execute();
            echo "<script>window.location.href = 'user_details.php';</script>";
	}
	if(isset($_GET['block_user']))
	{
            
            $id = $_GET['block_user'];
            $block_user = $conn->prepare("UPDATE ride_user_register SET user_reason= 'You are Blocked', block_user='1'  WHERE user_reg_id='$id' ");
           
            $block_user -> execute();
	   echo "<script>window.location.href = 'user_details.php';</script>";	
	}
        if(isset($_GET['unblock_user']))
	{
            
            $id = $_GET['unblock_user'];
            $block_user = $conn->prepare("UPDATE ride_user_register SET user_reason= 'You are Blocked', block_user='0'  WHERE user_reg_id='$id' ");
           
            $block_user -> execute();
	   echo "<script>window.location.href = 'user_details.php';</script>";	
	}
?>