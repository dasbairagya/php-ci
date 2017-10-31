<?php 

include 'connect.php';
if(isset($_REQUEST['add_outstation'])) {

    try{

$booking_id     = 'HOHO'.chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)).intval( rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9));

$status = 'processing';

 $stmt = $conn->prepare("INSERT INTO  ride_out_station (booking_id,type,pickup_area,pickup_address,amount,area,return_date, pickup_date,pickup_time,car_type,driver_name,status) VALUES (:booking_id, :type, :pickup_area,:pickup_address,:amount,:area,:return_date, :pickup_date, :pickup_time,:car_type, :driver_name, :status) ");

            // $stmt -> bindParam(':user_reg_id', $user_reg_id);air_status
            $stmt -> bindParam(':booking_id', $booking_id);
          
            $stmt -> bindParam(':type', $_REQUEST['type']);
            $stmt -> bindParam(':pickup_address', $_REQUEST['pickup_address']);
            $stmt -> bindParam(':amount', $_REQUEST['amount']);
            $stmt -> bindParam('return_date', $_REQUEST['return_date']);
            $stmt -> bindParam(':area', $_REQUEST['area']);
            $stmt -> bindParam(':pickup_area', $_REQUEST['pickup_area']);
            $stmt -> bindParam(':pickup_date', $_REQUEST['pickup_date']);
            $stmt -> bindParam(':pickup_time', $_REQUEST['pickup_time']);
            $stmt -> bindParam(':car_type', $_REQUEST['car_type']);
            $stmt -> bindParam(':driver_name', $_REQUEST['driver_name']);
            $stmt -> bindParam(':status', $status);
            $stmt -> execute(); 

$stmt1 = $conn->prepare("UPDATE driver SET status='busy' WHERE name='".$_REQUEST['driver_name']."' ");
        $stmt1 -> execute();  

        echo "<script>window.location.href = 'add_outstation_booking.php';</script>";
        }
        catch(PDOException $e){
          echo "Connection failed: " . $e->getMessage();
        } 
}

?>