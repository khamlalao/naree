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
$gettmp['action'] = (($_GET['action'] != '')? $_GET['action'] : '');
$gettmp['amount'] = (($_GET['amount'] != '')? $_GET['amount'] : '');

if($_SESSION['session_login'] == NULL){
	$_SESSION['session_login'] = session_id();
}

if($gettmp['action'] == 'additem'){
	$sql = "SELECT * FROM product_items WHERE 1 = 1 AND product_items.id =  ? ";
	$stmt = $db->Prepare($sql);
	$rs = $db->Execute($stmt,array($gettmp['id']));
	
	$sql2 = "SELECT * FROM session_orders m WHERE 1 = 1 AND m.session_code =  ? AND m.pid = ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ";
	$stmt2 = $db->Prepare($sql2);
	$rs2 = $db->Execute($stmt2,array($_SESSION['session_login'],$gettmp['id']));
	$gettmp["recordCount"] = $rs2->maxRecordCount();
	
	ADOdb_Active_Record::SetDatabaseAdapter($db);
	class session_order extends ADOdb_Active_Record{}
	$session_order = new session_order();
	if($gettmp["recordCount"] != 0){
	$session_order->Load("id = ? ", array($rs2->fields['id']));		
	}
	$session_order->session_code = ($_SESSION['session_login'] != '') ? $_SESSION['session_login'] : '';
	$session_order->member_id = ($_SESSION["member_id"] != '') ? $_SESSION['member_id'] : null;
	$session_order->pid = $rs->fields['id'];
	$session_order->pname = $rs->fields['title_en'];
	$session_order->amount = $gettmp['amount'];
	$session_order->discount = $rs->fields['discount'];
	$session_order->unit_price = $rs->fields['price'];
	$gettmp['unit_price'] = ($rs->fields['discount'] != '') ? $rs->fields['discount'] : $rs->fields['price'];
	$session_order->total = $gettmp['amount']*$gettmp['unit_price'];	
	$session_order->Replace();
}
?>