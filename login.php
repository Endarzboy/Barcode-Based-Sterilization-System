  <?php
  include("header.php");

  include("Database.php");

  
  if (isset($_POST['login'])) {
    $db=new Database();
    $uname=$_POST['userName'];
    $pass=$_POST['password'];

    if (!empty($uname)&& !empty($pass)) {
      $db->login($uname,$pass);
    }
  }
  ?>

  <div class="container">
  	<div class="row">
  		<div class="col-md-3">

  		</div>

  		<div class="col-md-6">
  			<h2>Login to grant access</h2>
        
  			<div class="jumbotron">
  				<form action="" method="post">
  					<div class="form-group">
  						<label for="userName">User Name:</label>
  						<input type="text" class="form-control" id="text" placeholder="Enter User Name" name="userName">
  					</div>
  					<div class="form-group">
  						<label for="pwd">Password:</label>
  						<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
  					</div>
  				<!-- <div class="checkbox">
  					<label><input type="checkbox" name="remember"> Remember me</label>
  				</div> -->
  				<input type="submit" value="Login" name="login" class="btn btn-info">
  			</form>
  		</div>
  	</div>

  	<div class="col-md-3">

  	</div>
  </div>
</div>

<?php
include ("inc/footer.php");
?>