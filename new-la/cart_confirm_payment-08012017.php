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
require_once DIR."library/class/class.phpmailer.php"; 

global $db;

#$db->debug=1;

if($_SESSION['member_id'] == null){ 

	echo "<meta http-equiv=\"refresh\" content=\"0;URL=member_login.php\" />";
	exit();

}
$gettmp["shipping_method"] = ($_POST["shipping_method"] != null) ? $_POST["shipping_method"] : null;
$gettmp["shipping_address"] = ($_POST["shipping_address"] != null) ? $_POST["shipping_address"] : null;
$gettmp["delivery_fee"] = ($_POST["delivery_fee"] != null) ? $_POST["delivery_fee"] : null;
$gettmp["sub_total"] = ($_POST["sub_total"] != null) ? $_POST["sub_total"] : null;
$gettmp["grand_total"] = ($_POST["grand_total"] != null) ? $_POST["grand_total"] : null;

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>NAREE LAOS BRAND</title>
<?php include('inc_css.php');?>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
  //$('#loadingpage').delay(1000).fadeOut();
  $('#sendform').submit();
});
</script>
</head>
<body onLoad="get_step(3);">
<?php // include('inc_cart_left.php')?>
<div id="wrapper">
<!--Header-->
<div id="header">
<?php include('inc_header_login.php')?>
</div>
<!--//header--> 

<!--content-->
<div id="Containner">
<div class="content"> 
    <!--New-->
    <div class="product_model">
    <?php include('inc_cart_step.php');?>
    <div class="box-content post" style="width:100%; ">
             <div class="box-message">
             	 <h1><span>…ກະລຸນາລໍຖ້າລະບົບຈ່າຍເງິນ…</span></h1>
                 <p>ຂອບໃຈທີ່ຊື້ສິນຄ້າ.</p>
            </div>
            <div class="clear"></div>
  <?php

ADOdb_Active_Record::SetDatabaseAdapter($db);
class members_location extends ADOdb_Active_Record{}
$location = new members_location();
$location->load("id= ?", array($gettmp['shipping_address']));
$template->location = $location;

class members_profile extends ADOdb_Active_Record{}
$member = new members_profile();
$member->load("id= ?", array($_SESSION['member_id']));
$template->member = $member;


$sql = "SELECT * FROM session_orders m WHERE 1 = 1 AND m.session_code = ? AND  m.member_id = ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ORDER BY m.pid ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['session_login'],$_SESSION['member_id']));
$itemOrder = $rs->GetAssoc();
$gettmp["recordCount"] = $rs->maxRecordCount();


$sql = "SELECT MAX(SUBSTRING(invoice_id, 5, 6)) AS invoice_id FROM invoice_orders WHERE SUBSTRING(invoice_id, 1, 2) = ? ";
$stmt = $db->Prepare($sql);
	  $year = (date("y"));
	  $year_short = (date("y"));
	  $val = $db->GetOne($stmt, array($year));
	  $gettmp['invoice_id'] = $year_short.date("m").str_pad(($val + 1) , 6, "0", STR_PAD_LEFT); // Pattern : YYMM000001 e.g. 1601000001

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
		$access_key = "79fd595e0b3a3ffaa5d5117a9bf739cb"; // FIX
		$profile_name = "nareehandbags"; // FIX
		$secret_key = "7b17e7a06f944699856ef93ddfb37b968241d688956c455a9da12868667a1eeb464dcd9ded384f4a8c03a18f235b6c70fef01351b631440faec25d318d94d231c5ca40f586134575a63fcf6b222f44ae5da4b8604c734b4393882a728c5805fe753014f1f04141f1a86b1fe09d80709917b6b50c1d3941e29f619c7f602d469d"; // FIX

		$merchant_id = "bcel_vte_nareehandbags"; // FIX

		$params = array();
		$params['access_key'] = $access_key;
		$params['profile_id'] = $profile_name;
		$params['transaction_uuid'] = uniqid();
		$params['signed_date_time'] = gmdate("Y-m-d\TH:i:s\Z");
		$params['locale'] = 'la';
		$params['transaction_type'] = 'sale'; // authorization uses for easy void, when goes live should change to 'sale'
		$params['reference_number'] = (int)(rand(0, 999999));
		$params['currency'] = 'usd';
		$params['device_fingerprint_id'] = $sid;
		$params['amount'] = $gettmp["grand_total"];
		$params['bill_to_address_country'] = "LA"; //"TH";
		$params['bill_to_forename'] = $location->name;
		$params['bill_to_surname'] = $location->surname;
		$params['bill_to_email'] = $member->email;
		$params['bill_to_phone'] = $location->phone1;

