<?php

 include 'connect.php';

  $add_user_id  =    $_GET['add_user_id'];
  

try {
  
    $stmt = $conn->prepare("delete  FROM admin_users WHERE add_user_id= '$add_user_id' ");
    $stmt->execute();
	echo "<script>window.location.href = 'createuser.php';</script>";
	
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

	 
	?>
  
  