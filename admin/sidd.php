  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin</p>
          <a href="#"><i class="fa fa-circle text-success"></i> HOHORIDE - ADMIN</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->

 <?php 
 if($_SESSION['admin'] == 'admin')
 {
?>

<ul class="sidebar-menu">
  <li class="header">HOME PAGE</li>
    <li class="treeview">
            <a href="#">
              <i class="fa fa-dashboard"></i>
                <span>View Booking Details</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
          <ul class="treeview-menu menu-toggale">
            <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i>Local Ride</a>
              <ul class="treeview-menu" >

                <li><a href="local_assign_driver.php"><i class="fa fa-circle-o"></i>Assign Driver</a></li>
                <li><a href="local_assigned_driver.php"><i class="fa fa-circle-o"></i> Assigned Driver</a></li>
               </ul>
            </li>
          </ul>
        <ul class="treeview-menu menu-toggale">
          <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i>Airport </a>
           <ul class="treeview-menu">
              <li><a href="airport_assign_driver.php"><i class="fa fa-circle-o"></i>Assign Driver</a></li>
              <li><a href="airport_assigned_driver.php"><i class="fa fa-circle-o"></i>Assigned Driver</a></li>
            </ul>
          </li>
        </ul>
        <ul class="treeview-menu menu-toggale">
          <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i>Hourly Rental</a>
            <ul class="treeview-menu">
              <li><a href="hourly_assign_driver.php"><i class="fa fa-circle-o"></i>Assign Driver</a></li>
               <li><a href="hourly_assigned_driver.php"><i class="fa fa-circle-o"></i> Assigned Driver</a></li>
            </ul>
          </li>
        </ul>
        <ul class="treeview-menu menu-toggale">
          <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i>Out station</a>
            <ul class="treeview-menu">
              <li><a href="outstation_assign_driver.php"><i class="fa fa-circle-o"></i>Assign Driver</a></li>
              <li><a href="outstation_assigned_driver.php"><i class="fa fa-circle-o"></i> Assigned Driver</a></li>
            </ul>
          </li>
      </ul>
   </li>
      <li class="treeview menu-toggale">
        <a href="#">
          <i class="fa fa-dashboard"></i>
          <span>Add booking Details</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
          <ul class="treeview-menu menu-toggale">
            <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i>Local Ride</a>
            <!--<ul class="treeview-menu menu-toggale" >
              <li><a href="driver_details.php"><i class="fa fa-circle-o"></i>Assign Driver</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Assigned Driver</a></li>
            </ul>-->
            </li>
          </ul>
        <ul class="treeview-menu">
          <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i>Airport </a>
           <!-- <ul class="treeview-menu">
              <li><a href=""><i class="fa fa-circle-o"></i>Assign Driver</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i>Assigned Driver</a></li>
          </ul>-->
           </li>
        </ul>
          <ul class="treeview-menu">
            <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i>Hourly Rental</a>
           <!-- <ul class="treeview-menu">
               <li><a href=""><i class="fa fa-circle-o"></i>Assign Driver</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> Assigned Driver</a></li>
            </ul>-->
            </li>
          </ul>
        <ul class="treeview-menu">
          <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i>Out station</a>
           <!-- <ul class="treeview-menu">
              <li><a href=""><i class="fa fa-circle-o"></i>Assign Driver</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> Assigned Driver</a></li>
             </ul>-->
          </li>
        </ul>
      </li>
   <li class="treeview">
      <a href="#">
        <i class="fa fa-dashboard"></i>
          <span>Car</span>
          <span class="label label-primary pull-right"></span>
      </a>
        <ul class="treeview-menu menu-toggale">
          <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i>Add Car</a></li>
          <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i>View All</a></li>
        </ul>
    </li>
 <li class="treeview">
    <a href="#">
      <i class="fa fa-dashboard"></i>
        <span>Outstation Package</span>
        <span class="label label-primary pull-right"></span>
    </a>
      <ul class="treeview-menu menu-toggale">
        <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i>Add Package</a></li>
        <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i>View All</a></li>
      </ul>
 </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Car Pooling</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-red"></i> <span>One Day Rides</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="oneday-upcoming-rides.php"><i class="fa fa-circle-o"></i> Upcoming Rides</a></li>
            <li><a href="oneday-past-rides.php"><i class="fa fa-circle-o"></i> Past Rides</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="daily-rides.php">
            <i class="fa fa-circle-o text-yellow"></i><span>Daily Rides</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-aqua"></i><span>Booking Details</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="today-rides.php"><i class="fa fa-circle-o"></i> Today Rides</a></li>
            <li><a href="all-rides.php"><i class="fa fa-circle-o"></i> All Rides</a></li>
          </ul>
        </li>
          </ul>
        </li>
        <li class="treeview">
          <li><a href="user_details.php"><i class="fa fa-circle-o"></i> User Details</a></li>
         </li>
         <li class="treeview">
          <a href="createuser.php">
            <i class="fa fa-circle-o text-aqua"></i><span>Create User</span>
            <span class="pull-right-container">             
            </span>
          </a>
         </li>
    </ul>
<?php
 }else {     
      try {
          $user_id = $_SESSION['admin'];
          $stmt = $conn->prepare (" SELECT * FROM admin_users WHERE add_user_id = '$user_id' ");
          $stmt -> execute();
        for($i=0; $object = $stmt->fetchObject(); $i++) { 
          $parul = $object->uroles;
          $parul = explode('-', $parul);
          $rule1 = $parul[0]; 
          $rule2 = $parul[1]; 
          $rule3 = $parul[2]; 
          $rule4 = $parul[3]; 
          $rule5 = $parul[4]; 
          $rule6 = $parul[5]; 
        ?>
<ul class="sidebar-menu">
  <li class="header">HOME PAGE</li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
      <?php if($rule1){?>
        <li><a href="user_details.php"><i class="fa fa-circle-o"></i> User Details</a></li>
        <?php } ?>
        <?php if($rule2){?>
        <li><a href="#"><i class="fa fa-circle-o"></i> Driver Details</a></li>
        <?php } ?>
        <li><a href="#"><i class="fa fa-circle-o"></i> Unknown</a></li>
      </ul>
    </li>
<?php if($rule3){?>
    <li class="treeview">
        <a href="#">
          <i class="fa fa-circle-o text-red"></i> <span>One Day Rides</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="oneday-upcoming-rides.php"><i class="fa fa-circle-o"></i> Upcoming Rides</a></li>
          <li><a href="oneday-past-rides.php"><i class="fa fa-circle-o"></i> Past Rides</a></li>
        </ul>
    </li>
  <?php } ?>
   <?php if($rule4){?>
      <li class="treeview">
        <a href="daily-rides.php">
          <i class="fa fa-circle-o text-yellow"></i><span>Daily Rides</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
      </li>
    <?php } ?>
    <?php if($rule5){?>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-circle-o text-aqua"></i><span>Booking Details</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="today-rides.php"><i class="fa fa-circle-o"></i> Today Rides</a></li>
          <li><a href="all-rides.php"><i class="fa fa-circle-o"></i> All Rides</a></li>
        </ul>
      </li>
    <?php } ?>
    <?php if($rule6){?>
        <li class="treeview">
          <a href="createuser.php">
            <i class="fa fa-circle-o text-aqua"></i><span>Create User</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
         <?php } ?>
  </ul>
    <?php 
          }
        }            
        catch(PDOException $e){
          echo "Connection failed: " . $e->getMessage();
        } 
      }
    ?>
    </section>
    <!-- /.sidebar -->
</aside>