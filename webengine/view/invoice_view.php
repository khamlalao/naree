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
 strong { font-weight: normal;font-family: 'pt_sansboldSVG', 'pt_sansbold';}
body { background:#fff;  font-family: 'pt_sansregularSVG','pt_sansregular'; font-size:16px; line-height:18px;color:#111}
.content { width:80%; margin:0 auto; padding:10px; border:1px solid #111}
.logo-print { width:200px}
.title { font-size:18px; color:#111; background:#111; text-align:center; padding:10px; color:#fff; font-weight:bold}
.box { border-top:1px solid #555; padding:10px 0 0 0; margin:10px 0 0 0;}

.cart-img { width:110px;   margin:0 10px;}
.cart-img img { width:100%;}
.cart-name  {  margin:0; padding:0 0 0 0}
.cart-name h2 { color:#111; text-align:left; font-size:14px; line-height:15px;font-family: 'pt_sansregularSVG','pt_sansregular'; font-weight: normal; letter-spacing:2px; text-transform:uppercase;}
.cart-price {   margin:0; font-size:14px; background:#fff;color:#000; text-align:right;  padding:0 0 0 0 }
.cart-price.total { width:12% !important}
.cart-price h3.txt-price { color:#000;  font-weight:normal; text-transform:uppercase; margin:0;font-family: 'pt_sansregularSVG','pt_sansregular'; font-size:14px;}
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
 <script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
 </script>
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
    <td width="9%"><div class="logo-print"><img src="../../en/images/logo_print.png"  alt=""/></div></td>
    <td width="91%" align="right"><strong>NAREE SHOWROOM & HEAD OFFICE</strong>
      <br>
      Nongbone Village (Horm 1), Saysettha District, 
      <br>
      Vientiane Capital, Lao PDR.<br>

      <strong>Mobile phone : </strong>+856 20-5930 9333 
      <strong>E-mail : </strong>naree.laos@gmail.com</td>
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
              <td width="43%"><table border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td><strong>Invoice No. :</strong></td>
                  <td><?php echo $invoice_order->invoice_id?></td>
                </tr>
                <tr>
                  <td><strong>Order Date :</strong></td>
                  <td><?php echo $invoice_order->order_date?></td>
                </tr>
                <tr>
                  <td><strong>Reference No :</strong></td>
                  <td><?php echo $invoice_order->req_reference_number?></td>
                </tr>
              </table></td>
              <td width="57%"><table width="90%" border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td width="161"><strong>Shipping Method :</strong></td>
                  <td width="120"><?php echo Lang::ShippingMethod($invoice_order->method_shipping)?></td>
                  <td width="6">&nbsp;</td>
                  <td width="129"><strong>Shipping Status :</strong></td>
                  <td width="168">
                  <?php if(($invoice_order->decision == 'ACCEPT')&&($invoice_order->status_delivery == '0')){?>
                  <form name="form" id="form">
                    <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
                      <option<?php echo ($invoice_order->status_delivery == '1') ? ' selected' : '';?> value="invoice_action.php?do=status&value=1&id=<?php echo $invoice_order->id?>">Delivery Complete</option>
                      <option<?php echo ($invoice_order->status_delivery == '0') ? ' selected' : '';?>>Delivery Waiting</option>
                    </select>
                  </form>
                  <?php }else{
                	
					switch($invoice_order->status_delivery){
					case'0' : echo 'wait'; break;
					case'1' : echo 'Complete'; break;
					case'2' : echo 'Cancel'; break;
					}
					
                 } ?>
                  
                  </td>
                </tr>
                <tr>
                  <td><strong>Payment Method :</strong></td>
                  <td><?php echo ($invoice_order->decision == 'ACCEPT') ? 'Credit Card' : 'CANCEL';?></td>
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
              <td width="43%" valign="top"><table border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td><strong>Buyer Contact</strong></td>
                </tr>
                <tr>
                  <td><?php echo $members_profile->name?><br>
                    E-mail : <?php echo $members_profile->email?></td>
                </tr>
              </table></td>
              <td width="57%" valign="top"><table border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td><strong>Shipping Address</strong></td>
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
    <td><strong>Items in My Bag</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    <table width="100%" border="1" cellspacing="0" cellpadding="3">
  <tr>
    <td colspan="2" align="center" bgcolor="#999999">Detail</td>
    <td width="20%" align="center" bgcolor="#999999"><span class="txt-price">Price: </span></td>
    <td width="15%" align="center" bgcolor="#999999"><span class="txt-price">QTY (Item)</span></td>
    <td width="14%" align="center" bgcolor="#999999">Total Price</td>
  </tr>
  <?php foreach ($itemOrder as $data) { ?>     
  <?php $i++; ?> 
  <tr>
    <td width="16%"><div class="cart-img"><img src="../../img_product/<?php echo Lang::getProductOrder($data['pid'],'image','en')?>" alt=""/></div></td>
    <td width="35%" align="center">  <!--/Name-->
      <div class="cart-name">
        <h2 class="txt-mdel"><?php echo Lang::getProductOrder($data['pid'],'title_la','en')?> <br>
          <span><?php echo Lang::getProductOrder($data['pid'],'code','en')?></span></h2>
        </div>
      <!--//name--> </td>
    <td>  
      <div class="cart-price">
        <h3 class="txt-price"><?php echo ($data['discount'] != '') ? $data['discount'] : $data['unit_price'] ?> USD<br>
<?php echo ($data['discount'] != '') ? Lang::eXchangeRate('lak',$data['discount']) : Lang::eXchangeRate('lak',$data['unit_price']) ?> LAK</h3>
        </div>
      </td>
    <td align="center"> <?php echo $data['amount']?></td>
    <td><div class="cart-price">
      <h3 class="txt-price"><?php echo ($data['discount'] != '') ? $data['discount']*$data['amount'] : $data['unit_price']*$data['amount'] ?> USD<br>
<?php echo ($data['discount'] != '') ? Lang::eXchangeRate('lak',$data['discount']*$data['amount']) : Lang::eXchangeRate('lak',$data['unit_price']*$data['amount']) ?> LAK</h3>
      </div></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="4" align="right">Sub-Total</td>
    <td align="right"><?php echo number_format($invoice_order->sub_total,2)?> USD</td>
  </tr>
  <tr>
    <td colspan="4" align="right">Shipping </td>
    <td align="right"><?php $gettmp['delivery_fee'] = $invoice_order->grand_total - $invoice_order->sub_total; ?>
	<?php echo ($gettmp['delivery_fee'] != 0) ? number_format($gettmp['delivery_fee'],2) : '-' ?> USD</td>
  </tr>
  <tr>
    <td colspan="4" align="right"><strong>Grand-Total</strong></td>
    <td align="right"><strong><?php echo number_format($invoice_order->grand_total,2)?> USD</strong></td>
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
