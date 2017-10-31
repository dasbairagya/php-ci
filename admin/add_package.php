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
      <section class="content-header"><h1>Package Management</h1></section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Add Package</h3>
                <!-- <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal123">Add Driver</button> -->
                <div class="box-body">
                   <form action="taxi_package.php" method="request">
        <div class="modal-body">
          <div class=row>            
            <div class="col-md-6  pick-up" >
              <label id="initial">Package</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input class="form-control" type="text" name="hourly_package" id="hourly_package" placeholder="4Hrs 40Kms" required="required" value="<?php print $object->drop_area;?>">
            </div>
            <div class="col-md-6 pick-up">                            
              <input  type="submit" class="btn btn-primary update-button" name="add_package" value="Add" style="margin-left: 0px;margin-top: 25px;">
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
