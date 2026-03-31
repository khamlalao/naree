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


switch ($_GET["do"]) {

  case "Activate" :
    $gettmp["id"] = ($_GET["id"] == null) ? null : $_GET["id"];
    $gettmp["authen"] = ($_GET["authen"] == null) ? null : $_GET["authen"];
    $gettmp['date_chk'] = date("Y-m-d",strtotime("-7 days",strtotime(date("Y-m-d"))));
    
    $sql = "
      SELECT Count(members_profiles.id) AS amount 
      FROM members_profiles 
      WHERE members_profiles.id = ? 
      AND members_profiles.authencode = ? 
      AND members_profiles.registered_date > ?
      ";
    $stmt = $db->Prepare($sql);
    $rs = $db->Execute($stmt, array($gettmp["id"], $gettmp["authen"], $gettmp['date_chk']));
    $itemCount = $rs->fields["amount"];
     
    if ($itemCount > 0){
      $sql = "
        SELECT Max(Cast(members_profiles.member_id AS UNSIGNED)) AS max FROM members_profiles
        ";
      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt);
      $max = $rs->fields["max"];
      $max = $max + 1;
      
      $sql = "
        UPDATE members_profiles 
        SET 
        members_profiles.member_id = ?, 
        members_profiles.status = '1', 
        members_profiles.member_type = '1' 
        WHERE members_profiles.id = ? 
        ";
      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt, array($max, $gettmp["id"]));
       
      class members_profile extends ADOdb_Active_Record{}
      $member = new members_profile();
      $member->load("id = ?", array($gettmp["id"]));
      $member->status = '1';
      $member->Replace();
	  
      $template->member = $member;


      // Set Email.
      $mail = new PHPMailer();
      $body = $mail->getFile("tmpl_member_active.html");
      if ($body !== false) {
        $body = eregi_replace("&name;", $member->name, $body);
        $body = eregi_replace("&passwd;", $member->password, $body);
        $body = eregi_replace("&birthday;", $member->birthday, $body);
        $body = eregi_replace("&email;", $member->email, $body);
        $body = eregi_replace("&sex;", $member->sex, $body);
        $body = eregi_replace("&register_date;", date("d-m-Y", strtotime($member->registered_date)), $body);
        $body = eregi_replace("&date;", date("Y-m-d"), $body);
        $body = eregi_replace("&time;", date("H:i:s"), $body);
        $body = StripSlashes($body);
      }

      $mail->CharSet = "utf-8";
      $mail->From = "info@naree.co";
      $mail->FromName = "Naree Handbags Mail";
      $mail->Subject = "Register for Naree.co";

     	    $mail->IsSMTP();        
			$mail->CharSet = "utf-8";  
			$mail->Host     = "mail.naree.co"; 
			$mail->SMTPAuth = true;                            
			$mail->Username = "info@naree.co";                     
			$mail->Password = "Naree1001";	
			$mail->IsHTML(true); 
			$mail->MsgHTML($body);


      $mail->AddAddress($member->email);
      $mail->AddBCC("boy@1001click.com");


  
      $mail->Send();
      
      // Admin Process
      $mail->From = $member->email;
      $mail->FromName = $member->name;
      $mail->to = array(); // Reset.
      $mail->AddAddress("project@1001click.com");
    //  $mail->AddBCC("boy@1001click.com");
      $mail->Send();

      $message = "<p>ยินดีต้อนรับสู่การเป็นสมาชิก Naree Handbags ค่ะ ท่านสามารถเข้าสู่ระบบเพื่อทำการสั่งซื้อสินค้าได้เลยค่ะ</p>";

      $template->message = $message;
      $template->redirect = true;
      $template->redirect_delay = 5;
      $template->redirect_url = "member_login.php";
    }else {
      $message = "<p>ข้อมูลสมาชิกของคุณเลยกำหนด 7 วัน กรุณาทำการสมัครใหม่</p>";

      $template->message = $message;
      $template->redirect = true;
      $template->redirect_delay = 5;
      $template->redirect_url = "register.php";
	  }
	  $template->member = $member;
	  break;
  default :
}


$template->display($render);
?>
 