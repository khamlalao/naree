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
$gettmp["id"] = ($_GET["id"] != null) ? $_GET["id"] : null;

ADOdb_Active_Record::SetDatabaseAdapter($db);

class promotion_item extends ADOdb_Active_Record{}
$item = new promotion_item();
$item->Load("id = ? ", array($gettmp['id']));
$template->item = $item;


$template->id =  $item->id;

$template->display($render);
?>
 