//		$params['bill_to_address_city'] = $location->city;

//		$params['bill_city'] = $location->city;

		//$params['bill_to_address_city'] = "Vientiane"; //$location->country;
		$params['bill_to_address_city'] = $location->country;

 // 		$params['bill_city'] = "Vientiane";

		$params['bill_to_address_line1'] = $location->address1." ".$location->country;
		$params['bill_to_address_postal_code'] = $location->postcode;
		$params['merchant_secure_data1'] = $_SESSION['session_login'];
		$params['merchant_secure_data2'] = $_SESSION['member_id'];
		$params['merchant_secure_data3'] = $gettmp['invoice_id'];
		$params['signed_field_names'] = '';
		$params['signed_field_names'] = implode(',', array_keys($params));
		$params['signature'] = signParams($params, $secret_key);

	  $sql = "UPDATE session_orders m SET m.invoice_id = ? , m.invoice_code = ? , m.transaction_uuid = ? ,m.location_shipping = ? WHERE m.session_code = ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL)";
	  $stmt = $db->Prepare($sql);
	  $rs = $db->Execute($stmt,array($gettmp['invoice_id'],$params['reference_number'],$params['transaction_uuid'],$gettmp['id'], $_SESSION['session_login']));
?>
<?php

		$gettmp['order_date'] = date("Y-m-d h:i:s");
		$gettmp['amount_item'] = $gettmp["recordCount"];

		ADOdb_Active_Record::SetDatabaseAdapter($db);
		class invoice_order extends ADOdb_Active_Record{}
		$invoice_order = new invoice_order();
		$invoice_order->invoice_id = $gettmp['invoice_id']; // invoice_id
		$invoice_order->invoice_code = $_SESSION['session_login'];  //session_login
		$invoice_order->location_shipping = $location->address1." ".$location->postcode." ".$location->country." ".$location->phone1;
		$invoice_order->method_shipping = $gettmp["shipping_method"]; // shipping_method
		$invoice_order->member_id = $_SESSION['member_id']; // member_id
		$invoice_order->order_date = $gettmp['order_date']; //$_POST['order_date'];
		$invoice_order->amount = $gettmp['amount_item']; // จำนวนรายการสั่งซื้อ
		$invoice_order->sub_total = $gettmp["sub_total"]; // ยอดชำระ ไม่รวมค่าขนส่ง
		$invoice_order->grand_total = $gettmp["grand_total"]; // ยอดชำระสุทธิ
		$invoice_order->status_payment = '0';
		$invoice_order->status_delivery = '0';
		$invoice_order->req_locale = '';
		$invoice_order->req_card_number = '';
    	$invoice_order->auth_trans_ref_no = '';
		$invoice_order->auth_time = '';
  	    $invoice_order->transaction_id = '';
		$invoice_order->req_card_type = '';
		$invoice_order->decision = '';
		$invoice_order->message = '';
		$invoice_order->req_transaction_uuid = $params['transaction_uuid'];
		$invoice_order->req_reference_number = $params['reference_number'];
		$invoice_order->remote_addr = $_SESSION['REMOTE_ADDR'];
		$invoice_order->status = '0';

		//$invoice_order->save();
	  if($invoice_order->save()){	
		$sql = "SELECT sum(m.amount) as total_amount FROM session_orders m WHERE 1 = 1 AND m.invoice_id =  ? AND  m.member_id = ? ";
		$stmt = $db->Prepare($sql);
		$rs = $db->Execute($stmt,array($invoice_order->invoice_id,$_SESSION['member_id']));
		$itemCountOrder = $rs->GetAssoc();

		$gettmp['quantity_unit'] = $rs->fields['total_amount'];		  


	  $gettmp['url_invoice'] = "http://".$_SERVER["HTTP_HOST"]."/la/review_order_print.php?id=".$gettmp['invoice_id']."&member_id=".$_SESSION['member_id']."&reference_number=".$params['reference_number'];



	 	  $mail = new PHPMailer();
          $body = $mail->getFile("tmpl_order_confirm.html");
		  if ($body !== false):
		  $body = eregi_replace("&email;", $member->email, $body);
		  $body = eregi_replace("&name;", $member->name, $body);
		  $body = eregi_replace("&tel;", $location->phone1, $body);
		  $body = eregi_replace("&shipping_method;", Lang::ShippingMethod($gettmp["shipping_method"]), $body);
  	      $body = eregi_replace("&shipping_address;", $invoice_order->location_shipping, $body);
		  $body = eregi_replace("&invoice_id;", $gettmp['invoice_id'], $body);
		  $body = eregi_replace("&order_date;", $gettmp['order_date'], $body);
		  $body = eregi_replace("&amount_item;", $gettmp['amount_item'].'  items', $body);
		  $body = eregi_replace("&quantity_unit;", $gettmp['quantity_unit'].'  units', $body);
		  $body = eregi_replace("&sub_total;", $gettmp['sub_total'] , $body);
		  $body = eregi_replace("&shipping;", ($gettmp["delivery_fee"] != '') ? $gettmp["delivery_fee"] : '-', $body);
		  $body = eregi_replace("&grand_total;", $gettmp['grand_total'], $body);
		  $body = eregi_replace("&date;", date("d-m-Y"), $body);
		  $body = eregi_replace("&time;", date("H:i:s"), $body);
		  $body = eregi_replace("&url_invoice;", $gettmp['url_invoice'], $body);
		  $body = StripSlashes($body);
		  endif;
  
    	    $mail->IsSMTP();        
			$mail->Host     = "mail.naree.co"; 
			$mail->SMTPAuth = true;                            
			$mail->Username = "info@naree.co";                     
			$mail->Password = "Naree1001";                         
			$mail->IsHTML(true); 

			$mail->CharSet = "utf-8";
			$mail->From = "info@naree.co";
		    $mail->FromName = "Naree HandBags Mail";
		    $mail->Subject = "Online Order #".$gettmp['invoice_id']."From Naree.co";



			$mail->MsgHTML($body);
            $mail->AddAddress($member->email);
     		$mail->Send();


			$mail->CharSet = "utf-8";
			$mail->From = $member->email;
		    $mail->FromName = $member->name;
		    $mail->Subject = "Online Order #".$gettmp['invoice_id']."From Naree.co";



			$mail->MsgHTML($body);

            $mail->AddAddress("naree.laos@gmail.com"); 

            $mail->AddBCC("svengit.web@gmail.com");
			
            $mail->AddBCC("project@1001click.com");

            $mail->AddBCC("boy@1001click.com");

     		$mail->Send();

	  }

