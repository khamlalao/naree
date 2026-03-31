<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>ສິນຄ້າ | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women">
<meta name="description" content="website naree.co">

<?php include('inc_css.php');?>

<style>

.contentHolder { position:relative; padding:0px; width: 810px; height: 533px; overflow: auto; }

.spacer { text-align:center }

</style>

<script type="text/javascript">

jQuery(document).ready(function($) {

	$.get('order_alert.php', {

		session : '<?php echo $_SESSION['session_login']?>',

		time : new Date().getTime()

		}, function(data) {

		//	alert(data);
		if(data != ''){

	  $('#yourcart-num').html('<span id="yourcart-num" class="num-items">'+data+'</span>'); //cartnum
		}
	// $('#yourcart-num').html(data);
	//	$('#cartnum').html(data);
	});

/*	setInterval(function(){
		$.get('order_alert.php', {
				session : '<?php //=$_SESSION['session_login']?>',
				time : new Date().getTime()
				}, function(data) {
				//	alert(data);
				  $('#yourcart-num').html(data);
			  });
		}, 0);
*/
	$('#add2Cart').click(function(){

		var num = document.getElementById('amount').value;

		//alert(num);	

		var id = '<?php echo $this->id?>';
		
				$.get('inc_cart_add.php', {
				id : id,
				action : 'additem',
				amount : num,				
				time : new Date().getTime()

				}, function(data) {
					//alert(data);
				  });	


			  $.get('inc_cart_render.php', {
				id : id,
				time : new Date().getTime()
				}, function(data) {
				//	alert(data);
				  $('#default_cart').html(data);
				//  $('#amount_incart').html(data)
				//	alert(data);

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

			MyCart();

		 });
});

function addtocart(obj){

	// alert(obj);

	 

	var num = document.getElementById('amount').value;

	 //alert($('#amount').val());

	// alert(num);

	//amount : $("#amount").val();

	//var delItem = $("#amount").val();

	if(obj == 'add'){

	//	alert('+');

		var num = document.getElementById('amount').value;

		//alert(num);

		var new_add = new Number(num)+1;

		//alert(new_add);

		//$('#amount').val(new_add); 

		document.getElementById('amount').value = new_add;





	}

	if(obj == 'del'){

		//	alert('-');

		var num = document.getElementById('amount').value;

		//alert(num);

		if(num > 1){

		var new_add = new Number(num)-1;

		//alert(new_add);

		//$('#amount').val(new_add); 

		document.getElementById('amount').value = new_add;

		}

		

	}

	

}



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
							if(data != 0){  $('#cashAmount').html(data); }else{ $('#cashAmount').html(''); }
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
				id : id,
				time : new Date().getTime()
				}, function(data) {
				//alert(data);
				  $('#cashAmount').html(data);
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
				id : id,
				time : new Date().getTime()
				}, function(data) {
				//alert(data);
				  $('#cashAmount').html(data);
			   });  		
		
		 });
		



		}

	}



	//alert(newAmount);

	

	

}



function MyCart(){

			  			

	jQuery("#box-cart-app").animate({  right: '0'}, 300);

	jQuery(".dim").fadeIn();

	jQuery("body").addClass('has-active-menu');

}

</script>    

</head>



<body onLoad="getMN(2);" >

<?php //if($this->OrderrecordCount > 0){ ?>
<div class="dim"></div>

<div id="box-cart-app">

  <div class="box-cart-titlebar">

    <div class="icon-close" id="close-cart" title="Close"><img src="images/icon/i_close.png"   alt=""/></div>

    <h2>ກະຕ່າສິນຄ້າຂອງຂ້ອຍ</h2>

    <!--<div class="your-item" id="yourcart-item"><?php //=$this->total_amount?></div> -->

  </div>

  <!--Item cart-->

