<?php



define("DIR",str_replace("\\", "/", dirname(__FILE__))."/");



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





date_default_timezone_set("Asia/Bangkok");

/*



echo " <BR>POST <BR>";



print_r($_POST);



echo " <BR> <BR>GET <BR>";



print_r($_GET);



echo " <BR>SESSION <BR>";



var_dump($_SESSION);



*/



global $db;



#$db->debug=1;



ADOdb_Active_Record::SetDatabaseAdapter($db);



class invoice_order extends ADOdb_Active_Record{} //req_transaction_uuid



$invoice_order = new invoice_order();



$invoice_order->load("invoice_id = ? AND req_transaction_uuid= ? AND req_reference_number = ? ", array($_POST['req_merchant_secure_data3'],$_POST['req_transaction_uuid'],$_POST['req_reference_number']));



$invoice_order->status_payment = ($_POST['decision'] == 'ACCEPT') ? '1' : '0';



$invoice_order->status_delivery = ($_POST['decision'] == 'ACCEPT') ? '0' : '2';



$invoice_order->req_locale = $_POST['req_locale'];



$invoice_order->req_card_number = $_POST['req_card_number'];



$invoice_order->auth_trans_ref_no = $_POST['auth_trans_ref_no'];



$invoice_order->auth_time = $_POST['auth_time'];



$invoice_order->transaction_id = $_POST['transaction_id'];



$invoice_order->req_card_type = $_POST['req_card_type'];



$invoice_order->decision = $_POST['decision'];



$invoice_order->message = $_POST['message'];



$invoice_order->status = ($_POST['decision'] == 'ACCEPT') ? '1' : '0';







 if($invoice_order->Replace()){	











		$sql = "SELECT sum(m.amount) as total_amount FROM session_orders m WHERE 1 = 1 AND m.invoice_id =  ? AND  m.member_id = ? ";



		$stmt = $db->Prepare($sql);

		$rs = $db->Execute($stmt,array($invoice_order->invoice_id,$_SESSION['member_id']));

		$itemCountOrder = $rs->GetAssoc();

		$gettmp['quantity_unit'] = $rs->fields['total_amount'];	







if($_POST['req_locale'] == 'en'){ $gettmp['locate'] = 'en'; }else{ $gettmp['locate'] = 'la';   }











	  $gettmp['url_invoice'] = "https://".$_SERVER["HTTP_HOST"]."/".$gettmp['locate']."/review_order_print.php?id=".$invoice_order->invoice_id."&member_id=".$_SESSION['member_id']."&reference_number=".$invoice_order->req_reference_number;







		



		class members_profile extends ADOdb_Active_Record{}



		$member = new members_profile();

		$member->load("id= ?", array($invoice_order->member_id));

		$template->member = $member;











		$gettmp['grand_total'] = $invoice_order->grand_total;

		$gettmp['sub_total'] = $invoice_order->sub_total;

		$gettmp['shipping_fee'] = $gettmp['grand_total'] - $gettmp['sub_total'];



if($_POST['decision'] == 'ACCEPT'){ // Order Payment Success



	 	  $mail = new PHPMailer();



          $body = $mail->getFile("tmpl_order_payment.html");



		  if ($body !== false):



		  $body = eregi_replace("&email;", $member->email, $body);



		  $body = eregi_replace("&name;", $member->name, $body);



		  $body = eregi_replace("&shipping_method;", Lang::ShippingMethod($invoice_order->method_shipping), $body);



		  $body = eregi_replace("&shipping_address;", $invoice_order->location_shipping, $body);



		  $body = eregi_replace("&invoice_id;", $invoice_order->invoice_id, $body);



		  $body = eregi_replace("&reference_number;", $invoice_order->req_reference_number, $body);



		  $body = eregi_replace("&order_date;", $invoice_order->order_date, $body);



		  $body = eregi_replace("&amount_item;", $invoice_order->amount.' items', $body);



		  $body = eregi_replace("&quantity_unit;", $gettmp['quantity_unit'].'  units', $body);



		  $body = eregi_replace("&sub_total;", (number_format($invoice_order->sub_total,2)) , $body);



		  $body = eregi_replace("&shipping;", (number_format($gettmp['shipping_fee'],2)), $body);



		  $body = eregi_replace("&grand_total;", (number_format($invoice_order->grand_total,2)), $body);



		  $body = eregi_replace("&payment_status;", (($_POST['decision'] == 'ACCEPT') ? 'COMPLETE' : 'NOT COMPLETE'), $body);



		  $body = eregi_replace("&date;", date("d-m-Y"), $body);



		  $body = eregi_replace("&time;", date("H:i:s"), $body);



		  $body = eregi_replace("&url_invoice;", $gettmp['url_invoice'], $body);



		  $body = StripSlashes($body);



		  endif;











			$mail->CharSet = "utf-8";



			$mail->From = "info@naree.co";



		    $mail->FromName = "Naree HandBags Mail";



		    $mail->Subject = "Receipt for Your Payment #".$invoice_order->invoice_id;



	  



     	    $mail->IsSMTP();        



			$mail->Host     = "mail.naree.co"; 

			$mail->SMTPAuth = true;

			$mail->Username = "info@naree.co";    

			$mail->Password = "Naree1001";    

			$mail->to = array(); // Reset.                     



			$mail->IsHTML(true); 

			$mail->MsgHTML($body);

			



            $mail->AddAddress($member->email);

            $mail->AddAddress("info@naree.co");
			
			$mail->AddBCC("svengit.web@gmail.com");

            $mail->AddBCC("project@1001click.com");

            $mail->AddBCC("boy@1001click.com");



     		$mail->Send();			

	} // End Check Payment Status

			



	  }







if($_POST['req_locale'] == 'en'){



  echo "<meta http-equiv=\"refresh\" content=\"0;URL=https://www.naree.co/en/cart_confirm_thank.php?msg=".$_POST['decision']."&invoice_id=".$_POST['req_merchant_secure_data3']."\" />";



} else {



  echo "<meta http-equiv=\"refresh\" content=\"0;URL=https://www.naree.co/la/cart_confirm_thank.php?msg=".$_POST['decision']."&invoice_id=".$_POST['req_merchant_secure_data3']."\" />";



}







?>



 