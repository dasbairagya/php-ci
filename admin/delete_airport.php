<?php

 include 'connect.php';

  $city_id  =    $_GET['city_id'];
  

try {
  
    $stmt = $conn->prepare("delete  FROM airport WHERE city_id= '$city_id' ");
    $stmt->execute();
	echo "<script>window.location.href = 'airport_details.php';</script>";
	
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

	 
	?>
  
  