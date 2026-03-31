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

class product_item extends ADOdb_Active_Record{}
$item = new product_item();
$item->Load("id = ? ", array($gettmp['id']));
$template->item = $item;

class product_category extends ADOdb_Active_Record{}
$category = new product_category();
$category->Load("id = ? ", array($item->parent_id));
$template->category = $category;

// status 1 = 'la' , 2 = 'en' , 3 = 'all'
$sql = "SELECT * FROM product_galleries m WHERE 1 = 1 AND m.parent_id = ?  AND (m.status = '1' OR  m.status = '2') ORDER BY m.sequence ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt, array($gettmp['id']));
$listImage = $rs->GetAssoc();
$gettmp["recordCount"] = $rs->maxRecordCount();

$template->listImage = $listImage;
$template->listImageCount = $gettmp["recordCount"];


$sql = "SELECT sum(m.amount) as total_amount FROM session_orders m WHERE 1 = 1 AND m.session_code =  ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['session_login']));
$itemCountOrder = $rs->GetAssoc();
$gettmp['total_amount'] = $rs->fields['total_amount'];
$template->total_amount = $gettmp['total_amount'];


$sql1 = "SELECT * FROM session_orders m WHERE 1 = 1 AND m.session_code =  ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ";
$stmt1 = $db->Prepare($sql1);
$rs1 = $db->Execute($stmt1,array($_SESSION['session_login']));
$itemOrder = $rs1->GetAssoc();
$OrderrecordCount = $rs1->maxRecordCount();

$template->itemOrder = $itemOrder;
$template->OrderrecordCount = $OrderrecordCount;


$sql = "SELECT sum(m.total) as total_pay FROM session_orders m WHERE 1 = 1 AND m.session_code = ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ORDER BY m.pid ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['session_login']));
$gettmp['totalPay'] = $rs->fields['total_pay'];
$template->totalPay = $gettmp['totalPay'];

$sql = "SELECT * FROM product_categories m WHERE 1 = 1 AND (m.status = '1' OR  m.status = '3') ORDER BY m.sequence ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt);
$itemList = $rs->GetAssoc();
$itemListCount = $rs->maxRecordCount();

$template->itemList = $itemList;
$template->itemListCount = $itemListCount;


$template->parent_id = $item->parent_id;
$template->id =  $item->id;

$template->display($render);
?>
 