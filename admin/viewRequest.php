  <?php
  include "../Database.php";
  
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
          <div class="col-md-8 jumbotron">
            <h3>View Recycle Requests</h3>
            <table class="table table-bordered">
              <thead>
                <th>Equipment</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Barcode</th>
                <th>Department</th>
                <th>Status</th>
                <th>Actions</th>
              </thead>
              <tbody>
                <?php 

                $db=new Database();
                $stmt=$db->con->prepare("SELECT * FROM Request");
                $stmt->execute();

                while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <tr>
                    <td><?php print($row['ItemName']); ?></td>
                    <td><?php print($row['Category']); ?></td>
                    <td><?php print($row['Quantity']); ?></td>
                    <td><?php print($row['ItemBarcode']); ?></td>
                    <td><?php print($row['Department']); ?></td>
                    <td style="font-weight:bold; color:red;"><?php print($row['Status']); ?></td>
                    <td>
                      <a href="cancelRequest.php?id=<?php print($row['ItemID']);?>" class="btn btn-warning"><i
                            class="glyphicon glyphicon-remove"></i></a>
                    </td>
                  </tr>
                  <?php
                }

                ?>
              </tbody>
            </table>
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