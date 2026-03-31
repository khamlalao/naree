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

/*
if($_SESSION['member_id'] == null){ 
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=member_login.php\" />";
	exit();
}
*/

$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));


$template = new Savant3();

ADOdb_Active_Record::SetDatabaseAdapter($db);


$sql = "SELECT * FROM session_orders m WHERE 1 = 1 AND m.session_code = ?  AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ORDER BY m.pid ASC";

$stmt = $db->Prepare($sql);

$rs = $db->Execute($stmt,array($_SESSION['session_login']));
$itemOrder = $rs->GetAssoc();
$gettmp["recordCount"] = $rs->maxRecordCount();
$template->itemOrder = $itemOrder;
$template->recordCount = $gettmp["recordCount"];

$sql = "SELECT sum(m.total) as total_pay FROM session_orders m WHERE 1 = 1 AND m.session_code =  ?  AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ORDER BY m.pid ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['session_login']));
$gettmp['totalPay'] = $rs->fields['total_pay'];
$template->totalPay = $gettmp['totalPay'];


$template->display($render);
?>
 