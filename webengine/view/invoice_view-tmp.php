<?php
require_once "common.inc.php";
require_once DIR."library/config/sessionstart.php";
//require_once DIR."library/config/checksessionlogin.php";
require_once DIR."library/adodb5/adodb.inc.php";
require_once DIR."library/adodb5/adodb-active-record.inc.php";
require_once DIR."library/config/config.php";
require_once DIR."library/config/connect.php";
require_once DIR."library/extension/extension.php";
require_once DIR."library/extension/utility.php";
require_once DIR."library/extension/lang.php";
require_once DIR."library/config/rewrite.php";
require_once DIR."library/Savant3.php";
?>
<?php
#$db->debug = 1;

$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$gettmp["id"] = ($_GET["id"] != null) ? $_GET["id"] : 0;

$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);


class invoice_order extends ADOdb_Active_Record{}
$invoice = new invoice_order();
$invoice->load("id = ? ", array($gettmp["id"]));
$template->invoice = $invoice;


class members_profile extends ADOdb_Active_Record{}
$members_profile = new members_profile();
$members_profile->load("id = ? ", array($invoice->member_id));
$template->members_profile = $members_profile;


class members_location extends ADOdb_Active_Record{}
$members_location = new members_location();
$members_location->load("id = ? ", array($invoice->location_shipping));
$template->members_location = $members_location;


$sql = "SELECT *  FROM session_orders m WHERE 1 = 1 AND m.invoice_id = ? ORDER BY  m.id DESC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($invoice->invoice_id));	
$itemList = $rs->GetAssoc();
$itemListCount = $rs->maxRecordCount();

$template->itemList = $itemList;
$template->itemListCount = $itemListCount;



$template->display($render);
?>