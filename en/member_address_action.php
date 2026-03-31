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

#print_r($_POST);

switch ($_REQUEST["do"]) {
  case "insert" :
  
		$sql = "SELECT * FROM location_zones m WHERE 1 = 1 AND m.id = ? ";
		$stmt = $db->Prepare($sql);
		$rs = $db->Execute($stmt,array($_POST["location_zone"]));
  
    class members_location extends ADOdb_Active_Record{}
      $member = new members_location();
      $member->member_id = ($_SESSION["member_id"] == null) ? null : $_SESSION["member_id"]; 
      $member->name = ($_POST["name"] == null) ? null : $_POST["name"];       
      $member->surname = ($_POST["surname"] == null) ? null : $_POST["surname"];
      $member->address1 = ($_POST["address1"] == null )? null : $_POST["address1"];
      $member->address2 = ($_POST["address2"] == null) ? null : $_POST["address2"];       
      $member->country = ($_POST["location_zone"] == null) ? null : $rs->fields['name'];       
      $member->location_zone = ($_POST["location_zone"] == null) ? null : $_POST["location_zone"];       
      $member->city = ($_POST["city"] == null) ? null : $_POST["city"];       
      $member->state = ($_POST["state"] == null) ? null : $_POST["state"];       
      $member->postcode = ($_POST["postcode"] == null) ? null : $_POST["postcode"];
      $member->phone1 = ($_POST["contact_no1"] == null )? null : $_POST["contact_no1"];
      $member->phone2 = ($_POST["contact_no2"] == null )? null : $_POST["contact_no2"];
      $member->created_date = date("Y-m-d H:i:s");
      $member->status = '1';
       
    if ($member->Save()){
      $gettmp['id'] = $member->id;

      $message = "<p>New Address Shipping Success</p>";

      $msg_title = "New Address Shipping";
      $message = $message;
      $redirect = true;
      $redirect_delay = 0;
      $redirect_url = "member_address.php";	  
	  
    } else {
    
      $_SESSION["member"]["name"] = ($_POST["name"] == null) ? null : $_POST["name"];
      $_SESSION["member"]["surname"] = ($_POST["surname"] == null) ? null : $_POST["surname"];
      $_SESSION["member"]["postcode"] = ($_POST["postcode"] == null) ? null : $_POST["postcode"];
      $_SESSION["member"]["contact_no1"] = ($_POST["contact_no1"] == null) ? null : $_POST["contact_no1"];
      $_SESSION["member"]["contact_no2"] = ($_POST["contact_no2"] == null) ? null : $_POST["contact_no2"];
      $_SESSION["member"]["city"] = ($_POST["city"] == null) ? null : $_POST["city"];
      $_SESSION["member"]["state"] = ($_POST["state"] == null) ? null : $_POST["state"];
      $_SESSION["member"]["address2"] = ($_POST["address2"] == null) ? null : $_POST["address2"];
      $_SESSION["member"]["address1"] = ($_POST["address1"] == null) ? null : $_POST["address1"];

      $message = "<p>ระบบไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้งค่ะ</p>";
      $message .= "<a href=\"Javascript:history.back(1)\">กลับไปแก้ไข</a>";

      $msg_title = "แก้ไขข้อมูลสมาชิก";
      $message = $message;
      $redirect = false;
      $redirect_delay = 0;
      $redirect_url = "member_create_address.php";
    }
	 echo "<meta http-equiv=\"refresh\" content=\"$redirect_delay;URL=$redirect_url\" />";
    break;
	
 case "update" :
	 $gettmp['id'] = ($_POST["id"] != null) ? $_POST["id"] : null;

		$sql = "SELECT * FROM location_zones m WHERE 1 = 1 AND m.id = ? ";
		$stmt = $db->Prepare($sql);
		$rs = $db->Execute($stmt,array($_POST["location_zone"]));

    class members_location extends ADOdb_Active_Record{}
      $member = new members_location();
	  $member->load("id= ?", array($gettmp['id']));
      $member->name = ($_POST["name"] == null) ? null : $_POST["name"];       
      $member->surname = ($_POST["surname"] == null) ? null : $_POST["surname"];
      $member->address1 = ($_POST["address1"] == null )? null : $_POST["address1"];
      $member->address2 = ($_POST["address2"] == null) ? null : $_POST["address2"];   
      $member->country = ($_POST["location_zone"] == null) ? null : $rs->fields['name'];       
      $member->location_zone = ($_POST["location_zone"] == null) ? null : $_POST["location_zone"];  	      
      $member->city = ($_POST["city"] == null) ? null : $_POST["city"];       
      $member->state = ($_POST["state"] == null) ? null : $_POST["state"];       
      $member->postcode = ($_POST["postcode"] == null) ? null : $_POST["postcode"];
      $member->phone1 = ($_POST["contact_no1"] == null )? null : $_POST["contact_no1"];
      $member->phone2 = ($_POST["contact_no2"] == null )? null : $_POST["contact_no2"];
      $member->created_date = date("Y-m-d H:i:s");
      $member->status = '1';
       
    if ($member->Replace()){
      $gettmp['id'] = $member->id;

      $message = "<p>Update Address Shipping Success</p>";

      $msg_title = "Update Address Shipping";
      $message = $message;
      $redirect = true;
      $redirect_delay = 0;
      $redirect_url = "member_address.php";	  
	  
    } else {
    
      $_SESSION["member"]["name"] = ($_POST["name"] == null) ? null : $_POST["name"];
      $_SESSION["member"]["surname"] = ($_POST["surname"] == null) ? null : $_POST["surname"];
      $_SESSION["member"]["postcode"] = ($_POST["postcode"] == null) ? null : $_POST["postcode"];
      $_SESSION["member"]["contact_no1"] = ($_POST["contact_no1"] == null) ? null : $_POST["contact_no1"];
      $_SESSION["member"]["contact_no2"] = ($_POST["contact_no2"] == null) ? null : $_POST["contact_no2"];
      $_SESSION["member"]["city"] = ($_POST["city"] == null) ? null : $_POST["city"];
      $_SESSION["member"]["state"] = ($_POST["state"] == null) ? null : $_POST["state"];
      $_SESSION["member"]["address2"] = ($_POST["address2"] == null) ? null : $_POST["address2"];
      $_SESSION["member"]["address1"] = ($_POST["address1"] == null) ? null : $_POST["address1"];

      $message = "<p>ระบบไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้งค่ะ</p>";
      $message .= "<a href=\"Javascript:history.back(1)\">กลับไปแก้ไข</a>";

      $msg_title = "แก้ไขข้อมูลสมาชิก";
      $message = $message;
      $redirect = false;
      $redirect_delay = 0;
      $redirect_url = "member_create_address.php";
    }
	 echo "<meta http-equiv=\"refresh\" content=\"$redirect_delay;URL=$redirect_url\" />";
    break;
	case "delete" :
	 $gettmp['id'] = ($_GET["id"] != null) ? $_GET["id"] : null;
 	 class members_location extends ADOdb_Active_Record{}
      $member = new members_location();
	  $member->load("id= ?", array($gettmp['id']));
       
    if ($member->Delete()){
      $message = "<p>Delete Address Shipping Success</p>";

      $msg_title = "Delete Address Shipping";
      $message = $message;
      $redirect = true;
      $redirect_delay = 0;
      $redirect_url = "member_address.php";	  
	  
    }	 
	 echo "<meta http-equiv=\"refresh\" content=\"$redirect_delay;URL=$redirect_url\" />";
	 
	break;	
  default :
}
//$template->display($render);
?>
 