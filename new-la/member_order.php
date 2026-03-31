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

if($_SESSION['member_id'] == null){ 
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=member_login.php\" />";
	exit();
}

$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));


$template = new Savant3();

ADOdb_Active_Record::SetDatabaseAdapter($db);


$sql = "SELECT * FROM invoice_orders m WHERE 1 = 1 AND m.member_id = ? ORDER BY m.id ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['member_id']));
$invoiceOrder = $rs->GetAssoc();
$gettmp["recordCount"] = $rs->maxRecordCount();

$template->invoiceOrder = $invoiceOrder;
$template->invoiceCount = $gettmp["recordCount"];

$template->display($render);
?>
 