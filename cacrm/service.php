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
    $sql = "SELECT * FROM add_service where  service_id= '$id'";
    $result=mysqli_query($conn,$sql);
    $sidemenus = array();
    while ($row=mysqli_fetch_object($result))
    {
        $sidemenus[] =  $row;
    }
        $price = $sidemenus[0]->price;
        $adv   = $sidemenus[0]->advanceper;
        $des   = $sidemenus[0]->description;
        $frequency_days =  $sidemenus[0]->docrequired;
        $frequency_days = unserialize($frequency_days);
        $tasks =  $sidemenus[0]->tasks;
        $task = unserialize($tasks);
        $var  = implode(",",$task);
        $sql  =  "SELECT * FROM add_task where task_id in ($var)";
        $task = mysqli_query($conn,$sql);
        while ($row=mysqli_fetch_array($task))
        {
            $tas[] = $row['task_title'];
        }
      echo json_encode(array('val'=>$price,'adv'=> $adv,'des'=> $des,'tas'=>$tas, 'docs'=> $frequency_days));
    $conn->close();
?>
