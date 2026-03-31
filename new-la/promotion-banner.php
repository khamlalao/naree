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

ADOdb_Active_Record::SetDatabaseAdapter($db);

// Set pagination parameters
$gettmp['perpage'] = 10; // Number of items per page
$gettmp['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page

// status 1 = 'la' , 2 = 'en' , 3 = 'all'
$sql = "SELECT * FROM promotion_items m WHERE 1 = 1 AND m.status != '0' ORDER BY m.created_date DESC";
$stmt = $db->Prepare($sql);
$rs = $db->PageExecute($stmt, $gettmp['perpage'], $gettmp['page']);
$itemList = $rs->GetAssoc();
$gettmp['recordCount'] = $rs->maxRecordCount();

$template->itemList = $itemList;
$template->itemListCount = $gettmp['recordCount'];


$template->display($render);
?>
 