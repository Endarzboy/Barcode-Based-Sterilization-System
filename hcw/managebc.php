  <?php
  include "../Database.php";
  // include "barcode/barcode.php";
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
              <h2>Generate and Print Barcodes</h2>
            </center>
            <form method="post" action="">

              <div class="form-group">
                <input type="submit" style="width:200px; height:50px; font-size:20px;" class="btn btn-info" id="bt" value="Generate Barcode" name="generate">
                <!-- <input type="submit" style="float: right; width:200px; height:50px; font-size:20px;" class="btn btn-info" id="bt" value="View Barcodes" name="viewBC">        -->       
              </div>
            </form>
            <?php
        if (isset($_POST['generate'])) {

          $bc=mt_rand();


          ?>
          <div class="form-group">
            <table class="table table-bordered" style="width:283px;">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Barcode Image</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>
                    <?php print("<img alt='Testing' src='barcode/barcode.php?codetype=Code39&size=40&text=".$bc."&print=true'/>");?>
                    <a href="javascript:window.print()" class="btn btn-info">Print</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <?php
        }
        ?>
          </div>
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