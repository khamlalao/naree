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
if($_SESSION['session_login']== null){ 
echo "<meta http-equiv=\"refresh\" content=\"0;URL=member_login.php\" />"; 
}
?>
<?php
global $db;
#$db->debug=1;
$gettmp['id'] = ($_GET["id"] != null) ? $_GET["id"] : null;
$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$template = new Savant3();

$sql = "SELECT * FROM location_zones m WHERE 1 = 1 AND m.status = 1 ORDER BY m.id ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt);
$itemList = $rs->GetAssoc();
$gettmp["recordCount"] = $rs->maxRecordCount();

$template->itemList = $itemList;
$template->itemListCount = $gettmp["recordCount"];

ADOdb_Active_Record::SetDatabaseAdapter($db);
class members_location extends ADOdb_Active_Record{}
$item = new members_location();
$item->load("id= ?", array($gettmp['id']));
$template->item = $item;



$template->display($render);
?>
 