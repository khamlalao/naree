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
if (empty($_SESSION['session_login'])) {
    $itemOrder = [];
    $gettmp["recordCount"] = 0;
    $gettmp['total_amount'] = 0;
    $gettmp['totalPay'] = 0;
} ?>
<?php 

global $db;

//print_r($_GET);

#$db->debug=1;

$sql = "SELECT * FROM session_orders m WHERE 1 = 1 AND m.session_code = ?  AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ORDER BY m.pid ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['session_login']));
$itemOrder = $rs->GetAssoc();
$gettmp["recordCount"] = $rs->maxRecordCount();

$sql = "SELECT sum(m.amount) as total_amount FROM session_orders m WHERE 1 = 1 AND m.session_code =  ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['session_login']));
$itemCountOrder = $rs ? $rs->GetAssoc() : [];
$gettmp['total_amount'] = $rs ? $rs->fields['total_amount'] : 0;



$sql = "SELECT sum(m.total) as total_pay FROM session_orders m WHERE 1 = 1 AND m.session_code =  ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ORDER BY m.pid ASC";

$stmt = $db->Prepare($sql);

$rs = $db->Execute($stmt,array($_SESSION['session_login']));

$gettmp['totalPay'] = $rs->fields['total_pay'];



?>

<script type="text/javascript">

function removeItem(id){

					$.get('inc_cart_remove.php', {
					id : id,
					action : 'remove',
					time : new Date().getTime()
					}, function(data) {
					  $('#default_cart').html(data);
					//  alert(data);
				  });
				
	    			 
			   $.get('inc_your_item.php', {
					   
				id : id,
				time : new Date().getTime()

				}, function(data) {

					//alert(data);
				  $('#yourcart-item').html(data);
				  $('#yourcart-num').html('<span id="yourcart-num" class="num-items">'+data+'</span>');
			   });	
			   
			   
			  $.get('inc_cash_amount.php', {
				rate : 'USD',
				time : new Date().getTime()
				}, function(data) {
					//alert(data);
				  $('#cashAmount').html(data);
			   });
			   $.get('inc_cash_amount.php', {
				rate : 'LAK',
				time : new Date().getTime()
				}, function(data) {
					//alert(data);
				  $('#cashAmount_KIP').html(data);
			   });		

}

function addcart(obj,id){

	// alert(obj+id);

	var amount = 'amount'+id; 

	var num = document.getElementById(amount).value;

	// alert(num);

	if(obj == 'add'){

		var num = document.getElementById(amount).value;

		var newAmount = new Number(num)+1;

		document.getElementById(amount).value = newAmount;

		

		jQuery(document).ready(function($) {

			$.get('inc_cart_render.php', {

				id : id,

				action : 'insert',

				amount : newAmount,

				time : new Date().getTime()

				}, function(data) {
				//	alert(data);

				  $('#default_cart').html(data);

			  });	

				 $.get('inc_cash_amount.php', {
				rate : 'USD',
				time : new Date().getTime()
				}, function(data) {
					//alert(data);
				  $('#cashAmount').html(data);
			   });
			   $.get('inc_cash_amount.php', {
				rate : 'LAK',
				time : new Date().getTime()
				}, function(data) {
					//alert(data);
				  $('#cashAmount_KIP').html(data);
			   });
			   		
         });
		

	}

	if(obj == 'del'){

		var num = document.getElementById(amount).value;

		if(num > 1){

		var newAmount = new Number(num)-1;

		document.getElementById(amount).value = newAmount;

		//	$('#cashAmount').html('2');

		
		jQuery(document).ready(function($) {
				$.get('inc_cart_render.php', {

				id : id,
				action : 'delete',
				amount : newAmount,

				time : new Date().getTime()
				}, function(data) {
				//	alert(data);

				  $('#default_cart').html(data);
			  });	
		
			 $.get('inc_cash_amount.php', {
				rate : 'USD',
				time : new Date().getTime()
				}, function(data) {
					//alert(data);
				  $('#cashAmount').html(data);
			   });
			   $.get('inc_cash_amount.php', {
				rate : 'LAK',
				time : new Date().getTime()
				}, function(data) {
					//alert(data);
				  $('#cashAmount_KIP').html(data);
			   }); 		
		
		 });
		



		}

	}



	//alert(newAmount);

	

	

}

