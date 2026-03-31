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
#$db->debug=1;
#print_r($_POST);
$gettmp['ip'] = $_SERVER['REMOTE_ADDR'];

		if($_SESSION['session_login'] == null){
			$render = 'member.php';
		}else{
			$render = 'cart_shipping.php';
		}
?>
<?php
if (($_POST["MM_action"] == "login")) {
  $gettmp['username'] = $_POST['username'];
  $gettmp['password'] = $_POST['password'];
  $sql = "SELECT * FROM members_profiles WHERE members_profiles.email = ? and members_profiles.status = ? ";
  $stmt = $db->Prepare($sql);
  $rs = $db->Execute($stmt,array($gettmp['username'],1));
  $numrows=$rs->RecordCount();

  if ($numrows == 1) {
    if ($gettmp['password'] == $rs->fields['password']) {
		//echo $gettmp['password'];
      $login = true;
      $_SESSION['member_id'] =  $rs->fields['id'];
      $_SESSION['email'] = $rs->fields['email'];
      $_SESSION['member_lastlogin'] = $rs->fields['lastlogin'];date('Y',strtotime($rs->fields['lastlogin']));
      $_SESSION['member_name'] = $rs->fields['name'];
      $_SESSION['member_birthday'] =  $rs->fields['birthday'];
      $_SESSION['session_login'] = ($_SESSION['session_login'] == null) ? session_id() : $_SESSION['session_login'];
      
      $sql = "UPDATE members_profiles SET members_profiles.lastlogin = ? WHERE members_profiles.id = ? ";
      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt, array(date("Y-m-d H:i:s"), $_SESSION['member_id']));

      $sql = "SELECT * FROM session_orders WHERE session_orders.session_code = ? ";
      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt, array($_SESSION['session_login']));
       
      if (!$rs->EOF){
        $gettmp['pid'] = $rs->fields['pid'];
        $gettmp['amount'] = $rs->fields['amount'];
        $sql = "SELECT * FROM product_items WHERE product_items.id = ? ";
        $stmt = $db->Prepare($sql);
        $rs = $db->Execute($stmt, array($gettmp['pid']));
        $gettmp['unit_price'] = $rs->fields['price_std'];
        $gettmp['total'] = $gettmp['unit_price']*$gettmp['amount'];
         
        /*		ADOdb_Active_Record::SetDatabaseAdapter($db);
         class session_order extends ADOdb_Active_Record{}
        $temp_order = new session_order();
        $temp_order->load("session_code= ?", array($_SESSION['session_login'])); //  Login
        $temp_order->member_id = $_SESSION['member_id'];
        $temp_order->unit_price = $gettmp['unit_price'];
        $temp_order->total = $gettmp['total'];
        $temp_order->replace();
         
        */
        $sql = "UPDATE session_orders SET  session_orders.member_id = ?  WHERE session_orders.session_code = ? ";
        $stmt = $db->Prepare($sql);
        $rs = $db->Execute($stmt, array($_SESSION['member_id'],$_SESSION['session_login']));
      }
      $msg = urlsafe_b64encode('Successful.');
      $login = true;
      $_SESSION['login']= true;
	  
		
      
      //saverecord('Login');
      
      if ($_POST['remember'] == 1) {
        //ob_start();
        $time = (time()+(60*60*24*7));
        //$time = (time()+(10));
        if ($_COOKIE['time'] == null) {
          setcookie("time", $time, $time);
          setcookie("username", $gettmp[username], $time);
          setcookie("password", $gettmp[password], $time);
        } else {
          setcookie("username", $gettmp[username], $_COOKIE['time']);
          setcookie("password", $gettmp[password], $_COOKIE['time']);
        }
        //ob_end_flush();
      } else { // Reset
        setcookie("username");
        setcookie("password");
        setcookie("time");
      }
    } else {
      $msg = urlsafe_b64encode('ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ');
      $login = false;
      $render = 'member_login.php';
    }
  } else {
    $msg = urlsafe_b64encode('ອີເມລບໍ່ຖືກຕ້ອງ ');
    $login = false;
    $render = 'member_login.php';
  }
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=$render?msg=$msg\" />";
} else {
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=member_login.php\" />";
}
$db->close();
?>