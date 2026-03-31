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

$gettmp['action'] = $_GET['action'];

ADOdb_Active_Record::SetDatabaseAdapter($db);

//$sql = "SELECT count(c.id) AS total FROM invoice_orders c WHERE 1 = 1 AND c.status = '1' ";
$sql = "SELECT count(c.id) AS total FROM invoice_orders c WHERE 1 = 1 AND c.status = '0' AND c.decision = 'ACCEPT'";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt);

echo $rs->fields['total'];
?>