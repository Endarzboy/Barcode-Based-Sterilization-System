<?php
if (isset($_POST['deleteImg'])) {
  // if (array_key_exists('delete_img', $_POST)) {
  $filename=$_POST['fileName'];
    if (file_exists($filename)) {
      unlink($filename);
      header("Location:mentorB.php");
    }
  // }
}
?>