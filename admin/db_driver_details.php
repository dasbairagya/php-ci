<?php

    include 'connect.php';
    
           
            $name  		       = $_POST['dname'];
            $password         = $_POST['dpassword'];
            $phone_number     = $_POST['dphone_number'];
            $vehicle_number		 = $_POST['dv_number'];
            $vehicle           = $_POST['dc_name'];
            $driver_dob           = $_POST['driver_dob'];
            $driver_address           = $_POST['driver_address'];
            $diver_city           = $_POST['diver_city'];
            $driver_pincode           = $_POST['driver_pincode'];
            $driver_gend           = $_POST['driver_gender'];
            if($driver_gend == 0)
            {
              $driver_gender = '0';
            }
            else
            {
             $driver_gender = '1';
            }
            $driver_status           = $_POST['driver_status'];
            if($driver_status == 0)
            {
              $status = '0';
            }
            else
            {
             $status = '1';
            }

          
	
             try 

              {
                $stmt = $conn->prepare("INSERT INTO driver(name, vehicle, vehicle_number, phone_number, password,driver_gender,driver_address,diver_city,driver_pincode,driver_dob,status)
				                                               VALUES  (:name, :vehicle, :vehicle_number, :phone_number, :password,:driver_gender, :driver_address, :diver_city, :driver_pincode, :driver_dob, :status)");
              
			        $stmt -> bindParam(':name', $name);
              $stmt -> bindParam(':vehicle', $vehicle);
              $stmt -> bindParam(':vehicle_number', $vehicle_number);
              $stmt -> bindParam(':phone_number', $phone_number);
              $stmt -> bindParam(':password', $password);
              $stmt -> bindParam(':driver_gender', $driver_gender);
              $stmt -> bindParam(':driver_address', $driver_address);
              $stmt -> bindParam(':diver_city', $diver_city);
              $stmt -> bindParam(':driver_pincode', $driver_pincode);
              $stmt -> bindParam(':driver_dob', $driver_dob);
              $stmt -> bindParam(':status', $status);
			        $stmt -> execute();


			  
              echo "<script>window.location.href = 'driver_details.php';</script>";
				
               
	    }
            catch(PDOException $e)
	    {
			echo "Connection failed: " . $e->getMessage();
	    }
		
              
        
?>    