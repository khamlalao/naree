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
global $db;
#$db->debug=1;


$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$gettmp["id"] = ($_GET["id"] != null) ? $_GET["id"] : null;


$template = new Savant3();

ADOdb_Active_Record::SetDatabaseAdapter($db);

class members_location extends ADOdb_Active_Record{}
$location = new members_location();
$location->load("id= ?", array($gettmp['id']));
$template->location = $location;

class members_profile extends ADOdb_Active_Record{}
$member = new members_profile();
$member->load("id= ?", array($_SESSION['member_id']));
$template->member = $member;


$sql = "SELECT * FROM session_orders m WHERE 1 = 1 AND m.session_code = ? AND  m.member_id = ? ORDER BY m.pid ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['session_login'],$_SESSION['member_id']));
$itemOrder = $rs->GetAssoc();
$gettmp["recordCount"] = $rs->maxRecordCount();


$sql = "SELECT sum(m.total) as total_pay FROM session_orders m WHERE 1 = 1 AND m.session_code =  ? AND  m.member_id = ? ORDER BY m.pid ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['session_login'],$_SESSION['member_id']));
$gettmp['totalPay'] = $rs->fields['total_pay'];


/// NAREE PAYMENT
	
		function signParams($params, $secretKey){
			$dataToSign = array();
			$signedFieldNames = explode(",",$params["signed_field_names"]);
			foreach ($signedFieldNames as &$field) {
			   $dataToSign[] = $field . "=" . $params[$field];
			}
			$joinedData = implode(",",$dataToSign);
			return base64_encode(hash_hmac('sha256', $joinedData, $secretKey, true));
		}
	
		$sid = sprintf("%06d", rand(0,999999));
		$access_key = "122e321ee50736e5910da3815cf44701"; // FIX
		$profile_name = "nareebags"; // FIX
		$secret_key = "25f3b5c1eb264bae85881b208e06e43907c302e1b9bb4d28972daac1bdf5f79a60e231e056fb4e54bdea007a09ca675163ad9b6dcd524225b512614aa287b89d16b0620380c94c14bdcc307aa66b904362b4d4e441824ea99fe96920c3cbae8bbb63e3dd6da44daeaa9508cd32df19da263c0535c724458092b52af347640a79"; // FIX
		$merchant_id = "bcel_test_malimar"; // FIX
		
		$params = array();
		$params['access_key'] = $access_key;
		$params['profile_id'] = $profile_name;
		$params['transaction_uuid'] = uniqid();
		$params['signed_date_time'] = gmdate("Y-m-d\TH:i:s\Z");
		$params['locale'] = 'en';
		$params['transaction_type'] = 'authorization';
		$params['reference_number'] = (int)(rand(0, 999999));
		$params['currency'] = 'usd';
		
		$params['device_fingerprint_id'] = $sid;
		
		$params['amount'] = $gettmp['totalPay'];
		$params['bill_to_address_country'] = "TH";
		$params['bill_to_forename'] = $location->name;
		$params['bill_to_surname'] = $location->surname;
		$params['bill_to_email'] = $member->email;
		$params['bill_to_phone'] = $location->phone1;
		$params['bill_to_address_city'] = $location->city;

		$params['bill_city'] = $location->city;

		$params['bill_to_address_line1'] = $location->address1;
		$params['bill_to_address_postal_code'] = $location->postcode;
		$params['merchant_secure_data1'] = "special message 1";
		$params['merchant_secure_data2'] = "special data 2";
		$params['merchant_secure_data3'] = "special data 3";

		$params['signed_field_names'] = '';
		$params['signed_field_names'] = implode(',', array_keys($params));
		
		$params['signature'] = signParams($params, $secret_key);
		
		$template->params = $params;
	
	
if($order == 'success'){	
  $mail = new PHPMailer();
  //$body = $mail->getFile("popup_order_report.php");
  ob_start();
  $_GET['id'] = $invoice->id; // 78
  include "formmail_order.php"; //execute the file as php
  $body = ob_get_clean();
  //echo "<br>-----------------------------------------------";
  //var_dump($body);
  //echo "<br>-----------------------------------------------";

//	$mail->Host = "mail.siamintermart.com";  // specify main and backup server
//	$mail->SMTPAuth = false;     // turn on SMTP authentication
	//$mail->Username = "xxxx";  // SMTP username
	//$mail->Password = "xxxx"; // SMTP password
  	  // used only when SMTP requires authentication  
	  $mail->IsSMTP();
	  $mail->SMTPAuth = true;
	  $mail->IsHTML(true); 
  	  $mail->Host = "localhost";
	  //$mail->Port = 25;
	  //$mail->Username = 'noreply@siamintermart.com';
	  //$mail->Password = 'Mail1001';  
  
  $mail->CharSet = "utf-8";
  $mail->From = "noreply@naree.co";
  $mail->FromName = "Naree Hand Bag Mail";
  $mail->Subject = "Online Order # ".$session_order->invoice_code." from naree.co ";
  
  $mail->AddAddress($member->email);
  //$mail->AddBCC("A_pookyka14@hotmail.com");
  $mail->AddBCC("boy@1001click.com");
  
  $mail->MsgHTML($body);
  $mail->Send();
  
  // Admin Process
  //$body = $mail->getFile("popup_order_report.php");
  ob_start();
  $_GET['id'] = $invoice->id; // 78
  include "formmail_order_admin.php"; //execute the file as php
  $body = ob_get_clean();
  //echo "<br>-----------------------------------------------";
  //var_dump($body);
  //echo "<br>-----------------------------------------------";
  $mail->From = $member->email;
  $mail->FromName = $member->name;
  $mail->to = array(); // Reset.
  $mail->AddAddress("info@naree.co");
  //$mail->AddBCC("A_pookyka14@hotmail.com");
  $mail->AddBCC("boy@1001click.com");
  
  $mail->MsgHTML($body);
  $mail->Send();
}

$template->display($render);
?>
 