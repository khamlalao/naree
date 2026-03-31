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

$gettmp["parent_id"] = ($_GET["parent_id"] != null) ? $_GET["parent_id"] : 0;
$gettmp["page"] = ($_GET["page"] != null) ? $_GET["page"] : 1;
$gettmp["perpage"] = ($_GET["perpage"] != null) ? $_GET["perpage"] : 20;

$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);


$sql = "SELECT *  FROM lookbook_items m WHERE 1 = 1   AND m.parent_id = ? ORDER BY m.sequence ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($gettmp['parent_id']));
$itemList = $rs->GetAssoc();
$itemListCount = $rs->maxRecordCount();

$template->itemList = $itemList;
$template->itemListCount = $itemListCount;


class lookbook_category extends ADOdb_Active_Record{}
$lookbook_category = new lookbook_category();
$lookbook_category->load("id = ? ", array($gettmp["parent_id"]));
$template->lookbook_category = $lookbook_category;


$template->parent_id = $gettmp["parent_id"];


$template->display($render);
?>