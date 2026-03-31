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

#print_r($_SESSION);



ADOdb_Active_Record::SetDatabaseAdapter($db);

// status 1 = 'la' , 2 = 'en' , 3 = 'all'

$sql = "SELECT * FROM product_categories m WHERE 1 = 1 AND (m.status = '1' OR  m.status = '3') ORDER BY m.sequence ASC";
$stmt = $db->Prepare($sql);

$rs = $db->Execute($stmt);

$itemList = $rs->GetAssoc();

$itemListCount = $rs->maxRecordCount();



if($_SESSION['session_login'] != NULL){

	//$sql2 = "SELECT * FROM session_orders m WHERE 1 = 1 AND m.session_code =  ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ";

	//$stmt2 = $db->Prepare($sql2);

	//$rs2 = $db->Execute($stmt2,array($_SESSION['session_login']));

	//$gettmp["your-item"] = $rs2->maxRecordCount();
	$sql = "SELECT sum(m.amount) as total_amount FROM session_orders m WHERE 1 = 1 AND m.session_code =  ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ";
	$stmt = $db->Prepare($sql);
	$rs = $db->Execute($stmt,array($_SESSION['session_login']));
	$itemOrder = $rs->GetAssoc();
	$gettmp['total_amount'] = $rs->fields['total_amount'];
	//$template->total_amount = $gettmp['total_amount'];	

}	

?>
<script type="text/javascript">
	jQuery(function(){
		//$('.menu').hide();
		$('#mn-mobile-close').hide();
		$('#mn-mobile').click(function(){
			
			$('.menu').slideDown();
			$('#mn-mobile').hide();
			$('#mn-mobile-close').show();
		 });
		$('#mn-mobile-close').click(function(){
			
			$('.menu').slideUp();
			$('#mn-mobile').show();
			$('#mn-mobile-close').hide();
		 });
		 
		 $('#click-subpro').click(function(){
			
			$('.dropdown ul#product-sub').slideToggle();
			//$('#mn-mobile').hide();
			//$('#mn-mobile-close').show();
		 });
		 
		 
		  $('#click-subpromo').click(function(){
			
			$('.dropdown ul#promo-sub').slideToggle();
			//$('#mn-mobile').hide();
			//$('#mn-mobile-close').show();
		 });
		 
		 
		 
		
		 
		});
</script>
<div class="content">

  <div class="logo"><a href="index.php"><img src="images/logo_naree.png" alt="Naree"/></a></div>
 
  <!--mobile-->
  
  <div class="mn-mobile" id="mn-mobile"><i class="fa fa-bars" aria-hidden="true"></i></div>
  <div class="mn-mobile" id="mn-mobile-close">
    <div class="boxclose"></div>
  </div>
   <div class="mn-mobile-cart"><a href="#nogo" id="mycart" >
        <?php if($gettmp['total_amount'] != 0){?>
        <div class="num-items" id="yourcart-num">
          <?php echo $gettmp['total_amount']?>
        </div>
        <?php } ?>
        
        <!-- // Amount No of Order --> 
        
        <img src="images/icon/i_cart.png"   alt="Cart"/> </a></div>
    <!--//mobile-->
  <div class="header_left"> 

    <!--mene top-->

    <ul class="menu_top">
<?php 
		$go = "../en/".htmlspecialchars(basename($_SERVER['PHP_SELF']));
		if($_SERVER['QUERY_STRING']!=""){
			$go .= "?".htmlspecialchars($_SERVER['QUERY_STRING']);
		}
	?>
      <li><a href="<?php echo str_replace('/la/', '/en/', $_SERVER['REQUEST_URI']) ?>" style="  text-align:center">
    English </a></li>

      <li><a href="#nogo" id="mycart" >

               <?php if($gettmp['total_amount'] != 0){?><div class="num-items" id="yourcart-num"><?php echo $gettmp['total_amount']?></div><?php } ?>



 <!-- // Amount No of Order -->

        <img src="images/icon/i_cart.png" alt="Cart"/> </a></li>

      <li><a href="register.php" class="txt-hover" id="nav_top4" title=" ລົງທະບຽນ"><img src="images/icon/i_regis.png" alt="Register"/> ລົງທະບຽນ</a></li>

      <li><a href="member_login.php" class="txt-hover" id="nav_top3" title="ເຂົ້າລະບົບ"><img src="images/icon/i_account.png"   alt="Log in"/> ເຂົ້າລະບົບ</a></li>

      <li><a href="shop.php" class="txt-hover" id="nav_top2" title="ຮ້ານຄ້າ"><img src="images/icon/i_map.png"   alt="Shops"/> ຮ້ານຄ້າ</a></li>

      <li><a href="where-to-buy.php" class="txt-hover" id="nav_top1" title=" ວິທີສັ່ງຊື້ອອນລາຍ"><img src="images/icon/i_how.png"   alt="How to buy online"/> ວິທີສັ່ງຊື້ອອນລາຍ</a></li>

    </ul>

    <!--//memu top-->

    <div class="clear"></div>

    <!--menu-->

    <div class="menu">

      <ul  class="dropdown">
   <!--mobile-->
      	<li class="show-mobile"><a href="member_login.php"  title="Log in">  ເຂົ້າລະບົບ</a></li>
      	<li class="show-mobile"><a href="register.php" title="Register">  ລົງທະບຽນ</a></li>
        <!--//mobile-->
        <li><a href="index.php"  id="mn7">ໜ້າຫຼັກ</a></li>
         <li><a href="news.php"  id="mn4"  >ຂ່າວ</a></li>
        <li><a href="products_all.php"  id="mn2"  >ສິນຄ້າ</a>
<div class="subpro" id="click-subpro">+</div>
          <ul id="product-sub">

            <li><a href="products_all.php"  >ລວມທຸກແບບ</a></li>

			<?php $i = 0; ?>

           <?php foreach ($itemList as $val) { ?> 

            <li><a href="products.php?parent_id=<?php echo $val['id']?>"><?php echo $val['title_la']?></a></li>

           <?php } ?>

          </ul>

        </li>

         <li><a href="promotion-all.php"  id="mn3">ໂປຣໂມຊັ່ນ</a>
        <div class="subpro" id="click-subpromo">+</div>
          <ul id="promo-sub">
           <li><a href="promotion-banner.php">ໂປຣໂມຊັ່ນລວມ</a></li>
           <li><a href="promotion.php">ສິນຄ້າຫຼຸດລາຄາ</a></li>

          

        </ul>
        </li>

         <li><a href="naree_story.php"  id="mn1">ປະຫວັດນາຣີ</a></li>

        <li><a href="lookbook.php"   id="mn5">ແບບຢ່າງກະເປົາ</a></li>

        <li><a href="contact.php"  id="mn6">ຕິດຕໍ່</a></li>
  <!--mobile-->
         
              <li class="show-mobile"><a href="shop.php" title="ຮ້ານຄ້າ">  ຮ້ານຄ້າ</a></li>

          <li class="show-mobile"><a href="where-to-buy.php" title=" ວິທີສັ່ງຊື້ອອນລາຍ" > ວິທີສັ່ງຊື້ອອນລາຍ</a></li>
       
    <li class="show-mobile"><a href="<?php echo str_replace('/la/', '/en/', $_SERVER['REQUEST_URI']) ?>" style="  text-align:center">
    English </a></li>
       <!--//mobile-->
      </ul>

    </div>

  </div>

  <div class="clear"></div>

</div>

