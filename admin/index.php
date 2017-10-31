<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
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
      <h1>
        Dashboard
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
<div class="col-sm-4">
		<div class="tile-title tile-cyan">
			<div class="icon">
				<i class="fa fa-user" style="font-size:40px;"></i>
			</div>
			<div class="title">
				<h3 style="font-weight:200;"><a href="https://hohoride.net/admin/user_details.php"><?php
$stmts = $conn->prepare("SELECT * FROM ride_user_register");
		                                              $stmts -> execute();

		                                             $counts = $stmts->rowCount();
						              if($counts)
						             {

						               echo $counts;
						             }
						             else
						             {
						               
                                                               echo 0; 
						             }
?> Total User</a></h3>
				<p></p>
			</div>
		</div>
	</div>

<div class="col-sm-4">
		<div class="tile-title tile-red">
			<div class="icon">
				<i class="fa fa-group" style="font-size:40px;"></i>
			</div>
			<div class="title">
				<h3 style="font-weight:200;"><a href="https://hohoride.net/admin/view_driver.php"><?php
$stmtss = $conn->prepare("SELECT * FROM driver");
		                                              $stmtss -> execute();

		                                             $countss = $stmtss->rowCount();
						              if($countss)
						             {

						               echo $countss;
						             }
						             else
						             {
						               
                                                               echo 0; 
						             }
?> Total Driver</a></h3>
				<p></p>
			</div>
		</div>
	</div>




<div class="col-sm-4">
		<div class="tile-title ">
			<div class="icon">
				<i class="fa fa-car" style="font-size:40px;"></i>
			</div>
			<div class="title">
				<h3 style="font-weight:200;"><a href="https://hohoride.net/admin/view_car.php"><?php
$stmtsss = $conn->prepare("SELECT * FROM car");
		                                              $stmtsss -> execute();

		                                             $countsss = $stmtsss->rowCount();
						              if($countsss)
						             {

						               echo $countsss;
						             }
						             else
						             {
						               
                                                               echo 0; 
						             }
?> Total Car</a></h3>
				<p></p>
			</div>
		</div>
	</div>

         
         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
       <div class="row">
        <div class="col-xs-12">
             <div class="col-sm-6">
               <div class="box">
            <div class="box-header">
              <h3 class="box-title">Today Car Pooling</h3>
              
            </div>
                <div class="box-body">
              <table  class="table table-hover">
                <thead>
                <tr>
                  <th>Source</th>
                  <th>Destination</th>
                  
                </tr>
                </thead>
                <tbody>
                <?php 
                  try 
                  {
                      $today = date('m/d/Y');
                      $stmt = $conn->prepare(" SELECT * FROM ride_offer_ride  WHERE departure_date = '$today' AND offride_frequency = '1' ");
                      $stmt -> execute();
                      for($i=0; $object = $stmt->fetchObject(); $i++)
                      { ?>
                        <tr>
                          <td><?php echo $object->source; ?></td>
                          <td><?php echo $object->destination; ?></td>
                          
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
             <div class="col-sm-6">
                 <div class="box">
                     <div class="box-header">
              <h3 class="box-title">Today Booking</h3>
              
            </div>
                
                <div class="box-body">
              <table  class="table table-hover">
                <thead>
                <tr>
                  <th>Source</th>
                  <th>Destination</th>
                  
                </tr>
                 </thead>
                   <tbody>
                  <?php 
                  try 
                  {
                      $todays = date('d-m-Y');
                      $stmt1 = $conn->prepare(" SELECT * FROM ride_book_now  WHERE pickup_date = '$todays'");
                      $stmt1 -> execute();
                      for($i=0; $object1 = $stmt1->fetchObject(); $i++)
                      { ?>
                        <tr>
                          <td><?php echo $object1->pickup_area; ?></td>
                          <td><?php echo $object1->drop_area; ?></td>
                          
                        </tr>
                      <?php 
                      }
                  }
                  catch(PDOException $e)
                  {
                  echo "Connection failed: " . $e->getMessage();
                  } ?>
                   <?php 
                  try 
                  {
                      $todayss = date('d-m-Y');
                      $stmt2 = $conn->prepare("SELECT * FROM ride_out_station WHERE pickup_date = '$todayss'");
                      $stmt2 -> execute();
                      for($i=0; $object2 = $stmt2->fetchObject(); $i++)
                      { ?>
                        <tr>
                          <td><?php echo $object2->pickup_area; ?></td>
                          <td><?php echo $object2->area; ?></td>
                          
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
         </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Modal -->

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
