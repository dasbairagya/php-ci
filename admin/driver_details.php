<!DOCTYPE html>
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
  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"><h1>Driver Details</h1></section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">User Details</h3>
              <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal123">Add Driver</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-hover">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Vehicle</th>
                  <th>Vehicle No</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  try {
                      $stmt = $conn->prepare (" SELECT * FROM driver");
                      $stmt -> execute();
                      for($i=0; $object = $stmt->fetchObject(); $i++)
                      { ?>

                        <tr>
                          <td><?php print $object->name; ?></td>
                          <td><?php print $object->vehicle; ?></td>
                          <td><?php print $object->vehicle_number; ?></td>
                          <td>
                          <a href="#"  data-toggle="modal" data-target="#myModal<?php print $i; ?>"  class="btn btn-primary">View</a>
                          <?php
                          if($object->status==0) {
                          ?>
                          <a href="driver_block.php?block_driver=<?php print $object->id; ?>" class="btn btn-danger">Block User</a>
                          <?php } else {?>
                        <a href="driver_block.php?unblock_driver=<?php print $object->id; ?>" class="btn btn-info">UnBlock User</a>
                          <?php } ?>
                          </td>
                        </tr>
                      <?php 
                      }
                  }
                  catch(PDOException $e){
                    echo "Connection failed: " . $e->getMessage();
                  } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <?php 
    try {

        $stmt = $conn->prepare (" SELECT * FROM driver ");
        $stmt -> execute();
        for($i=0; $object = $stmt->fetchObject(); $i++)
        { ?>
          <!-- Modal -->
          <div id="myModal<?php print $i; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><?php print $object->name; ?> Details</h4>
                </div>
                <div class="modal-body">
                <div class=row>
                <div class="col-md-6">
                  <p>
                  <?php $user_id = $object->user_reg_id;
                    print "Name: ".$object->name."<br>"; 
                    print "Password: ".$object->password."<br>"; 
                    print "Contact No: ".$object->phone_number."<br>"; 
                    $gender = $object->driver_gender;
                    if($gender == 0)
                    {
                      print "Gender: Male<br>"; 
                    }
                    else if($gender == 1)
                    {
                      print "Gender: Female<br>"; 
                    }
                    print "Date Of Birth: ".$object->driver_dob."<br>";  
                    print "Vehicle Number: ".$object->vehicle_number."<br>"; 
                    print "Vehicle Name: ".$object->vehicle."<br>";
                    print "Address: ".$object->driver_address."<br>"; 
                    print "City: ".$object->diver_city."<br>"; 
                    print "Pincode: ".$object->driver_pincode."<br>"; 
                  ?>

                  </p>
                  </div>
                  <div class="col-md-6">                    
                    <?php if($object->user_dl != "" && $object->user_rc != "" && $object->user_insurance != "" && $object->user_emition != "" ){ ?>
                      <h4>Download Documents</h4>
                    <?php if($object->user_dl){ ?>
                    <a href="../assets/img/user/<?php echo $object->user_dl; ?>" download>Download Driving Licence</a><br>
                    <?php } if($object->user_rc){ ?>
                    <a href="../assets/img/user/<?php echo $object->user_rc; ?>" download>Download Registration Certificate</a><br>
                    <?php } if($object->user_insurance){ ?>
                    <a href="../assets/img/user/<?php echo $object->user_insurance; ?>" download>Download Insurance</a><br>
                    <?php } if($object->user_emition){ ?>
                    <a href="../assets/img/user/<?php echo $object->user_emition; ?>" download>Download Emission</a><br><br>
                    <?php } ?>

                     <?php
                     $user_docs = $object->user_docs;
                     if($user_docs == 0){ ?>
                      <a href="documents_verified.php?accept=<?php echo $user_id; ?>" class="btn btn-primary">Accept</a> &nbsp;
                      <a href="documents_verified.php?reject=<?php echo $user_id; ?>" class="btn btn-danger">Reject</a>
                     <?php } else if($user_docs == 1){ ?>
                      <button class="btn btn-success">Accepted</button>
                      <?php } else if($user_docs == 2){ ?>
                        <button class="btn btn-warning">Rejected</button>
                     <?php } } else { echo "Documents Not Uploaded"; } ?>
                  </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
           <?php 
          }
      }
      catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
      } ?>
<!-- driver add -->
<div id="myModal123" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add User Details</h4>
      </div>
     <form action="db_driver_details.php" class="" method="post" >
         <div class="modal-body" >
             <div class="row"  style="padding:20px 40px;" >
                        <div class="col-md-6">
                            <label>Driver Name</label>
                            <div class="form-group">
                                <input class="form-control" name="dname" type="text" required placeholder="eg. username ">
                            </div>
                        </div>
                         <div class="col-md-6">
                            <label>Password</label>
                            <div class="form-group">
                                <input class="form-control" name="dpassword" type="password" required placeholder="eg.password ">
                            </div>
                        </div>

                           <div class="col-md-6">
                            <label>Phone Number</label>
                            <div class="form-group">
                             <input class="form-control" name="dphone_number" type="tel" required placeholder="eg. Phone Number">  
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Vehicle Number</label>
                            <div class="form-group">
                             <input class="form-control" name="dv_number" type="tel" required placeholder="eg. Vehicle Number">  
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Vehicle Name</label>
                            <div class="form-group">
                             <input class="form-control" name="dc_name" type="tel" required placeholder="eg. Vehicle Name">  
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Date Of Birth</label>
                            <div class="form-group">
                             <input class="form-control" name="driver_dob" type="tel" required placeholder="eg. Date of Birth">  
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Gender</label>
                            <div class="form-group">
                              <input type="radio" name="driver_gender" value="0" checked> Male<br>
                              <input type="radio" name="driver_gender" value="1"> Female 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Address</label>
                            <div class="form-group">
                             <input class="form-control" name="driver_address" type="tel" required placeholder="eg. Address">  
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>City</label>
                            <div class="form-group">
                             <input class="form-control" name="diver_city" type="tel" required placeholder="eg. City">  
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Status</label>
                            <div class="form-group">
                              <input type="radio" name="driver_status" value="0" checked> Activate<br>
                              <input type="radio" name="driver_status" value="1"> Deactive 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Driver Pincode</label>
                            <div class="form-group">
                             <input class="form-control" name="driver_pincode" type="tel" required placeholder="eg. Pincode">  
                            </div>
                        </div>
                </div> 
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-default btn-theme" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-theme pull-right btn-reservation-now">SAVE</button>
             </div>
        
         </form>
          </div>
    </div>
  <!-- driver add -->
  <!-- /.content-wrapper -->
<?php include 'footer.php'; ?>
<?php include 'color.php'; ?>
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include 'script.php'; ?>
<script>
  $(function () {
    $("#example1").DataTable();
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
</body>
</html>

