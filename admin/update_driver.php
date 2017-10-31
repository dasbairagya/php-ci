<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Home</title>
  <?php include 'style.php'; ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>
    <div class="content-wrapper">
      <section class="content-header"><h1>Update</h1></section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Driver Details</h3>
                <!-- <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal123">Add Driver</button> -->
                <div class="box-body">
                   <form action="taxi_package.php" method="post">
        <div class="modal-body">
          <div class=row>
          <?php 
              $stmt = $conn->prepare ("SELECT * FROM driver WHERE id='".$_GET['id']."' ");
              $stmt -> execute();
              for($i=0; $object = $stmt->fetchObject(); $i++)
                { ?>
              <div class="col-md-6  pick-up">
              <label>Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
                <input class="form-control" type="text" name="driver_name" value="<?php echo $object->name; ?>" >
            </div>
            <div class="col-md-6  pick-up">
              <label>User Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
                <input class="form-control" type="text" name="user_name" value="<?php echo $object->user_name; ?>" readonly>
            </div>
            <div class="col-md-6  pick-up">
              <label>License No</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
                <input class="form-control" type="text" name="license_no" value="<?php echo $object->driver_license; ?>" >
            </div>
            <div class="col-md-6  pick-up">
              <label>Car Type</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <select id="driver" name="car_type" class="form-control">
              <option value="<?php echo $object->vehicle; ?>"  required="required" class="form-control" selected="selected"><?php echo $object->vehicle; ?></option>
                <?php  $c = $object->driver_type;
              if($c ==1)  
              {       
              $stmt1 = $conn->prepare ("SELECT * FROM local_ride_rates");
              $stmt1 -> execute();
              for($ii=0; $object1 = $stmt1->fetchObject(); $ii++)

                  { ?> 
              <option><?php echo $object1->taxi; ?></option>
            <?php
                  } 
               }
                elseif($c ==2){
             $stmt1 = $conn->prepare ("SELECT * FROM outstation_rates");
              $stmt1 -> execute();
              for($ii=0; $object1 = $stmt1->fetchObject(); $ii++)

                  { ?> 
              <option value="<?php echo $object1->taxi; ?>"><?php echo $object1->taxi; ?></option>
            <?php
                  } 
               }
                elseif($c ==3){ 
              $stmt1 = $conn->prepare ("SELECT * FROM airport_rates");
              $stmt1 -> execute();
              for($ii=0; $object1 = $stmt1->fetchObject(); $ii++)

                  { ?> 
              <option><?php echo $object1->car_type; ?></option>
            <?php
                  } 
               }
                elseif($c ==4){ 
                $stmt1 = $conn->prepare ("SELECT * FROM hourly_rates");
              $stmt1 -> execute();
              for($ii=0; $object1 = $stmt1->fetchObject(); $ii++)

                  { ?> 
              <option><?php echo $object1->car_type; ?></option>
            <?php
                  } 
               }
               ?>
             
              </select>
            
            </div>
            <div class="col-md-6  pick-up">
              <label>Password</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
                <input class="form-control" type="text" name="password" value="<?php echo $object->password; ?>" >
            </div>
            <div class="col-md-6  pick-up">
              <label>Car No</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
                <input class="form-control" type="text" name="car_no" value="<?php echo $object->vehicle_number; ?>" >
            </div>
            <div class="col-md-6  pick-up">
              <label>Address</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
              <textarea class="form-control" name="address"><?php echo $object->driver_address; ?></textarea>
            </div>
             
            <div class="col-md-6  pick-up">
              <label>Phone No</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
                <input class="form-control" type="text" name="phone_no" value="<?php echo $object->phone_number; ?>" >
            </div>
              <div class="col-md-6  pick-up">
              <label>City</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
                <input class="form-control" type="text" name="city" value="<?php echo $object->city; ?>" readonly>
            </div>
             <div class="col-md-6  pick-up">
              <label>Driver Type</label>
              <select id="driver_type" name="driver_type" class="form-control">
              <?php
              $b = $object->driver_type;
              if($b ==1)  
              {    ?>       
              <option value="<?php echo $b; ?>"   class="form-control"   selected="selected">Local</option>
              <option value="2"  class="form-control" >Outstation</option>
              <option value="3"  class="form-control" >Airport</option>
              <option value="4"  class="form-control" >Hourly</option>
            <?php } 
             elseif($b ==2)  
              {   ?>        
              <option value="<?php echo $b; ?>"   class="form-control" selected="selected">Outstation</option>
              <option value="1"  class="form-control" >Local</option>
              <option value="3"  class="form-control" >Airport</option>
              <option value="4"  class="form-control" >Hourly</option>
           <?php  } 
           elseif($b ==3)  
              {   ?>        
              <option value="<?php echo $b; ?>"   class="form-control" selected="selected">Airport</option>
              <option value="1"  class="form-control" >Local</option>
              <option value="2"  class="form-control" >Outstation</option>
              <option value="4"  class="form-control" >Hourly</option>
           <?php  } 
           elseif($b ==4)  
              {   ?>        
              <option value="<?php echo $b; ?>"   class="form-control" selected="selected">Hourly</option>
              <option value="1"  class="form-control" >Local</option>
              <option value="2"  class="form-control" >Airport</option>
              <option value="3"  class="form-control" >Outstation</option>
           <?php  } ?>
              
              
            </select>
            </div>

            <div class="col-md-6  pick-up">
              <label>Driver Status</label>
              <select id="driver" name="approve_status" class="form-control">
              <?php
              $a = $object->aprove_status;
              if($a =='' || $a ==0)  
              {    ?>       
              <option value="<?php echo $a; ?>"   class="form-control"   selected="selected">Unapproved</option>
 <option value="1"  class="form-control" >Approved</option>
            <?php } 
             elseif($a =='1')  
              {   ?>        
              <option value="<?php echo $a; ?>"  class="form-control" selected="selected">Approved</option>
             <option value="0"  class="form-control" >Unapproved</option>
           <?php  } ?>
              
              
            </select>
            </div>
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <?php } ?>
          </div>
          <div class=row>
             <div class="col-md-6 pick-up">
              <input type="submit" class="btn btn-primary update-button pull-right" name="update_driver" value="Update" style="margin-left: 0px;margin-top: 25px;">
            </div>
            <div class="col-md-6 pick-up">                            
              
              <input type="reset" class="btn btn-primary update-button" value="Reset" style="margin-left: 10px;margin-top: 25px;">
            </div>
            
          </div>
        </div>
        </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>


</body>
</html>

<?php include 'script.php'; ?>
<script>
  $(function () {
// $("#example1").DataTable();
$('#example2').DataTable({
  "paging": true,
  "lengthChange": false,
  "searching": false,
  "ordering": true,
  "info": true,
  "autoWidth": false
});
});
</script>
