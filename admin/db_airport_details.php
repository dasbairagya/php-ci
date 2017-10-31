<?php

    include 'connect.php';
    
            
             $city           = $_POST['city'];
           

             $aname    = serialize($_POST['aname']);

             $airportname          = serialize($_POST['airportname']);

         
           
			   
			     
            
            try 
            {
                $stmt = $conn->prepare(" INSERT INTO airport( city, aname, airportname)
				                                               VALUES (:city, :airportname, :aname)");
              
  			   
                $stmt -> bindParam(':city', $city);
                      
                $stmt -> bindParam(':aname', $aname);
                     
                $stmt -> bindParam(':airportname', $airportname);
  			 
  			    $stmt -> execute();


			  
               echo "<script>window.location.href = 'airport_details.php';</script>";
				
               
	    }
            catch(PDOException $e)
	    {
			echo "Connection failed: " . $e->getMessage();
	    }
		
              
        
?>    