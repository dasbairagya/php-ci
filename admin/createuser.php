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
    <section class="content-header">
      <h1>User Details</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">User Details</h3>
              <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal2">Add user</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-hover">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Emailid</th>
                  <th>Contact No</th>
                  <th>Roles</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  try 
                  {
                      $stmt = $conn->prepare (" SELECT * FROM admin_users");
                      $stmt -> execute();
                      for($i=0; $object = $stmt->fetchObject(); $i++)
                      { ?>
                        <tr>
                          <td><?php print $object->uname; ?></td>
                          <td><?php print $object->uemailid; ?></td>
                          <td><?php print $object->uphone_number; ?></td>
                          <td><?php $parul = $object->uroles;
                          $parul = explode('-', $parul);
                          $rule1 = $parul[0]; 
                          $rule2 = $parul[1]; 
                          $rule3 = $parul[2]; 
                          $rule4 = $parul[3]; 
                          $rule5 = $parul[4]; 
                          $rule6 = $parul[5]; 

                          if($rule1){
                            echo "User Details<br>";
                          }
                          if($rule2){
                            echo "Driver Details<br>";
                          }
                          if($rule3){
                            echo "One Day Details<br>";
                          }
                          if($rule4){
                            echo "Daily Rides<br>";
                          }
                          if($rule5){
                            echo "Book_details<br>";
                          }
                          if($rule6){
                            echo "Create user<br>";
                          }

                           ?></td>

                            <td><a href='delete.php?add_user_id=<?php print $object->add_user_id; ?>'>Delete</a></td>
                        </tr>
                      <?php 
                      }
                  }
                  catch(PDOException $e)
                  {
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
       try 
       {
          $stmt = $conn->prepare("SELECT * FROM admin_users"); 
          $stmt->execute();
          for($i = 0;  $mod_object = $stmt->fetchObject(); $i++)     
          {    
            $uname = $object->uname;
            $uemailid = $object->uemailid;
            $uphone_number = $object->uphone_number;
            $uroles = $bject->uroles;
          
          }
        }
        catch(PDOException $e) 
        {
          echo "Error: " . $e->getMessage();
        } ?>
          <!-- Modal -->


  <div id="myModal222<?php print $i;?>" class="modal fade" role="dialog">
     <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
       <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php print $object->uname;?> Details</h4>
      </div>
   <form action="db_update_user.php" class="" method="post" >
         <div class="modal-body" >
             <div class="row"  style="padding:20px 40px;" >
                  
                        <div class="col-md-6">
                            <label>User Name</label>
                            <div class="form-group">
                                <input class="form-control" name="uname" type="text" required placeholder="eg. username ">
                            </div>
                        </div>
                         <div class="col-md-6">
                            <label>password</label>
                            <div class="form-group">
                                <input class="form-control" name="upassword" type="password" required placeholder="eg.password ">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Emailid</label>
                            <div class="form-group">
                               <input class="form-control" name="uemailid" type="email" required placeholder="eg. Email id">
                            </div>
                        </div>

                           <div class="col-md-6">
                            <label>Phone Number</label>
                            <div class="form-group">
                             <input class="form-control" name="uphone_number" type="tel" required placeholder="eg. Phone Number">  
                            </div>
                        </div>


                        <div class="col-md-6">
                            <label>Role</label>
                            <div class="form-group">
                               
                                <input type="checkbox" name="urole1"  >User details<br>
                            
                               <input type="checkbox"  name="urole2"  >Driver details<br>
                          
                                <input type="checkbox" name="urole3"  >Oneday Ride<br>
                           
                                <input type="checkbox" name="urole4"  >Daily Rides<br>
                            
                                <input type="checkbox" name="urole5"  >Book details<br>

                                <input type="checkbox" name="urole6"  >Create User<br>
                            </div>

                        </div>
                      
                       
                     
                        
                    
                   
                </div> 
            </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-default btn-theme" data-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-theme pull-right btn-reservation-now">update</button>
                              </div>
        
          </form>
        </div>
       </div>

     </div>
        
          



<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add User Details</h4>
      </div>
     <form action="db_user_details.php" class="" method="post" >
         <div class="modal-body" >
             <div class="row"  style="padding:20px 40px;" >
                  
                        <div class="col-md-6">
                            <label>User Name</label>
                            <div class="form-group">
                                <input class="form-control" name="uname" type="text" required placeholder="eg. username ">
                            </div>
                        </div>
                         <div class="col-md-6">
                            <label>password</label>
                            <div class="form-group">
                                <input class="form-control" name="upassword" type="password" required placeholder="eg.password ">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Emailid</label>
                            <div class="form-group">
                               <input class="form-control" name="uemailid" type="email" required placeholder="eg. Email id">
                            </div>
                        </div>

                           <div class="col-md-6">
                            <label>Phone Number</label>
                            <div class="form-group">
                             <input class="form-control" name="uphone_number" type="tel" required placeholder="eg. Phone Number">  
                            </div>
                        </div>


                        <div class="col-md-6">
                            <label>Role</label>
                            <div class="form-group">
                               
                                <input type="checkbox" name="urole1"  >User details<br>
                            
                               <input type="checkbox"  name="urole2"  >Driver details<br>
                          
                                <input type="checkbox" name="urole3"  >Oneday Ride<br>
                           
                                <input type="checkbox" name="urole4"  >Daily Rides<br>
                            
                                <input type="checkbox" name="urole5"  >Book details<br>

                                <input type="checkbox" name="urole6"  >Create User<br>
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

  </div>










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
