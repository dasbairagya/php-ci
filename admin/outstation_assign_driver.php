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
      <section class="content-header"><h1>Driver Details</h1></section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">User Details</h3>
                <!-- <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal123">Add Driver</button> -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped dataTable no-footer" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Date Of Departure</th>
                        <th>Return Date</th>
                        <th>Outstation Status</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      try {
                        $stmt = $conn->prepare (" SELECT * FROM ride_out_station where status ='Booking'");
                        $stmt -> execute();
                        for($i=0; $object = $stmt->fetchObject(); $i++)
                          { ?>

                        <tr>
                          <td><?php print $object->booking_id; ?></td>
                          <td><?php print $object->pickup_area; ?></td>
                          <td><?php print $object->area; ?></td>
                          <td><?php print $object->pickup_date; ?></td>
                          <td><?php 
                                if($object->return_date == NULL || $object->return_date == '')
                                {
                                    echo "No return date";
                                  } 
                                  else
                                  {
                                    print $object->return_date; 
                                  } ?>
                          </td>
                          <td><?php 
                                if($object->type == 0)
                                {
                                    echo "One Way Trip";
                                  } 
                                  else
                                  {
                                    echo "Two Way Trip";
                                  } ?>
                          </td>
                          <td><?php print $object->status; ?></td>
                          <td class="center">
                            <a href="" data-toggle="modal" data-target="#myModal<?php print $object->id; ?>"><i class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;
                            <a href="booking_delete.php?delete_outstation_assign_id=<?php print $object->id; ?>" title="<?php print $object->id; ?>" onclick="return confirm('Are you sure for deleting this ride')" class="delete"><i class="fa fa-trash-o "></i></a>
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
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>


</body>
</html>
<?php 
try {
  $stmt = $conn->prepare (" SELECT * FROM ride_out_station where status ='Booking'");
  $stmt -> execute();
  for($i=0; $object = $stmt->fetchObject(); $i++)

    { ?>
  <!-- Modal -->
  <div id="myModal<?php print $object->id; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Driver  Details</h4>
        </div>
        <form action="update_outstation_status.php" method="post">
        <div class="modal-body">
          <div class=row>
            <div class="col-md-6  pick-up">
              <label>Pickup Area </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" name="pickup_area" id="pickup_area" value="<?php print $object->pickup_area;?>">
            </div>
            <div class="col-md-6  pick-up" >
              <label>Drop Area </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" name="drop_area" id="drop_area" value="<?php print $object->area;?>">
            </div>
          </div>
          <div class=row>
            <div class="col-md-6 pick-up">
              <label>Departure Date</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" name="pickup_area" id="pickup_area" value="<?php print $object->pickup_date;?>">
            </div>
            <div class="col-md-6 pick-up">
              <label>Return Date</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" name="return_date" id="return_date" value="<?php if($object->return_date == NULL || $object->return_date == '')
                                {
                                    echo 'No return date';
                                  } 
                                  else
                                  {
                                    print $object->return_date; 
                                  } ?> ">
            </div>
          </div>
          <div class=row>
            <div class="col-md-6 pick-up">
              <label>Outstation Status</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" name="type" id="type" value="<?php if($object->type==0) echo 'One Way Trip'; else { echo 'Two Way Trip'; }?>">
            </div>
            <div class="col-md-6 pick-up" >
              <label>Car Type </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" name="car_type" id="car_type" value="<?php print $object->car_type;?>">
            </div>
          </div>
          <div class=row>            
            <div class="col-md-6 pick-up">
              <label>Assigned </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

              <select id="driver" name="driver_name">
              <option value="" disabled="disabled" selected="selected">Please assign Driver</option>
              <?php 
              $stmt1 = $conn->prepare ("SELECT * FROM driver WHERE status='free' ");
              $stmt1 -> execute();
              for($ii=0; $object1 = $stmt1->fetchObject(); $ii++)

                { ?> 
                <option value="<?php echo $object1->name; ?>"><?php echo $object1->name; ?></option>
                <?php } ?>
              </select>
              
            </div>
           
          </div>
           <div class="modal-footer">
          
           <input type="hidden" name="booking_id" value="<?php echo $object->id; ?>">
           <input type="submit" class="btn btn-primary update-button" name="update" value="Update">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
        </form>
      
      </div>
    </div>
   
  </div>


<?php 
}
}
catch(PDOException $e){
  echo "Connection failed: " . $e->getMessage();
} ?>
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

function myFunction(id)
{
 alert(id);
}

});
</script>
