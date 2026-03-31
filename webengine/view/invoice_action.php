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
//$db->debug = 1;

//if (! in_array($_SESSION['st_member'], array(1, 4))) {
//  die("<meta http-equiv=\"refresh\" content=\"0; URL=login.php\">");
//}
//print_r($_POST);
//echo stripslashes($_POST['description_la']);
//exit();
$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$upload_max_size = 10 * 1024 * 1024;
$upload_temp_path = "../../temp/";
$upload_path = "../../img_lookbook/";

$gettmp["status"] = ($_REQUEST["status"] != null) ? $_REQUEST["status"] : 0;
$gettmp["value"] = ($_REQUEST["value"] != null) ? $_REQUEST["value"] : '0';
$gettmp["id"] = ($_REQUEST["id"] != null) ? $_REQUEST["id"] : '';
$gettmp["do"] = ($_REQUEST["do"] != null) ? $_REQUEST["do"] : '';


$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);

switch ($gettmp["do"]) {
	  case "deletelist" :
      #print_r($_POST); exit();
 
      foreach ($_POST["chkbox"] as $row => $gettmp["no"]) :   
        $gettmp["id"] = $_POST["id"][$gettmp["no"] - 1];

        $stmt = $db->Prepare("DELETE FROM invoice_orders WHERE invoice_orders.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));  
      endforeach;
      
      // Set Log.
      saverecord("Delete Invlice List");
      
      $render = "invoice_list.php?mn=7&sub=1&menu=SW52b2ljZQ";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
	  
  break;
  case "status" :
    class invoice_order extends ADOdb_Active_Record{}
    $item = new invoice_order();
    $item->load("id = ?", array($gettmp["id"]));
    $item->status_delivery = $gettmp['value'];
    $item->Replace();

    saverecord("Change Status delivery");

      $render = "invoice_list.php?mn=7&sub=1&menu=SW52b2ljZQ";
    die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;
  case "delete" : 
    class invoice_order extends ADOdb_Active_Record{}
    $item = new invoice_order();
    $item->load("id = ?", array($gettmp["id"]));
    $item->Delete();
 
      saverecord("Delete Invoice");
      $render = "invoice_list.php?mn=7&sub=1&menu=SW52b2ljZQ";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;
}

//$template->display($render);
?>