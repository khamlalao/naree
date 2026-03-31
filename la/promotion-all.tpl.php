<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>Promotion | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="Search Products |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women,Register">
<meta name="description" content="search products on website naree.co">



<?php include('inc_css.php');?>

 </head>



<body onLoad="getMN(3);">

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

  <div id="Containner"  >

    <div class="content" > 

      <!--nav-->

      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>ໂປຣໂມຊັ່ນ</span> </div>

      <!--end nav--> 

      

      <!--New-->

      <div class="product_model post">
      <ul class=" promotion-all">
      	<li><a href="promotion-banner.php"><div class="box-cation-promo-app">
        	<div class="box-cation-promo"> ໂປຣໂມຊັ່ນລວມ</div>
        </div><?php if($this->cover->image1 != null){?>
        <img src="../img_promotion/cover/<?php echo $this->cover->image1?>"  alt=""/>
        <?php }else{?><img src="images/promotion/ad-promo-01.jpg"  alt=""/><?php } ?></a></li>
        <li><a href="promotion.php"><div class="box-cation-promo-app">
        	<div class="box-cation-promo">ສິນຄ້າຫຼຸດລາຄາ</div>
        </div><?php if($this->cover->image2 != null){?>
        <img src="../img_promotion/cover/<?php echo $this->cover->image2?>"  alt=""/>
        <?php }else{?><img src="images/promotion/ad-promo-02.jpg"  alt=""/><?php } ?></a></li>
         
      </ul> <div class="clear"></div>
          <div style="height:30px"></div>
</div>

       <div class="clear"></div>

      <!--<div class="box-message">

    <img src="images/logo_coming.png" width="99" height="78"  alt=""/>

<h1> <span>How & Where to Buy</span></h1>

      	Coming Soon !

      </div>-->

   		

                 

      </div>

      <!--Model--> 

      

    </div>

 

  <!--end content--> 

  

  <!--footer-->

  <div id="footer" >

    <?php include('inc_footer.php');?>

  </div>

  <!--end footer--> 

  

</div>

 

 </body>

</html>

