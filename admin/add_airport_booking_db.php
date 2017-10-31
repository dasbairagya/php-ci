<?php 

include 'connect.php';
if(isset($_REQUEST['add_airport'])) {
    try{

$booking_id     = 'HOHO'.chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)).intval( rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9));

$status = 'processing';

 $stmt = $conn->prepare("INSERT INTO  ride_to_airport (booking_id, airport_name, type,drop_area,pickup_area,amount,area,flight_number, pickup_date,pickup_time,car_type,driver_name,status) VALUES (:booking_id, :airport_name, :type, :drop_area ,:pickup_area,:amount,:area,:flight_number, :pickup_date, :pickup_time,:car_type, :driver_name, :status) ");

            // $stmt -> bindParam(':user_reg_id', $user_reg_id);air_status
            $stmt -> bindParam(':booking_id', $booking_id);
            $stmt -> bindParam(':airport_name', $_REQUEST['airport_name']);
            $stmt -> bindParam(':type', $_REQUEST['type']);
            $stmt -> bindParam(':pickup_area', $_REQUEST['pickup_area']);
            $stmt -> bindParam(':amount', $_REQUEST['amount']);
            $stmt -> bindParam('flight_number', $_REQUEST['flight_number']);
            $stmt -> bindParam(':area', $_REQUEST['area']);
            $stmt -> bindParam(':drop_area', $_REQUEST['drop_area']);
            $stmt -> bindParam(':pickup_date', $_REQUEST['pickup_date']);
            $stmt -> bindParam(':pickup_time', $_REQUEST['pickup_time']);
            $stmt -> bindParam(':car_type', $_REQUEST['car_type']);
            $stmt -> bindParam(':driver_name', $_REQUEST['driver_name']);
            $stmt -> bindParam(':status', $status);
            $stmt -> execute(); 

       $stmt1 = $conn->prepare("UPDATE driver SET status='busy' WHERE name='".$_REQUEST['driver_name']."' ");
        $stmt1 -> execute();  

        echo "<script>window.location.href = 'add_airport_booking.php';</script>";
        }
        catch(PDOException $e){
          echo "Connection failed: " . $e->getMessage();
        } 
}

?>