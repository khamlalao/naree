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
#print_r($_GET);
#$db->debug=1;
$gettmp['id'] = (($_GET['id'] != '')? $_GET['id'] : '');
$gettmp['action'] = (($_GET['action'] != '')? $_GET['action'] : '');
$gettmp['amount'] = (($_GET['amount'] != '')? $_GET['amount'] : '');

switch($gettmp['action']){
	case 'remove' : 
	
	$sql = "DELETE FROM session_orders WHERE 1 = 1 AND session_orders.session_code = ? AND session_orders.id = ? ";
	$stmt = $db->Prepare($sql);
	$rs = $db->Execute($stmt,array($_SESSION['session_login'],$gettmp['id']));
	//$itemAction = $rs->GetAssoc();
	break;
	case 'insert' : 
	
	ADOdb_Active_Record::SetDatabaseAdapter($db);
	class session_order extends ADOdb_Active_Record{}
	$session_order = new session_order();
	$session_order->Load("id = ? ", array($gettmp['id']));		
	
	$gettmp['unit_price'] = ($session_order->discount != null) ? $session_order->discount : $session_order->unit_price;
	$gettmp['total'] = $gettmp['amount']*$gettmp['unit_price'];
	
	
	$sql = "UPDATE session_orders SET session_orders.amount = ? , session_orders.total = ?  WHERE 1 = 1 AND session_orders.session_code = ? AND  session_orders.id = ? ";
	$stmt = $db->Prepare($sql);
	$rs = $db->Execute($stmt,array($gettmp['amount'],$gettmp['total'],$_SESSION['session_login'],$gettmp['id']));
	//$itemAction = $rs->GetAssoc();
	break;

	case 'delete' : 
	
	ADOdb_Active_Record::SetDatabaseAdapter($db);
	class session_order extends ADOdb_Active_Record{}
	$session_order = new session_order();
	$session_order->Load("id = ? ", array($gettmp['id']));		
	
	$gettmp['unit_price'] = ($session_order->discount != null) ? $session_order->discount : $session_order->unit_price;
	$gettmp['total'] = $gettmp['amount']*$gettmp['unit_price'];
	
	
	$sql = "UPDATE session_orders SET session_orders.amount = ? , session_orders.total = ?  WHERE 1 = 1 AND session_orders.session_code = ? AND  session_orders.id = ? ";
	$stmt = $db->Prepare($sql);
	$rs = $db->Execute($stmt,array($gettmp['amount'],$gettmp['total'],$_SESSION['session_login'],$gettmp['id']));
//$itemAction = $rs->GetAssoc();
break;
	}

$sql = "SELECT * FROM session_orders m WHERE 1 = 1 AND m.session_code = ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ORDER BY m.pid ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt,array($_SESSION['session_login']));
$itemOrder = $rs->GetAssoc();
$gettmp["recordCount"] = $rs->maxRecordCount();


?>
<script type="text/javascript">
function removeItem(id){
				//alert(id);
		jQuery(document).ready(function($) {
				//	alert("xx");
					$.get('inc_cart_remove.php', {
					id : id,
					action : 'remove',
					time : new Date().getTime()
					}, function(data) {
					  $('#default_cart').html(data);
					//  alert(data);
				  });
	  });
		jQuery(document).ready(function($) {
	  
	   $.get('inc_your_item.php', {
					   
				id : id,

				time : new Date().getTime()

				}, function(data) {
					if(data != 0){
				//	alert(data);
				  $('#yourcart-item').html(data);
				  $('#yourcart-num').html('<span id="yourcart-num" class="num-items">'+data+'</span>');
					}else{
				  $('#yourcart-item').html('0');
				  $('#yourcart-num').html('<span id="yourcart-num" class="num-items">0</span>');						
					}
			   });	
		});		   
		jQuery(document).ready(function($) {
			   
					$.get('inc_cash_amount.php', {
						rate : 'USD',
						time : new Date().getTime()
						}, function(data) {
						//	alert(data);
						  $('#cashAmount').html(data);
					   });
			   });	
		jQuery(document).ready(function($) {			   
			   $.get('inc_cash_amount.php', {
				rate : 'LAK',
				time : new Date().getTime()
				}, function(data) {
				//	alert(data);
				  $('#cashAmount_KIP').html(data);
			   });			   
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
  <ul class="cart-right">
        <?php $i =0; ?>
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
        <h3 class="txt-price">Prices: <br><?php if($data['discount'] != ''){?><span><?php echo Lang::getProductOrder($data['pid'],'price','en')?> USD</span> <span class="special"><?php echo Lang::getProductOrder($data['pid'],'discount','en')?> USD</span><?php }else{ ?><?php echo Lang::getProductOrder($data['pid'],'price','en')?> USD<?php } ?></h3>
        <table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="padding-bottom:5px; text-transform:uppercase">Quantity </td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="20" align="center" bgcolor="#8c7d77"><a href="javascript:void(0);" title="Minus" onClick="return addcart('del','<?php echo $data['id']?>');" style="color:#fff"><i class="fa fa-minus" aria-hidden="true"></i></a></td>
                  <td><input type="text" value="<?php echo $data['amount']?>" name="amount<?php echo $data['id']?>" id="amount<?php echo $data['id']?>" class="txtbox-quantity"></td>
                  <td width="20" align="center"  bgcolor="#8c7d77"><a href="javascript:void(0);" title="Add" onClick="return addcart('add','<?php echo $data['id']?>');" style="color:#fff"><i class="fa fa-plus" aria-hidden="true"></i>
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
