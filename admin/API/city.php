<?php
include 'connect.php';

if($_SERVER['REQUEST_METHOD']=="POST")
{

if(!empty($_POST))
	{
        $city 			= $_POST['city'];
		
		


               
  
            $stmt = $conn->prepare("SELECT * FROM airport_new WHERE city = '$city'"); 
            $stmt->execute();

            $airport_id = $stmt->fetchObject()->airport_id;
            
           echo $airport1       =     splchar($_POST['airport1']);
           echo $airport2       =     splchar($_POST['airport2']);
           echo $airport3       =     splchar($_POST['airport3']);
           exit();
           

echo "success";
exit();
          

	}
	

}








?>