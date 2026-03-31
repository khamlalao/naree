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


$template = new Savant3();
      
     
ADOdb_Active_Record::SetDatabaseAdapter($db);

 

	switch ($_POST["do"]) {
    case "insert" : 
      if ($_SESSION["captcha_id"] == $_POST["secure_code"]) : 
        unset($_SESSION["captcha_id"]);
        
        class contactus_contact extends ADOdb_Active_Record{}
        $contact = new contactus_contact(); 
        $contact->subject = ($_POST["subject"] == null) ? null : $_POST["subject"];
        $contact->name = ($_POST["name"] == null) ? null : $_POST["name"];
        $contact->address = ($_POST["address"] == null) ? null : $_POST["address"];
        $contact->mobile = ($_POST["mobile"] == null) ? null : $_POST["mobile"];
        $contact->email = ($_POST["email"] == null) ? null : $_POST["email"];
        $contact->description = ($_POST["description"] == null) ? null : $_POST["description"];
        $contact->post_date = date("Y-m-d H:i:s");
        $contact->post_ip = $_SERVER["REMOTE_ADDR"];
       $contact->readed_status = '0';
        
        if ($contact->save("id")) :    
          unset($_SESSION["contactus_form"]);  		
          // Set Email.
          $mail = new PHPMailer();
          $body = $mail->getFile("tmpl_contact.html");  
          if ($body !== false): 
            $body = eregi_replace("&first_name;", $contact->first_name, $body);
            $body = eregi_replace("&address;", $contact->address, $body);
            $body = eregi_replace("&phone;", $contact->phone, $body);
            $body = eregi_replace("&email;", $contact->email, $body);
            $body = eregi_replace("&description;", $contact->description, $body);
            
            $body = eregi_replace("&date;", date("Y-m-d"), $body);
            $body = eregi_replace("&time;", date("H:i:s"), $body);
            $body = eregi_replace("&ip;", $contact->post_ip, $body);
            $body = StripSlashes($body);  
          endif;
      
          $mail->CharSet = "utf-8";
          $mail->From = "info@naree.co";
          $mail->FromName = "Naee Mail";
          $mail->Subject = "Contact for Naree.co";

          // Member Process
          $mail->Subject = "Contact for NAREE.co";
          $mail->AddAddress($contact->email);
          $mail->AddBCC("boy@1001click.com");
          
          $mail->MsgHTML($body);
          $mail->IsHtml(true);
          
          $mail->Send();
          
          // Admin Process
          $mail->From = $contact->email;
          $mail->FromName = $contact->first_name;
          $mail->to = array(); // Reset.
          $mail->AddAddress("info@naree.co");
          $mail->AddBCC("boy@1001click.com");
          $mail->Send();
              
          $message = "<p>ส่งข้อความเรียบร้อยแล้ว</p>";
          $message .= "<br />ทางบริษัทฯ จะทำการตอบกลับภายใน 7 วัน หลังจากได้รับข้อความจากท่าน<br />";
          $message .= "หากมีข้อสงสัย กรุณาติดต่อเจ้าหน้าที่ฝ่ายบริการลูกค้าในเวลาทำการได้ที่หมายเลขโทรศัพท์ ";
          $template->message = $message;
          $template->redirect = true;
          $template->redirect_delay = 5;
          $template->redirect_url = "contact.php";
        else : 
          $_SESSION["contactus_form"]["first_name"] = $_POST["first_name"];
          $_SESSION["contactus_form"]["address"] = $_POST["address"];
          $_SESSION["contactus_form"]["phone"] = $_POST["phone"];
          $_SESSION["contactus_form"]["email"] = $_POST["email"];
          $_SESSION["contactus_form"]["description"] = $_POST["description"];
          
          $message = "<p>ข้อความของคุณไม่สามารถส่งถึง NAREE HANDS BAG ได้  กรุณาลองใหม่อีกครั้ง</p>";
          $message .= "<a href=\"Javascript:history.back(1)\">กลับไปแก้ไข</a>";
        
          $template->message = $message;
          $template->redirect = false;
          $template->redirect_delay = 5;
          $template->redirect_url = "contact.php";
        endif;
       else : 
          $_SESSION["contactus_form"]["first_name"] = $_POST["first_name"];
          $_SESSION["contactus_form"]["address"] = $_POST["address"];
          $_SESSION["contactus_form"]["phone"] = $_POST["phone"];
          $_SESSION["contactus_form"]["email"] = $_POST["email"];
          $_SESSION["contactus_form"]["description"] = $_POST["description"];

          
        $message = "<p>คุณกรอกตัวอักษรไม่ตรงตามรหัสภาพ  กรุณาลองใหม่อีกครั้ง</p>";
        $message .= "<a href=\"Javascript:history.back(1)\">กลับไปแก้ไข</a>";
		
		
        $template->message = $message;
        $template->redirect = false;
        $template->redirect_delay = 5;
        $template->redirect_url = "contact.php";
      endif;
     
      $template->contact = $contact;
      break;
    default :
  }                                               
  
  $template->do = $gettmp["do"];

  $template->display($render);
?>