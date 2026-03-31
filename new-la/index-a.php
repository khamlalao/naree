<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>NAREE</title>
<?php include('inc_css.php');?>
 
</head>

<body onLoad="getMN(7);" >
<?php include('inc_cart_left.php')?>
<div id="wrapper"> 
  <!--Header-->
  <div id="header">
   
    <?php include('inc_header.php');?>
    
  </div>
  <!--//header--> 
  <!--banner-->
  <div id="mainBanner">
    <div id="example1" class="slider-pro">
      <div class="sp-slides"> 
        
        <!--1-->
        <div class="sp-slide"> <img class="sp-image" src="images/banner_index/1.jpg"
					data-src="images/banner_index/1.jpg"
					data-retina="images/banner_index/1.jpg"/>
                    <div style="background:url(images/banner_index/1.jpg) no-repeat top center; width:100%; height:100%; background-size: cover"></div>
          <h2 class="sp-layer sp-head sp-padding" 
					data-position="Right" data-vertical="200" 
					data-show-transition="left" data-show-delay="1000" data-show-duration="800" data-hide-transition="right"  style="margin-right:200px;" > <span >It's not a bag but <br>
            a thousand fines of silk</span> </h2>
        </div>
        <!--End 1--> 
        
        <!--2-->
        <div class="sp-slide"> <img class="sp-image" src="images/banner_index/2.jpg"
					data-src="images/banner_index/2.jpg"
					data-retina="images/banner_index/2.jpg"/>
          <h2 class="sp-layer sp-head sp-padding" 
					data-position="Right" data-vertical="-180" 
					data-show-transition="left" data-show-delay="1000" data-show-duration="800" data-hide-transition="right"    style="margin-right:200px;"  > <span >It's not a bag but <br>
            a thousand fines of silk</span> </h2>
        </div>
        <!--End 2--> 
        
        <!--3-->
        <div class="sp-slide"> <img class="sp-image" src="images/banner_index/3.jpg"
					data-src="images/banner_index/3.jpg"
					data-retina="images/banner_index/3.jpg"/>
          <h2 class="sp-layer sp-head sp-padding" 
					data-position="Left" data-vertical="0" 
					data-show-transition="right" data-show-delay="1000" data-show-duration="800" data-hide-transition="left"     style="margin-left:100px;" > <span >It's not a bag but <br>
            a thousand fines of silk</span> </h2>
        </div>
        <!--End 3--> 
        
        <!--1-->
        <div class="sp-slide"> <img class="sp-image" src="images/banner_index/4.jpg"
					data-src="images/banner_index/4.jpg"
					data-retina="images/banner_index/4.jpg"/>
          <h2 class="sp-layer sp-head sp-padding" 
					data-position="Right" data-vertical="100" 
					data-show-transition="left" data-show-delay="1000" data-show-duration="800" data-hide-transition="right"    style="margin-right:300px;"  > <span >It's not a bag but <br>
            a thousand fines of silk</span> </h2>
        </div>
        <!--End 1--> 
        <!--1-->
        <div class="sp-slide"> <img class="sp-image" src="images/banner_index/5.jpg"
					data-src="images/banner_index/5.jpg"
					data-retina="images/banner_index/5.jpg"/>
          <h2 class="sp-layer sp-head sp-padding" 
					data-position="Right" data-vertical="-240" 
					data-show-transition="left" data-show-delay="1000" data-show-duration="800" data-hide-transition="right"    style="margin-right:300px;"  > <span >It's not a bag but <br>
            a thousand fines of silk</span> </h2>
        </div>
        <!--End 1--> 
        
      </div>
    </div>
  </div>
  <!--end banner--> 
  
 <!--footer--> 
 <div id="footer"  >
 	 <?php include('inc_footer.php');?>
 </div>
 <!--end footer-->
  
</div>

<!--SliderPro-->
<link rel="stylesheet" type="text/css" href="js/sliderPro/slider-pro.min.css"/>
<script type="text/javascript" src="js/sliderPro/jquery.sliderPro.min.js"></script> 
<script type="text/javascript">
	$( document ).ready(function( $ ) {
		$( '#example1' ).sliderPro({
			width: '100%',
			height: '676px',
			fade: false,
			visibleSize: '100%',
			forceSize: 'fullWidth',
			arrows: true,
			buttons: true,
			waitForLayers: true,
			autoplay: true,
			autoScaleLayers: true
		});
	});
</script> 
<!--End SliderPro-->
</body>
</html>
