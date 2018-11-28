        <?php
        session_start();
        

        if (isset($_SESSION['username'])&&isset($_SESSION['fullname'])) {
          include("headermentor.php");

          //Include php barcode library
          include("barcode/Barcode39.php");
          ?>
          <div class="container">
            <div class="alert alert-success">
              <Strong>&nbsp;Welcome : &nbsp;<?php print($_SESSION['fullname']); ?></strong>

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
              <!-- <div class="col-md-3">
                <a href="mentorB.php">Manage Barcode</a><br>
                <a href="modifyProfile.php">Modify Profile</a><br>
                <a href="logout.php">Logout</a><br>
              </div> -->

              <!-- Start Menu -->
      <div class="col-sm-2">
        <div class="sidebar-nav">
          <div class="nav-canvas">
            <div class="nav-sm nav nav-stacked">

            </div>
            <ul class="nav nav-pills nav-stacked main-menu">
              <!-- <li class="nav-header">Main</li> -->
              <li><a class="ajax-link" href="scanPack.php"><i class="glyphicon glyphicon-home"></i><span> Scan Packages</span></a></li>
              <li class="accordion">
                <a href="scanBoxes.php"><i class="glyphicon glyphicon-th-list"></i><span> Scan Boxes</span></a>
              </li>
              <li class="accordion">
                <a href="modifyProfhcw1.php"><i class="glyphicon glyphicon-th-list"></i><span> Modify Profile</span></a>
              </li>
              <li class="accordion">
                <a href="logout.php"><i class="glyphicon glyphicon-log-out"></i><span> Logout</span></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- End of Menu -->
              <div class="col-md-8">
                <div class="row jumbotron">

                  <center><h2>Modify Your Profile here</h2></center>
                  <hr>
                  <br>
                  <center>
                   
                   
                 </center>
               </div>

             </div>
             <div class="col-md-2">

             </div>
           </div>
           <?php
           include "footer.php";
         }else{
           header("Location:login.php?msg=Incorrect Information....");
         }?>