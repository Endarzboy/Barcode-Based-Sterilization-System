<?php 

	include "../Database.php";
	$db=new Database();

	$db->DeleteBoxe($_GET['id']);
	header("Location:scanBoxes.php?msg=Boxe Removed successfully");
 ?>