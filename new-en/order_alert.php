<?php
require_once "common.inc.php";
require_once DIR."library/config/sessionstart.php";
//require_once DIR."library/config/checksessionlogin.php";
require_once DIR."library/adodb5/adodb.inc.php";
require_once DIR."library/adodb5/adodb-active-record.inc.php";
require_once DIR."library/config/config.php";
require_once DIR."library/config/connect.php";
require_once DIR."library/extension/extension.php";
require_once DIR."library/extension/utility.php";
require_once DIR."library/extension/lang.php";
require_once DIR."library/config/rewrite.php";
?>
<?php
#$db->debug = 1;

$gettmp['session'] = $_GET['session'];

ADOdb_Active_Record::SetDatabaseAdapter($db);

//	$sql = "SELECT * FROM session_orders m WHERE 1 = 1 AND m.session_code =  ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ";
//	$stmt = $db->Prepare($sql);
//	$rs = $db->Execute($stmt,array($gettmp['session']));
//	$gettmp["your-items"] = $rs->maxRecordCount();

$sql = "SELECT sum(m.amount) as total_amount FROM session_orders m WHERE 1 = 1 AND m.session_code =  ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['session_login']));
$itemOrder = $rs->GetAssoc();
$gettmp['total_amount'] = $rs->fields['total_amount'];
	
	if($gettmp['total_amount'] != 0){
	//echo "<div class='num-items'>".$gettmp['your-items']."</div>";
	echo $gettmp['total_amount'];
	}else{
//	echo "<div class='num-items'>0</div>";
	}
?>