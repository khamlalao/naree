<?php
require_once "common.inc.php";
require_once DIR."library/config/sessionstart.php";
require_once DIR."library/config/checksessionlogin.php";
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
$datenow = date('Y-m-d');
$year = date('Y');
$th_year = $year+543;
function show_date($datenow){
	
		$thmonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	
		// tmp : value date

			list($year,$month,$day)=explode("-",$datenow);	
			$th_year = $year+543;
			$time = date("H:i:s");
			$datedit=$day." ".$thmonth[$month-1]." ".$th_year."  ".$time;			

		return $datedit;
	}
	
 $render = '../login.php';
 $last_login = date("Y-m-d H:i:s");
//saverecord('Logout');
      $stmt = $db->Prepare("UPDATE admin_infos SET admin_infos.last_date = ? WHERE admin_infos.admin_id = ? ");
      $rs = $db->Execute($stmt, array($last_login, $_SESSION['adminid'])); 

$db->close();
session_destroy();
echo "<meta http-equiv=\"refresh\" content=\"0;URL=$render\" />";
?>