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
$gettmp["do"] = ($_REQUEST["do"] != null) ? $_REQUEST["do"] : '';


$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);

switch ($gettmp["do"]) {
  case "insert" :
    class contactus_category extends ADOdb_Active_Record{}
    $item = new contactus_category();
    
    $item->title_th = ($_POST["title_th"] != null) ? encodeToDB($_POST["title_th"]) : null;
    $item->title_en = ($_POST["title_en"] != null) ? encodeToDB($_POST["title_en"]) : null;
    $item->email = ($_POST["email"] != null) ? encodeToDB($_POST["email"]) : null;
    $item->email_bcc = ($_POST["email_bcc"] != null) ? encodeToDB($_POST["email_bcc"]) : null;
	$item->status = ($_POST["status"] == "1") ? "1" : "0";
    $item->created_date = date("Y-m-d H:i:s");
    $item->update_date = date("Y-m-d H:i:s");
	
	if($item->save()){   
      $render = "contact_cate_list.php?mn=15&menu=Q29udGFjdCBDYXRlZ29yeQ";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "contact_cate_list.php?mn=15&menu=Q29udGFjdCBDYXRlZ29yeQ";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }

    saverecord("Save Data Item");
    break;
  case "update" :
    class contactus_category extends ADOdb_Active_Record{}
    $item = new contactus_category();
    $item->load("id = ?", array($gettmp["id"]));
    $item->title_th = ($_POST["title_th"] != null) ? encodeToDB($_POST["title_th"]) : null;
    $item->title_en = ($_POST["title_en"] != null) ? encodeToDB($_POST["title_en"]) : null;
    $item->email = ($_POST["email"] != null) ? encodeToDB($_POST["email"]) : null;
    $item->email_bcc = ($_POST["email_bcc"] != null) ? encodeToDB($_POST["email_bcc"]) : null;
	$item->status = ($_POST["status"] == "1") ? "1" : "0";
    $item->created_date = date("Y-m-d H:i:s");
    $item->update_date = date("Y-m-d H:i:s");
	
	if($item->Replace()){   
      $render = "contact_cate_list.php?mn=15&menu=Q29udGFjdCBDYXRlZ29yeQ";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "contact_cate_list.php?mn=15&menu=Q29udGFjdCBDYXRlZ29yeQ";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }

    saverecord("Save Data Item");
    break;
 
  case "delete" : 
    class contactus_category extends ADOdb_Active_Record{}
    $item = new contactus_category();
    $item->load("id = ?", array($gettmp["id"]));
    $item->Delete();

    saverecord("Delete Contact Category");
      $render = "contact_cate_list.php?mn=15&menu=Q29udGFjdCBDYXRlZ29yeQ";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;
   
}

//$template->display($render);
?>