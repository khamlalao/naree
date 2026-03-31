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

//id=1607000001&member_id=1&reference_number=771364
$gettmp["invoice_id"] = ($_GET["id"] != null) ? $_GET["id"] : null;
$gettmp["member_id"] = ($_GET["member_id"] != null) ? $_GET["member_id"] : null;
$gettmp["reference_number"] = ($_GET["reference_number"] != null) ? $_GET["reference_number"] : null;

ADOdb_Active_Record::SetDatabaseAdapter($db);


class invoice_order extends ADOdb_Active_Record{}
$invoice_order = new invoice_order();
$invoice_order->load("invoice_id = ? AND member_id = ? AND req_reference_number = ? ", array($gettmp['invoice_id'],$gettmp['member_id'],$gettmp["reference_number"]));
//$template->invoice_order = $invoice_order; Load item invoice order

class session_order extends ADOdb_Active_Record{}
$session_order = new session_order();
$session_order->load("invoice_id = ? AND  member_id = ? ", array($gettmp['invoice_id'],$gettmp['member_id']));
//$template->session_order = $session_order; Load item session order


class members_profile extends ADOdb_Active_Record{}
$members_profile = new members_profile();
$members_profile->load("id= ?", array($gettmp['member_id']));
//$template->members_profile = $members_profile; Load item members_profile

$sql = "SELECT * FROM session_orders m WHERE 1 = 1 AND m.invoice_id = ? AND  m.member_id = ? ORDER BY m.id ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($gettmp['invoice_id'],$gettmp['member_id']));
$itemOrder = $rs->GetAssoc();
$gettmp["recordCount"] = $rs->maxRecordCount();





?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>NAREE</title>
<link rel="stylesheet" type="text/css" href="font-face/stylesheet.css">

 <style type="text/css">
 .numberEN {  font-family: 'pt_sansregularSVG','pt_sansregular';  }
span.numberEN {  font-family: 'pt_sansregularSVG','pt_sansregular'; text-decoration:none !important  }
#cashAmount_KIP, #cashAmount { font-family: 'pt_sansregularSVG','pt_sansregular'; }

 strong { font-weight: normal; font-family: 'saysettha_otregular';  }
