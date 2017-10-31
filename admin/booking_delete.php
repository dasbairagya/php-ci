<?php 
include 'connect.php';
if(isset($_GET['delete_booking_id']))
	{		
		$delete_id=$_GET['delete_booking_id'];
         $stmt = $conn->prepare("DELETE FROM ride_book_now WHERE id=$delete_id ");
            $stmt -> execute();
            echo "<script>window.location.href = 'local_assign_driver.php';</script>";
	}

if(isset($_GET['delete_assigned_id']))
	{		
		$delete_id=$_GET['delete_assigned_id'];
         $stmt = $conn->prepare("DELETE FROM ride_book_now WHERE id=$delete_id ");
            $stmt -> execute();
            echo "<script>window.location.href = 'local_assigned_driver.php';</script>";
	}

 if(isset($_GET['delete_airport_assign_id']))
	{		
		$delete_id=$_GET['delete_airport_assign_id'];
         $stmt = $conn->prepare("DELETE FROM ride_to_airport WHERE id=$delete_id ");
            $stmt -> execute();
            echo "<script>window.location.href = 'airport_assign_driver.php';</script>";
	}

	if(isset($_GET['delete_airport_assigned_id']))
	{		
		$delete_id=$_GET['delete_airport_assigned_id'];
         $stmt = $conn->prepare("DELETE FROM ride_to_airport WHERE id=$delete_id ");
            $stmt -> execute();
            echo "<script>window.location.href = 'airport_assigned_driver.php';</script>";
	}


	 if(isset($_GET['delete_hourly_assign_id']))
	{		
		$delete_id=$_GET['delete_hourly_assign_id'];
         $stmt = $conn->prepare("DELETE FROM hourly_rental WHERE id=$delete_id ");
            $stmt -> execute();
            echo "<script>window.location.href = 'hourly_assign_driver.php';</script>";
	}

	if(isset($_GET['delete_hourly_assigned_id']))
	{		
		$delete_id=$_GET['delete_hourly_assigned_id'];
         $stmt = $conn->prepare("DELETE FROM hourly_rental WHERE id=$delete_id ");
            $stmt -> execute();
            echo "<script>window.location.href = 'hourly_assigned_driver.php';</script>";
	}


	if(isset($_GET['delete_outstation_assign_id']))
	{		
		$delete_id=$_GET['delete_outstation_assign_id'];
         $stmt = $conn->prepare("DELETE FROM ride_out_station WHERE id=$delete_id ");
            $stmt -> execute();
            echo "<script>window.location.href = 'outstation_assign_driver.php';</script>";
	}

	if(isset($_GET['delete_outstation_assigned_id']))
	{		
		$delete_id=$_GET['delete_outstation_assigned_id'];
         $stmt = $conn->prepare("DELETE FROM ride_out_station WHERE id=$delete_id ");
            $stmt -> execute();
            echo "<script>window.location.href = 'outstation_assigned_driver.php';</script>";
	}



?>	