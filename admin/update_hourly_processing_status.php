<?php 
include 'connect.php';
if(isset($_GET['status_id']))
	{	
	try{	
		$status_id=$_GET['status_id'];

         $stmt = $conn->prepare("UPDATE hourly_rental SET status='completed' WHERE id=$status_id ");
         $stmt -> execute();

         $stmt1 = $conn->prepare ("SELECT driver_name FROM hourly_rental WHERE id='".$status_id."'");
         $stmt1 -> execute();
     	for($i=0; $object = $stmt1->fetchObject(); $ii++)
        	{ 
        	 $name = $object->driver_name;
        	} 
        $stmt2 = $conn->prepare("UPDATE driver SET status='free' WHERE name='".$name."' ");
        $stmt2 -> execute();

        echo "<script>window.location.href = 'hourly_assigned_driver.php';</script>";

       }
        catch(PDOException $e){
		  echo "Connection failed: " . $e->getMessage();
		} 
	}
?>	