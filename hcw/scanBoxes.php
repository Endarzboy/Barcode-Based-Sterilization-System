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
      <div class="col-md-8">
        <div class="row jumbotron">
          <h2>Scan and Save Each Boxes</h2>

          <form method="post" action="">
            <div class="form-group">
              <label for="packCode">Box Barcode:</label>
              <input type="text" class="form-control" id="text" placeholder="Box Barcode" name="boxCode">
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-info" id="bt" value="Confirm Boxes" name="confirm">
              <input style="float:right;" type="submit" class="btn btn-info" id="bt" value="View Boxes" name="viewBox">
            </div>

          </form>
          <!-- View Packages -->
          <?php 
          if (isset($_POST['viewBox'])) {

            $query="SELECT * FROM Boxes";
            $stmt=$db->con->prepare($query);
            $stmt->execute();

            ?>
            <!-- View point -->
            <div class="panel-group">
              <div class="panel panel-info">
                <div class="panel-heading">View Boxe Info</div>
                <div class="panel-body">

                 <table class="table table-bordered">
                  <thead>
                    <th>Box Barcode</th>
                    <th><center>Status</center></th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    <?php 
                    $count=0;

                    // $query="SELECT * FROM Boxes WHERE BoxeCode=?";
                    // $stmt=$db->con->prepare($query);
                    // $stmt->bindParam(1,$_POST['boxCode']);
                    $query="SELECT * FROM Boxes";
                    $stmt=$db->con->prepare($query);
                    $stmt->execute();


                    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                     
                      $ns="Ready";
                    if ($row['status'] == $ns) {
                       $count++;
                      ?>
                      <tr>
                        <td><?php print($row['BoxeCode']); ?></td>
                        <td style="color:blue; font-weight:bold;font-face:bold;"><center><?php print($row['status']); ?></center></td>
                        <td><a class="btn btn-danger" href="deleteBox.php?id=<?php print($row['IDNo']); ?>" onclick='confirm("Are you sure to delete?")'><i class="glyphicon glyphicon-trash"></i></a></td>
                      </tr>
                      <?php
                    }
                    }
                    ?>
                    <?php 
                    ?>
                    <tr style="background:skyblue;">
                      <td>
                        <b><?php print("Total of Boxes: "); ?></b>
                      </td>
                      <td style="color:red;"><b><center><?php print($count); ?></center></b></td>
                    </tr>
                    <?php
                    ?>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
          <?php
        }
        ?>
        <!-- Confirm Boxes by Scanning Barcode -->
        <?php if (isset($_POST['confirm']) && !empty($_POST['boxCode'])) {
            // Change the status of the recycled equipments
          $barcode=$_POST['boxCode'];
          $status="Ready";
          $query="INSERT INTO Boxes(BoxeCode,status) VALUES(?,?)";
          $stmt=$db->con->prepare($query);

          $stmt->bindParam(1,$barcode,PDO::PARAM_STR);
          $stmt->bindParam(2,$status,PDO::PARAM_STR);
          $stmt->execute();

          ?>
          <div class="panel-group">
            <div class="panel panel-info">
              <div class="panel-heading">View Boxe Info</div>
              <div class="panel-body">

               <table class="table table-bordered">
                <thead>
                  <th>Box Barcode</th>
                  <th><center>Status</center></th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php 
                  $count=0;

                    // $query="SELECT * FROM Boxes WHERE BoxeCode=?";
                    // $stmt=$db->con->prepare($query);
                    // $stmt->bindParam(1,$_POST['boxCode']);
                  $query="SELECT * FROM Boxes";
                  $stmt=$db->con->prepare($query);
                  $stmt->execute();


                  while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                    
                    $ns="Ready";
                    if ($row['status'] == $ns) {
                      $count++;
                    ?>
                    <tr>
                      <td><?php print($row['BoxeCode']); ?></td>
                      <td><center><?php print($row['status']); ?></center></td>
                      <td><a class="btn btn-danger" href="deleteBox.php?id=<?php print($row['IDNo']); ?>">Remove</a></td>
                    </tr>
                    <?php
                     }
                  }
                  ?>
                  <?php 
                  ?>
                  <tr style="background:skyblue;">
                    <td>
                      <b><?php print("Total of Boxes: "); ?></b>
                    </td>
                    <td style="color:red;"><b><center><?php print($count); ?></center></b></td>
                  </tr>
                  <?php
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