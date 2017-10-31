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
      <section class="content-header"><h1>Profile</h1></section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Car Deatails</h3>
                
                <div class="box-body">
                   <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class=row>
          <div class="col-md-12 pick-up">             
              <label>User Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <?php 
              $id= "$_SESSION['admin']";
              $stmt = $conn->prepare ("SELECT * FROM admin WHERE id=$id ");
              $stmt -> execute();
              $object = $stmt->fetchObject();?> 
              <input class="form-control" type="text" name="car_type" required="required" value="<?php print $object->car_type; ?>" style="width: 50%;" readonly>
            </div>
            <div class="col-md-12 pick-up">
              <label>Car Image</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="file" name="new_pic" style="width: 50%;"><br>
              <img src="uploads/<?php print $object->image; ?>" style="height: 30%;width:30%;">              
            </div>
          </div>
          <div class=row>
            <div>
              <input type="hidden" name="car_id" value="<?php echo $object->id; ?>">
              <input type="hidden" name="car_image" value="<?php echo $object->image; ?>">
              <input type="submit" class="btn btn-primary update-button" name="update_car" value="Update">
              <?php } ?>
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

function myFunction(id)
{
 alert(id);
}

});
</script>
