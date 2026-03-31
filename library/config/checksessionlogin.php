<?php
if (!isset($_SESSION)) { 
  session_start();
}
if(!isset($_SESSION['adminid'])){
  echo "<meta http-equiv=\"refresh\" content=\"0; URL=login.php\">";
  exit();
}
?>