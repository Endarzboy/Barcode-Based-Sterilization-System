<?php
session_start();
include("headermentor.php");
//Include php barcode library
include("barcode/Barcode39.php");
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

    <!-- End of Menu -->
    <div class="col-md-8">
      <div class="row jumbotron">
        <h3>List of Generated Barcodes</h3>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Barcode Image</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $files=glob("images/*");
            for ($i=0; $i < count($files); $i++) { 
              $image=$files[$i];
              $supportedFiles=array(
                'gif',
                'png',
                'jpeg',
                'jpg'
                );
              $ext=strtolower(pathinfo($image,PATHINFO_EXTENSION));
              if (in_array($ext, $supportedFiles)) {
                ?>
                <tr>
                  <td><?php print($i+1);?></td>
                  <td>
                    <?php
                    echo "<form method='post'>";
                    echo "<img alt='Testing' src='".$image."' width='200px',height='60px'/>";
                    echo "<input type='hidden' value='".$image."' name='fileName'>";
                    echo "<input type='submit' onclick='javascript:window.print()' value='Print' class='btn btn-info' name='printImg'>&nbsp;&nbsp;";
                  // echo "<input type='submit' value='Delete' class='btn btn-danger' onclick='confirm('Are you sure to Delete?')' name='deleteImg'>";
                    echo "</form>";
                    ?>
                  </td>
                </tr>
                <?php
              }else{
                continue;
              }
            }
            ?>
          </tbody>
        </table>
        <?php
        if (isset($_POST['deleteImg'])) {
                  // if (array_key_exists('delete_img', $_POST)) {
          $filename=$_POST['fileName'];
          if (file_exists($filename)) {
            unlink($filename);
          //header("Location:viewBarcodes.php?msg=Barcode has been Deleted");
          }
                  // }
        }
        ?>
      </div>
    </div>

    <div class="col-md-2">
    </div>
  </div>
  <?php
  include ("footer.php");
  ?>


