<?php if( !isset( $_SESSION ) ) { session_start(); }
if( isset( $_SESSION['REMOTE_ADDR'] ) && $_SESSION['REMOTE_ADDR'] != $_SERVER['REMOTE_ADDR'] )
{ session_regenerate_id(); $_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR']; }
if( !isset( $_SESSION['REMOTE_ADDR'] ) ) { $_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR']; }
$tmpsid = session_id();
	if (!isset($_SESSION['customer_id'])) : 
		$login = false ;
	else :
		$login = true ;
	endif ;
?>