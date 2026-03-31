<?php session_start();
	$tmpuid = session_id();
	if (!isset($_SESSION['adminid'])) : 
		$login = false ;
	else :
		$login = true ;
	endif ;
?>