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
#print_r($_GET);
#$db->debug=1;
$gettmp['id'] = (($_GET['id'] != '')? $_GET['id'] : '');
	
//	$sql2 = "SELECT * FROM session_orders m WHERE 1 = 1 AND m.session_code = ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ";
//	$stmt2 = $db->Prepare($sql2);
//	$rs2 = $db->Execute($stmt2,array($_SESSION['session_login']));
//	$gettmp["recordCount"] = $rs2->maxRecordCount();
	
$sql = "SELECT sum(m.amount) as total_amount FROM session_orders m WHERE 1 = 1 AND m.session_code =  ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['session_login']));
$itemOrder = $rs->GetAssoc();
$gettmp['total_amount'] = $rs->fields['total_amount'];
	
    echo $gettmp['total_amount'];
?>