?>
<?php

		echo "<form action='https://secureacceptance.cybersource.com/oneclick/pay' method='post'  name='sendform' id='sendform'>\r\n";

		foreach ($params as $key => $val){

			echo "<input type='hidden' name='$key' value='$val' />\r\n";

		}

		//echo "<input type='submit' value='Make Payment' />\r\n";
		echo "</form>";

		echo "<p style='background:url(https://h.online-metrix.net/fp/clear.png?org_id=k8vif92e&amp;session_id=" . $merchant_id . $sid . "&amp;m=1)'></p>";
		echo "<img src='https://h.online-metrix.net/fp/clear.png?org_id=k8vif92e&amp;session_id=" . $merchant_id . $sid . "&amp;m=2' alt=''>";

		echo "<object type='application/x-shockwave-flash' data='https://h.onlinemetrix.net/fp/fp.swf?org_id=k8vif92e&amp;session_id=" . $merchant_id . $sid . "' width='1' height='1' id='thm_fp'>";
		echo "<param name='movie' value='https://h.online-metrix.net/fp/fp.swf?org_id=k8vif92e&amp;session_id=" . $merchant_id . $sid . "' />";

		echo "<div></div></object>";

		echo "<script src='https://h.online-metrix.net/fp/check.js?org_id=k8vif92e&amp;session_id=" . $merchant_id . $sid . "' type='text/javascript'></script>";
?>
  </div>

      <!--Model--> 

    </div>
  </div>

  <!--end content--> 
  </div>

  <!--footer-->
  <div id="footer" >
    <?php include('inc_footer.php');?>
  </div>
  <!--end footer--> 
</div>
</body>
</html>