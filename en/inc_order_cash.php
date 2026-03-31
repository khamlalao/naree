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

?>
<?php
global $db;
#$db->debug=1;

$gettmp["action"] = ($_GET["action"] != null) ? $_GET["action"] : null;
$gettmp["id"] = ($_GET["id"] != null) ? $_GET["id"] : null;

ADOdb_Active_Record::SetDatabaseAdapter($db);
if($gettmp['action'] == 'remove'){
$sql = "DELETE FROM session_orders WHERE 1 = 1 AND session_orders.session_code = ? AND  session_orders.member_id = ? AND session_orders.id = ? ";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['session_login'],$_SESSION['member_id'],$gettmp['id']));
}


$sql = "SELECT * FROM session_orders m WHERE 1 = 1 AND m.session_code = ? AND  m.member_id = ? ORDER BY m.pid ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['session_login'],$_SESSION['member_id']));
$itemOrder = $rs->GetAssoc();
$gettmp["recordCount"] = $rs->maxRecordCount();


$sql = "SELECT sum(m.total) as total_pay FROM session_orders m WHERE 1 = 1 AND m.session_code =  ? AND  m.member_id = ? ORDER BY m.pid ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['session_login'],$_SESSION['member_id']));
$gettmp['totalPay'] = $rs->fields['total_pay'];

?>
<?php echo number_format($gettmp['totalPay'],2)?>