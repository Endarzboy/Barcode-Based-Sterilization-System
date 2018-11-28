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
          <div class="col-md-9 well">
            <center>
              <h2>List of Washed Equipments</h2>
            </center>
            <hr>
            <table class="table table-bordered">
              <thead>
               <th>Barcode</th>
               <th>Name</th>
               <th>Quantity</th>
               <th>Department</th>
               <th>Status</th>
             </thead>
             <tbody>
               <?php 
               $status="Washed";
               $query="SELECT * FROM Request WHERE Status=?";
               $stmt=$db->con->prepare($query);
               $stmt->bindParam(1,$status,PDO::PARAM_STR);
               $stmt->execute();

               
               while ($rows=$stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($rows['Status'] == $status) {

                  ?>
                  <tr>
                    <td><?php print($rows['ItemBarcode']); ?></td>
                    <td><?php print($rows['ItemName']); ?></td>
                    <td><?php print($rows['Quantity']); ?></td>
                    <td><?php print($rows['Department']); ?></td>
                    <!-- <td><img src="image/<?php print($rows['image']); ?>" class='img-rounded' width='80px' height='80px'/></td> -->
                    <td style="color:green;font-weight:bold;"><?php print($rows['Status']); ?></td>
                    <!-- <td><a href="" class="btn btn-success"><i class="glyphicon glyphicon-right"></i></a></td> -->
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
      <!--   <div class="col-md-1">

        </div> -->
      </div>
    </div>
    <?php
    include ("footer.php");
    ?>
    <?php
  }else{
   header("Location:login.php?msg=Incorrect Information....");
 }?>