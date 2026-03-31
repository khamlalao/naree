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
//$db->debug = 1;

$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$gettmp["id"] = ($_GET["id"] != null) ? $_GET["id"] : '';

$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);


$sql = "SELECT *  FROM contactus_contacts m WHERE 1 = 1 AND m.parent_id = ? ORDER BY m.id ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($gettmp["id"]));
$itemList = $rs->GetAssoc();
$itemListCount = $rs->maxRecordCount();

$template->itemList = $itemList;
$template->itemListCount = $itemListCount;

class contactus_category extends ADOdb_Active_Record{}
$contactus_category = new contactus_category();
$contactus_category->load("id = ? ", array($gettmp["id"]));
$template->contactus_category = $contactus_category;
 
$template->id = $gettmp["id"];
$template->parent_id = $gettmp["id"];

$template->display($render);
?>