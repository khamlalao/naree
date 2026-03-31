<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>ລວມທຸກແບບ | Naree partner shop in Vientiane Capital & Provinces</title>
<meta name="title" content="Shops | Naree partner shop in Vientiane Capital & Provinces">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women">
<meta name="description" content="How to buy online on website naree.co">


<?php include('inc_css.php');?>

</head>



<body onLoad="getMN(2);">

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

      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>ລວມທຸກແບບ</span> </div>

      <!--end nav--> 

      

      <!--New-->

      <div class="product_model post">

        <div class=" box-content">

          <h1><span>ລວມທຸກແບບ</span></h1>

         <!-- <p></p>-->

        </div>

        <ul class="news-list">
          <?php foreach ($this->itemList as $val) { ?> 

            <li class="post shop-list-w">

              <div class="box-news"> <!---->

                 <p><a href="products.php?parent_id=<?php echo $val['id']?>"><?php echo $val['title_la']?></a> </p>

                 <a href="products.php?parent_id=<?php echo $val['id']?>"><img src="../img_product/collection/<?php echo $val['image']?>" alt=""/></a> 

              </div>

            </li>

          <?php } ?>  

            <div class="clear"></div>

            <div class="clear"></div>
          
          </ul>

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

