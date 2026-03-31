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

switch ($_POST["do"]) {
  case "update" :
    class members_profile extends ADOdb_Active_Record{}
      $member = new members_profile();
      $member->load("id = ?", array($_SESSION['member_id']));
      $member->email = ($_POST["email"] == null) ? null : $_POST["email"];
      $member->name = ($_POST["name"] == null) ? null : $_POST["name"];
      $member->sex = ($_POST["sex"] == null) ? null : $_POST["sex"];       
      $member->birthday = $_POST["bd_year"]."-".$_POST["bd_month"]."-".$_POST["bd_date"];  
      $member->modified_date = date("Y-m-d H:i:s");
       
      $gettmp['passwd_old'] = ($_POST["passwd_old"] == null) ? null : $_POST["passwd_old"];
      $gettmp['passwd_new'] = ($_POST["passwd_new"] == null) ? null : $_POST["passwd_new"];
      $gettmp['passwd_re'] = ($_POST["passwd_re"] == null) ? null : $_POST["passwd_re"];
	  if($gettmp['passwd_old'] == $member->password){
		$member->password = $gettmp['passwd_new'];   
	  }

    if ($member->Replace()){
     // unset($_SESSION["member"]);
      //$gettmp['url'] = "http://".$_SERVER["HTTP_HOST"]."/th/member_login_activate.php?id=".$member->id."&authen=".$gettmp['authen']."&do=Activate";
      $gettmp['id'] = $member->id;

      $message = "<p>บันทึกข้อมูลเรียบร้อยแล้วค่ะ</p>";

      $template->msg_title = "แก้ไขข้อมูลสมาชิก";
      $template->message = $message;
      $template->redirect = true;
      $template->redirect_delay = 10;
      $template->redirect_url = "member.php";
    } else {
    /* 
      $_SESSION["member"]["zipcode_job"] = ($_POST["zipcode_job"] == null) ? null : $_POST["zipcode_job"];
      $_SESSION["member"]["postcode"] = ($_POST["postcode"] == null) ? null : $_POST["postcode"];
      $_SESSION["member"]["postcode_job"] = ($_POST["postcode_job"] == null) ? null : $_POST["postcode_job"];
      $_SESSION["member"]["expedition"] = ($_POST["expedition"] == null) ? null : $_POST["expedition"];
      $_SESSION["member"]["expedition_job"] = ($_POST["expedition_job"] == null) ? null : $_POST["expedition_job"];
      $_SESSION["member"]["mobile"] = ($_POST["mobile"] == null) ? null : $_POST["mobile"];
      $_SESSION["member"]["phone"] = ($_POST["phone"] == null) ? null : $_POST["phone"];
      $_SESSION["member"]["fax"] = ($_POST["fax"] == null) ? null : $_POST["fax"];
      $_SESSION["member"]["subscribe"] = ($_POST["subscribe"] == null) ? null : $_POST["subscribe"];
*/
      $message = "<p>ระบบไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้งค่ะ</p>";
      $message .= "<a href=\"Javascript:history.back(1)\">กลับไปแก้ไข</a>";

      $msg_title = "แก้ไขข้อมูลสมาชิก";
      $message = $message;
      $redirect = false;
      $redirect_delay = 0;
      $redirect_url = "member.php";
    }
	 echo "<meta http-equiv=\"refresh\" content=\"0;URL=member.php\" />";
    break;
  case'forgot':
  #$db->debug=1;
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
          $gettmp['url'] = "http://".$_SERVER["HTTP_HOST"]."/en/member_forgot_activate.php?id=".$member->id."&authen=".$gettmp['authen']."&do=Activate";
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
			$mail->CharSet = "utf-8";  
			$mail->Host     = "mail.naree.co"; 
			$mail->SMTPAuth = true;                            
			$mail->Username = "info@naree.co";                     
			$mail->Password = "Naree1001";	
			$mail->IsHTML(true); 
			$mail->MsgHTML($body);


          $mail->AddAddress($member->email);
          $mail->AddBCC("project@1001click.com");
		  $mail->AddBCC("boy@1001click.com");
		  
		  echo $body;

          if($mail->Send()){

          $message = "<p>ระบบได้ทำการส่งอีเมล์ยืนยันการแก้ไขรหัสผ่านให้คุณเรียบร้อยแล้วค่ะ <br><br><strong> กรุณาเช็คที่เมล์กล่องขาเข้า หรือเช็คที่กล่องถังขยะ (Junk Mail)<br> เมล์ที่ส่งไปหาท่านอาจอยู่ในนั้น ให้ลองเปิดดูค่ะ</strong></p>";
		  }else{
		  $message = "<p>ข้อความของคุณไม่สามารถส่งได้  กรุณาลองใหม่อีกครั้งค่ะ</p>";
          $message .= "<a href=\"Javascript:history.back(1)\">กลับไปแก้ไข</a>";
		  }
	  

          $template->msg_title = "เข้าสู่ระบบ";
          $template->message = $message;
          $template->redirect = true;
          $template->redirect_delay = 10;
          $template->redirect_url = "member_login.php";
        }
      } else {
        $message = "<p>ข้อความของคุณไม่สามารถส่งได้  กรุณาลองใหม่อีกครั้งค่ะ</p>";
        $message .= "<a href=\"Javascript:history.back(1)\">กลับไปแก้ไข</a>";

        $template->msg_title = "เข้าสู่ระบบ";
        $template->message = $message;
        $template->redirect = false;
        $template->redirect_delay = 10;
        $template->redirect_url = "member_login.php";
      }
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=member_login.php?msg=$msg\" />";
	  
    break;
  default :
}
//$template->display($render);
?>
 