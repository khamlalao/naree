<?php
require_once "common.inc.php";
require_once DIR."library/config/sessionstart.php";
require_once DIR."library/adodb5/adodb.inc.php";
require_once DIR."library/adodb5/adodb-active-record.inc.php";
require_once DIR."library/class/class.GenericEasyPagination.php";
require_once DIR."library/config/config.php";
require_once DIR."library/config/connect.php";
require_once DIR."library/extension/extension.php";
require_once DIR."library/extension/utility.php";
require_once DIR."library/extension/lang.php";
require_once DIR."library/config/rewrite.php";
require_once DIR."library/Savant3.php";
?>
<?php 
global $db;
//print_r($_GET);
#$db->debug=1;
$gettmp['rate'] = (($_GET['rate'] != '')? $_GET['rate'] : '');

	$sql2 = "SELECT sum(m.total) as total_pay FROM session_orders m WHERE 1 = 1 AND m.session_code =  ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ORDER BY m.pid ASC";
	$stmt2 = $db->Prepare($sql2);
	$rs2 = $db->Execute($stmt2,array($_SESSION['session_login']));
	
	if($gettmp['rate'] == 'USD'){
    echo number_format($rs2->fields['total_pay'],2);
	}else{
	echo Lang::eXchangeRate('lak',$rs2->fields['total_pay']);	
	}
?>
