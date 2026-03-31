<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>ສິນຄ້າທີ່ຢາກໄດ້ | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="ສິນຄ້າທີ່ຢາກໄດ້ |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women">
<meta name="description" content=" ສິນຄ້າທີ່ຢາກໄດ້ on website naree.co">


<?php include('inc_css.php');?>

<script type="text/javascript">

jQuery(document).ready(function($) {

	$.get('order_alert.php', {

		session : '<?php echo $_SESSION['session_login']?>',

		time : new Date().getTime()

		}, function(data) {

		//	alert(data);
		if(data != ''){

	  $('#yourcart-num').html('<span id="yourcart-num" >'+data+'</span>'); //cartnum
		}
	// $('#yourcart-num').html(data);
	//	$('#cartnum').html(data);
	});

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
				  $('#yourcart-num').html('<span id="yourcart-num"  >'+data+'</span>');
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

				//	alert(data);
				  $('#yourcart-item').html(data);
				  $('#yourcart-num').html('<span id="yourcart-num">'+data+'</span>');
			   });	
		  });	   
}

function add2cart(obj,id){
		//alert("OK");
jQuery(document).ready(function($) {
				$.get('inc_cart_add.php', {
				id : id,
				action : 'additem',
				amount : '1',				
				time : new Date().getTime()

				}, function(data) {
					//alert(data);
				  });	

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
				  $('#yourcart-num').html('<span id="yourcart-num"  >'+data+'</span>');
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


}
function MyCart(){
	jQuery("#box-cart-app").animate({  right: '0'}, 300);
	jQuery(".dim").fadeIn();
	jQuery("body").addClass('has-active-menu');
}
</script>    
</head>



<body onLoad="get_account(4);">

<?php include('inc_cart_left.php')?>

<div id="wrapper"> 

  <!--Header-->

  <div id="header"  >

    <?php if(isset($_SESSION['member_id'])){ ?>

    <?php include('inc_header_login.php')?>

    <?php }else{?>

    <?php include('inc_header.php')?>

    <?php } ?>

  </div>

  <!--//header--> 

  

  <!--content-->

  <div id="Containner">

    <div class="content"> 

      <!--nav-->

      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <a href="member.php">ລູກຄ້າ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>ສິນຄ້າທີ່ຢາກໄດ້</span> </div>

      <!--end nav--> 

      

      <!--Model-->

      <div class="product_model post">

        <?php include('inc_account.php');?>

        <div class="box-member-right ">

          <div class="box-content" style="width:100%">

            <h1><span>ສິນຄ້າທີ່ຢາກໄດ້</span></h1>

            <ul class="cart-tbl">

              <!--table--> 

              <!--	<li>

                	<ul>

                    	<li class="tddetail">Details</li>

                        <li class="tdprice">Price</li>

                    

                      

                               <li class="tdTotal"> </li>

                        <div class="clear"></div>

                    </ul>

                </li>--> 

              <!--//table-->

            </ul>

            <ul class="cart-right">

              <?php $i =0; ?>

			  <?php foreach ($this->listWishlist as $val) { ?>     

              <?php $i++; ?>   

              <li> 

                <!--Remove-->

                <div class="delete-item"><a href="?do=delete&id=<?php echo $val['pid']?>" title="Remove" ><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>

                <!--//Remove--> 

                <!--Img-->

                <div class="cart-img"> <a href="products_detail.php?id=<?php echo $val['pid']?>"><img src="../img_product/<?php echo $val['image']?>" alt=""/></a> </div>

                <!--//Img--> 

                

                <!--/Name-->

                <div class="cart-name" style="padding-top:0; width:250px;">

                  <h2 class="txt-mdel"><a href="products_detail.php?id=<?php echo $val['pid']?>"><?php echo $val['title_la']?></a> <span><?php echo $val['code']?></span></h2>
<div class="cart-price-confirm ">

					<?php if($val['discount'] != ''){?>

                   <div class="txt-model-r  txt-model-price">
                     <span ><span class="numberEN"><?php echo number_format($val['price'],2);?></span> ໂດລາ</span><br>
                     <span class="special"><span class="numberEN"><?php echo number_format($val['discount'],2);?></span> ໂດລາ</span>
                    
                    <span><span class="numberEN"><?php echo Lang::eXchangeRate('lak',$val['price'])?></span>  ກີບ</span><br>
                    <span class="special"><span class="numberEN"><?php echo Lang::eXchangeRate('lak',$val['discount'])?></span>  ກີບ</span>
                    </div>

                   <?php }else{ ?>

                  <div class="txt-model-r  txt-model-price"><span class="numberEN"><?php echo number_format($val['price'],2);?></span> ໂດລາ<br>
               <span class="numberEN"> <?php echo Lang::eXchangeRate('lak',$val['price'])?></span>  ກີບ</div>

                   <?php } ?>
                   <BR>
                   </div>
                </div>

                <!--//name--> 

                <!--Price-->

              <!--  <div class="cart-price">

                   <h3 class="txt-price">Price:<br>
 

                   

                   </h3>

                </div>
-->
                <!--//Price--> 

                

                <!--date-->
<div class="clear hide-pc"></div>
                <div class="add-to-cart"> 
                <a href="javascript:void(0);" class="bth-cart" onClick="return add2cart('cart','<?php echo $val['pid']?>');"><img src="images/icon/i_cart.png" alt=""/> ເພີ່ມໃສ່ກະຕ່າ </a> </div> 

                <!--//date-->

                

                <div class="clear"></div>

              </li>

              <?php } ?>

            </ul>

          </div>
          
        

        </div>

        <div class="clear"></div>

      </div>

      <!--Model--> 

      

    </div>

  </div>

  <!--end content--> 

  

  <!--footer-->

  <div id="footer" >

    <?php include('inc_footer.php');?>

  </div>

  <!--end footer--> 

  

</div>



</html>

