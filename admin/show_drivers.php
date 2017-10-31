<?php
include 'connect.php';

                $stmt = $conn->prepare("SELECT name,vehicle FROM driver ");
                $stmt -> execute();

                $count = $stmt->rowCount();
              
                if($count)
                {
                	$response['RESULT'] = array();
                          for($i=0; $object = $stmt->fetchObject(); $i++)
                          { 
                              array_push($response["RESULT"], $object);// push all row lists in to array
                          }
                          echo $json_response = json_encode($response);// success Result json value
                }
                else
                {
                      echo "400";              
  }
  ?>