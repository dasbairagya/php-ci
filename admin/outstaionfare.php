<?php

    include 'connect.php';

    $id     =  intval($_POST['id']);
  
  
     
    
   
	   $stmt = $conn->prepare("SELECT * FROM outstation_rates WHERE id ='$id'"); 
     $stmt->execute();
        for($i = 0;  $object = $stmt->fetchObject(); $i++)  
        { 
           
           $arr[] = $object ;
           //  $id         = $object->id;
           // $amount		= $object->standard_rate;
          
        }
          $amount		= $arr[0]->initial_rate;
         
    
        echo json_encode(array('amount'=>$amount));


   
?>