<?php

    include 'connect.php';
    
           
            $uname  		       = $_POST['uname'];
            $upassword         = $_POST['upassword'];
            $uemailid  	    	 = $_POST['uemailid'];
            $uphone_number     = $_POST['uphone_number'];
            $urole1		         = $_POST['urole1'];
            $urole2            = $_POST['urole2'];
            $urole3            = $_POST['urole3'];
            $urole4            = $_POST['urole4'];
            $urole5            = $_POST['urole5'];
            $urole6            = $_POST['urole6'];

          if($urole1 == '')
          {
            $urole1 = '0';
          }
          else
          {
            $urole1 = '1';
          }

          if($urole2 == '')
          {
            $urole2 = '0';
          }
          else
          {
            $urole2 = '1';
          }

          if($urole3 == '')
          {
            $urole3 = '0';
          }
          else
          {
            $urole3 = '1';
          }

          if($urole4 == '')
          {
            $urole4 = '0';
          }
          else
          {
            $urole4 = '1';
          }


          if($urole5 == '')
          {
            $urole5 = '0';
          }
          else
          {
            $urole5 = '1';
          }
           
          if($urole6 == '')
          {
            $urole6 = '0';
          }
          else
          {
            $urole6 = '1';
          }
			$roles = $urole1."-".$urole2."-".$urole3."-".$urole4."-".$urole5."-".$urole6;
	
             try 

              {
                $stmt = $conn->prepare("INSERT INTO admin_users(uname, upassword, uemailid, uphone_number, uroles)
				                                               VALUES  (:uname, :upassword, :uemailid , :uphone_number, :roles)");
              
			        $stmt -> bindParam(':uname', $uname);
              $stmt -> bindParam(':upassword', $upassword);
              $stmt -> bindParam(':uemailid', $uemailid);
              $stmt -> bindParam(':uphone_number', $uphone_number);
              $stmt -> bindParam(':roles', $roles);
			        $stmt -> execute();


			  
              echo "<script>window.location.href = 'createuser.php';</script>";
				
               
	    }
            catch(PDOException $e)
	    {
			echo "Connection failed: " . $e->getMessage();
	    }
		
              
        
?>    