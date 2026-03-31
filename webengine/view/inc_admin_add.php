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
global $db;
#$db->debug = 1;

$render = "inc_admin_add.tpl.php";
$gettmp["do"] = ($_GET["do"] != null) ? $_GET["do"] : "";
$gettmp["menu"] = ($_GET["menu"] != null) ? $_GET["menu"] : "";

$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);
class admin_info extends ADOdb_Active_Record{}
$admin_info = new admin_info();
$template->admin_info = $admin_info;

$template->do = $gettmp["do"];
$template->menu = $gettmp["menu"];

$template->display($render);
?>