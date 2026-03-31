<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>ແບບຢ່າງກະເປົາ | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="Look Book |  |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women,Register">
<meta name="description" content="Look Book on website naree.co">

<?php include('inc_css.php');?>

		
 

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

    <!--End Header-->  </div>

  <!--//header--> 

  

  <!--content-->

  <div id="Containner">

    <div class="content"> 

      <!--nav-->

      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>ແບບຢ່າງກະເປົາ</span> </div>

      <!--end nav--> 

      

      <!--New-->

      <div class="product_model">

         <div style="min-height:400px">

        <ul class="lookbok">

       <?php $i = 1; ?>

       <?php foreach ($this->itemList as $val) { ?> 

       <?php $i++; ?> 

          <li class="post hidden visible animated fadeInDown">

          <a href="lookbook_naree.php?parent_id=<?php echo $val['id']?>">

            <div class="caption<?php echo (($i%2 == 1) ? ' left' : '')?>">

              <div class="txt-w"> " <?php echo $val['title_la']?> " <br><?php echo $val['subject_la']?></div>

            </div>

            <img src="../img_lookbook/<?php echo $val['image']?>" alt=""/> 

           </a>

           </li>

           

          <?php } ?> 



          <div class="clear"></div>

        </ul>

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



<!--<script>

      var $ = document.querySelector.bind(document);

      window.onload = function () {

       Ps.initialize($('#default'));

		 Ps.initialize($('#default_cart'));

        Ps.initialize($('#no-keyboard'), {

          handlers: ['click-rail', 'drag-scrollbar', 'wheel', 'touch']

        });

        Ps.initialize($('#click-and-drag'), {

          handlers: ['click-rail', 'drag-scrollbar']

        });

      };

	  

 

    </script>

-->

</body>

</html>