<!--  <div class="box-overflow">-->

  <div id="default_cart" class="contentHolder_cart">

  <ul class="cart-right">

        <?php $i =0; ?>

        <?php foreach ($this->itemOrder as $data) { ?>     

        <?php $i++; ?>   

    <li>

      <div class="delete-item"><a href="#nogo" title="Remove" id="remove-cart" onclick="return removeItem(<?php echo $data['id']?>);" ><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>

      <div class="cart-right-img"> <a href="products_detail.php?id=<?php echo $data['pid']?>"><img src="../img_product/<?php echo Lang::getProductOrder($data['pid'],'image','la')?>" alt=""/></a>

        <div class="cart-right-name">

          <h2 class="txt-mdel"><a href="products_detail.php?id=<?php echo $data['pid']?>"><?php echo Lang::getProductOrder($data['pid'],'title_la','la')?></a> <div class="numberEN"><?php echo Lang::getProductOrder($data['pid'],'code','la')?></span></h2>

        </div>

      </div>

      <div class="cart-right-price">

        <h3 class="txt-price">ລາຄາ: <br><?php if($data['discount'] != ''){?><span><span class="numberEN"><?php echo Lang::getProductOrder($data['pid'],'price','la')?></span> ໂດລາ</span> <br>
<span class="special"><span class="numberEN"><?php echo Lang::getProductOrder($data['pid'],'discount','la')?></span> ໂດລາ</span><?php }else{ ?><span class="numberEN"><?php echo Lang::getProductOrder($data['pid'],'price','la')?></span> ໂດລາ<?php } ?></h3>

        <table border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td style="padding-bottom:5px; text-transform:uppercase">ຈຳນວນ </td>

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

  <?php // if($this->OrderrecordCount > 0){ ?>
  <div class="cart-right-total">
  <div class="pad">
  	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>ຍອດລວມ</td>
    <td align="right"><span id="cashAmount"><span class="numberEN"><?php echo $this->totalPay?></span></span> ໂດລາ</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><span id="cashAmount_KIP"><span class="numberEN"><?php echo Lang::eXchangeRate('lak',$this->totalPay)?></span></span> ກີບ</td>
  </tr>
    </table>
</div>
 <a href="products.php" class="continue-shop">ສືບຕໍ່ເລືອກສິນຄ້າ</a>
 <a href="cart_session.php" class="check-out">ສັ່ງຊື້ເລີຍ</a>
 <div class="clear"></div>
 </div>
<?php // } ?>
  

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

<?php //} ?>

<div id="wrapper"> 

  <!--Header-->

  <div id="header"  >

    <!--Header-->

    <?php if(isset($_SESSION['member_id'])){ ?>

    <?php // include('inc_header_login.php')?>

<div class="content">

  <div class="logo"><a href="index.php"><img src="images/logo_naree.png"   alt=""/></a></div>

  <div class="header_left"> 

    <!--mene top-->

    <ul class="menu_top dropdown">

      <li><a href="<?php echo str_replace('/la/', '/en/', $_SERVER['REQUEST_URI']) ?>" style="  text-align:center">English</a></li>

      <li><a href="#nogo" id="mycart" >

          <span id="yourcart-num"></span>

        <img src="images/icon/i_cart.png" alt=""/> </a></li>

      	<li><a href="member_login.php" class="txt-nohover" ><img src="images/profile.png" alt=""/><?php echo $_SESSION['member_name']?></a>

        <ul style="left:-40px;">

          <!--<li><a href="#nogo" class="txt-select">Your Account</a></li> -->

          <BR />

         <li><a href="member.php">ລາຍລະອຽດບັນຊີ</a></li>

          <li><a href="member_address.php">ທີ່ຢູ່ສົ່ງສິນຄ້າ</a></li>

          <li><a href="member_order.php">ປະຫວັດການສັ່ງສິນຄ້າ</a></li>

          <li><a href="member_wishlist.php">ສິນຄ້າທີ່ຢາກໄດ້</a></li>

           <!-- <li><a href="member_notifer.php">Notify Money Transfer</a></li> -->

          <li><a href="logout.php">ອອກລະບົບ</a></li>

        </ul>

      </li>

  

      <li><a href="shop.php" class="txt-hover" id="nav_top2" title="Shops"><img src="images/icon/i_map.png"   alt="Shops"/> ຮ້ານຄ້າ</a></li>

      <li><a href="where-to-buy.php" class="txt-hover" id="nav_top1" title="How to buy online"><img src="images/icon/i_how.png"   alt="How to buy online"/> ວິທີສັ່ງຊື້ອອນລາຍ</a></li>

    </ul>

      

      <!-- <li><a href="register.php" class="txt-hover" id="nav_top4"><img src="images/icon/i_regis.png"   alt=""/> Register</a></li>-->

      

    </ul>

    <!--//memu top-->

    <div class="clear"></div>

    <!--menu-->

    <div class="menu">

      <ul  class="dropdown">

        <li><a href="index.php"  id="mn7">ໜ້າຫຼັກ</a></li>
         <li><a href="news.php"  id="mn4" >ຂ່າວ</a></li>
        <li><a href="products_all.php"  id="mn2 ">ສິນຄ້າ</a>

          <ul>

            <li><a href="products_all.php"  >ລວມທຸກແບບ</a></li>

			<?php $i = 0; ?>

           <?php foreach ($this->itemList as $val) { ?> 

            <li><a href="products.php?parent_id=<?php echo $val['id']?>"><?php echo $val['title_la']?></a></li>

           <?php } ?>

          </ul>

        </li>
<li><a href="promotion.php"   id="mn3">ໂປຣໂມຊັ່ນ</a></li>

         <li><a href="naree_story.php"  id="mn1">ປະຫວັດນາຣີ</a></li>

        <li><a href="lookbook.php"    id="mn5">ແບບຢ່າງກະເປົາ</a></li>

        <li><a href="contact.php"  id="mn6">ຕິດຕໍ່</a></li>

      </ul>

    </div>

  </div>

  <div class="clear"></div>

</div>



    <?php }else{?>



<div class="content">

  <div class="logo"><a href="index.php"><img src="images/logo_naree.png" alt=""/></a></div>

  <div class="header_left"> 

    <!--mene top-->

    <ul class="menu_top">

      <li><a href="<?php echo str_replace('/la/', '/en/', $_SERVER['REQUEST_URI']) ?>" style="  text-align:center">English</a></li>

      <li><a href="#nogo" id="mycart" >

          <span id="yourcart-num"></span>



 <!-- // Amount No of Order -->

        <img src="images/icon/i_cart.png"   alt=""/> </a></li>

      <li><a href="register.php" class="txt-hover" id="nav_top4"><img src="images/icon/i_regis.png" alt=""/> ລົງທະບຽນ</a></li>

      <li><a href="member_login.php" class="txt-hover" id="nav_top3"><img src="images/icon/i_account.png"   alt=""/> ເຂົ້າລະບົບ</a></li>

       <li><a href="shop.php" class="txt-hover" id="nav_top2"><img src="images/icon/i_map.png"   alt=""/> ຮ້ານຄ້າ</a></li>

      <li><a href="where-to-buy.php" class="txt-hover" id="nav_top1"><img src="images/icon/i_how.png"   alt=""/> ວິທີສັ່ງຊື້ອອນລາຍ</a></li>

    </ul>

    <!--//memu top-->

    <div class="clear"></div>

    <!--menu-->

    <div class="menu">

      <ul  class="dropdown">

     <li><a href="index.php" title="ໜ້າຫຼັກ" id="mn7">ໜ້າຫຼັກ</a></li>
         <li><a href="news.php"  id="mn4" title="ຂ່າວ">ຂ່າວ</a></li>
        <li><a href="products_all.php"  id="mn2" title="ສິນຄ້າ">ສິນຄ້າ</a>

          <ul>

            <li><a href="products_all.php" title="ລວມທຸກແບບ">ລວມທຸກແບບ</a></li>
			<?php $i = 0; ?>

           <?php foreach ($this->itemList as $val) { ?> 

            <li><a href="products.php?parent_id=<?php echo $val['id']?>"><?php echo $val['title_la']?></a></li>

           <?php } ?>

          </ul>

        </li>

     <li><a href="promotion.php"  title="ໂປຣໂມຊັ່ນ" id="mn3">ໂປຣໂມຊັ່ນ</a></li>

         <li><a href="naree_story.php" title="ປະຫວັດນາຣີ" id="mn1">ປະຫວັດນາຣີ</a></li>

        <li><a href="lookbook.php"  title="ແບບຢ່າງກະເປົາ" id="mn5">ແບບຢ່າງກະເປົາ</a></li>

        <li><a href="contact.php" title="ຕິດຕໍ"  id="mn6">ຕິດຕໍ່</a></li>


      </ul>

    </div>

  </div>

  <div class="clear"></div>

</div>    

    <?php // include('inc_header.php')?>

    <?php } ?>

    <!--End Header-->

  </div>

  <!--//header--> 

  

  <!--content-->

  <div id="Containner">

    <div class="content"> 

      <!--nav-->

      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <a href="products.php">ສິນຄ້າ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <a href="products.php?parent_id=<?php echo $this->parent_id?>"><?php echo $this->category->title_la?></a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span><?php echo $this->item->title_la?></span> </div>

      <!--end nav--> 

      

  <?php include('inc_search_product.php');?>

  

  

      <!--Model detail-->

    <div id="model-detail" class="post">

       <!--page--> 

      <div id="page" style="width:100%; margin:0 0 10px 0">

   		<ul>

        	 <li><a href="javascript:history.back();" class="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td><img src="images/icon/arrow_left.png" width="66" height="65"  alt=""/> </td>

    <td>&nbsp;</td>

    

    <td>ກັບຄືນ</td>

  </tr>

</table>

</a></li>

            

      		  <div class="clear"></div>

            

	    </ul>

      </div>

        <div class="clear"></div>

      <!--//page--> 

       	<div class="model-detail-left ">

         <div id="default" class="contentHolder">

         <?php if($this->listImageCount != 0){?>

       	  <ul class="model-gallery">

          <?php foreach($this->listImage as $val){ ?>

          <li><img src="../img_product_gallery/<?php echo $val['file_name']?>" alt="<?php echo $val['title_la']?>"/> </li>

          <?php } ?>     

   	      </ul>

          <?php } ?>

          </div>

     <p> * ວາງມາວສເທິງຮູບແລ້ວເລື່ອນລົງເພື່ອເບິ່ງຮູບອື່ນໆ</p>

        </div>

        <div class="model-detail-right">

        	<h2 class="txt-mdel">  <?php echo $this->item->title_la?><span  class="numberEN" ><?php echo $this->item->code?></span></h2>

            
            <?php if($this->item->size_la != null){?>
            <p>ຂະໜາດ: <span class="numberEN"><?php echo $this->item->size_la?></span></p>
            <?php } ?>
           <?php /*?> <p>ຂະໜາດ (ຊມ): <span class="numberEN"><?php echo $this->item->size_cm?></span></p>
            <p>ຂະໜາດ (ນິ້ວ): <span class="numberEN"><?php echo $this->item->size_inch?></span></p>
            <p>ນໍ້າໜັກ (ກິໂລ): <span class="numberEN"><?php echo $this->item->weight?></span></p>
            <p>ສີ: <?php echo $this->item->color_la?></p>
            <p>ປະເພດຜ້າ: <?php echo $this->item->fabric_la?></p>
            <p>ອຸປະກອນ: <?php echo $this->item->material_la?></p><?php */?>
            
            <div style="font-size:14px">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    
    <tr>
      <td width="23%">ຂະໜາດ (ຊມ)</td>
      <td width="3%" align="center">:</td>
      <td width="73%"><span class="numberEN"><?php echo $this->item->size_cm?></span> </td>
    </tr>
    <tr>
      <td>ຂະໜາດ (ນິ້ວ)</td>
      <td width="3%" align="center">:</td>
      <td><span class="numberEN"><?php echo $this->item->size_inch?></span></td>
    </tr>
    <tr>
      <td>ຂະໜາດ (ນິ້ວ)</td>
      <td width="4%" align="center">:</td>
      <td> <span class="numberEN"><?php echo $this->item->size_inch?></span></td>
    </tr>
    <tr>
      <td>ສີ</td>
      <td width="3%" align="center">:</td>
      <td><?php echo $this->item->color_la?></td>
    </tr>
    <tr>
      <td>ປະເພດຜ້າ </td>
      <td width="3%" align="center">:</td>
      <td><?php echo $this->item->fabric_la?></td>
    </tr>
    <tr>
      <td>ອຸປະກອນ້າ</td>
      <td width="3%" align="center">:</td>
      <td><?php echo $this->item->material_la?></td>
    </tr>
  </tbody>
</table>

      </div>
            
            
            
          <BR>
           <?php echo  convTextFromDB(encodeFromDB($this->item->detail_la)) ?> 


<div class="box-price">
<table border="0" cellpadding="3" cellspacing="0" >
  <tbody>
   <?php if($this->item->discount != ''){?>
    <tr>
      <td>ລາຄາ ໂດລາ </td>
      <td>:</td>
      <td><span class="normalprice"><?php echo number_format($this->item->price,2);?></span> ໂດລາ</td>
      <td><span class="specialprice"><?php echo number_format($this->item->discount,2);?></span> ໂດລາ</td>
    </tr>
    <?php }else{ ?>
        <tr>
      <td>ລາຄາ ໂດລາ</td>
      <td>:</td>
      <td><span class="txt-model-price"><span class="numberEN"><?php echo number_format($this->item->price,2);?></span> ໂດລາ</span></td>
      <td>&nbsp;</td>
    </tr>
	<?php } ?>
  <?php if($this->item->discount != ''){?>
    <tr>
      <td>ລາຄາ ກີບ</td>
      <td>:</td>
      <td><span class="normalprice"><?php echo Lang::eXchangeRate('lak',$this->item->price);?></span> ກີບ</td>
      <td><span class="specialprice"><?php echo Lang::eXchangeRate('lak',$this->item->discount);?></span> ກີບ</td>
    </tr>
    <?php }else{ ?>
        <tr>
      <td>ລາຄາ ກີບ</td>
      <td>:</td>
      <td><span class="txt-model-price"><span class="numberEN"><?php echo Lang::eXchangeRate('lak',$this->item->price);?></span> ກີບ</span></td>
      <td>&nbsp;</td>
    </tr>
	<?php } ?>
     
  </tbody>
</table>
</div>


<div class="box-quantity">

<table border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td style="padding-right:10px">ຈຳນວນ </td>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr>

    <td width="30" align="center" bgcolor="#000000"><a href="javascript:void(0);" title="Minus" onClick="return addtocart('del');"><i class="fa fa-minus" aria-hidden="true"></i></a></td>

    <td><input type="text" value="1" class="txtbox-quantity" name="amount" id="amount"></td>

    <td width="30" align="center"  bgcolor="#000000"><a href="javascript:void(0);" title="Add" onClick="return addtocart('add');"><i class="fa fa-plus" aria-hidden="true"></i>

</a></td>

  </tr>

</table>

</td>

  </tr>

</table>



</div>



<div class="box-btn">

<!--<a href="javascript:void(0);" class="bth-cart" id="add2Cart" onClick="return addtocart('cart');"> -->
<a href="javascript:void(0);" class="bth-cart" id="add2Cart"><img src="images/icon/i_cart.png" alt=""/> ເພີ່ມໃສ່ກະຕ່າ </a>

<a href="member_wishlist.php?id=<?php echo $this->item->id?>" class="bth-wishlist "><img src="images/icon/i_wishlist.png" alt=""/>ສິນຄ້າທີ່ຢາກໄດ້</a>

<div class="clear"></div>

</div>



 





 

        </div>

        <div class="clear"></div>

        </div>

      <!--//Model detail--> 

      

     

      

    </div>

  </div>

  <!--end content--> 

  

  <!--footer-->

  <div id="footer" >

    <?php include('inc_footer.php');?>

  </div>

  <!--end footer--> 

  

</div>



     <script>

      var $ = document.querySelector.bind(document);

      window.onload = function () {

       Ps.initialize($('#default'));

	//	 Ps.initialize($('#default_cart'));

        Ps.initialize($('#no-keyboard'), {

          handlers: ['click-rail', 'drag-scrollbar', 'wheel', 'touch']

        });

        Ps.initialize($('#click-and-drag'), {

          handlers: ['click-rail', 'drag-scrollbar']

        });

      };
    </script>

</body>

</html>

