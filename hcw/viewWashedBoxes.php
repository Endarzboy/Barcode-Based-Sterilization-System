  <?php
  include "../Database.php";
  $db=new Database();
  
  if (isset($_SESSION['username'])&&isset($_SESSION['fullname'])) {
    include("headerhcw3.php");
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
          <div class="col-sm-3">
            <div class="sidebar-nav">
              <div class="nav-canvas">
                <div class="nav-sm nav nav-stacked">

                </div>
                <ul class="nav nav-pills nav-stacked main-menu">
                  <!-- <li class="nav-header">Main</li> -->
                  <li><a class="ajax-link" href="viewWashedBoxes.php"><i class="glyphicon glyphicon-home"></i><span> View Washed Boxes</span></a></li>
                  <li class="accordion">
                    <a href="washedEquip.php"><i class="glyphicon glyphicon-th-list"></i><span> View Washed Equipments</span></a>
                  </li>
                  <li class="accordion">
                    <a href="managebc.php"><i class="glyphicon glyphicon-th-list"></i><span> Manage Barcodes</span></a>
                  </li>
                  <li class="accordion">
                    <a href="modifyProfhcw3.php"><i class="glyphicon glyphicon-th-list"></i><span> Modify Profile</span></a>
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
              <h2>List of Washed Boxes</h2>
            </center>
            <hr>
            <table class="table">
             <thead>
               <th>Boxe Barcode</th>
               <th>Status</th>
               <th>Flag</th>
             </thead>
             <tbody>
               <?php 
               $status="Washed";
               $query="SELECT * FROM Boxes WHERE status=?";
               $stmt=$db->con->prepare($query);
               $stmt->bindParam(1,$status,PDO::PARAM_STR);
               $stmt->execute();

               
               while ($rows=$stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($rows['status'] == $status) {

                  ?>
                  <tr>
                    <td><?php print($rows['BoxeCode']); ?></td>
                    <td style="color:green;font-weight:bold;"><?php print($rows['status']); ?>
                    <!-- <a href="freeboxes.php?boxID=<?php print($rows['IDNo']); ?>" class='btn btn-success'>Free Boxes</a> -->
                    </td>
                    <td><a href="freeboxes.php?boxID=<?php echo $rows['IDNo']; ?>" class="btn btn-success">Free</a></td>
                  </tr>
                  <?php 
                }
              }
              ?>
                <!-- <tr>
                  <td colspan="2"><input type="submit" name="confirmall" style="width:640px;" href="" class="btn btn-info" value="Confirm All Boxes"></a></td>
                </tr> -->
              <?php

              ?>
            </tbody>
          </table>
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