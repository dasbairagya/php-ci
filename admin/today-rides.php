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
      <h1>Today Booked Rides</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Today Booked Rides</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-hover">
                <thead>
                <tr>
                  <th>offered</th>
                  <th>Booked</th>
                  <th>Date</th>
                  <th>Booked at</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  try 
                  {
                    $today = date('m/d/Y');
                      $stmt = $conn->prepare(" SELECT * FROM ride_book_ride  WHERE ride_date = '$today' ");
                      $stmt -> execute();
                      for($i=0; $object = $stmt->fetchObject(); $i++)
                      { ?>
                        <tr>
                          <td><?php $user_id = $object->user_id;
                            $user_stmt = $conn->prepare (" SELECT * FROM ride_user_register WHERE user_reg_id = '$user_id' ");
                            $user_stmt -> execute();
                            for($i2=0; $user_object = $user_stmt->fetchObject(); $i2++)
                            {
                            echo $user_object->user_name;
                            } ?></td>
                          <td><?php $user_id = $object->offerer_id;
                            $user_stmt = $conn->prepare (" SELECT * FROM ride_user_register WHERE user_reg_id = '$user_id' ");
                            $user_stmt -> execute();
                            for($i2=0; $user_object = $user_stmt->fetchObject(); $i2++)
                            {
                            echo $user_object->user_name;
                            } ?></td>
                          <td><?php print $object->ride_date; ?></td>
                          <td><?php print $object->book_date; ?></td>
                          <td><a href="#"  data-toggle="modal" data-target="#myModal<?php print $i; ?>" >View</a></td>
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
        $stmt = $conn->prepare (" SELECT * FROM ride_book_ride  WHERE ride_date = '$today'  ");
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
                  <h4 class="modal-title"><?php print $object->user_name; ?> Details</h4>
                </div>
                <div class="modal-body">
                  <?php $user_id = $object->user_id;
                    $user_stmt = $conn->prepare (" SELECT * FROM ride_user_register WHERE user_reg_id = '$user_id' ");
                    $user_stmt -> execute();
                    for($i2=0; $user_object = $user_stmt->fetchObject(); $i2++)
                    {
                    echo "<p><b>".$user_object->user_name."</b> is Offering</p>";
                    }?>
                  <p><b>From: </b><?php print $object->source; ?></p>
                  <p><b>To: </b><?php print $object->destination; ?></p>
                  <p><b>Week Days: </b><?php $days = unserialize($object->frequency_days);
                  foreach ($days as $value) {
                    # code...
                  }
                   ?></p>
                  <p><b>At: </b><?php print $object->departure_time; ?></p>
                  <p><b>Price: </b><?php print $object->ride_price; ?></p>
                  <p><b>Posted at: </b><?php print $object->offride_date; ?></p>
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
