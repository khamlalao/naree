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
require_once DIR."library/class/class.phpmailer.php";    

?>
<?php
global $db;
#$db->debug=1;


$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$gettmp["id"] = ($_GET["id"] != null) ? $_GET["id"] : null;



$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);



class invoice_order extends ADOdb_Active_Record{}
$invoice = new invoice_order();
$invoice->Load("invoice_id = ? ", array($gettmp["id"]));
$template->invoice = $invoice;


class members_profile extends ADOdb_Active_Record{}
$member = new members_profile();
$member->Load("id = ? ", array($invoice->member_id));
$template->member = $member;

class session_order extends ADOdb_Active_Record{}
$session_order = new session_order();
$session_order->Load("invoice_id = ? ", array($gettmp["id"]));
$template->session_order = $session_order;


// Query to display only
//$sql = "SELECT * FROM orders WHERE orders.invoice_id = ? ORDER BY orders.id ASC";
$sql = "
SELECT * ,
(SELECT Sum(o.amount) FROM session_orders o 
      WHERE o.invoice_id = '".$invoice->invoice_id."' ) AS total_amount
FROM session_orders
WHERE session_orders.invoice_id = ?
GROUP BY session_orders.invoice_id";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($gettmp["id"]));
$orderList = $rs->GetAssoc();
$orderListCount = $rs->maxRecordCount();

$template->orderList =  $orderList;
$template->total_amount =  $rs->fields['total_amount'];
$template->orderListCount =  $orderListCount;

class members_location extends ADOdb_Active_Record{}
$location = new members_location();
$location->load("id= ?", array($session_order->location_shipping));
$template->location = $location;


$template->display($render);
?>