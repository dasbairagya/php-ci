<?php 
include 'connect.php';
if(isset($_POST['update']))
	{	try{	
		$book_id=$_POST['book_id'];
		$driver_name=$_POST['driver_name'];
		 
         $stmt = $conn->prepare("UPDATE ride_book_now SET status='processing', driver_name='$driver_name'  WHERE id=$book_id ");
            $stmt -> execute();
         $stmt1 = $conn->prepare("UPDATE driver SET status='busy' WHERE name='$driver_name' ");
            $stmt1 -> execute();
            echo "<script>window.location.href = 'local_assign_driver.php';</script>";
            }
            catch(PDOException $e){
  echo "Connection failed: " . $e->getMessage();
}
	}
?>	