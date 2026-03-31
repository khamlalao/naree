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
		 
		 $('.subpro').click(function(){
			
			$('.dropdown ul').slideToggle();
			//$('#mn-mobile').hide();
			//$('#mn-mobile-close').show();
		 });
		 
		});
</script>

<div class="content">

  <div class="logo"><a href="index.php"><img src="images/logo_naree.png" alt=""/></a></div>
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
<?php 
		$go = "../la/".htmlspecialchars(basename($_SERVER['PHP_SELF']));
		if($_SERVER['QUERY_STRING']!=""){
			$go .= "?".htmlspecialchars($_SERVER['QUERY_STRING']);
		}
	?>
    <ul class="menu_top">

      <li class="lang"><a href="<?php echo str_replace('/en/', '/la/', $_SERVER['REQUEST_URI']) ?>" style="  text-align:center">
    ພາສາລາວ </a></li>

      <li><a href="#nogo" id="mycart" >

          <span id="yourcart-num"></span>



 <!-- // Amount No of Order -->

        <img src="images/icon/i_cart.png"   alt=""/> </a></li>

      <li><a href="register.php" class="txt-hover" id="nav_top4"><img src="images/icon/i_regis.png" alt=""/> Register</a></li>

      <li><a href="member_login.php" class="txt-hover" id="nav_top3"><img src="images/icon/i_account.png"   alt=""/> Log in</a></li>

      <li><a href="shop.php" class="txt-hover" id="nav_top2"><img src="images/icon/i_map.png"   alt=""/> Shops</a></li>

      <li><a href="where-to-buy.php" class="txt-hover" id="nav_top1"><img src="images/icon/i_how.png"   alt=""/> How to buy online</a></li>

    </ul>

    <!--//memu top-->

    <div class="clear"></div>

    <!--menu-->

    <div class="menu">

      <ul  class="dropdown">
        <!--mobile-->
      	 <li class="show-mobile"><a href="member_login.php"  title="Log in">  Log in</a></li>
      	<li class="show-mobile"><a href="register.php" title="Register">  Register</a></li>
        <!--//mobile-->

        <li><a href="index.php" id="mn7">Home</a></li>

        <li><a href="news.php"  id="mn4">news</a></li>

        <li><a href="products_all.php"  id="mn2">products</a>

          <ul>

            <li><a href="products_all.php">All Collections</a></li>

			<?php $i = 0; ?>

           <?php foreach ($this->itemList as $val) { ?> 

            <li><a href="products.php?parent_id=<?php echo $val['id']?>"><?php echo $val['title_en']?></a></li>

           <?php } ?>

          </ul>

        </li>

        <li><a href="promotion.php"  id="mn3">Promotion</a></li>

        <li><a href="naree_story.php" id="mn1">naree story</a></li>

        <li><a href="lookbook.php"  id="mn5">look book</a></li>

        <li><a href="contact.php"  id="mn6">contact us</a></li>
          <!--mobile-->
          <li class="show-mobile"><a href="shop.php" title="Shops">  Shops</a></li>
      <li class="show-mobile"><a href="where-to-buy.php" title="How to buy online"> How to buy online</a></li>
      <?php 
		$go = "../la/".htmlspecialchars(basename($_SERVER['PHP_SELF']));
		if($_SERVER['QUERY_STRING']!=""){
			$go .= "?".htmlspecialchars($_SERVER['QUERY_STRING']);
		}
	?>
       <li class="lang show-mobile"><a href="<?php echo str_replace('/en/', '/la/', $_SERVER['REQUEST_URI']) ?>" style="text-align:center;">ພາສາລາວ </a></li>
       <!--//mobile-->

      </ul>

    </div>

  </div>

  <div class="clear"></div>

</div>