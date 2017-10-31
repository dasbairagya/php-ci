<?php 

include 'connect.php';
if(isset($_REQUEST['add_hourly'])) {

    try{

$book_id     = 'HOHO'.chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)).intval( rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9));

$status = 'processing';

 $stmt = $conn->prepare("INSERT INTO  hourly_rental (book_id,hour_package, pickup_area, area,landmark, pickup_date, pickup_address, pickup_time,select_car,driver_name,status) VALUES (:book_id, :hour_package,:pickup_area, :area ,:landmark,:pickup_date, :pickup_address, :pickup_time,:select_car, :driver_name, :status) ");

            // $stmt -> bindParam(':user_reg_id', $user_reg_id);air_status
            $stmt -> bindParam(':book_id', $book_id);
            $stmt -> bindParam(':pickup_area', $_REQUEST['pickup_area']);
            $stmt -> bindParam(':hour_package', $_REQUEST['hour_package']);
            $stmt -> bindParam(':area', $_REQUEST['area']);
            $stmt -> bindParam(':landmark', $_REQUEST['landmark']);
            $stmt -> bindParam(':pickup_date', $_REQUEST['pickup_date']);
            $stmt -> bindParam(':pickup_address', $_REQUEST['pickup_address']);
            $stmt -> bindParam(':pickup_time', $_REQUEST['pickup_time']);
            $stmt -> bindParam(':select_car', $_REQUEST['select_car']);
            $stmt -> bindParam(':driver_name', $_REQUEST['driver_name']);
            $stmt -> bindParam(':status', $status);
            $stmt -> execute(); 

$stmt1 = $conn->prepare("UPDATE driver SET status='busy' WHERE name='".$_REQUEST['driver_name']."' ");
        $stmt1 -> execute();  

        echo "<script>window.location.href = 'add_hourly_booking.php';</script>";
        }
        catch(PDOException $e){
          echo "Connection failed: " . $e->getMessage();
        } 
}

?>