</script> 

<script>

jQuery(document).ready(function($) {

//setInterval('window.location.reload()', 100); 

});

</script>

<div class="dim" style="display:none;"></div>

<div id="box-cart-app">

  <div class="box-cart-titlebar">

    <div class="icon-close" id="close-cart" title="Close"><img src="images/icon/i_close.png"   alt=""/></div>

    <h2>My Shopping Bag</h2>

    <!--<div class="your-item" id="yourcart-item"><?php //=$gettmp['total_amount']?></div> -->

  </div>

  <!--Item cart-->

<!--  <div class="box-overflow">-->

  <div id="default_cart" class="contentHolder_cart">

  <ul class="cart-right">

        <?php $i =0; ?>

        <?php if (!empty($itemOrder)) ?>
  <?php if (!empty($itemOrder))?>
  <?php foreach ($itemOrder as $data) { ?>  

        <?php $i++; ?>   

    <li>

      <div class="delete-item"><a href="#nogo" title="Remove" onclick="return removeItem(<?php echo $data['id']?>);" ><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>

      <div class="cart-right-img"> <a href="products_detail.php?id=<?php echo $data['pid']?>"><img src="../img_product/<?php echo Lang::getProductOrder($data['pid'],'image','en')?>" alt=""/></a>

        <div class="cart-right-name">

          <h2 class="txt-mdel"><a href="products_detail.php?id=<?php echo $data['pid']?>"><?php echo Lang::getProductOrder($data['pid'],'title_en','en')?></a> <span><?php echo Lang::getProductOrder($data['pid'],'code','en')?></span></h2>

        </div>

      </div>

      <div class="cart-right-price">

        <h3 class="txt-price">Price: <br><?php if($data['discount'] != ''){?><span><?php echo Lang::getProductOrder($data['pid'],'price','en')?> USD</span> <span class="special"><?php echo Lang::getProductOrder($data['pid'],'discount','en')?> USD</span><?php }else{ ?><?php echo Lang::getProductOrder($data['pid'],'price','en')?> USD<?php } ?></h3>

        <table border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td style="padding-bottom:5px; text-transform:uppercase">Quantity </td>

          </tr>

          <tr>

            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>

                  <td width="20" align="center" bgcolor="#000000"><a href="javascript:void(0);" title="Minus" onClick="return addcart('del','<?php echo $data['id']?>');" style="color:#fff"><i class="fa fa-minus" aria-hidden="true"></i></a></td>

                  <td><input type="text" value="<?php echo $data['amount']?>" name="amount<?php echo $data['id']?>" id="amount<?php echo $data['id']?>" class="txtbox-quantity"></td>

                  <td width="20" align="center"  bgcolor="#000000"><a href="javascript:void(0);" title="Add" onClick="return addcart('add','<?php echo $data['id']?>');" style="color:#fff"><i class="fa fa-plus" aria-hidden="true"></i>

</a></td>

                </tr>

              </table></td>

          </tr>

        </table>

      </div>

       <div class="clear"></div>

    </li>

  <?php } ?>

     

     

  </ul>

 </div>

  
<?php if($gettmp["recordCount"] > 0){ ?>
  <div class="cart-right-total">
  <div class="pad">
  	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Sub-Total</td>
    <td align="right"><span id="cashAmount"><?php echo number_format($gettmp['totalPay'],2)?></span> USD</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><span id="cashAmount_KIP"><?php echo Lang::eXchangeRate('lak',$gettmp['totalPay'])?></span> LAK</td>
  </tr>
    </table>
</div>
 <a href="products.php" class="continue-shop">Continue Shopping</a>
 <a href="cart_session.php" class="check-out">Buy Now</a>
 <div class="clear"></div>
</div>
<?php } ?>
  

    <!--Item cart-->

    

  <!--no item-->

  <div class="cart-no-item" style="display:none">

Your Shopping Bag is Empty

<div class="box-btn">

<a href="products.php" class="shop-now " > Start Shopping Now </a>

<div class="clear"></div>

</div>

</div>

<!--//no item-->

  

  

 

</div>

