<?php 

	include "../Database.php";
	$db=new Database();

	$idno=$_GET['id'];
	$db->DeleteAccount($idno);
	header("Location:../hcw/manageAccount.php?Msg=Account has been deleted");

 ?>