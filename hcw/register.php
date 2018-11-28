    <?php
   include "../Database.php";
    $db=new Database();
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
        <!-- Start Menu -->
        <div class="col-sm-2">
          <div class="sidebar-nav">
            <div class="nav-canvas">
              <div class="nav-sm nav nav-stacked">

              </div>
              <ul class="nav nav-pills nav-stacked main-menu">
                <!-- <li class="nav-header">Main</li> -->
                <li><a class="ajax-link" href="mentorB.php"><i class="glyphicon glyphicon-home"></i><span> Manage Barcodes</span></a></li>
                <li class="accordion">
                  <a href="viewBarcodes.php"><i class="glyphicon glyphicon-th-list"></i><span> View Barcodes</span></a>
                </li>
                <li class="accordion">
                  <a href="manageAccount.php"><i class="glyphicon glyphicon-th-list"></i><span> Manage Account</span></a>
                </li>
                <li class="accordion">
                  <a href="modifyProfMentor.php"><i class="glyphicon glyphicon-th-list"></i><span> Modify Profile</span></a>
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
            <div>
              <a href="manageAccount.php" style="float:right;" class="btn btn-info">View Account</a>
            </div>
            <h3>Create User Account</h3>
            <form method="post" action="">

              <div class="col-md-4">
                <div class="form-group">
                  <label for="barcodes">Full Name</label>
                  <input type="text" class="form-control" required style="width:240px;" id="bc" placeholder="Full Name" name="fullname">
                </div>
                <div class="form-group">
                  <label for="barcodes">User Name</label>
                  <input type="text" class="form-control" required style="width:240px;" id="bc" placeholder="User Name" name="username">
                </div>
                <div class="form-group">
                  <label for="barcodes">Password</label>
                  <input type="password" class="form-control" required style="width:240px;" id="bc" placeholder="Password" name="password">
                </div>
              </div>
              <div class="col-md-1"></div>
              <div class="col-md-4">
                <div class="form-group">
                 <label>Role</label>
                 <select name="role" required class="form-control" style="width:240px; height:40px;">

                  <option value="Department">Department</option>
                  <option value="hcw1">HCW1</option>
                  <option value="hcw2">HCW2</option>
                  <option value="hcw3">HCW3</option>
                  <option value="hcw4">HCW4</option>
                  <option value="hcw5">HCW5</option>
                  <option value="Mentor">Mentor</option>
                </select>

              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-info" id="bt" value="Create Account" name="create">              
              </div>
            </div>
          </form>
          <?php
          if (isset($_POST['create'])) {

            $fullname=$_POST['fullname'];
            $username=$_POST['username'];
            $password=$_POST['password'];
            $role=$_POST['role'];

            $db->Register($fullname,$username,$password,$role);
            
          }
          ?>
        </div>
      </div>
      <div class="col-md-2">
      </div>
    </div>
    <?php
    include ("footer.php");
    ?>


