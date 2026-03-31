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
$gettmp["id"] = ($_GET["id"] != null) ? $_GET["id"] : '';
$gettmp["mn"] = ($_GET["mn"] != null) ? $_GET["mn"] : null;


$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);


    class contactus_contact extends ADOdb_Active_Record{}
    $item = new contactus_contact();
    $item->load("id = ?", array($gettmp["id"]));
	$item->readed_status = '1';
	$item->Replace();
	$template->item = $item;
	

    class contactus_category extends ADOdb_Active_Record{}
    $contactus_category = new contactus_category();
    $contactus_category->load("id = ?", array($item->parent_id));
	$template->contactus_category = $contactus_category;
	
	//contactus_list.php?id=1&mn=15&menu=Q29udGFjdCBDYXRlZ29yeQ
	
$template->url = "contactus_list.php?id=".$item->parent_id."&mn=15&menu=Q29udGFjdCBDYXRlZ29yeQ";

$template->menu = $gettmp["menu"];
$template->mn = $gettmp["mn"];
$template->id = $item->id;

$template->display($render);
?>