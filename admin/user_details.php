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

              <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Add Tag</button>

            </div>

            <!-- /.box-header -->

            <div class="box-body">

              <table id="example1" class="table table-hover">

                <thead>

                <tr>

                  <th>Name</th>

                  <th>Email Id</th>

                  <th>Contact No</th>

                  <th>Address</th>

                  <th>Action</th>

                </tr>

                </thead>

                <tbody>

                <?php 

                  try 

                  {

                      $stmt = $conn->prepare (" SELECT * FROM ride_user_register");

                      $stmt -> execute();

                      for($i=0; $object = $stmt->fetchObject(); $i++)

                      { ?>

                        <tr>

                          <td><?php echo $object->user_name; ?></td>

                          <td><?php echo $object->user_email; ?></td>

                          <td><?php echo $object->user_contact; ?></td>

                          <td><?php echo $object->user_city; ?></td>

                          <td>
                          <a href="#"  data-toggle="modal" data-target="#myModal<?php echo $object->user_reg_id; ?>"  class="btn btn-primary">View</a>
                          <?php
                          if($object->block_user != 1)
                          {
                           ?>
                            <a href="documents_verified.php?block_user=<?php echo $object->user_reg_id; ?>" class="btn btn-danger">Block User</a>
                           <?php
                           }
                           else
{
?>
<a href="documents_verified.php?unblock_user=<?php echo $object->user_reg_id; ?>" class="btn btn-danger">Unblock User</a>
<?php
}
                          ?>

                          </td>

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

        $stmt = $conn->prepare (" SELECT * FROM ride_user_register ");

        $stmt -> execute();

        for($i=0; $object = $stmt->fetchObject(); $i++)

        { ?>

          <!-- Modal -->

          <div id="myModal<?php echo $object->user_reg_id; ?>" class="modal fade" role="dialog">

            <div class="modal-dialog">



              <!-- Modal content-->

              <div class="modal-content">

                <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                  <h4 class="modal-title"><?php echo $object->user_name; ?> Details</h4>

                </div>

                <div class="modal-body">
                <div class=row>
                <div class="col-md-6">

                  <p>

                  <?php $user_id = $object->user_reg_id;?>
<?php
if($object->user_picture != "")
{
?>
                  <img src="../assets/img/user/<?=$object->user_picture?>" width="100px" height="auto" style="border-radius:50%;" /><br>
<?php
}
else
{
?>
<td><img src="../assets/img/user/blank-profile-picture-973460_640.png" width="100px" height="auto" style="border-radius:50%;" /><br>
<?php
}
                 

                    echo "Name: ".$object->user_name."<br>"; 

                    echo "Email Id: ".$object->user_email."<br>"; 

                    echo "Contact No: ".$object->user_contact."<br>"; 

                    $gender = $object->user_gender;

                    if($gender == 0)

                    {

                      echo "Gender: Male<br>"; 

                    }

                    else if($gender == 1)

                    {

                      echo "Gender: Female<br>"; 

                    }

                    echo "Date Of Birth: ".$object->user_dob."<br>"; 

                    echo "Address: ".$object->user_address."<br>"; 

                    echo "City: ".$object->user_city."<br>"; 

                    echo "Pincode: ".$object->user_pincode."<br>"; 
                    
                    
?>
 

                  </p>
                  </div>
                  <div class="col-md-6">                    
                    <?php if($object->user_dl != "" || $object->user_rc != "" || $object->user_insurance != "" || $object->user_emition != "" ){ ?>
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

      catch(PDOException $e)

      {

      echo "Connection failed: " . $e->getMessage();

      } ?>





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

