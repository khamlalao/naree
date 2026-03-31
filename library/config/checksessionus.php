<?php
session_start();
if(!isset($_SESSION["cus_id"])){
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=login.php\">";
	exit();
}
?>