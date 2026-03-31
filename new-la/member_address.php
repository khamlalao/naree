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
#$db->debug=1;

$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$template = new Savant3();


ADOdb_Active_Record::SetDatabaseAdapter($db);
$sql = "SELECT * FROM members_locations m WHERE 1 = 1 AND m.member_id = ? ORDER BY m.id ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['member_id']));
$itemList = $rs->GetAssoc();
$gettmp["recordCount"] = $rs->maxRecordCount();

$template->itemList = $itemList;
$template->itemListCount = $gettmp["recordCount"];


$sql = "SELECT sum(m.amount) as total_amount FROM session_orders m WHERE 1 = 1 AND m.session_code =  ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ";
	$stmt = $db->Prepare($sql);
	$rs = $db->Execute($stmt,array($_SESSION['session_login']));
	$itemOrder = $rs->GetAssoc();
	$gettmp['total_amount'] = $rs->fields['total_amount'];
	
	if($gettmp['total_amount'] > 0){
	$template->url_next = "cart_session.php";
		
	}else{
		
	$template->url_next = "products.php";
	}


$template->display($render);
?>
 