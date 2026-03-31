<?php
require_once "common.inc.php";
//require_once DIR."library/config/sessionstart.php";
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
#$db->debug = 1;
#print_r($_POST);
$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$gettmp["menu"] = urlsafe_b64decode($_GET['menu']);
$gettmp["mn"] = urlsafe_b64decode($_GET['mn']);
$gettmp["sub"] = urlsafe_b64decode($_GET['sub']);
$gettmp["do"] = ($_POST["do"] != null) ? $_POST["do"] : '';
$gettmp["id"] = ($_POST["id"] != null) ? $_POST["id"] : '1';

$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);

		class rate_exchange extends ADOdb_Active_Record{}


		if($gettmp['do'] == 'update'){
		#$db->debug = 1;

//print_r($_POST);	
  		$rate_exchange = new rate_exchange();
 		$rate_exchange->load("id = ?", array($gettmp["id"]));
   		$rate_exchange->usd = '1';
   		$rate_exchange->lak = ($_POST["lak"] != null) ? encodeToDB($_POST["lak"]) : null;
   		$rate_exchange->created_date = date("Y-m-d");
		$rate_exchange->Replace();

		}

	//	class rate_exchange extends ADOdb_Active_Record{}
  		$item = new rate_exchange();
 		$item->load("id = ?", array($gettmp["id"]));
		$template->item = $item;

	

$template->display($render);
?>