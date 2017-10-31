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
                <h3 class="box-title">Airport Ride</h3>
                <!-- <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal123">Add Driver</button> -->
                <div class="box-body">
                   <form action="add_airport_booking_db.php" novalidate method="REQUEST">
        
  <div class="row">
                     <div class="col-md-6 pick-up" >
                          <label>Select User</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <select id="driver" name="user_reg_id" class="form-control" >
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
    

             <div class="col-md-6  pick-up">
              <label>Airport Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input list="airport_name" name="airport_name" class="form-control">
              <datalist id="airport_name">
              <?php 
              $stmt12 = $conn->prepare ("SELECT * FROM airport_details ");
              $stmt12 -> execute();
              for($iii=0; $object12 = $stmt12->fetchObject(); $iii++)

                { ?> 
              <option value="<?php echo $object12->airport; ?>"></option>
              <?php } ?>
            </datalist>
            </div>

            <div class="col-md-6 pick-up">
              <label>Type</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <Select id="colorselector"  class="form-control" name="type" >
               
               <option value="0">Going to Airport</option>
               <option value="1">Coming from Airport</option>
            </Select>
            </div>

            <div class="col-md-6 pick-up">
              <label>Pickup Date</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="date" name="pickup_date" class="form-control" id="pickup_date" required="required" value="<?php print $object->pickup_date;?>">
            </div>

           <div id="0" class="colors col-md-6 pick-up"><br>
           <label>pickup area</label>
           <input type="text" name="pickup_area"  class="form-control" value="<?php print $object->pickup_area;?>">
            </div>

            <div  id="1" class="colors col-md-6 pick-up"  style="display:none">
            <label>drop area</label>
            <input type="text" name="drop_area"  class="form-control" value="<?php print $object->drop_area;?>" > </div>


            <div class="col-md-6 pick-up" >
            <label>Amount</label>
            <input type="text" name="amount"  class="form-control amount" required="required"> </div>

            <div class="col-md-6 pick-up" >
            <label>Flight Number</label>
            <input type="text" name="flight_number"  class="form-control" required="required"> </div>

            <div class="col-md-6 pick-up" >
            <label>Area</label>
            <input type="text" name="area"  class="form-control" required="required"> </div>
          
            
         
          
            <div class="col-md-6 pick-up" >
                          <label>Select Car</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <select id="driver" name="car_type" class="form-control" onchange="getCarFare(this.value)">
                            <option value="" required="required" class="form-control" selected="selected">Select car</option>
                            <?php 
                            $stmt1 = $conn->prepare ("SELECT * FROM airport_rates");
                            $stmt1 -> execute();
                            for($ii=0; $object1 = $stmt1->fetchObject(); $ii++)

                              { ?> 
                            <option value="<?php echo $object1->id; ?>"><?php echo $object1->car_type; ?></option>
                            <?php } ?>
                          </select>
              </div>

             
            <div class="col-md-6 pick-up">
              <label>Pickup Time</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="time" name="pickup_time" class="form-control" id="pickup_time" required="required" value="<?php print $object->pickup_time;?>">
            </div>
          
          
            
            <div class="col-md-6 pick-up">
              <label>Assigned </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

              <select id="driver" name="driver_name" class="form-control">
              <option value="" disabled="disabled" required="required" selected="selected">Please assign Driver</option>
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
   <div>
              
              <input type="hidden" name="booking_id" value="<?php echo $object->id; ?>">
              <input type="submit" class="btn btn-primary update-button" name="add_airport" value="Add">
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

   function getCarFare(id){

    $.ajax({
    type: "POST",
    url: "airportfare.php",
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
 $(function() {
        $('#colorselector').change(function(){
            $('.colors').hide();
            $('#' + $(this).val()).show();
        });
    });



</script>
