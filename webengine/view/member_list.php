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
require_once DIR."library/Savant3.php";
?>
<?php
#$db->debug = 1;

$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

 $gettmp["perpage"] = ($_GET["perpage"] != null) ? $_GET["perpage"] : 10; 
  $gettmp["page"] = ($_GET["page"] != null) ? $_GET["page"] : 1;
  
  $gettmp["keyword"] = ($_GET["keyword"] != null) ? $_GET["keyword"] : null;
  
  $gettmp["begin_date"] = ($_GET["begin_date"] != null) ? $_GET["begin_date"] : null;
  
 if ($gettmp["begin_date"] != null) {
    list($gettmp["day"], $gettmp["month"], $gettmp["year"],) = explode("/", $gettmp["begin_date"]);
    $begin_date = date("Y-m-d H:i:s", strtotime($gettmp["year"]."-".$gettmp["month"]."-".$gettmp["day"]." 00:00:00"));
  } else {
    $begin_date = null;
  }
  
  $gettmp["end_date"] = ($_GET["end_date"] != null) ? $_GET["end_date"] : null;
  if ($gettmp["end_date"] != null) {
    list($gettmp["day"], $gettmp["month"], $gettmp["year"],) = explode("/", $gettmp["end_date"]);
    $end_date = date("Y-m-d H:i:s", strtotime($gettmp["year"]."-".$gettmp["month"]."-".$gettmp["day"]." 00:00:00"));
  } else {
    $end_date = null;
  }  
  
$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);
$sql = "SELECT *  FROM members_profiles m WHERE 1 = 1  ORDER BY  m.registered_date DESC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt);	
$itemList = $rs->GetAssoc();
$itemListCount = $rs->maxRecordCount();

$template->itemList = $itemList;
$template->itemListCount = $itemListCount;

$template->display($render);
?>