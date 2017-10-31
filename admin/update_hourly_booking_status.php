<?php 
include 'connect.php';
if(isset($_POST['update']))
    {   try{    
        $booking_id=$_POST['booking_id'];
        $driver_name=$_POST['driver_name'];
         
         $stmt = $conn->prepare("UPDATE hourly_rental SET status='processing', driver_name='$driver_name' WHERE id=$booking_id ");
            $stmt -> execute();
         $stmt1 = $conn->prepare("UPDATE driver SET status='busy' WHERE name='$driver_name' ");
            $stmt1 -> execute();
            echo "<script>window.location.href = 'hourly_assign_driver.php';</script>";
            }
            catch(PDOException $e){
  echo "Connection failed: " . $e->getMessage();
}
    }
?>  