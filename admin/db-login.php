<?php 
session_start();
include 'connect.php'; 
function splchar($data)
    {
        return mysql_real_escape_string(htmlspecialchars($data));
    }

 if($_SERVER['REQUEST_METHOD']=="POST")
    {
        if(isset($_POST['login']))
        {
          
          $user =  $_POST['user'];
          $username   = $_POST['username'];
          $password   = $_POST['password'];

          if ($user=='0') 
          {

                 

      try 
                  {
                      $stmt = $conn->prepare (" SELECT * FROM admin WHERE username='$username' AND password='$password' ");
                      $stmt -> execute();
                      $count = $stmt->rowCount();
                      if($count)
                      {
                        $_SESSION['admin'] = "admin";
                        echo "<script>window.location.href= 'index.php';</script>";
                      }
                      else
                      {
                        $_SESSION['success_message'] = "Wrong Username/Password";
                        echo "<script>window.location.href= 'login.php';</script>";
                      }

                  }
                  catch(PDOException $e)
                  {
                  echo "Connection failed: " . $e->getMessage();
                  }
          }
        

      
            if ($user=='1') 
            {


      try 
                  {
                      $stmt = $conn->prepare (" SELECT * FROM admin_users WHERE uname='$username' AND upassword='$password' ");
                      $stmt -> execute();
                      $count = $stmt->rowCount();
                      $user_id = $stmt->fetchObject()->add_user_id;
                      //$block_user = $stmt->fetchObject()->block_user;
                      if($count)
                      {
                        $_SESSION['admin'] = $user_id;
                        echo "<script>window.location.href= 'index.php';</script>";
                      }
                      else
                      {
                        
                        $_SESSION['success_message'] = "Wrong Username/Password";
                        echo "<script>window.location.href= 'login.php';</script>";
                      }

                  }
                  catch(PDOException $e)
                  {
                  echo "Connection failed: " . $e->getMessage();
                  }
            }
      
		
	}
    }
 ?>