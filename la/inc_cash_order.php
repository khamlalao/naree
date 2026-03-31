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
global $db;
#$db->debug=1;
$gettmp["id"] = ($_GET["id"] != null) ? $_GET["id"] : null;
$gettmp["type"] = ($_GET["type"] != null) ? $_GET["type"] : null;


$sql = "SELECT sum(m.total) as total_pay FROM session_orders m WHERE 1 = 1 AND m.session_code =  ? AND  m.member_id = ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ORDER BY m.pid ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['session_login'],$_SESSION['member_id']));
$gettmp['totalPay'] = $rs->fields['total_pay'];


$sql1 = "SELECT sum(product_items.weight) as total_weight FROM product_items INNER JOIN session_orders ON session_orders.pid = product_items.id 
WHERE 1 = 1 AND session_orders.session_code =  ? AND  session_orders.member_id = ? AND (session_orders.invoice_id = '' OR session_orders.invoice_id IS NULL) AND (session_orders.invoice_code = '' OR session_orders.invoice_code IS NULL) ORDER BY session_orders.pid ASC";
$stmt1 = $db->Prepare($sql1);
$rs1 = $db->Execute($stmt1,array($_SESSION['session_login'],$_SESSION['member_id']));
$gettmp['weight_total'] = $rs1->fields['total_weight'];


class members_location extends ADOdb_Active_Record{}
$item = new members_location();
$item->load("id= ?", array($gettmp['id']));

class location_zone extends ADOdb_Active_Record{}
$location_zone = new location_zone();
$location_zone->load("id= ?", array($item->location_zone));



?>

<?php if($gettmp['type'] == '1'){ ?>
<div class="box-summary">

                	  <h2 class="txt-topic-member">ສະຫລຸບລາຍການສັ່ງຊື້ </h2>

                	  <ul>
                	    <li>ຍອດລວມ <div> <span class="numberEN"> <?php echo number_format($gettmp['totalPay'],2)?></span> ໂດລາ<BR><span class="numberEN"><?php echo Lang::eXchangeRate('lak',$gettmp['totalPay'])?></span> ກີບ</div><div class="clear"></div></li>

                        <li>ການສົ່ງສິນຄ້າ <div><span class="numberEN">00.00</span></div><div class="clear"></div></li>

                        <li>ຍອດລວມທັງຫມົດ <div> <span class="numberEN"><?php echo number_format($gettmp['totalPay']+$delivery_fee,'2')?></span> ໂດລາ<BR><span class="numberEN"><?php echo Lang::eXchangeRate('lak',$gettmp['totalPay']+$delivery_fee)?></span> ກີບ</div> <div class="clear"></div></li>

                        

              	    </ul>
                    <input type="hidden" name="delivery_fee" id="delivery_fee" value="0">
                    <input type="hidden" name="sub_total" id="sub_total" value="<?php echo $gettmp['totalPay']?>">
                    <input type="hidden" name="grand_total" id="grand_total" value="<?php echo $gettmp['totalPay']?>">
                    <input name="submit" type="submit" class="btn-login" id="submit" value="ຢືນຢັນສັ່ງຊື້" onclick="return checkForm();">
                    <a href="products.php" class="btn-login">ເລືອກສິນຄ້າເພີ່ມ</a>
            	</div>
<?php }else{ ?>
<div class="box-summary">

                	  <h2 class="txt-topic-member">ສະຫລຸບລາຍການສັ່ງຊື້ </h2>

                	  <ul>
                	    <li>ຍອດລວມ <div>  <span class="numberEN"><?php echo number_format($gettmp['totalPay'],2)?></span> ໂດລາ<BR><span class="numberEN"><?php echo Lang::eXchangeRate('lak',$gettmp['totalPay'])?></span> ກີບ</div><div class="clear"></div></li>

                        <li>ການສົ່ງສິນຄ້າ  <div><span class="numberEN"><?php $delivery_fee = Lang::DeliveryFee($location_zone->zone,$gettmp['weight_total'])?><?php echo $delivery_fee?></span> ໂດລາ<BR><span class="numberEN"><?php echo Lang::eXchangeRate('lak',$delivery_fee)?></span> ກີບ</div><div class="clear"></div></li>

                        <li>ຍອດລວມທັງຫມົດ <div> <span class="numberEN"><?php echo number_format($gettmp['totalPay']+$delivery_fee)?></span> ໂດລາ<BR><span class="numberEN"><?php echo Lang::eXchangeRate('lak',$gettmp['totalPay']+$delivery_fee)?></span> ກີບ</div> <div class="clear"></div></li>

                        

              	    </ul>
                    <input type="hidden" name="delivery_fee" id="delivery_fee" value="<?php echo Lang::DeliveryFee($location_zone->zone,$gettmp['weight_total'])?>">
                    <input type="hidden" name="sub_total" id="sub_total" value="<?php echo $gettmp['totalPay']?>">
                    <input type="hidden" name="grand_total" id="grand_total" value="<?php echo $gettmp['totalPay']+Lang::DeliveryFee($location_zone->zone,$gettmp['weight_total'])?>">
                    <input name="submit" type="submit" class="btn-login" id="submit" value="ຢືນຢັນສັ່ງຊື້" onclick="return checkForm();">
                    <a href="products.php" class="btn-login">ເລືອກສິນຄ້າເພີ່ມ</a>


            	</div>
<?php } ?>                