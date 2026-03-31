<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>Look Book | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="Look Book |  |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women,Register">
<meta name="description" content="Look Book on website naree.co">
<?php include('inc_css.php');?>

<link rel="stylesheet" type="text/css" href="js/flexslider/flexslider.css">

</head>



<body onLoad="getMN(5);">

<?php include('inc_cart_left.php')?>

<div id="wrapper"> 

  <!--Header-->

  <div id="header"  >

    <!--Header-->

    <?php if(isset($_SESSION['member_id'])){ ?>

    <?php include('inc_header_login.php')?>

    <?php }else{?>

    <?php include('inc_header.php')?>

    <?php } ?>

    <!--End Header-->

  </div>

  <!--//header--> 

  

  <!--content-->

  <div id="Containner">

    <div class="content"> 

      <!--nav-->

      <div class="nav post"> <a href="index.php" class="home">Home</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <a href="lookbook.php">Look Book</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span><?php echo $this->category->title_en?> <?php echo $this->category->subject_en?></span> </div>

      <!--end nav--> 

      

      <!--New-->

      <div class="product_model post">

      

   		<h1 class="txt-lookbook">" <?php echo $this->category->title_en?> " <?php echo $this->category->subject_en?></h1>

                <div class="box-lookbook">

       	    	<!-- Place somewhere in the <body> of your page -->

<div class="flexslider">

  <ul class="slides">

    <?php foreach ($this->itemList as $val) { ?> 

    <li>

      <img src="../img_lookbook_gallery/<?php echo $val['file_name']?>" />

    </li>

    <?php } ?>



  </ul>

</div>

                </div>

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

