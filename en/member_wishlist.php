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
$gettmp["id"] = ($_GET["id"] != null) ? $_GET["id"] : null;

ADOdb_Active_Record::SetDatabaseAdapter($db);


$sql = "SELECT * FROM session_wishlists m WHERE 1 = 1 AND m.pid = ? AND m.member_id = ? ";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt, array($gettmp['id'],$_SESSION['member_id']));
$listImage = $rs->GetAssoc();
$gettmp["recordCount"] = $rs->maxRecordCount();


class session_wishlist extends ADOdb_Active_Record{}


if(($_SESSION['member_id'] != null)&&($gettmp["id"] != '')&&($_GET['do'] != 'delete')){ 
$item = new session_wishlist();
$item->member_id = $_SESSION['member_id'];
$item->pid = $gettmp["id"];
$item->created_date = date("Y-m-d");
if($gettmp["recordCount"] == 0){ $item->save(); }
}

if($_GET['do'] == 'delete'){ 
$session_wishlist = new session_wishlist();
$session_wishlist->load("member_id = ? AND pid = ? ", array($_SESSION['member_id'],$gettmp["id"]));
$session_wishlist->delete();
}

$sql = "SELECT * FROM product_items INNER JOIN session_wishlists ON session_wishlists.pid = product_items.id WHERE session_wishlists.member_id = ? ";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt, array($_SESSION['member_id']));
$listWishlist = $rs->GetAssoc();
$template->listWishlist = $listWishlist;


$template->display($render);
?>
 