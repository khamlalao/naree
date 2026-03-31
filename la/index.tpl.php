<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>NAREE | Blending traditional craftsmanship with modern style</title>
<meta name="title" content="NAREE | Blending traditional craftsmanship with modern style">
<meta name="keywords" content="Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women, shopping online">
<meta name="description" content="Naree is an ancient Pali/Sanskrit-derived Lao word, meaning woman or goddess. The Naree brand strives to communicate to modern women the value of tradition alongside social development.">

<?php include('inc_css.php');?>

<!--Flexslider-->

<link rel="stylesheet" type="text/css" href="js/flexslider/flexslider_index.css"/>

<!--End Flexslider-->

</head>



<body onLoad="getMN(7);" >

<?php include('inc_cart_left.php')?>

<div id="wrapper"> 

  <!--Header-->

  <div id="header">

    <!--Header-->

    <?php if(isset($_SESSION['member_id'])){ ?>

    <?php include('inc_header_login.php')?>

    <?php }else{?>

    <?php include('inc_header.php')?>

    <?php } ?>

    <!--End Header-->

  </div>

  <!--//header--> 

  <!--banner-->

  <div id="mainBanner"> 

    <!--Flexslider-->

    <div class="flexslider">

      <ul class="slides">

      <?php $i = 0; ?>

       <?php foreach ($this->itemList as $val) { ?> 

      	<li><img src="../img_banner/<?php echo $val['file_name_la']?>" alt="<?php echo $val['title_la']?>" title="<?php echo $val['title_la']?>"/></li>

       <?php } ?>

      </ul>

    </div>

    <!--End Flexslider--> 

  </div>

  <!--end banner--> 

  

  <!--footer-->

  <div id="footer"  >

    <?php include('inc_footer.php');?>

  </div>

  <!--end footer--> 

  

  <!--FlexSlider--> 

  <script defer src="js/flexslider/jquery.flexslider.js"></script> 

  <script type="text/javascript" src="js/flexslider/jquery.flexslider-min.js"></script> 

  <script type="text/javascript">

	$(function(){

      SyntaxHighlighter.all();

    });

    $(window).load(function(){

      $('.flexslider').flexslider({

        animation: "fade",

		directionNav: true,

        controlNav: true,

        animationLoop: true,

        slideshow: true,

		 slideshowSpeed: 6000, 

		//sync: "#carousel",

        start: function(slider){

          $('body').removeClass('loading');

        }

      });

    });

  </script> 

  <!--End FlexSlider--> 

  

</div>

</html>

