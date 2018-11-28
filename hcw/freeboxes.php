<?php 

	include "../Database.php";
	$db=new Database();
		 //Confirm all boxes and free them
	
			$status="Ready for Service";
			$boxID=$_GET['boxID'];
			$db->free($status,$boxID);
			
	header("Location:../hcw/viewWashedBoxes.php");

?>