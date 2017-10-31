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
      <section class="content-header"><h1>Add Booking</h1></section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Hourly Rental</h3>
                <!-- <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal123">Add Driver</button> -->
                <div class="box-body">
                  <form action="add_hourly_booking_db.php" method="REQUEST">
                    <div class="modal-body">
                      <div class=row>
                        <div class="col-md-6 pick-up" >
                          <label>Select User</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <select id="driver" name="user_reg_id" class="form-control">
                            <option value="" disabled="disabled" required="required" class="form-control" selected="selected">Select user</option>
                            <?php 
                            $stmt = $conn->prepare ("SELECT * FROM ride_user_register");
                            $stmt -> execute();
                            for($i=0; $object = $stmt->fetchObject(); $i++)

                              { ?> 
                            <option value="<?php echo $object->user_reg_id; ?>"><?php echo $object->user_name; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-6 pick-up" >
                          <label>Select Car</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <select id="driver" name="select_car" class="form-control" onchange="getCarFare(this.value)">
                            <option value="" disabled="disabled" required="required" class="form-control" selected="selected">Select car</option>
                            <?php 
                            $stmt1 = $conn->prepare ("SELECT * FROM hourly_rates");
                            $stmt1 -> execute();
                            for($ii=0; $object1 = $stmt1->fetchObject(); $ii++)

                              { ?> 
                            <option  value="<?php echo $object1->id; ?>"><?php echo $object1->car_type; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-6  pick-up">
                          <label>Pickup Area </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="text" class="form-control" name="pickup_area" id="pickup_area" required="required" value="<?php print $object->pickup_area;?>">
                        </div>

                         <div class="col-md-6  pick-up">
                          <label>Amount</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="text" class="form-control amount" name="amount"  required="required" value="<?php print $object->amount;?>">
                        </div>

                        <div class="col-md-6  pick-up">
                          <label>Area</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="text" class="form-control" name="area" id="area" required="required">
                        </div>
                        <div class="col-md-6 pick-up" >
                          <label>Package</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <select id="driver" name="hour_package" class="form-control">
                          <option value="" disabled="disabled" required="required" class="form-control" selected="selected">Select Package</option>
                          <?php 
                          $stmt1 = $conn->prepare ("SELECT * FROM hourly_package");
                          $stmt1 -> execute();
                          for($ii=0; $object1 = $stmt1->fetchObject(); $ii++)

                          { ?> 
                          <option><?php echo $object1->hourly_package; ?></option>
                          <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-6  pick-up" >
                          <label> Landmark</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="text" class="form-control" name="landmark" id="landmark" required="required" value="<?php print $object->landmark;?>">
                        </div> 
                       

                        <div class="col-md-6 pick-up">
                          <label>Pickup Date</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="date" name="pickup_date" class="form-control" id="pickup_date" required="required" value="<?php print $object->pickup_date;?>">
                        </div>

                         <div class="col-md-6  pick-up" >
                          <label> Pickup Address</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="text" class="form-control" name="pickup_address" id="pickup_address" required="required" value="<?php print $object->pickup_address;?>">
                        </div>
                        <div class="col-md-6 pick-up">
                          <label>Pickup Time</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="time" name="pickup_time" id="pickup_time" class="form-control" required="required" value="<?php print $object->pickup_time;?>">
                        </div>
                        <div class="col-md-6 pick-up">
                          <label>Assigned </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <select id="driver" name="driver_name" class="form-control">
                            <option value="" disabled="disabled" required="required" selected="selected">Please assign Driver</option>
                            <?php 
                            $stmt2 = $conn->prepare ("SELECT * FROM driver WHERE status='free' ");
                            $stmt2 -> execute();
                            for($iii=0; $object2 = $stmt2->fetchObject(); $iii++)

                              { ?> 
                            <option><?php echo $object2->name; ?></option>
                            <?php } ?>
                          </select>

                        </div>
                        <div>

                          <input type="hidden" name="booking_id" value="<?php echo $object->id; ?>">
                          <input type="submit" class="btn btn-primary update-button" name="add_hourly" value="Add">
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

   function getCarFare(id){


    $.ajax({
    type: "POST",
    url: "hourlyfare.php",
    data: {'id' : id},
   
    success: function(data){
      console.log(data['amount']);
     var t = $.parseJSON(data);
     t['amount'];
     console.log(t['amount']);
    $(".amount").val(t['amount']);
  }
});
  

}
</script>
