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
//$db->debug = 1;

// Modified substr_replace() to support multibyte charactor.
$sql = "SELECT * FROM members_profiles m WHERE 1 = 1 AND m.email = ? ";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_GET['email']));
$itemOrder = $rs->GetAssoc();
$gettmp["recordCount"] = $rs->maxRecordCount();


if($gettmp["recordCount"] > 0){
	echo "false";
}else{
	echo "true";
}
?>