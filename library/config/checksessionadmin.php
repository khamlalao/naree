<?php
if (!isset($_SESSION)) { 
  session_start();
}
if($_SESSION['admin_type'] != 1){
  echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php\">";
  exit();
}
?>