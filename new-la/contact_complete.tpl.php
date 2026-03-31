<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>Thank | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="Thank |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women,Register">
<meta name="description" content="Thank naree.co">

<?php include('inc_css.php');?>



</head>



<body onLoad="getMN(6);">

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

      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>Contact Us</span> </div>

      <!--end nav--> 

      

      <!--New-->

      <div class="product_model post">

      <div class="contact-form ">

      <h1>Contact Form</h1>

      

      <ul class="form-all">

       <li>

        <label><?php echo  $this->message ?></label>

        </li>

      </ul>

      </div>

      

      <div class="contact-address">

      	    <h2>NAREE LAOS BRAND (SHOWEROOM &amp; HEAD OFFICE)</h2>

            Nongbone Village (Horm 1), Saysettha District, Vientiane Capital, Lao PDR.<br>

<br>



<strong>Tel. : </strong><a href="tel:+856212616133">+856 21-261 613</a><br>

<strong>Mobile phone : </strong>+856 20-5930 9333, +856 20-2307 1333<br>

<strong>E-mail : </strong><a href="mailto:naree.laos@gmail.com">naree.laos@gmail.com</a><br>

 

<strong>Line ID : </strong>nareehandbags<br>

<strong>Instagram : </strong>nareehandbags<br>

<strong>Facebook :</strong> Naree Hangbags

<br>







<ul class="map">

	<li><a href="images/map.jpg" class="fancybox">

    	<div class="box-map">

    	<img src="images/icon/i_mapgraphic.png" width="52" height="49"  alt=""/>

        <p>GHAPHIC MAP</p>

    </div></a></li>

    <li><a href="https://www.google.la/maps/place/Naree+Handbags+Laos+Brand/@17.9718837,102.6266575,18z/data=!4m12!1m6!3m5!1s0x0000000000000000:0x3ad99d8d61a4d257!2sNaree+Handbags+Laos+Brand!8m2!3d17.9718516!4d102.6270984!3m4!1s0x0000000000000000:0x3ad99d8d61a4d257!8m2!3d17.9718516!4d102.6270984" target="_blank"><div class="box-map">

    <img src="images/icon/i_map_google.png" width="52" height="49"  alt=""/>

        <p>GOOGLE MAP</p>

    </div></a></li>

    <li><a href="shop.php"><div class="box-map">

    <img src="images/icon/i_map_pin.png" width="52" height="49"  alt=""/>

        <p>SHOP</p>

    </div></a></li>

    

</ul>

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

<script type="text/javascript">

 $(document).ready(function() {

	$(".fancybox").fancybox({

		openEffect	: 'none',

		closeEffect	: 'none'

	});

});



 

</script>

  </body>

</html>

