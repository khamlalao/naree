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
require_once DIR."library/class/class.upload2.php";
require_once DIR."library/Savant3.php";
?>
<?php
#$db->debug = 1;


$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$gettmp["status"] = ($_REQUEST["status"] != null) ? $_REQUEST["status"] : 0;
$gettmp["id"] = ($_REQUEST["id"] != null) ? $_REQUEST["id"] : '';
$gettmp["parent_id"] = ($_REQUEST["parent_id"] != null) ? $_REQUEST["parent_id"] : '';
$gettmp["do"] = ($_REQUEST["do"] != null) ? $_REQUEST["do"] : '';


$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);

switch ($gettmp["do"]) {
  case "delete" :
    class contactus_contact extends ADOdb_Active_Record{}
    $item = new contactus_contact();
    $item->load("id = ?", array($gettmp["id"]));
    $item->Delete();

    saverecord("Delete Contact");
    $render = "contactus_list.php?id=".$gettmp['parent_id']."&mn=15&menu=Q29udGFjdCBDYXRlZ29yeQ";
    die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;
  case "listdelete" :

    foreach ($_POST["chkbox"] as $row => $gettmp["no"]) {
      $gettmp["id"] = $_POST["id"][$gettmp["no"] - 1];
       
      $stmt = $db->Prepare("DELETE FROM contactus_contacts WHERE contactus_contacts.id = ? ");
      $rs = $db->Execute($stmt, array($gettmp["id"]));
    }

    saverecord("Delete Contact");
    $render = "contactus_list.php?id=".$gettmp['parent_id']."&mn=15&menu=Q29udGFjdCBDYXRlZ29yeQ";
    die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;
}

//$template->display($render);
?>