  <?php
  include "../Database.php";
  $db=new Database();
  
  if (isset($_SESSION['username'])&&isset($_SESSION['fullname'])) {
  	include("headerhcw2.php");
  	?>
    <div class="container">
      <div class="alert alert-success">
        <strong>&nbsp;Welcome : &nbsp;<?php print($_SESSION['fullname']); ?></strong>

        <div class="pull-right">
          <i class="glyphicon glyphicon-calendar"></i>
          <?php
          $Today = date('y:m:d');
          $new = date('l, F d, Y', strtotime($Today));
          echo $new;
          ?>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <!-- Start Menu -->
        <div class="col-sm-3">
          <div class="sidebar-nav">
            <div class="nav-canvas">
              <div class="nav-sm nav nav-stacked">

              </div>
              <ul class="nav nav-pills nav-stacked main-menu">
                <!-- <li class="nav-header">Main</li> -->
                <li><a class="ajax-link" href="confirmBoxe.php"><i class="glyphicon glyphicon-home"></i><span> Confirm Box to Wash</span></a></li>
                <!-- <li class="accordion">
                  <a href="viewBoxesTowash.php"><i class="glyphicon glyphicon-th-list"></i><span> Boxes to Wash</span></a>
                </li> -->
                <li class="accordion">
                  <a href="modifyProfhcw2.php"><i class="glyphicon glyphicon-th-list"></i><span> Modify Profile</span></a>
                </li>
                <li class="accordion">
                  <a href="logout.php"><i class="glyphicon glyphicon-log-out"></i><span> Logout</span></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- End of Menu -->
        <div class="col-md-8 jumbotron">
          <center>
            <h2>Undergoing washing</h2>
          </center>
          <hr>
          <form method="post">
           <div class="form-group">
             <label>Confirm Boxes</label>
             <input type="text" name="boxBarcode" required class="form-control" style="width:400px;" placeholder="Scan Box Barcode" />
           </div>
           <div class="form-group">
             <input type="submit" name="confirmBoxes" class="btn btn-info" value="Allow Wash" />
           </div>
         </form>
         <?php 
         if (isset($_POST['confirmBoxes'])) {
          $status="Washed";
          $boxeCode=$_POST['boxBarcode'];

          $db->WashBoxes($status,$boxeCode);
          $status1="Confirmed";
          $db->WashedEquip($status,$status1);
          echo "<script>window.alert('Boxes are Confirmed')</script>";
        }
        ?>
      </div>
      <div class="col-md-1">

      </div>
    </div>
  </div>
  <?php
  include ("footer.php");
  ?>
  <?php
}else{
 header("Location:login.php?msg=Incorrect Information....");
}?>