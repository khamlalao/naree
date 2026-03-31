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
?>
<?php
//$db->debug=true;
  if (!empty($_REQUEST["MM_action"])) :
    $gettmp['username'] = $_POST['username'];
    $gettmp['password'] = $_POST['password'];
    $password = $_POST['password']; 

    $sql = "SELECT * FROM admins WHERE admins.username = ? AND admins.password = ? AND admins.status = ? ";
    $stmt = $db->Prepare($sql);
    if ($db->databaseType == "mssql") $stmt = $sql; // Fix for mssql prepare stmt
    $rs = $db->Execute($stmt,array($gettmp['username'],$gettmp['password'],1));
    $numrows=$rs->RecordCount();
    $sql = "SELECT st_members.st_member_detail,st_members.st_member, admins.id FROM admins INNER JOIN st_members ON st_members.st_member = admins.st_member WHERE admins.id = ? ";
    $stmt = $db->Prepare($sql);
    if ($db->databaseType == "mssql") $stmt = $sql; // Fix for mssql prepare stmt
    $rsadmin = $db->Execute($stmt,array($rs->fields['id'],1));
    $login_status =  $rsadmin->fields['st_member_detail'];
    # echo $numrows;
    if ($numrows == 1) :  
	 if ($gettmp['password'] == $rs->fields['password']) :
        $login = true;	
        $_SESSION['adminid'] =  $rs->fields['id'];
        $_SESSION['lastadmin'] = $rs->fields['last_date'];
        $_SESSION['statusadmin'] = $rsadmin->fields['st_member_detail'];
        $_SESSION['nameadmin'] =  $rs->fields['name'];
        $_SESSION['surnameadmin'] =  $rs->fields['surname'];
        $_SESSION['teladmin'] =  $rs->fields['tel'];
        $_SESSION['email_admin'] =  $rs->fields['email'];
        $_SESSION['admin_id'] =  $rs->fields['id'];
        $_SESSION['end_date'] =  $rs->fields['end_date'];
        $_SESSION['st_member'] =  $rs->fields['st_member'];

        $_SESSION['pv_code'] = $rs->fields['province'];


        $msg = urlsafe_b64encode('Successful.');
        $login = true;
        $_SESSION['login']= true;
        $render = 'index.php';
        //saverecord('Login');
      else :
       
      $login = false;
      $render = '../login.php';
      endif;
    else :
      $msg = urlsafe_b64encode('ท่านกรอกรหัสสมาชิกไม่ถูกต้อง');	
      $login = false;
      $render = '../login.php';
    endif;
  endif;
  $db->close();
 // print_r($_SESSION);
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=$render?msg=$msg\" />";
?>