<?php
require_once "common.inc.php";
//require_once DIR."library/config/sessionstart.php";
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
#$db->debug = true;
$render = str_replace(".php", ".tpl.php", end(explode("/", $_SERVER["PHP_SELF"])));

$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);

$gettmp["id"] = ($_REQUEST['id'] == null) ? ($_REQUEST["id"] == null) ? null : $_REQUEST["id"] : $_REQUEST["id"];
$gettmp["do"] = ($_REQUEST["do"] == null) ? ($_REQUEST["do"] == null) ? null : $_REQUEST["do"] : $_REQUEST["do"];

switch ($gettmp["do"]) {
  case "enabled" :
    $gettmp["id"] = $_GET["id"];
    $gettmp["value"] = ($_GET["value"] == "1") ? 1 : 0;

    $sql = "UPDATE admins SET admins.status = ? WHERE admins.id = ? ";
    $stmt = $db->Prepare($sql);
    $rs = $db->Execute($stmt, array($gettmp["value"], $gettmp["id"]));

    $template->redirect = true;
    $template->redirect_delay = 0;
    $template->url = "admin_list.php?listitem=admin&menu=4Lij4Liy4Lii4LiK4Li34LmI4Lit4LmA4LiI4LmJ4Liy4Lir4LiZ4LmJ4Liy4LiX4Li14LmI&active=7";
    break;
  case "delete" :
    $gettmp["id"] = $_GET["id"];
     
    $sql = "DELETE FROM admins WHERE admins.id = ? ";
    $stmt = $db->Prepare($sql);
    $rs = $db->Execute($stmt, array($gettmp["id"]));

    $template->redirect = true;
    $template->redirect_delay = 0;
    $template->url = "admin_list.php?listitem=admin&menu=4Lij4Liy4Lii4LiK4Li34LmI4Lit4LmA4LiI4LmJ4Liy4Lir4LiZ4LmJ4Liy4LiX4Li14LmI&active=7";
    break;
  case "insert" :
    class admin extends ADOdb_Active_Record{}
    $admin = new admin();
    //$admin->load("id = ?", array($gettmp["id"]));
    //$admin->id = $gettmp["id"];
    $admin->username = ($_POST["username"] != null) ? $_POST["username"] : null;
    $admin->password = ($_POST["password"] != null) ? $_POST["password"] : null;
    $admin->name = ($_POST["name"] != null) ? encodeToDB($_POST["name"]) : null;
    $admin->surname = ($_POST["surname"] != null) ? encodeToDB($_POST["surname"]) : null;
    $admin->province = ($_POST["corp_province"] != null) ? encodeToDB($_POST["corp_province"]) : null;
    $admin->tel = ($_POST["tel"] != null) ? $_POST["tel"] : null;
    $admin->position = ($_POST["position"] != null) ? $_POST["position"] : null;
    $admin->email = ($_POST["email"] != null) ? $_POST["email"] : null;
    $admin->st_member = ($_POST["st_member"] != null) ? $_POST["st_member"] : null;
    $admin->status = ($_POST["status"] != null) ? $_POST["status"] : 0;
    $admin->begin_date = date("Y-m-d H:i:s");
    $admin->end_date = date("Y-m-d H:i:s");
    $admin->date_created = date("Y-m-d H:i:s");

    if ($admin->save()) {
      $update = false;

      unset($_SESSION["admin_form"]);
      $message = "<span class=\"ArGray12B01\">Add Administrator Completed !!!</span><br /><br />";
    } else {
      $_SESSION["admin_form"]["username"] = $_POST["username"];
      $_SESSION["admin_form"]["password"] = $_POST["password"];
      $_SESSION["admin_form"]["name"] = $_POST["name"];
      $_SESSION["admin_form"]["surname"] = $_POST["surname"];
      $_SESSION["admin_form"]["email"] = $_POST["email"];
      $_SESSION["admin_form"]["position"] = $_POST["position"];
      $_SESSION["admin_form"]["tel"] = $_POST["tel"];
      $_SESSION["admin_form"]["status"] = $_POST["status"];
      
      $message = "<span class=\"TxtRed12B01\">Add Administrator Not Completed !!!</span><br /><br />";
    }

    $template->admin = $admin;
    $template->message = $message;
    $template->redirect = true;
    $template->redirect_delay = 5;
    $template->url = "admin_list.php?listitem=admin&menu=4Lij4Liy4Lii4LiK4Li34LmI4Lit4LmA4LiI4LmJ4Liy4Lir4LiZ4LmJ4Liy4LiX4Li14LmI&active=7";
    break;
  case "update" :
 # $db->debug = true;
     class admin extends ADOdb_Active_Record{}
    $admin = new admin();
    $admin->load("id = ?", array($gettmp["id"]));
    $admin->username = ($_POST["username"] != null) ? $_POST["username"] : null;
    $admin->password = ($_POST["password"] != null) ? $_POST["password"] : null;
    $admin->name = ($_POST["name"] != null) ? encodeToDB($_POST["name"]) : null;
    $admin->surname = ($_POST["surname"] != null) ? encodeToDB($_POST["surname"]) : null;
    $admin->province = ($_POST["corp_province"] != null) ? encodeToDB($_POST["corp_province"]) : null;
    $admin->tel = ($_POST["tel"] != null) ? $_POST["tel"] : null;
    $admin->position = ($_POST["position"] != null) ? $_POST["position"] : null;
    $admin->email = ($_POST["email"] != null) ? $_POST["email"] : null;
    $admin->st_member = ($_POST["st_member"] != null) ? $_POST["st_member"] : null;
    $admin->status = ($_POST["status"] != null) ? $_POST["status"] : 0;
    $admin->begin_date = date("Y-m-d H:i:s");
    $admin->end_date = date("Y-m-d H:i:s");
    $admin->date_created = date("Y-m-d H:i:s");

    if ($admin->save()) {
      $update = false;

      unset($_SESSION["admin_form"]);
      $message = "<span class=\"ArGray12B01\">Update Administrator Completed !!!</span><br /><br />";
    } else {
      $_SESSION["admin_form"]["username"] = $_POST["username"];
      $_SESSION["admin_form"]["password"] = $_POST["password"];
      $_SESSION["admin_form"]["name"] = $_POST["name"];
      $_SESSION["admin_form"]["surname"] = $_POST["surname"];
      $_SESSION["admin_form"]["email"] = $_POST["email"];
      $_SESSION["admin_form"]["position"] = $_POST["position"];
      $_SESSION["admin_form"]["tel"] = $_POST["tel"];
      $_SESSION["admin_form"]["status"] = $_POST["status"];
      
      $message = "<span class=\"TxtRed12B01\">Update Administrator Not Completed !!!</span><br /><br />";
    }

    $template->admin = $admin;
    $template->message = $message;
    $template->redirect = true;
    $template->redirect_delay = 5;
    $template->url = "admin_list.php?listitem=admin&menu=4Lij4Liy4Lii4LiK4Li34LmI4Lit4LmA4LiI4LmJ4Liy4Lir4LiZ4LmJ4Liy4LiX4Li14LmI&active=7";
    break;
  default :
}

$template->do = $gettmp["do"];

$template->display($render);
?>