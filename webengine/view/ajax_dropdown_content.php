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
//$db->debug = 1;

ADOdb_Active_Record::SetDatabaseAdapter($db);

$sql = "
SELECT p.id, CONCAT_WS(' - ', c.title_th, p.title_th) AS title_th
FROM content_pages p 
LEFT JOIN content_categories c ON c.id = p.parent_id
WHERE 1 = 1 
ORDER BY p.parent_id ASC, p.title_th ASC 
    ";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt);
$list = $rs->GetAssoc();
echo json_encode($list);
?>