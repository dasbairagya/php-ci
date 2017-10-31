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
      <section class="content-header"><h1>Car Details</h1></section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">View Car Details</h3>
                <!-- <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal123">Add Driver</button> -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped dataTable no-footer" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Car Type</th>
                        <th>Image</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      try {
                        $stmt = $conn->prepare (" SELECT * FROM car");
                        $stmt -> execute();
                        for($i=0; $object = $stmt->fetchObject(); $i++)
                          { ?>

                        <tr>
                          <td><?php print $object->id; ?></td>
                          <td><?php print $object->car_type; ?></td>
                          <td><img src="uploads/<?php print $object->image; ?>" style="height: 50%"></td>
                          <td class="center">
                            <a href="update_car.php?car_id=<?php echo $object->id; ?>" ><i class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;
                            <a href="booking_delete.php?car_id=<?php print $object->id; ?>" onclick="return confirm('Are you sure for deleting this ride')" class="delete"><i class="fa fa-trash-o "></i></a>
                          </td>
                          <!-- <td class="center">
                            <a href="" data-toggle="modal" data-target="#myModal<?php print $object->id; ?>"><i class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;
                            <a href="delete.php?id=<?php print $object->id; ?>" title="<?php print $object->id; ?>" class="delete"><i class="fa fa-trash-o "></i></a>
                          </td> -->
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
  $stmt = $conn->prepare (" SELECT * FROM ride_book_now where status ='Booking'");
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
        <form action="update_booking_status.php" method="post">
        <div class="modal-body">
          <div class=row>
            <div class="col-md-6  pick-up">
              <label>Pickup Area </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" name="pickup_area" id="pickup_area" value="<?php print $object->pickup_area;?>">
            </div>
            <div class="col-md-6  pick-up" >
              <label>Drop Area </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" name="drop_area" id="drop_area" value="<?php print $object->drop_area;?>">
            </div>
          </div>
          <div class=row>
            <div class="col-md-6 pick-up">
              <label>Pickup Date</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" name="pickup_area" id="pickup_area" value="<?php print $object->pickup_date;?>">
            </div>
            <div class="col-md-6 pick-up">
              <label>Pickup Time</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" name="pickup_area" id="pickup_area" value="<?php print $object->pickup_time;?>">
            </div>
          </div>
          <div class=row>
            <div class="col-md-6 pick-up" >
              <label>Car Type </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" name="pickup_area" id="pickup_area" value="">
            </div>
            <div class="col-md-6 pick-up">
              <label>Assigned </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

              <select>
              <option value="" disabled="disabled" selected="selected">Please assign Driver</option>
              <?php 
              $stmt1 = $conn->prepare ("SELECT id,name FROM driver");
              $stmt1 -> execute();
              for($ii=0; $object1 = $stmt1->fetchObject(); $ii++)

                { ?> ?>
                <option value="<?php echo $object1->id; ?>"><?php echo $object1->name; ?></option>
                <?php } ?>
              </select>
            </div>
            <div>
              <input type="hidden" name="driver_id" value="<?php echo $object1->id; ?>">
              <input type="hidden" name="booking_id" value="<?php echo $object->id; ?>">
              <input type="submit" class="btn btn-primary update-button" name="update" value="Update">
            </div>
          </div>
        </div>
        </form>
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
