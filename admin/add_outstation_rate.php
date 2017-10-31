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
      <section class="content-header"><h1>Add Rate</h1></section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Outstation Ride</h3>
                <!-- <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal123">Add Driver</button> -->
                <div class="box-body">
                   <form action="taxi_package.php" method="request">
        <div class="modal-body">
          <div class=row>
            <div class="col-md-6  pick-up">
              <label>Car Type</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <select id="car" name="taxi" class="form-control" required="required">
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
              <select name="timing" class="form-control" required="required">
                <option>Day(06:00AM-10:00PM)</option>
                <option>Night(10:00PM-06:00AM)</option>
              </select>
            </div>
             <div class="col-md-6 pick-up">
              <label>Initial Km</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input class="form-control" type="text" name="initial_km" id="initial_km" placeholder="100" required="required" >
            </div>
            <div class="col-md-6  pick-up" >
              <label id="initial">Initial Km Rate</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input class="form-control" type="text" name="initial_rate" id="initial_km_rate" placeholder="49" required="required">
            </div>
          </div>
          <div class=row>
            <div class="col-md-6 pick-up">
              <label>Trip Type</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <select name="trip_type" class="form-control" required="required">
                <option value="0">One Way</option>
                <option value="1">Two Way</option>
              </select>
            </div>
            <div class="col-md-6 pick-up">
              <label>Standard Rate</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input class="form-control" type="text" name="standard_rate" id="standard_rate" placeholder="100" required="required" >
            </div>
          </div>
          <div class=row>            
          <div class="col-md-6 pick-up">
          <input  type="submit" class="btn btn-primary update-button pull-right" name="add_outstation_rate" value="Add" style="margin-left: 0px;margin-top: 25px;">
          </div>
            <div class="col-md-6 pick-up">
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
