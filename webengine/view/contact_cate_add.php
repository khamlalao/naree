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
$gettmp["parent_id"] = ($_GET["parent_id"] != null) ? $_GET["parent_id"] : null;
$gettmp["sub"] = ($_GET["sub"] != null) ? $_GET["sub"] : null;
$gettmp["mn"] = ($_GET["mn"] != null) ? $_GET["mn"] : null;


$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);

$template->menu = $gettmp["menu"];
$template->parent_id = $gettmp["parent_id"];
$template->sub = $gettmp["sub"];
$template->mn = $gettmp["mn"];

$template->do = $gettmp["do"];

$template->display($render);
?>