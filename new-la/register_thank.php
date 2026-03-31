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

?>
<?php
global $db;
#$db->debug=1;

$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$template = new Savant3();

ADOdb_Active_Record::SetDatabaseAdapter($db);
// status 1 = 'la' , 2 = 'en' , 3 = 'all'

switch ($_POST["do"]) {
  case "insert" :
 //   if ($_SESSION["captcha_id"] == $_POST["secure_code"]) {
      unset($_SESSION["captcha_id"]);
	  
	  
	  $sql = "SELECT MAX(SUBSTRING(memberID, 5, 6)) AS memberID FROM members_profiles WHERE SUBSTRING(memberID, 3, 2) = ? ";
	  $stmt = $db->Prepare($sql);
	  $year = (date("y"));
	  $MemberCode = "NR";
	  $val = $db->GetOne($stmt, array($year));
	  
	  $gettmp['member_code'] = 'NR'.$year.str_pad(($val + 1) , 6, "0", STR_PAD_LEFT); // Pattern : YYMM000001 e.g. 1601000001	  
	  

      class members_profile extends ADOdb_Active_Record{}
      $member = new members_profile();
      $member->memberid = $gettmp["member_code"];       
      $member->email = ($_POST["email"] == null) ? null : $_POST["email"];
      $member->password = ($_POST["password"] == null) ? null : $_POST["password"];
      $member->name = ($_POST["name"] == null) ? null : $_POST["name"];
      $member->sex = ($_POST["sex"] == null) ? null : $_POST["sex"];       
      $member->birthday = $_POST["bd_year"]."-".$_POST["bd_month"]."-".$_POST["bd_date"];  
//      $member->birthday = date("Y-m-d", strtotime($_POST["birth_date"]));
	  
	  $gettmp['authen'] = createRandomPassword();
      $member->authencode = $gettmp['authen'];
      $member->created_date = date("Y-m-d H:i:s");
      $member->modified_date = date("Y-m-d H:i:s");
      $member->registered_date = date("Y-m-d H:i:s");
       
      $gettmp['registered_date'] = date("Y-m-d H:i:s");
      $member->status = '0';
	  $member->save();
	  
	  
	  $gettmp['url'] = "http://".$_SERVER["HTTP_HOST"]."/la/member_login_activate.php?id=".$member->id."&authen=".$gettmp['authen']."&do=Activate";
	  
	  $mail = new PHPMailer();
       $body = $mail->getFile("tmpl_mail_activate.html");
      if ($body !== false):
      $body = eregi_replace("&email;", $member->email, $body);
      $body = eregi_replace("&name;", $member->name, $body);
      $body = eregi_replace("&sex;", $member->sex, $body);
      $body = eregi_replace("&birthday;", $member->birthday, $body);
      $body = eregi_replace("&url;", $gettmp['url'] , $body);
      $body = eregi_replace("&authen;", $gettmp['authen'], $body);
      $body = eregi_replace("&register_date;", $gettmp['registered_date'], $body);
      $body = StripSlashes($body);
      endif;


      $mail->CharSet = "utf-8";
      $mail->From = "info@naree.co";
      $mail->FromName = "Naree Handbags Mail";
      $mail->Subject = "New Member Register for Naree.co";
	  
     	    $mail->IsSMTP();        
			$mail->Host     = "mail.naree.co"; 
			$mail->SMTPAuth = true;                            
			$mail->Username = "info@naree.co";                     
			$mail->Password = "Naree1001";                         
			$mail->IsHTML(true); 
			$mail->MsgHTML($body);
            $mail->AddAddress($member->email);
            $mail->AddBCC("boy@1001click.com");



     		 $mail->Send();




     
  //  } else {
   //   $_SESSION["member"]["email"] = ($_POST["email"] == null) ? null : $_POST["email"];
   //   $_SESSION["member"]["name"] = ($_POST["name"] == null) ? null : $_POST["name"];
  //    $_SESSION["member"]["birth_day"] = ($_POST["birth_date"] == null) ? null : $_POST["birth_date"];

  //    $message = "<p>คุณกรอกตัวอักษรไม่ตรงตามรหัสภาพ  กรุณาลองใหม่อีกครั้งค่ะ</p>";
  //    $message .= "<a href=\"Javascript:history.back(1)\">กลับไปแก้ไข</a>";


  //    $template->msg_title = "สมัครสมาชิก";
  //    $template->message = $message;
  //    $template->redirect = false;
  //    $template->redirect_delay = 10;
  //    $template->redirect_url = "member_register.php";
   // }

    $template->member = $member;
    break;
  case "update" :

    class members_profile extends ADOdb_Active_Record{}
    $member = new members_profile();
    $member->load("id = ?", array($_SESSION['member_id']));
         $member->email = ($_POST["email"] == null) ? null : $_POST["email"];
      $member->password = ($_POST["password"] == null) ? null : $_POST["password"];
      $member->name = ($_POST["name"] == null) ? null : $_POST["name"];
      $member->sex = ($_POST["sex"] == null) ? null : $_POST["sex"];       
      $member->birthday = $_POST["bd_year"]."-".$_POST["bd_month"]."-".$_POST["bd_date"];  
      $member->created_date = date("Y-m-d H:i:s");
      $member->modified_date = date("Y-m-d H:i:s");
       
    //$gettmp['authen'] = createRandomPassword();
    //$member->authencode = $gettmp['authen'];

    $member->modified_date = date("Y-m-d H:i:s");
    //$member->status = '1';

    if ($member->Replace()) {
      unset($_SESSION["member"]);
      //$gettmp['url'] = "http://".$_SERVER["HTTP_HOST"]."/th/member_login_activate.php?id=".$member->id."&authen=".$gettmp['authen']."&do=Activate";
      $gettmp['id'] = $member->id;

      // Set Email.
      /*         $mail = new PHPMailer();
       $body = $mail->getFile("tmpl_member_activate.html");
      if ($body !== false):
      $body = eregi_replace("&id;", $member->id, $body);
      $body = eregi_replace("&url;", $gettmp['url'] , $body);
      $body = eregi_replace("&authen;", $gettmp['authen'], $body);
      $body = eregi_replace("&date;", date("Y-m-d"), $body);
      $body = eregi_replace("&time;", date("H:i:s"), $body);
      $body = StripSlashes($body);
      endif;

      $mail->CharSet = "utf-8";
      $mail->From = "noreply@siamintermart.com";
      $mail->FromName = "Siamintermart - Webmaster ";
      $mail->Subject = $member->name_la."  ".$member->surname_la."  Register Siamintermart Member ";

      $mail->AddAddress($member->email);
      $mail->AddBCC("chy_boy@hotmail.com");

      $mail->MsgHTML($body);
      $mail->IsHtml(true);

      $mail->Send();
      */
      $message = "<p>บันทึกข้อมูลเรียบร้อยแล้วค่ะ</p>";

      $template->msg_title = "แก้ไขข้อมูลสมาชิก";
      $template->message = $message;
      $template->redirect = true;
      $template->redirect_delay = 10;
      $template->redirect_url = "member.php";
    } else {
      $_SESSION["member"]["email"] = ($_POST["email"] == null) ? null : $_POST["email"];
      $_SESSION["member"]["name_la"] = ($_POST["name_la"] == null) ? null : $_POST["name_la"];
      $_SESSION["member"]["name_la"] = ($_POST["name_la"] == null) ? null : $_POST["name_la"];
      $_SESSION["member"]["surname_la"] = ($_POST["surname_la"] == null) ? null : $_POST["surname_la"];
      $_SESSION["member"]["surname_la"] = ($_POST["surname_la"] == null) ? null : $_POST["surname_la"];
      $_SESSION["member"]["birth_day"] = ($_POST["birth_day"] == null) ? null : $_POST["birth_day"];
      $_SESSION["member"]["birth_month"] = ($_POST["birth_month"] == null) ? null : $_POST["birth_month"];
      $_SESSION["member"]["birth_year"] = ($_POST["birth_year"] == null) ? null : $_POST["birth_year"];
      $_SESSION["member"]["address"] = ($_POST["address"] == null) ? null : $_POST["address"];
      $_SESSION["member"]["address_job"] = ($_POST["address_job"] == null) ? null : $_POST["address_job"];
      $_SESSION["member"]["country_id"] = ($_POST["country_id"] == null) ? null : $_POST["country_id"];
      $_SESSION["member"]["country_id_job"] = ($_POST["country_id_job"] == null) ? null : $_POST["country_id_job"];
      $_SESSION["member"]["city"] = ($_POST["city"] == null) ? null : $_POST["city"];
      $_SESSION["member"]["city_job"] = ($_POST["city_job"] == null) ? null : $_POST["city_job"];
      $_SESSION["member"]["province_id"] = ($_POST["province_id"] == null) ? null : $_POST["province_id"];
      $_SESSION["member"]["province_id_job"] = ($_POST["province_id_job"] == null) ? null : $_POST["province_id_job"];
      $_SESSION["member"]["district_id"] = ($_POST["district_id"] == null) ? null : $_POST["district_id"];
      $_SESSION["member"]["district_id_job"] = ($_POST["district_id_job"] == null) ? null : $_POST["district_id_job"];
      $_SESSION["member"]["subdistrict"] = ($_POST["subdistrict"] == null) ? null : $_POST["subdistrict"];
      $_SESSION["member"]["subdistrict_job"] = ($_POST["subdistrict_job"] == null) ? null : $_POST["subdistrict_job"];
      $_SESSION["member"]["state"] = ($_POST["state"] == null) ? null : $_POST["state"];
      $_SESSION["member"]["state_job"] = ($_POST["state_job"] == null) ? null : $_POST["state_job"];
      $_SESSION["member"]["zipcode"] = ($_POST["zipcode"] == null) ? null : $_POST["zipcode"];
      $_SESSION["member"]["zipcode_job"] = ($_POST["zipcode_job"] == null) ? null : $_POST["zipcode_job"];
      $_SESSION["member"]["postcode"] = ($_POST["postcode"] == null) ? null : $_POST["postcode"];
      $_SESSION["member"]["postcode_job"] = ($_POST["postcode_job"] == null) ? null : $_POST["postcode_job"];
      $_SESSION["member"]["expedition"] = ($_POST["expedition"] == null) ? null : $_POST["expedition"];
      $_SESSION["member"]["expedition_job"] = ($_POST["expedition_job"] == null) ? null : $_POST["expedition_job"];
      $_SESSION["member"]["mobile"] = ($_POST["mobile"] == null) ? null : $_POST["mobile"];
      $_SESSION["member"]["phone"] = ($_POST["phone"] == null) ? null : $_POST["phone"];
      $_SESSION["member"]["fax"] = ($_POST["fax"] == null) ? null : $_POST["fax"];
      $_SESSION["member"]["subscribe"] = ($_POST["subscribe"] == null) ? null : $_POST["subscribe"];

      $message = "<p>ระบบไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้งค่ะ</p>";
      $message .= "<a href=\"Javascript:history.back(1)\">กลับไปแก้ไข</a>";

      $template->msg_title = "แก้ไขข้อมูลสมาชิก";
      $template->message = $message;
      $template->redirect = false;
      $template->redirect_delay = 10;
      $template->redirect_url = "member.php";
    }

    $template->member = $member;
    break;
  case'forgot':
    if ($_SESSION["captcha_id"] == $_POST["secure_code"]) {
      unset($_SESSION["captcha_id"]);
      $gettmp["email"] = ($_POST["email"] == null) ? null : $_POST["email"];

      $stmt = $db->Prepare("SELECT *,Count(members_profiles.id) AS amount From members_profiles WHERE members_profiles.email = ?  ");
      $rs = $db->Execute($stmt, array($gettmp["email"]));
      $itemCount = $rs->fields["amount"];
      $gettmp["id"] =  $rs->fields["id"];
      if($itemCount > 0){
        class members_profile extends ADOdb_Active_Record{}
        $member = new members_profile();
        $member->load("id = ?", array($gettmp["id"]));
        $member->status = '0';
        $gettmp['authen'] = createRandomPassword();
        $member->authencode = $gettmp['authen'];
        if ($member->replace()) {
          unset($_SESSION["member"]);
          $gettmp['url'] = "http://".$_SERVER["HTTP_HOST"]."/th/member_forgot_activate.php?id=".$member->id."&authen=".$gettmp['authen']."&do=Activate";
          $gettmp['id'] = $member->id;

          // Set Email.
          $mail = new PHPMailer();
          $body = $mail->getFile("tmpl_member_forgot.html");
          if ($body !== false) {
            $body = eregi_replace("&id;", $member->id, $body);
            $body = eregi_replace("&url;", $gettmp['url'] , $body);
            $body = eregi_replace("&authen;", $gettmp['authen'], $body);
            $body = eregi_replace("&date;", date("Y-m-d"), $body);
            $body = eregi_replace("&time;", date("H:i:s"), $body);
            $body = StripSlashes($body);
          }
		  

     	    $mail->CharSet = "utf-8";
    		$mail->From = "info@naree.co";
    		$mail->FromName = "Naree Handbags Mail";
    		$mail->Subject = "Forgot Password Member for Naree.co";
	  
     	    $mail->IsSMTP();        
			$mail->Host     = "mail.naree.co"; 
			$mail->SMTPAuth = true;                            
			$mail->Username = "info@naree.co";                     
			$mail->Password = "Naree1001";                         
			$mail->IsHTML(true); 
			$mail->MsgHTML($body);
            $mail->AddAddress($member->email);
            $mail->AddBCC("boy@1001click.com");

          if($mail->Send()){

          $message = "<p>ระบบได้ทำการส่งอีเมล์ยืนยันการแก้ไขรหัสผ่านให้คุณเรียบร้อยแล้วค่ะ <br><br><strong> กรุณาเช็คที่เมล์กล่องขาเข้า หรือเช็คที่กล่องถังขยะ (Junk Mail)<br> เมล์ที่ส่งไปหาท่านอาจอยู่ในนั้น ให้ลองเปิดดูค่ะ</strong></p>";
		  }else{
		  $message = "<p>ข้อความของคุณไม่สามารถส่งถึง Siamintermart.com ได้  กรุณาลองใหม่อีกครั้งค่ะ</p>";
          $message .= "<a href=\"Javascript:history.back(1)\">กลับไปแก้ไข</a>";
		  }
	  

          $template->msg_title = "เข้าสู่ระบบ";
          $template->message = $message;
          $template->redirect = true;
          $template->redirect_delay = 10;
          $template->redirect_url = "member_login.php";
        }
      } else {
        $message = "<p>ข้อความของคุณไม่สามารถส่งถึง Siamintermart.com ได้  กรุณาลองใหม่อีกครั้งค่ะ</p>";
        $message .= "<a href=\"Javascript:history.back(1)\">กลับไปแก้ไข</a>";

        $template->msg_title = "เข้าสู่ระบบ";
        $template->message = $message;
        $template->redirect = false;
        $template->redirect_delay = 10;
        $template->redirect_url = "member_login.php";
      }
    } else { // else check captcha
      $message = "<p>คุณกรอกตัวอักษรไม่ตรงตามรหัสภาพ  กรุณาลองใหม่อีกครั้งค่ะ</p>";
      $message .= "<a href=\"Javascript:history.back(1)\">กลับไปแก้ไข</a>";


      $template->msg_title = "เข้าสู่ระบบ";
      $template->message = $message;
      $template->redirect = false;
      $template->redirect_delay = 10;
      $template->redirect_url = "member_login.php";
    } // end check captcha
    $template->member = $member;
    break;
  default :
}


$template->display($render);
?>
 