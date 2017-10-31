<?php
$q = intval($_GET['q']);

include 'connect.php';

              $stmt1 = $conn->prepare ("SELECT * FROM driver WHERE id = '".$q."' ");
              $stmt1 -> execute();
              for($ii=0; $object1 = $stmt1->fetchObject(); $ii++)

                { 
                        echo $object1->name;
                } 

?>