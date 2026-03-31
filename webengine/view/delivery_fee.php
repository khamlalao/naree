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
//print_r($_POST);
$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$gettmp["menu"] = urlsafe_b64decode($_GET['menu']);
$gettmp["mn"] = urlsafe_b64decode($_GET['mn']);
$gettmp["sub"] = urlsafe_b64decode($_GET['sub']);
$gettmp["do"] = ($_POST["do"] != null) ? $_POST["do"] : '';

$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);



if($gettmp['do'] == 'update'){
#$db->debug = 1;

#print_r($_POST);	
class price_zone extends ADOdb_Active_Record{}

foreach ($_POST["chkbox"] as $row => $gettmp["no"]) :   
        $gettmp["id"] = $_POST["id"][$gettmp["no"] - 1];        
        $gettmp["weight"] = $_POST["weight"][$gettmp["no"] - 1];        
        $gettmp["vte_capital"] = $_POST["vte_capital"][$gettmp["no"] - 1];        
        $gettmp["vte_province"] = $_POST["vte_province"][$gettmp["no"] - 1];        
        $gettmp["zone0"] = $_POST["zone0"][$gettmp["no"] - 1];        
        $gettmp["zone1"] = $_POST["zone1"][$gettmp["no"] - 1];        
        $gettmp["zone2"] = $_POST["zone2"][$gettmp["no"] - 1];        
        $gettmp["zone3"] = $_POST["zone3"][$gettmp["no"] - 1];        
        $gettmp["zone4"] = $_POST["zone4"][$gettmp["no"] - 1];        
        $gettmp["zone5"] = $_POST["zone5"][$gettmp["no"] - 1];        
        $gettmp["zone6"] = $_POST["zone6"][$gettmp["no"] - 1];        
       // $gettmp["to"] = $_POST["sequence_new"][$gettmp["no"] - 1];
		
	
  		$item = new price_zone();
 		$item->load("id = ?", array($gettmp["id"]));
   		$item->weight = ($gettmp["weight"] != null) ? encodeToDB($gettmp["weight"]) : null;
   		$item->vte_capital = ($gettmp["vte_capital"] != null) ? encodeToDB($gettmp["vte_capital"]) : null;
   		$item->vte_province = ($gettmp["vte_province"] != null) ? encodeToDB($gettmp["vte_province"]) : null;
   		$item->zone0 = ($gettmp["zone0"] != null) ? encodeToDB($_POST["zone0"]) : null;
   		$item->zone1 = ($gettmp["zone1"] != null) ? encodeToDB($gettmp["zone1"]) : null;
   		$item->zone2 = ($gettmp["zone2"] != null) ? encodeToDB($gettmp["zone2"]) : null;
   		$item->zone3 = ($gettmp["zone3"] != null) ? encodeToDB($gettmp["zone3"]) : null;
   		$item->zone4 = ($gettmp["zone4"] != null) ? encodeToDB($gettmp["zone4"]) : null;
   		$item->zone5 = ($gettmp["zone5"] != null) ? encodeToDB($gettmp["zone5"]) : null;
   		$item->zone6 = ($gettmp["zone6"] != null) ? encodeToDB($gettmp["zone6"]) : null;
		
		$item->Replace();

		
endforeach;
//print_r($_POST);	

}

$sql = "SELECT * FROM price_zones m WHERE 1 = 1 ORDER BY m.id ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt);
$itemList = $rs->GetAssoc();
$itemListCount = $rs->maxRecordCount();

$template->itemList = $itemList;
$template->itemListCount = $itemListCount;

	

$template->display($render);
?>