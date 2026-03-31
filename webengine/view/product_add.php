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


$gettmp["do"] = ($_GET["do"] != null) ? $_GET["do"] : "";
$gettmp["menu"] = ($_GET["menu"] != null) ? $_GET["menu"] : "";
$gettmp["id"] = ($_GET["id"] != null) ? $_GET["id"] : 0;
$gettmp["parent_id"] = ($_GET["parent_id"] != null) ? $_GET["parent_id"] : null;

$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);

class product_category extends ADOdb_Active_Record{}
$category = new product_category();
$category->load("id = ? ", array($gettmp["parent_id"]));
$template->category = $category;


  $sql = "SELECT Count(product_items.id) AS amout FROM product_items WHERE product_items.parent_id = ".$gettmp["parent_id"];
  $stmt = $db->Prepare($sql);
  $rs = $db->Execute($stmt);
  $template->listItemCount = $rs->fields["amout"];
  $gettmp["sequence"] = $rs->fields["amout"] + 1;
  $template->sequence = $gettmp["sequence"];



$template->id = $gettmp["id"];
$template->do = $gettmp["do"];
$template->menu = $gettmp["menu"];
$template->parent_id = $gettmp["parent_id"];

$template->display($render);
?>
