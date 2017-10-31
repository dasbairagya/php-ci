<?php 
include 'connect.php';
if(isset($_GET['lrr_id']))
	{		
		$delete_id=$_GET['lrr_id'];
         $stmt = $conn->prepare("DELETE FROM local_ride_rates WHERE id=$delete_id ");
            $stmt -> execute();
            echo "<script>window.location.href = 'local_ride_rate.php';</script>";
	}

if(isset($_GET['pk_id']))
	{		
		$delete_id=$_GET['pk_id'];
         $stmt = $conn->prepare("DELETE FROM hourly_package WHERE id=$delete_id ");
            $stmt -> execute();
            echo "<script>window.location.href = 'package_management.php';</script>";
	}

 if(isset($_GET['hr_id']))
	{		
		$delete_id=$_GET['hr_id'];
         $stmt = $conn->prepare("DELETE FROM hourly_rates WHERE id=$delete_id ");
            $stmt -> execute();
            echo "<script>window.location.href = 'hourly_rate.php';</script>";
	}

	if(isset($_GET['arr_id']))
	{		
		$delete_id=$_GET['arr_id'];
         $stmt = $conn->prepare("DELETE FROM airport_rates WHERE id=$delete_id ");
            $stmt -> execute();
            echo "<script>window.location.href = 'airport_rate.php';</script>";
	}


	if(isset($_GET['or_id']))
	{		
		$delete_id=$_GET['or_id'];
         $stmt = $conn->prepare("DELETE FROM outstation_rates WHERE id=$delete_id ");
            $stmt -> execute();
            echo "<script>window.location.href = 'outstation_rate.php';</script>";
	}

	if(isset($_GET['dr_id']))
	{		
		$delete_id=$_GET['dr_id'];
         $stmt = $conn->prepare("DELETE FROM driver WHERE id=$delete_id ");
            $stmt -> execute();
            echo "<script>window.location.href = 'view_driver.php';</script>";
	}

	
	if(isset($_GET['aird_id']))
	{		
		$delete_id=$_GET['aird_id'];
         $stmt = $conn->prepare("DELETE FROM airport_details WHERE id=$delete_id ");
            $stmt -> execute();
            echo "<script>window.location.href = 'airport_management.php';</script>";
	}


?>	