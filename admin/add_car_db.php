<?php
include 'connect.php';
if(isset($_POST['add_car']))
{
	try{
     $pic = rand(1,100000).$_FILES['pic']['name'];
    	$pic_loc = $_FILES['pic']['tmp_name'];
     $folder="uploads/";
     move_uploaded_file($pic_loc,$folder.$pic);
     $image=$pic;

      $stmt = $conn->prepare("INSERT INTO car (car_type, image) VALUES (:car_type, :image) ");

            // $stmt -> bindParam(':user_reg_id', $user_reg_id);air_status
            $stmt -> bindParam(':car_type', $_POST['car_type']);
            $stmt -> bindParam(':image', $image);
            $stmt -> execute(); 
     echo "<script>window.location.href = 'add_car.php';</script>";
        }
        catch(PDOException $e)
        {
          echo "Connection failed: " . $e->getMessage();
        } 
}

if(isset($_POST['update_car']))
{
	try{
		if($_FILES['new_pic']['name']==NULL || $_FILES['new_pic']['name']=='')
		{
			$image = $_POST['car_image'];
		}
		else
		{
     	$new_pic = rand(1,100000).$_FILES['new_pic']['name'];
    	$new_pic_loc = $_FILES['new_pic']['tmp_name'];
     	$folder="uploads/";
     	move_uploaded_file($new_pic_loc,$folder.$new_pic);
     	$image=$new_pic;
     	unlink("uploads/".$_POST['car_image']."");
     	}
      	$stmt = $conn->prepare("UPDATE car SET car_type='".$_POST['car_type']."', image='".$image."'  WHERE id=".$_POST['car_id']." ");
         $stmt -> execute();
     	echo "<script>window.location.href = 'view_car.php';</script>";
        }
        catch(PDOException $e){
          echo "Connection failed: " . $e->getMessage();
        } 
}


?>