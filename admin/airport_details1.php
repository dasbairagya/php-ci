<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Admin Home</title>

  <?php include 'style.php'; ?>
 <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>


 <script>


$(document).ready(function(){
    $('#hider').hide();
    $("#checker").click(function(){
        $("#hider").toggle();
    });
});

function addnew() {
  $("<DIV>").load("temp.php", function() {
      $("#item").append($(this).html());
  }); 
}
function deleteRow() {
  $('DIV.product-item').each(function(index, item){
    jQuery(':checkbox', this).each(function () {
            if ($(this).is(':checked')) {
        $(item).remove();
            }
        });
  });
}
</script>

</head>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">



<?php include 'header.php'; ?>

<?php include 'sidebar.php'; ?>



  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>Airport Details</h1>

    </section>



    <!-- Main content -->

    <section class="content">

      <div class="row">

        <div class="col-xs-12">

          <!-- /.box -->



          <div class="box">

            <div class="box-header">

              <h3 class="box-title">Airport Details</h3>

              <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal123">Add Airport</button>

            </div>

            <!-- /.box-header -->

            <div class="box-body">

              <table id="example1" class="table table-hover">

                <thead>

                <tr>

                  <th>City</th>

                  <th>Airport Name1</th>
                   <th>Airport Name2</th>
                    <th>Airport Name3</th>
                     <th>Action</th>

                 
                  

                </tr>

                </thead>

                <tbody>

                <?php 

                  try 

                  {

                      $stmt = $conn->prepare (" SELECT * FROM airport_new");

                      $stmt -> execute();

                      for($i=0; $object = $stmt->fetchObject(); $i++)

                      { ?>

                        <tr>

                          <td><?php print $object->city; ?></td>

                            <td><?php print $object->airport1; ?></td>
                            <td><?php print $object->airport2; ?></td>
                             <td><?php print $object->airport3; ?></td>
                        
                           <td><a href='delete_airport1.php?airport_id=<?php print $object->airport_id; ?>'>Delete</a></td>

                        

                        

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

        <!-- /.col -->

      </div>

      <!-- /.row -->

    </section>

    <!-- /.content -->

  </div>




<!-- driver add -->
<div id="myModal123" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Airport Details</h4>
      </div>
     <form action="db_airport_details1.php" class="" method="post" >
         <div class="modal-body" >
             <div class="row"  style="padding:20px 40px;" >
                  
                        <div class="col-md-6">
                            <label>City</label>
                            <div class="form-group">
                                <input class="form-control" name="city" type="text" required placeholder="eg. City ">
                            </div>
                        </div>
                           <div class="col-md-6">
                            <label>Airport name1</label>
                            <div class="form-group">
                                <input class="form-control" name="airport1" type="text" required placeholder="eg. Airport name1 ">
                            </div>
                        </div>
                         <div class="col-md-6">
                            <label>Airport name2</label>
                            <div class="form-group">
                                <input class="form-control" name="airport2" type="text"  placeholder="eg. Airport name1 ">
                            </div>
                        </div>
                         <div class="col-md-6">
                            <label>Airport name3</label>
                            <div class="form-group">
                                <input class="form-control" name="airport3" type="text"  placeholder="eg. Airport name1 ">
                            </div>
                        </div>

                          
            </div> 
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-default btn-theme" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-theme pull-right btn-reservation-now">SAVE</button>
             </div>
        
         </form>
          </div>
    </div>

  </div>

  <!-- driver add -->

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

