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
require_once DIR."library/Savant3.php";
require_once DIR."library/class/class.phpmailer.php";
?>
<?php
#$db->debug = 1;

//if (! in_array($_SESSION['st_member'], array(1, 4))) {
//  die("<meta http-equiv=\"refresh\" content=\"0; URL=login.php\">");
//}


$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$gettmp["id"] = ($_REQUEST["id"] != null) ? $_REQUEST["id"] : '';
$gettmp["do"] = ($_REQUEST["do"] != null) ? $_REQUEST["do"] : '';
$gettmp["mn"] = ($_REQUEST["mn"] != null) ? $_REQUEST["mn"] : '';


$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);

switch ($gettmp["do"]) {
  case "status" :
    class members_profile extends ADOdb_Active_Record{}

        $item = new members_profile();
        $item->load("id = ? ", array($gettmp["id"]));
        $gettmp['password'] = randompassword(8);
        $item->password = $gettmp['password'];
        $item->status = '0';
        $item->Replace();

        saverecord("Save Data Item");

        $mail = new PHPMailer();
        $body = $mail->getFile("tmpl_profile_member.html");
        if ($body !== false) {
          $body = eregi_replace("&email;", $item->email, $body);
          $body = eregi_replace("&name;", $item->name, $body);
          $body = eregi_replace("&sex;", $item->sex, $body);
          $body = eregi_replace("&password;", $item->password, $body);
          $body = eregi_replace("&birthday;", $item->birthday, $body);
          $body = eregi_replace("&created_date;", $item->created_date, $body);
          $body = eregi_replace("&lastlogin;", $item->lastlogin, $body);
          $body = eregi_replace("&date;", date("Y-m-d"), $body);
          $body = eregi_replace("&time;", date("H:i:s"), $body);
          $body = StripSlashes($body);
        }

        $mail->CharSet = "utf-8";

        $mail->From = "info@naree.co";
        $mail->FromName = "NAREE HAND BAGS - Webmaster ";
        $mail->Subject = "Welcome to Member Status";

        $mail->AddAddress($item->email);
        $mail->AddBCC("chy_boy@hotmail.com");

        $mail->MsgHTML($body);
        $mail->IsHtml(true);
        $mail->Send();


    die("<meta http-equiv=\"refresh\" content=\"0; URL=member_list.php?mn=5&menu=TWVtYmVyIE1hbmFnZW1lbnQ\">");
    break;
 case "activate" :
    class members_profile extends ADOdb_Active_Record{}

        $item = new members_profile();
        $item->load("id = ? ", array($gettmp["id"]));
        $gettmp['password'] = randompassword(8);
        $item->password = $gettmp['password'];
        $item->status = '1';
        $item->Replace();

        saverecord("Activate Member");

        $mail = new PHPMailer();
        $body = $mail->getFile("tmpl_member_active.html");
        if ($body !== false) {
          $body = eregi_replace("&email;", $item->email, $body);
          $body = eregi_replace("&name;", $item->name, $body);
          $body = eregi_replace("&sex;", $item->sex, $body);
          $body = eregi_replace("&passwd;", $item->password, $body);
          $body = eregi_replace("&birthday;", $item->birthday, $body);
          $body = eregi_replace("&register_date;", date("d-m-Y", strtotime($item->registered_date)), $body);
          $body = eregi_replace("&date;", date("Y-m-d"), $body);
          $body = eregi_replace("&time;", date("H:i:s"), $body);
          $body = StripSlashes($body);
        }

        $mail->CharSet = "utf-8";

        $mail->From = "info@naree.co";
        $mail->FromName = "NAREE HAND BAGS - Webmaster ";
        $mail->Subject = "Welcome to Member Status";

        $mail->AddAddress($item->email);
        $mail->AddBCC("chy_boy@hotmail.com");

        $mail->MsgHTML($body);
        $mail->IsHtml(true);
        $mail->Send();


    die("<meta http-equiv=\"refresh\" content=\"0; URL=member_list.php?mn=5&menu=TWVtYmVyIE1hbmFnZW1lbnQ\">");
    break;	
  
  case "delete":
    class members_profile extends ADOdb_Active_Record{}

    $item = new members_profile();
    $item->load("id = ?", array($gettmp["id"]));
    $item->Delete();

    saverecord("Delete Data Item");

    die("<meta http-equiv=\"refresh\" content=\"0; URL=member_list.php?mn=5&menu=TWVtYmVyIE1hbmFnZW1lbnQ\">");
    break;
}
	saverecord("Update Member");
    die("<meta http-equiv=\"refresh\" content=\"0; URL=member_list.php?mn=5&menu=TWVtYmVyIE1hbmFnZW1lbnQ\">");
//$template->display($render);
?>
