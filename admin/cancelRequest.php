<?php 
include "../Database.php";
$db=new Database();
$db->CancelRequest($_GET['id']);
header("Location:viewRequest.php?message=Request has been canceled");
 ?>