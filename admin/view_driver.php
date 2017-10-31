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
      <section class="content-header"><h1 style="float: left;margin-right: 10px">Driver List</h1><a href="add_driver.php"><button>Add New</button></a></section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Local Ride</h3>
                <!-- <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal123">Add Driver</button> -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped dataTable no-footer" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Display Name</th>
                        <th>Display Image</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>License No</th>
                        <th>Car Type</th>
                        <th>Car No</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      try {
                        $stmt = $conn->prepare (" SELECT * FROM driver ");
                        $stmt -> execute();
                        for($i=0; $object = $stmt->fetchObject(); $i++)
                          { ?>

                        <tr>
                          <td><?php print $object->user_name; ?></td>
                          <?php
                          if($object->profile_image != "")
                          {
                           ?>
                            <td><img src="../ride/driverapp/<?=$object->profile_image?>" width="100px" height="auto" /></td>
                          <?php
                          }
                          else
                          {
                           ?>
                           <td><img src="../assets/img/user/blank-profile-picture-973460_640.png" width="100px" height="auto" /></td>
                           <?php
                           }
                          ?>
                          
                          <td><?php print $object->phone_number; ?></td>
                          <td><?php print $object->driver_address; ?></td>
                          <td><?php print $object->driver_license; ?></td>
                          <td><?php print $object->vehicle; ?></td>
                          <td><?php print $object->vehicle_number; ?></td>                          
                          <td class="center">
                            <a href="update_driver.php?id=<?php echo $object->id; ?>" ><i class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;
                            <a href="taxi_package_delete.php?dr_id=<?php print $object->id; ?>"><i class="fa fa-trash-o " onclick="return confirm('Are you sure to delete')"></i></a>
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
