  <?php
  session_start();
  
  if (isset($_SESSION['username'])) {
  	include("header.php");
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
        <div class="row">
          
          <!-- Start Menu -->
              <div class="col-sm-2">
                <div class="sidebar-nav">
                  <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                      <!-- <li class="nav-header">Main</li> -->
                      <li><a class="ajax-link" href="request.php"><i class="glyphicon glyphicon-home"></i><span> Request Recycle</span></a></li>
                      <li class="accordion">
                      <a href="viewRequest.php"><i class="glyphicon glyphicon-th-list"></i><span> View Request</span></a>
                      </li>
                      <li class="accordion">
                        <a href="modifyProf.php"><i class="glyphicon glyphicon-th-list"></i><span> Modify Profile</span></a>
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
            <div class="jumbotron">
              <center><h2>Modify Your Profile here</h2></center>
              <hr>
              <br>
              
            </div>
          </div>
          <div class="col-md-2">

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