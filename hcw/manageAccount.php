    <?php
    include("headermentor.php");
      //Include php barcode library
    include("barcode/Barcode39.php");
    include "../Database.php";
    $db=new Database();
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
        <div class="col-md-8">
          <div class="row jumbotron">
          <div>
            <a href="register.php" style="float:right;" class="btn btn-info">Create Account</a>
          </div>
            <h3>Manage User Account</h3>
            <table class="table table-bordered">
              <thead>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Role</th>
                <th>Actions</th>
              </thead>
              <tbody>
                <?php 
                  $stmt=$db->con->prepare("SELECT * FROM User");
                  $stmt->execute();
                  while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) { 
                    ?>
                      <tr>
                        <td><?php print($row['FullName']); ?></td>
                        <td><?php print($row['UserName']); ?></td>
                        <td><?php print($row['Role']); ?></td>
                        <td><a href="deleteAcc.php?id=<?php print($row['IDNo']); ?>" class="btn btn-danger">Delete</a></td>
                      </tr>
                    <?php
                  }
                 ?>
              </tbody>
            </table>
        </div>
      </div>
      <div class="col-md-2">
      </div>
    </div>
    <?php
    include ("footer.php");
    ?>


