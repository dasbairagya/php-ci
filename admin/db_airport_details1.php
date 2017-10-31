<?php

    include 'connect.php';
    
            
             $city               = $_POST['city'];
             $airport1           = $_POST['airport1'];
             $airport2           = $_POST['airport2'];
             $airport3           = $_POST['airport3'];

         
           
			   
			     
            
            try 
            {
                $stmt = $conn->prepare(" INSERT INTO airport_new( city, airport1, airport2,airport3)
				                                               VALUES (:city, :airport1, :airport2,:airport3)");
              
  			   
                $stmt -> bindParam(':city', $city);
                      
                $stmt -> bindParam(':airport1', $airport1);
                     
                $stmt -> bindParam(':airport2', $airport2);

                 $stmt -> bindParam(':airport3', $airport3);
  			 
  			    $stmt -> execute();


			  
               echo "<script>window.location.href = 'airport_details1.php';</script>";
				
               
	    }
            catch(PDOException $e)
	    {
			echo "Connection failed: " . $e->getMessage();
	    }
		
              
        
?>    