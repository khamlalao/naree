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
if($_SESSION['session_login']== null){ 
echo "<meta http-equiv=\"refresh\" content=\"0;URL=member_login.php\" />"; 
}
?>
<?php
global $db;
#$db->debug=1;

$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$template = new Savant3();


ADOdb_Active_Record::SetDatabaseAdapter($db);
class members_profile extends ADOdb_Active_Record{}
$members = new members_profile();
$members->load("id= ?", array($_SESSION['member_id'])); //  Login
$template->members = $members;

list($bd_year, $bd_month, $bd_date) = explode("-", $members->birthday);

$template->bd_date = $bd_date;
$template->bd_month = $bd_month;
$template->bd_year = $bd_year;


$template->display($render);
?>
 