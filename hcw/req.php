  <?php
  include "../Database.php";
  $msg="";
  include "../hcw/barcode/Barcode39.php";
  $db=new Database();
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
          <h3>&nbsp;&nbsp;Perform Recycle Request</h3>
          <div class="col-md-8">
            <div class="row jumbotron">
              <div class="col-md-4">

                <form method="post" action="">
                  <div class="form-group">
                    <label>Department:</label>
                    <select name="department" required class="form-control" style="width:220px; height:40px;">
                      <?php

                      $stmt=$db->con->prepare("SELECT DISTINCT DeptName FROM Department");
                      $stmt->execute();

                      while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {?>
                      <option><?php print($row['DeptName']);?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                 <label>Equipments:</label>
                 <select name="equipment" required class="form-control" style="width:220px; height:40px;">
                  <?php
                  // include "../Database.php";
                  // $db=new Database();
                  $stmt=$db->con->prepare("SELECT DISTINCT itemName FROM Equipment");
                  $stmt->execute();

                  while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {?>
                  <option><?php print($row['itemName']);?></option>
                  <?php
                }
                ?>
              </select>

            </div>
            <div class="form-group">
             <label>Category:</label>
             <select name="category" required class="form-control" style="width:220px; height:40px;">
              <?php
              $stmt=$db->con->prepare("SELECT DISTINCT cat FROM Category");
              $stmt->execute();

              while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {?>
              <option><?php print($row['cat']);?></option>
              <?php
            }
            ?>
          </select>
        </div>

      </div>
      <div class="col-md-1"></div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Quantity:</label>
          <input type="text" class="form-control" required placeholder="Quantity" style="width:280px; height:40px;" name="quantity">
        </div>
        <!-- <div class="form-group">
          <label>Barcode:</label>
          <input type="hidden" value="<?php echo mt_rand(); ?>" class="form-control" required placeholder="Barcode" style="width:280px; height:40px;" name="barcode">
        </div> -->
        <div class="form-group">
          <label>Barcode:</label>
          <input type="text" class="form-control" required placeholder="Barcode" style="width:280px; height:40px;" name="barcode">
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-info" id="bt" value="Request Recycle" name="request">
        </div>
        <!-- Generate Barcode and print it -->
        <?php
        if (isset($_POST['request'])) {

          $barcode=$_POST['barcode'];
          $equp=$_POST['equipment'];
          $dept=$_POST['department'];
          $cat=$_POST['category'];
          $status="Ready to Recycle";
          $quant=$_POST['quantity'];
          $msg=$db->Request($equp,$cat,$quant,$barcode,$dept,$status);
         echo "<script>window.alert('Request has been added')</script>";
        }
        ?>
      </form>
      <form method="post">
        <input type="submit" class="btn btn-info" id="bt" value="Generate Barcode" name="generateBC">
      </form>
    </div>
    <!-- Generate Barcode -->
    <?php 
    if (isset($_POST['generateBC'])) {

      // echo(mt_rand() . "<br>");
      $bc=mt_rand();


      ?>
      <div class="form-group" style="float:right;">
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