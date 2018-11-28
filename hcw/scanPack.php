  <?php
  include("../Database.php");
  include("headerhcw1.php");
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
      <div class="col-md-8 jumbotron">
        <div class="row">
          <h2>Scan and Confirm Packages</h2>
          <form method="post" action="">
            <div class="form-group">
              <label for="packCode">Package Barcode:</label>
              <input type="text" class="form-control" id="text" placeholder="Package Barcode" name="packageCode">
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-info" id="bt" value="Accept Packages" name="accept">
              <!-- <a href="scanBoxes.php" class="btn btn-info">Next</a> -->
            </div>

          </form>
          <!-- View Packages -->
          <?php if (isset($_POST['accept']) && !empty($_POST['packageCode'])) {
            // Change the status of the recycled equipments
            $barcode=$_POST['packageCode'];
            $status="Confirmed";
            $query="UPDATE Request SET Status=? WHERE ItemBarcode=?";
            $stmt=$db->con->prepare($query);

            $stmt->bindParam(1,$status,PDO::PARAM_STR);
            $stmt->bindParam(2,$barcode,PDO::PARAM_STR);
            $stmt->execute();
            ?>
            <div class="panel-group">
              <div class="panel panel-info">
                <div class="panel-heading">View Package Info</div>
                <div class="panel-body">

                 <table class="table table-bordered">
                  <thead>
                    <th>Equipment</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Barcode</th>
                    <th>Department</th>
                    <th>Status</th>
                    <!-- <th>Actions</th> -->
                  </thead>
                  <tbody>
                    <?php 

                    $query="SELECT * FROM Request WHERE ItemBarcode=?";
                    $stmt=$db->con->prepare($query);
                    $stmt->bindParam(1,$_POST['packageCode']);
                    $stmt->execute();

                    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <tr>
                        <td><?php print($row['ItemName']); ?></td>
                        <td><?php print($row['Category']); ?></td>
                        <td><?php print($row['Quantity']); ?></td>
                        <td><?php print($row['ItemBarcode']); ?></td>
                        <td><?php print($row['Department']); ?></td>
                        <td style="font-style: Italic; font-weight:bold; color:red;"><?php print($row['Status']); ?></td>
                        <td>
                          <a href="confirm.php?id=<?php print($row['ItemID']);?>" class="btn btn-warning">Report</a>
                          <!-- <form method="post">
                            <input type="submit" class="btn btn-info" id="bt" value="Report" name="report">
                          </form> -->
                        </td> 
                      </tr>
                      <?php
                    }

                    // Confirm packed item once check all devices
                    if (isset($_POST['report'])) {
                      $barcode=$_POST['packageCode'];
                      $status="Ready to Recycle";
                      $query="UPDATE Request SET Status=? WHERE ItemBarcode=?";
                      $stmt=$db->con->prepare($query);

                      $stmt->bindParam(1,$status,PDO::PARAM_STR);
                      $stmt->bindParam(2,$barcode,PDO::PARAM_STR);
                      $stmt->execute();
                    }

                    ?>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="col-md-2">

      </div>
    </div>
    <?php
    include ("footer.php");
    ?>