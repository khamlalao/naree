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

?>
<?php
global $db;
#$db->debug=1;

$gettmp["action"] = ($_GET["action"] != null) ? $_GET["action"] : null;
$gettmp["id"] = ($_GET["id"] != null) ? $_GET["id"] : null;

ADOdb_Active_Record::SetDatabaseAdapter($db);
if($gettmp['action'] == 'remove'){
$sql = "DELETE FROM session_orders WHERE 1 = 1 AND session_orders.session_code = ? AND  session_orders.member_id = ? AND session_orders.id = ? ";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['session_login'],$_SESSION['member_id'],$gettmp['id']));
}


$sql = "SELECT * FROM session_orders m WHERE 1 = 1 AND m.session_code = ? AND  m.member_id = ? ORDER BY m.pid ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['session_login'],$_SESSION['member_id']));
$itemOrder = $rs->GetAssoc();
$gettmp["recordCount"] = $rs->maxRecordCount();

?>
 <ul class="cart post" > 
        <?php $i =0; ?>
        <?php foreach ($itemOrder as $data) { ?>     
        <?php $i++; ?> 
              <li> 
                <!--Remove-->
                <div class="delete-item"><a href="#nogo" title="Remove" onclick="return delItem(<?php echo $data['id']?>);" ><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>
                <!--//Remove--> 
                <!--Img-->
                <div class="cart-img"  style="padding-top:20px;"> <a href="products_detail.php?id=<?php echo $data['pid']?>"><img src="../img_product/<?php echo Lang::getProductOrder($data['pid'],'image','en')?>" alt=""/></a> </div>
                <!--//Img--> 
                
                <!--/Name-->
                <div class="cart-name">
                  <h2 class="txt-mdel"><a href="products_detail.php?id=<?php echo $data['pid']?>"><?php echo Lang::getProductOrder($data['pid'],'title_la','en')?></a> <span><?php echo Lang::getProductOrder($data['pid'],'code','en')?></span></h2>
                </div>
                <!--//name--> 
                <!--Price-->
                <div class="cart-price">
                  <h3 class="txt-price">Prices: <?php echo ($data['discount'] != '') ? $data['discount'] : $data['unit_price'] ?> USD</h3>
                </div>
                <!--//Price--> 
                
                <!--Price-->
                <div class="cart-price">
                  <h3 class="txt-price">QTY: <?php echo $data['amount']?> Item</h3>
                </div>
                <!--//Price--> 
                
                <div class="clear"></div>
              </li>
              
         <?php } ?>  
            </ul>