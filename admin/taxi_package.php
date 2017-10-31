<?php 

include 'connect.php';

/*Local Ride*/
if(isset($_REQUEST['add_local_ride_rate'])) 
{
    try
    {

        $stmt = $conn->prepare("INSERT INTO local_ride_rates (taxi, initial_km,initial_rate,standard_rate,timing) VALUES (:taxi, :initial_km , :initial_rate, :standard_rate,:timing) ");

// $stmt -> bindParam(':user_reg_id', $user_reg_id);air_status
        $stmt -> bindParam(':taxi', $_REQUEST['car_type']);
        $stmt -> bindParam(':initial_km', $_REQUEST['initial_km']);
        $stmt -> bindParam(':initial_rate', $_REQUEST['initial_km_rate']);
        $stmt -> bindParam(':standard_rate', $_REQUEST['standard_rate']);
        $stmt -> bindParam(':timing', $_REQUEST['timing']);
        $stmt -> execute(); 
        echo "<script>window.location.href = 'local_ride_rate.php';</script>";
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    } 
}

if(isset($_POST['update_local_ride_rate']))
{  
    try
    {    
        $id=$_POST['update_id'];

        $stmt = $conn->prepare("UPDATE local_ride_rates SET taxi='".$_POST['car_type']."', initial_km='".$_POST['initial_km']."',initial_rate='".$_POST['initial_km_rate']."', standard_rate='".$_POST['standard_rate']."', timing='".$_POST['timing']."' WHERE id=$id ");
        $stmt -> execute();
        echo "<script>window.location.href = 'local_ride_rate.php';</script>";
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
}
/*Local Ride*/

/*Airport Ride*/
if(isset($_REQUEST['add_airport_rate'])) 
{
    try
    {

        $stmt = $conn->prepare("INSERT INTO airport_rates (car_type, timing, tinitial_km, tinitial_rate, tstandard_rate,finitial_km, finitial_rate, fstandard_rate) VALUES (:car_type, :timing, :tinitial_km, :tinitial_rate, :tstandard_rate, :finitial_km, :finitial_rate, :fstandard_rate) ");

// $stmt -> bindParam(':user_reg_id', $user_reg_id);air_status
        $stmt -> bindParam(':car_type', $_REQUEST['car_type']);
        $stmt -> bindParam(':timing', $_REQUEST['timing']);
        $stmt -> bindParam(':tinitial_km', $_REQUEST['tinitial_km']);
        $stmt -> bindParam(':tinitial_rate', $_REQUEST['tinitial_rate']);
        $stmt -> bindParam(':tstandard_rate', $_REQUEST['tstandard_rate']);
        $stmt -> bindParam(':finitial_km', $_REQUEST['finitial_km']);
        $stmt -> bindParam(':finitial_rate', $_REQUEST['finitial_rate']);
        $stmt -> bindParam(':fstandard_rate', $_REQUEST['fstandard_rate']);
        $stmt -> execute(); 
        echo "<script>window.location.href = 'airport_rate.php';</script>";
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    } 
}

if(isset($_POST['update_airport_rate']))
{  
    try
    {    
        $id=$_POST['update_id'];

        $stmt = $conn->prepare("UPDATE airport_rates SET car_type='".$_POST['car_type']."',timing='".$_POST['timing']."', tinitial_km='".$_POST['tinitial_km']."',tinitial_rate='".$_POST['tinitial_rate']."', tstandard_rate='".$_POST['tstandard_rate']."', finitial_km='".$_POST['finitial_km']."',finitial_rate='".$_POST['finitial_rate']."', fstandard_rate='".$_POST['fstandard_rate']."' WHERE id=$id ");
        $stmt -> execute();
        echo "<script>window.location.href = 'airport_rate.php';</script>";
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
}
/*Airport Ride*/

/*Hourly Ride*/
if(isset($_REQUEST['add_hourly_rate'])) 
{
    try
    {
        $stmt = $conn->prepare("INSERT INTO hourly_rates (car_type, timing, package, rate) VALUES (:car_type, :timing , :package, :rate) ");

// $stmt -> bindParam(':user_reg_id', $user_reg_id);air_status
        $stmt -> bindParam(':car_type', $_REQUEST['car_type']);
        $stmt -> bindParam(':timing', $_REQUEST['timing']);
        $stmt -> bindParam(':package', $_REQUEST['package']);
        $stmt -> bindParam(':rate', $_REQUEST['rate']);
        $stmt -> execute(); 
        echo "<script>window.location.href = 'hourly_rate.php';</script>";
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    } 
}

if(isset($_POST['update_hourly_rate']))
{  
    try
    {    
        echo $id=$_POST['update_id'];
        $stmt = $conn->prepare("UPDATE hourly_rates SET car_type='".$_POST['car_type']."', timing='".$_POST['timing']."',package='".$_POST['package']."', rate='".$_POST['rate']."' WHERE id=$id ");
        $stmt -> execute();
        echo "<script>window.location.href = 'hourly_rate.php';</script>";
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
}
/*Hourly Ride*/

/*Outstation Ride*/
if(isset($_REQUEST['add_outstation_rate'])) 
{
    try
    {

        $stmt = $conn->prepare("INSERT INTO outstation_rates (taxi, trip_type, initial_km,initial_rate,standard_rate,timing) VALUES (:taxi, :trip_type, :initial_km , :initial_rate, :standard_rate,:timing) ");

// $stmt -> bindParam(':user_reg_id', $user_reg_id);air_status
        $stmt -> bindParam(':taxi', $_REQUEST['taxi']);
        $stmt -> bindParam(':trip_type', $_REQUEST['trip_type']);
        $stmt -> bindParam(':initial_km', $_REQUEST['initial_km']);
        $stmt -> bindParam(':initial_rate', $_REQUEST['initial_rate']);
        $stmt -> bindParam(':standard_rate', $_REQUEST['standard_rate']);
        $stmt -> bindParam(':timing', $_REQUEST['timing']);
        $stmt -> execute(); 
        echo "<script>window.location.href = 'outstation_rate.php';</script>";
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    } 
}

if(isset($_POST['update_outstation_rate']))
{  
    try
    {    
        $id=$_POST['update_id'];

        $stmt = $conn->prepare("UPDATE outstation_rates SET taxi='".$_POST['taxi']."', trip_type='".$_POST['trip_type']."', initial_km='".$_POST['initial_km']."',initial_rate='".$_POST['initial_rate']."', standard_rate='".$_POST['standard_rate']."', timing='".$_POST['timing']."' WHERE id=$id ");
        $stmt -> execute();
        echo "<script>window.location.href = 'outstation_rate.php';</script>";
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
}
/*Outstation Ride*/

/*Package Management*/
if(isset($_REQUEST['add_package']))
{
    try
    {
        $stmt = $conn->prepare("INSERT INTO hourly_package (hourly_package) VALUES (:hourly_package) ");

// $stmt -> bindParam(':user_reg_id', $user_reg_id);air_status
        $stmt -> bindParam(':hourly_package', $_REQUEST['hourly_package']);
        $stmt -> execute(); 
        echo "<script>window.location.href = 'package_management.php';</script>";
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    } 
}

if(isset($_POST['update_package']))
{  
    try
    {    
        $id=$_POST['id'];
        $stmt = $conn->prepare("UPDATE hourly_package SET hourly_package='".$_POST['package']."' WHERE id=$id ");
        $stmt -> execute();
        echo "<script>window.location.href = 'package_management.php';</script>";
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
}
/*Package Management*/

/*Driver Management*/
if(isset($_POST['add_driver'])) 
{
    try
    {

        $stmt = $conn->prepare("INSERT INTO driver (name, driver_license, user_name, vehicle, password, vehicle_number, driver_address, phone_number,  email) VALUES (:name, :driver_license, :user_name, :vehicle, :password, :vehicle_number, :driver_address, :phone_number,  :email) ");

// $stmt -> bindParam(':user_reg_id', $user_reg_id);air_status
        $stmt -> bindParam(':name', $_REQUEST['driver_name']);
        $stmt -> bindParam(':driver_license', $_REQUEST['license_no']);
        $stmt -> bindParam(':user_name', $_REQUEST['user_name']);
        $stmt -> bindParam(':vehicle', $_REQUEST['car_type']);
        $stmt -> bindParam(':password', $_REQUEST['password']);
        $stmt -> bindParam(':vehicle_number', $_REQUEST['car_no']);
        $stmt -> bindParam(':driver_address', $_REQUEST['address']);
        $stmt -> bindParam(':phone_number', $_REQUEST['phone_no']);
        $stmt -> bindParam(':email', $_REQUEST['email']);
        $stmt -> execute(); 
        echo "<script>window.location.href = 'view_driver.php';</script>";
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    } 
}
          

 
if(isset($_POST['update_driver']))
{  
    try
    {    
        $id=$_POST['id'];
        $stmt = $conn->prepare("UPDATE driver SET name='".$_POST['driver_name']."', user_name='".$_POST['user_name']."', driver_license  ='".$_POST['license_no']."', vehicle='".$_POST['car_type']."', password='".$_POST['password']."', vehicle_number='".$_POST['car_no']."', driver_address='".$_POST['address']."', phone_number='".$_POST['phone_no']."', aprove_status='".$_POST['approve_status']."', driver_type='".$_POST['driver_type']."', city='".$_POST['city']."' WHERE id=$id ");
        $stmt -> execute();
        echo "<script>window.location.href = 'view_driver.php';</script>";
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
}
/*Driver Management*/




/*Airport Management*/
if(isset($_POST['add_airport'])) 
{
    try
    {

        $stmt = $conn->prepare("INSERT INTO airport_details (airport) VALUES (:airport) ");

// $stmt -> bindParam(':user_reg_id', $user_reg_id);air_status
        $stmt -> bindParam(':airport', $_REQUEST['name']);
        $stmt -> execute(); 
        echo "<script>window.location.href = 'airport_management.php';</script>";
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    } 
}
          

 
if(isset($_POST['update_airport']))
{  
    try
    {    
        $id=$_POST['id'];
        $stmt = $conn->prepare("UPDATE airport_details SET airport='".$_POST['name']."' WHERE id=$id ");
        $stmt -> execute();
        echo "<script>window.location.href = 'airport_management.php';</script>";
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
}
/*Airport Management*/
      
?>

