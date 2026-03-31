<?php
require_once "common.inc.php";
//require_once DIR."library/config/sessionstart.php";
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

$gettmp["menu"] = urlsafe_b64decode($_GET['menu']);

$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);

$sql = "SELECT Count(banner_items.id) AS amout FROM banner_items";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt);
$template->listItemCount = $rs->fields["amout"];
$gettmp["sequence"] = $rs->fields["amout"] + 1;
$template->sequence = $gettmp["sequence"];

$template->menu = $gettmp["menu"];

$template->do = $gettmp["do"];

$template->display($render);
?>