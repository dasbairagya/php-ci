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
      <section class="content-header"><h1>Update Rate</h1></section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Hourly Ride</h3>
                <!-- <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal123">Add Driver</button> -->
                <div class="box-body">
                   <form action="taxi_package.php" method="post">
        <div class="modal-body">
          <div class=row>
            <div class="col-md-6  pick-up">
              <label>Car Type</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <select id="car" name="car_type" class="form-control" >
              <?php 
              $stmt = $conn->prepare ("SELECT * FROM car ");
              $stmt -> execute();
              for($i=0; $object = $stmt->fetchObject(); $i++)
                { ?> 
                <option value="<?php echo $object->car_type; ?>"><?php echo $object->car_type; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-6 pick-up">
              <label>Time</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <select name="timing" class="form-control" >
                <option>Day(06:00AM-10:00PM)</option>
                <option>Night(10:00PM-06:00AM)</option>
              </select>
            </div>
          </div>
          <div class=row>
            <div class="col-md-6  pick-up">
              <label>Package</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <select name="package" class="form-control" >
              <?php 
              $stmt1 = $conn->prepare ("SELECT * FROM hourly_package ");
              $stmt1 -> execute();
              for($ii=0; $object1 = $stmt1->fetchObject(); $ii++)
                { ?> 
                <option><?php echo $object1->hourly_package; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-6 pick-up">
              <label>Rate</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <?php 
              $id=$_GET['id'];
              $stmt2 = $conn->prepare ("SELECT * FROM hourly_rates WHERE id=$id ");
              $stmt2 -> execute();
              for($i1=0; $object2 = $stmt2->fetchObject(); $i2++)
                { ?>
              <input class="form-control" type="text" name="rate" placeholder="100" value="<?php echo $object2->rate; ?>">
              <input type="hidden" name="update_id" value="<?php echo $_GET['id']; ?>" >
              <?php } ?>
            </div>
          </div>
          <div class=row>
             <div class="col-md-6 pick-up">              
            </div>
            <div class="col-md-6 pick-up">                            
              <input  type="submit" class="btn btn-primary update-button" name="update_hourly_rate" value="Add" style="margin-left: 0px;margin-top: 25px;">
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

  $(document).ready(function(){
    $("#initial_km").change(function(){
      var a = $(this).val();
        var km ="km";
  $('#initial').html('Intial '  +  a + km +' Rate');
    });
});
</script>