body { background:#fff; font-family: 'saysettha_otregular'; font-size:14px; line-height:20px;color:#111}
.content { width:80%; margin:0 auto; padding:10px; border:1px solid #111}
.logo-print { width:200px}
.title { font-size:18px; color:#111; background:#111; text-align:center; padding:10px; color:#fff; font-weight:bold}
.box { border-top:1px solid #555; padding:10px 0 0 0; margin:10px 0 0 0;}

.cart-img { width:110px;   margin:0 10px;}
.cart-img img { width:100%;}
.cart-name  {  margin:0; padding:0 0 0 0}
.cart-name h2 { color:#111; text-align:left; font-size:16px; line-height:15px; font-family: 'saysettha_otregular';  font-weight: normal; letter-spacing:2px; text-transform:uppercase;}
.cart-price {   margin:0; font-size:14px; background:#fff;color:#000; text-align:right;  padding:0 0 0 0 }
.cart-price.total { width:12% !important}
.cart-price h3.txt-price { color:#000;  font-weight:normal; text-transform:uppercase; margin:0; font-family: 'saysettha_otregular';  font-size:16px;}
.cart-price h3.txt-price span { text-decoration:line-through}
.cart-price h3.txt-price span.special { color:#f00; text-decoration:none; font-size:14px}
.cart-quantity  { width:23%; float:left; margin:0 auto; padding:30px 0 0 0}
.print { text-align:center; font-size:15px; color:#111; padding:10px 0}
.print  a { color:#fff; background: #111; padding:6px 30px; display:block; width:10%; text-decoration: none; margin:0 auto; }
@media print {
	.content { width:100%; border:none; padding:0; }
.print { display:none}
	}
</style>

</head>

<body style="background:#fff">
<div class="print">
<a href="javascript:window.print();">Print Order</a>
</div>
<div class="content">


<table width="100%"  cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div class="logo-print"><img src="images/logo_print.png"  alt=""/></div></td>
        <td align="right" valign="top"><strong> ຮ້ານ ນາຣີ ກະເປົາລາວປະຍຸກ </strong> <br>
          ບ້ານຫນອງບອນ (ຮ່ອມ 1), ເມືອງໄຊເສດຖາ, ນະຄອນຫລວງວຽງຈັນ, ສປປ ລາວ<br>
          <strong>ໂທລະສັບມືຖື : </strong> <span class="numberEN">+856 20-5930 9333</span><br>
          <strong> ອີເມລ  : </strong>naree.laos@gmail.com</td>
      </tr>
    </table>
</td>
  </tr>
  <tr>
    <td><div class="box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="50%"><table border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td><strong>ໃບສັ່ງຊື້ເລກທີ</strong></td>
                  <td><span class="numberEN"><?php echo $invoice_order->invoice_id?></span></td>
                </tr>
                <tr>
                  <td><strong>	

ວັນທີສັ່ງຊື້</strong></td>
                  <td><span class="numberEN"><?php echo $invoice_order->order_date?></span></td>
                </tr>
              </table></td>
              <td><table width="90%" border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td width="147"><strong>ວິທີສົ່ງສິນຄ້າ:</strong></td>
                  <td width="152"><?php echo Lang::ShippingMethod($invoice_order->method_shipping,'la')?></td>
                  <td width="6">&nbsp;</td>
                  <td width="174"><strong>ສະຖານະການຂົນສົ່ງ :</strong></td>
                  <td width="143">
                  <?php if($invoice_order->decision == 'ACCEPT'){
                	
					switch($invoice_order->status_delivery){
					case'0' : echo 'ລໍຖ້າ'; break;
					case'1' : echo 'ສຳເລັດ'; break;
					case'2' : echo 'ຍົກເລີກ'; break;
					}
					
                 }else{ echo "ຍົກເລີກ"; } ?>
                  
                  </td>
                </tr>
                <tr>
                  <td><strong>ວິທີຈ່າຍເງິນ :</strong></td>
                  <td><?php echo ($invoice_order->decision == 'ACCEPT') ? 'ບັດ​ເຄຣ​ດິດ' : 'ຍົກເລີກ';?></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="50%" valign="top"><table border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td><strong>ຂໍ້ມູນຜູ້ຊື້</strong></td>
                </tr>
                <tr>
                  <td><?php echo $members_profile->name?><br>
                  ອີເມລ: <?php echo $members_profile->email?></td>
                </tr>
              </table></td>
              <td valign="top"><table border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td><strong>ທີ່ຢູ່ສົ່ງສິນຄ້າ</strong></td>
                </tr>
                <tr>
                  <td> <?php echo $invoice_order->location_shipping?></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td>
    <div class="box">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>ສິນຄ້າໃນກະຕ່າຂອງຂ້ອຍ</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    <table width="100%" border="1" cellspacing="0" cellpadding="3">
  <tr>
    <td colspan="2" align="center" bgcolor="#999999">ລາຍລະອຽດ</td>
    <td width="20%" align="center" bgcolor="#999999"><span class="txt-price">ລາຄາ</span></td>
    <td width="15%" align="center" bgcolor="#999999"><span class="txt-price">ຈ/ນ (ສິນຄ້າ)</span></td>
    <td width="14%" align="center" bgcolor="#999999">ລວມທັງໝົດ</td>
  </tr>
  <?php foreach ($itemOrder as $data) { ?>     
  <?php $i++; ?> 
  <tr>
    <td width="12%"><div class="cart-img"><img src="../img_product/<?php echo Lang::getProductOrder($data['pid'],'image','en')?>" alt=""/></div></td>
    <td width="39%" align="center">  <!--/Name-->
      <div class="cart-name">
        <h2 class="txt-mdel"><?php echo Lang::getProductOrder($data['pid'],'title_la','en')?> <br>
          <span style="font-size:12px"><span class="numberEN"><?php echo Lang::getProductOrder($data['pid'],'code','en')?></span></span></h2>
        </div>
      <!--//name--> </td>
    <td>  
      <div class="cart-price">
        <h3 class="txt-price"><span class="numberEN"><?php echo ($data['discount'] != '') ? $data['discount'] : $data['unit_price'] ?></span> ໂດລາ<br>
<span class="numberEN"><?php echo ($data['discount'] != '') ? Lang::eXchangeRate('lak',$data['discount']) : Lang::eXchangeRate('lak',$data['unit_price']) ?></span> ກີບ</h3>
        </div>
      </td>
    <td align="center"> <span class="numberEN"><?php echo $data['amount']?></span></td>
    <td><div class="cart-price">
      <h3 class="txt-price"><span class="numberEN"><?php echo ($data['discount'] != '') ? $data['discount']*$data['amount'] : $data['unit_price']*$data['amount'] ?></span> ໂດລາ<br>
<span class="numberEN"><?php echo ($data['discount'] != '') ? Lang::eXchangeRate('lak',$data['discount']*$data['amount']) : Lang::eXchangeRate('lak',$data['unit_price']*$data['amount']) ?></span> ກີບ</h3>
      </div></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="4" align="right">	

ຍອດລວມ</td>
    <td align="right"><span class="numberEN"><?php echo number_format($invoice_order->sub_total,2)?></span> ໂດລາ</td>
  </tr>
  <tr>
    <td colspan="4" align="right">ການສົ່ງສິນຄ້າ </td>
    <td align="right"><span class="numberEN"><?php $gettmp['delivery_fee'] = $invoice_order->grand_total - $invoice_order->sub_total; ?>
	<?php echo ($gettmp['delivery_fee'] != 0) ? number_format($gettmp['delivery_fee'],2) : '-' ?></span> ໂດລາ</td>
  </tr>
  <tr>
    <td colspan="4" align="right"><strong>ຍອດລວມທັງຫມົດ</strong></td>
    <td align="right"><strong><span class="numberEN"><?php echo number_format($invoice_order->grand_total,2)?></span> ໂດລາ</strong></td>
  </tr>
    </table>

     
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
    </table>

    
    </div>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>

</table>

 
 
</body>
</html>
