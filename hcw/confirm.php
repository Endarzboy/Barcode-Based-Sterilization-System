<?php 

	// include "scanPack.php";
	include "../Database.php";
	$db=new Database();

	// $barcode=$_POST['packageCode'];
	$id=$_GET['id'];
	$status="Ready to Recycle";
	$query="UPDATE Request SET Status=? WHERE ItemID=?";
	$stmt=$db->con->prepare($query);

	$stmt->bindParam(1,$status,PDO::PARAM_STR);
	$stmt->bindParam(2,$id,PDO::PARAM_STR);
	$stmt->execute();
	//echo "<script>window.alert('Report has been Sent')</script>";

	header("Location:../hcw/scanPack.php?msg=Report has been Sent");


?>