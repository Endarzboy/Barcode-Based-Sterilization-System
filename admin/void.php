  <?php
  include "../Database.php";
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
        <div class="row well">
          <div class="col-md-2">
            <a href="request.php">Request Recycle</a><br>
            <a href="viewRequest.php">View Request</a><br>
          </div>
          <div class="col-md-10">
            <div class="col-md-6">
              <h2>Perform Recycle Request</h2>
              <br>
              <form method="post" action="">
                <div class="form-group">
                  <label>Department:</label>
                  <select name="department" class="form-control" style="width:220px; height:40px;">
                    <?php

                    $stmt=$db->con->prepare("SELECT * FROM Department");
                    $stmt->execute();

                    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {?>
                    <option value="items"><?php print($row['DeptName']);?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
               <label>Equipments:</label>
               <select name="equipment" class="form-control" style="width:220px; height:40px;">
                <?php
                  // include "../Database.php";
                  // $db=new Database();
                $stmt=$db->con->prepare("SELECT * FROM Request");
                $stmt->execute();

                while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {?>
                <option value="items"><?php print($row['ItemName']);?></option>
                <?php
              }
              ?>
            </select>

          </div>
          <div class="form-group">
           <label>Category:</label>
           <select name="category" class="form-control" style="width:220px; height:40px;">
            <?php
            $stmt=$db->con->prepare("SELECT DISTINCT Category FROM Request");
            $stmt->execute();

            while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {?>
            <option value="catagory"><?php print($row['Category']);?></option>
            <?php
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label>Quantity:</label>
        <input type="text" class="form-control" placeholder="Quantity" style="width:230px; height:40px;" name="quantity">
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-success" id="bt" value="Request Recycle" name="request">
      </div>

    </form>
  </div>
  <div class="col-md-4">
    <form method="post">
      <div class="form-group">
        <label>Generate Barcode:</label>
        <input type="text" class="form-control" placeholder="Barcode" style="width:230px; height:40px;" name="barcode">
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-info" id="bt" style="width:230px;" value="Generate Barcode" name="generateBCs">
      </div>
    </form>
    <!-- Generate Barcode and print it -->
    <?php
    if (isset($_POST['generateBCs'])) {

      $barcode=$_POST['barcode'];
                  // set object
      // $bc = new Barcode39($barcode);

      //             // set text size
      // $bc->barcode_text_size = 5;

      //             // set barcode bar thickness (thick bars)
      // $bc->barcode_bar_thick = 4;

      //             // set barcode bar thickness (thin bars)
      // $bc->barcode_bar_thin = 2;

      //             // save barcode GIF file
      // $img=$bc->draw("images/".$barcode.".png");

      if (!empty($barcode)) {

       ?>
       <table class="table table-bordered">
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
              <?php print("<img alt='Testing' src='barcode/barcode.php?codetype=Code39&size=40&text=".$barcode."&print=true'/>");?>
              <a href="javascript:window.print()" class="btn btn-info">Print</a>
            </td>
          </tr>
        </tbody>
      </table>
      <?php
    }
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