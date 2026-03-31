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
 $render = 'member_login.php';
 $last_login = date("Y-m-d H:i:s");
//saverecord('Logout');
 $stmt = $db->Prepare("UPDATE members_profiles SET members_profiles.lastlogin = ? WHERE members_profiles.id = ? ");
 $rs = $db->Execute($stmt, array($last_login, $_SESSION['member_id'])); 
	   
$db->close();
session_destroy();
unset($_SESSION);

echo "<meta http-equiv=\"refresh\" content=\"0;URL=$render\" />";
?>