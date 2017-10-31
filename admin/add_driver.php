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
      <section class="content-header"><h1>Add Driver</h1></section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Drvier Details</h3>
                <!-- <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal123">Add Driver</button> -->
                <div class="box-body">
                  <form action="taxi_package.php" method="post" enctype="multipart/form-data>
                    <div class="modal-body">
                      <div class=row>
                        <div class="col-md-6  pick-up">
                          <label>Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="text" class="form-control" name="driver_name" required="required" >
                        </div>
                        <div class="col-md-6  pick-up">
                          <label>License No</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="text" class="form-control" name="license_no" required="required">
                        </div>
                        <div class="col-md-6  pick-up" >
                          <label>User Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="text" class="form-control" name="user_name" required="required">
                        </div>
                        <div class="col-md-6 pick-up">
                          <label>Car Type</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <select name="car_type" class="form-control">
                            <option value="" disabled="disabled" required="required" selected="selected">Select car</option>
                            <?php 
                            $stmt = $conn->prepare ("SELECT car_type FROM car ");
                            $stmt -> execute();
                            for($i=0; $object = $stmt->fetchObject(); $i++)
                              { ?> 
                            <option><?php echo $object->car_type; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-6 pick-up">
                          <label>password</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="text" class="form-control" name="password" required="required">
                        </div>
                        <div class="col-md-6 pick-up">
                          <label>Car No</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="text" class="form-control" name="car_no" required="required">
                        </div>
                        <div class="col-md-6 pick-up">
                          <label>Address</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <textarea type="text" class="form-control" name="address" required="required"></textarea>
                        </div>
                        <div class="col-md-6 pick-up">
                          <label>Phone No</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="text" class="form-control" name="phone_no" required="required">
                        </div>
                        <div class="col-md-6 pick-up">                          
                        </div> 
                        <div class="col-md-6 pick-up">                          
                        </div> 
                        <div class="col-md-6 pick-up">
                          <label>Email</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="text" class="form-control" name="email" required="required">
                        </div>
                        <div class="col-md-6 pick-up">                          
                        </div>
                        <div class="col-md-6 pick-up">
                          <input type="submit" class="btn btn-primary update-button" name="add_driver" value="Add" style="margin-left: 10px">
                          <input type="reset" class="btn btn-primary update-button" value="Reset"  style="margin-left: 0px">
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
