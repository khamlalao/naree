<?php
require_once "common.inc.php";
//require_once DIR."library/config/sessionstart.php";
//require_once DIR."library/config/checksessionlogin.php";
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
#$db->debug = 1;
//echo DIR."library/Savant3.php";
//$render = explode("/", $_SERVER["PHP_SELF"]);

//$render = str_replace(".php", ".tpl.php", end($render));
$render = "inc_admin.tpl.php";
$gettmp["do"] = ($_GET["do"] != null) ? $_GET["do"] : "";
global $db;

  $gettmp["perpage"] = ($_GET["perpage"] != null) ? $_GET["perpage"] : 10; 
  $gettmp["page"] = ($_GET["page"] != null) ? $_GET["page"] : 1;           
  
  $template = new Savant3();    
  
  $sql = "SELECT * FROM admins ".
         "LEFT JOIN st_members ON st_members.st_member = admins.st_member ".            
         "ORDER BY admins.username ASC ";
  $stmt = $db->Prepare($sql);
  if ($db->databaseType == "mssql") $stmt = $sql; // Fix for mssql prepare stmt
  $rs = $db->PageExecute($stmt, $gettmp["perpage"], $gettmp["page"]);
  $template->listAdmin = $rs->GetAssoc();     
  $template->listAdminCount = $rs->maxRecordCount(); 
  $gettmp["recordCount"] = $rs->maxRecordCount();
  
  $template->maxpage = ceil($gettmp["recordCount"]/$gettmp["perpage"]);    
  $template->perpage = $gettmp["perpage"];   
  $template->page = $gettmp["page"];             
  
  $stmt = $db->Prepare("SELECT Count(admins.id) AS amount FROM admins ");
  $rs = $db->Execute($stmt);
  $template->itemCount = $rs->fields["amount"];      
  
  $genericEasyPagination = new GenericEasyPagination($gettmp["page"], $gettmp["perpage"], "eng");
  $genericEasyPagination->setTotalRecords($gettmp["recordCount"]);
  $genericEasyPagination->setGetVars("perpage=".$gettmp["perpage"]);
  $template->genericEasyPagination = $genericEasyPagination;              

$template->display($render);
?>