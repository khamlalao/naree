<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>Promotion | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="Search Products |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women,Register">
<meta name="description" content="search products on website naree.co">
<link rel="stylesheet" type="text/css" href="js/flexslider/flexslider.css">



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

    <div class="content"  > 

      <!--nav-->

      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <a href="promotion-all.php">ໂປຣໂມຊັ່ນ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>ໂປຣໂມຊັ່ນລວມ</span> </div>

      <!--end nav--> 

      

      <!--New-->

      <div class="product_model post">
     <div class="box-lookbook">

       	    	<!-- Place somewhere in the <body> of your page -->
<?php if($this->itemListCount > 0){ ?>
<div class="flexslider">
  <ul class="slides">
        <?php $i =0; ?>
        <?php foreach ($this->itemList as $val) { ?>     
        <?php $i++; ?> 
    <li><a href="promotion-banner-detail.php?id=<?php echo $val['id']?>"><img src="../img_promotion/banner/<?php echo $val['image']?>"  alt=""/></a></li>
   		<?php } ?>

  </ul>
</div>
<?php } ?>

        </div>
         
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
<script src="js/flexslider/jquery.flexslider-min.js"></script>

 <script type="text/javascript">

 // Can also be used with $(document).ready()

$(window).load(function() {

  $('.flexslider').flexslider({

    animation: "slide"

  });

});

 </script>

 
 

 </body>

</html>

