<?php

 include 'connect.php';

  $airport_id  =    $_GET['airport_id'];
  

try {
  
    $stmt = $conn->prepare("delete  FROM airport_new WHERE airport_id= '$airport_id' ");
    $stmt->execute();
	echo "<script>window.location.href = 'airport_details1.php';</script>";
	
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

	 
	?>
  
  