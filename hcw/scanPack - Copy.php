  <?php
  include("../Database.php");
  if (isset($_SESSION['username'])&&isset($_SESSION['fullname'])) {
  	include("headerhcw1.php");
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
        <div class="col-md-2">
          <a href="scanPack.php">Scan Packed Items</a><br>
          <a href="scanBoxes.php">Scan Boxes</a><br>
          <a href="modifyProfile.php">Modify Profile</a><br>
          <a href="logout.php">Logout</a><br>
        </div>
        <div class="col-md-7">
          <div class="row">
            <h2>Scan and Save Each Packages</h2>
            <?php

            $db=new Database();

            if (isset($_POST['confirm'])) {
              $barcode=$_POST['packCode'];
              $status="Confirmed";

              if (!empty($barcode)) {
                $db->ConfirmPackages($barcode,$status);
              }

            }

            ?>

            <form method="post" action="">
              <div class="form-group">
                <label for="packCode">Package Barcode:</label>
                <input type="text" class="form-control" id="text" placeholder="Package Barcode" name="packCode">
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-success" id="bt" value="Confirm" name="confirm">
                <!-- <a href="scanBoxes.php" class="btn btn-info">Next</a> -->
              </div>

            </form>
            <!-- View Packages -->
            <div class="panel-group">
              <div class="panel panel-info">
                <div class="panel-heading">View Package Info</div>
                <div class="panel-body">
                 <table class="table table-striped table-hover ">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Package Barcode</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $db=new Database;
                    $query="SELECT * FROM Packages";
                    $stmt=$db->con->prepare($query);
                    $stmt->execute();
                    if ($stmt->rowCount()>0) {
                      while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tbody>
                          <tr>

                            <td><?php echo $row['packID']; ?></td>
                            <td><?php echo $row['PackageBarcode']; ?></td>
                            <!-- <td><img src="imgs/<?php echo $row['photo']; ?>" class='img-rounded' width='80px' height='80px'></td> -->
                            <td><?php echo $row['status']; ?></td>
                        <!-- <td><a class="btn btn-primary" href="editTraining.php?editID=<?php echo $row['id']; ?>">Edit</a></td>
                        <td><a class="btn btn-success" href="viewEach.php?viewID=<?php echo $row['id']; ?>">View</a></td>
                        <td><a class="btn btn-danger" href="deleteTraining.php?deleteID=<?php echo $row['id']; ?>">Delete</a></td> -->
                      </tr>
                    </tbody>
                    <?php
                  }

                }

                ?>
              </tbody>
            </table> 
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">

  </div>
</div>
<?php
include ("footer.php");
?>
<?php
}else{
 header("Location:login.php?msg=Incorrect Information....");
}?>