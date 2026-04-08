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

function paginate_three($reload, $page, $tpages, $adjacents) {
	
	$prevlabel = "<img src=\"images/icon/arrow_left_2.png\" />";
	$nextlabel = "<img src=\"images/icon/arrow_right_2.png\"   />";
	
//	$out = "";
	
	// previous

	if($page==2) {
		$out.= "<li><a href=\"" . $reload . "\"  class=\"left\">" . $prevlabel . "</a></li>";
		
	}
	else {
		$out.= "<li><a href=\"" . $reload . "&amp;page=" . ($page-1) . "\" class=\"left\">" . $prevlabel . "</a></li>";
	}


	$out .= "<li class=\"page\">";
	
	// first
	if($page>($adjacents+1)) {
		$out.= "<a href=\"" . $reload . "\">...</a>\n";
	}

	
	// pages
	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<a class=\"selectPage\">" . $i . "</a>\n";
		}
		elseif($i==1) {
			$out.= "<a href=\"" . $reload . "\">" . $i . "</a>\n";
		}
		else {
			$out.= "<a href=\"" . $reload . "&amp;page=" . $i . "\">" . $i . "</a>\n";
		}
	}
	// last
	if($page<($tpages-$adjacents)) {
		$out.= "<a href=\"" . $reload . "&amp;page=" . $tpages . "\">...</a>\n";
	}
	$out.= "</li>";
	
		
	// next
	if($page<$tpages) {
		$out.= "<li><a href=\"" . $reload . "&amp;page=" . ($page+1) . "\"  class=\"right\">" . $nextlabel . "</a></li>";
	}

	
	
	
	return $out;
}
?>
<?php
global $db;
#$db->debug=1;

$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));


$template = new Savant3();
$gettmp["keyword"] = ($_GET["keyword"] != null) ? $_GET["keyword"] : null;
$gettmp["perpage"] = ($_GET["perpage"] != null) ? $_GET["perpage"] : 12;
$gettmp["page"] = ($_GET["page"] != null) ? $_GET["page"] : 1;

$gettmp["parent_id"] = ($_GET["parent_id"] != null) ? $_GET["parent_id"] : null;
$gettmp["order_by"] = ($_GET["order_by"] != null) ? $_GET["order_by"] : null;  // Defaults by new

ADOdb_Active_Record::SetDatabaseAdapter($db);


if($gettmp['order_by'] != NULL){
  switch($gettmp['order_by']){
    case'1': $gettmp['order_txt'] = " AND m.price <= '10'"; break;
    case'2': $gettmp['order_txt'] = " AND ('20' >= m.price AND m.price >= '11')"; break;
    case'3': $gettmp['order_txt'] = " AND ('30' >= m.price AND m.price >= '21')"; break;
    case'4': $gettmp['order_txt'] = " AND m.price > '30'"; break;
    default: $gettmp['order_txt'] = "";
  }
}
if($gettmp['parent_id'] != NULL){
	$gettmp['order_cat'] = "AND m.parent_id = '".$gettmp['parent_id']."'";
}
class product_category extends ADOdb_Active_Record{}
$category = new product_category();
$category->Load("id = ? ", array($gettmp['parent_id']));
$template->category = $category;

// status 1 = 'la' , 2 = 'en' , 3 = 'all'
$sql = "SELECT * FROM product_items AS m WHERE 1 = 1 ".$gettmp['order_txt']." ".$gettmp['order_cat']." AND (m.status = '1' OR  m.status = '2') ORDER BY m.parent_id DESC,m.sequence ASC";
$stmt = $db->Prepare($sql);
$rs = $db->PageExecute($stmt, $gettmp["perpage"], $gettmp["page"]);
$itemList = $rs->GetAssoc();
$gettmp["recordCount"] = $rs->maxRecordCount();

$template->itemList = $itemList;
$template->itemListCount = $gettmp["recordCount"];

$template->maxpage = ceil($gettmp["recordCount"]/$gettmp["perpage"]);
$template->perpage = $gettmp["perpage"];
$template->page = $gettmp["page"];
$template->keyword = $gettmp["keyword"];



$template->Pagereload = ($_GET["parent_id"] != null) ? "products.php?parent_id=".$_GET["parent_id"] : "products.php?load";
$template->parent_id = $gettmp["parent_id"];
$template->order_by =  $gettmp['order_by'];

$template->display($render);
?>
 