<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cacrm";
// $id     = isset($_POST["id"]) ? $_POST["id"] : 0;
    $id     =  intval($_GET['id']);

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    $sql = "SELECT ad.title,ad.service_id,p.project_id,p.client_id FROM project P LEFT JOIN add_service ad ON p.service_id = ad.service_id WHERE p.client_id = '$id'";
    $result = mysqli_query($conn,$sql);
    $rowCount =  $result ->num_rows;
    if($rowCount >0){
        $sidemenus = array();
        while ($row=mysqli_fetch_object($result))
        {
            $sidemenus[] =  $row;
            $name[]      = $sidemenus[0]->title;
        }
     
        $id = 1;
        foreach ($name as  $value) {
             echo  '<option value="'.$id.'">'.$value.'</option>';
        }          
    }
    else
    {
        echo '<option value="">Country not available</option>';
    }
    
  
?>
