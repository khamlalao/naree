<!doctype html>

<html lang="en">

<head>

<meta http-equiv="content-type" charset="utf-8">

<title>Shpping Cart | NAREE : Blending traditional craftsmanship with modern style</title>

<meta name="title" content="Shpping Cart |  NAREE : Blending traditional craftsmanship with modern style">

<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women">

<meta name="description" content="Shpping Cart on website naree.co">



<?php include('inc_css.php');?>



</head>







<body onLoad="get_step(3);">



<?php include('inc_cart_left.php')?>



<div id="wrapper">



<!--Header-->



<div id="header"  >



  <?php include('inc_header_login.php');?>



</div>



<!--//header--> 







<!--content-->



<div id="Containner">



  <div class="content"> 



    <!--nav-->



    <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>Confirm</span> </div>



    <!--end nav--> 



    



    <!--New-->



    <div class="product_model">



      <?php include('inc_cart_step.php');?>



      <div class="box-content post" style="width:100%; ">



	



		<p style='background:url(https://h.online-metrix.net/fp/clear.png?org_id=k8vif92e&amp;session_id=" . $merchant_id . $sid . "&amp;m=1)'></p>



		<img src='https://h.online-metrix.net/fp/clear.png?org_id=k8vif92e&amp;session_id=" . $merchant_id . $sid . "&amp;m=2' alt=''>



		<object type='application/x-shockwave-flash' data='https://h.onlinemetrix.net/fp/fp.swf?org_id=k8vif92e&amp;session_id=" . $merchant_id . $sid . "' width='1' height='1' id='thm_fp'>



		<param name='movie' value='https://h.online-metrix.net/fp/fp.swf?org_id=k8vif92e&amp;session_id=" . $merchant_id . $sid . "' />



		<div></div></object>



		<script src='https://h.online-metrix.net/fp/check.js?org_id=k8vif92e&amp;session_id=" . $merchant_id . $sid . "' type='text/javascript'></script>



        



        



             <div class="box-message">



<?php if($this->decision == 'ACCEPT'){?>

<h1><span>ການສັ່ງຊື້ຂອງທ່ານສຳເລັດ!

</span></h1>

<p>ຂອບໃຈທີ່ຊື້ສິນຄ້າ ນາຣີ. ກະລຸນາກວດເບິ່ງໃບຢືນຢັນການສັ່ງຊື້ໃນອີເມລຂອງທ່ານ ເມື່ອການຈ່າຍເງິນຜ່ານທະນາຄານສໍາເລັດແລ້ວ ພວກເຮົາຈະຈັດສົ່ງສິນຄ້າໃຫ້ທ່ານພາຍໃນ 3-40 ວັນ ອີງຕາມແຕ່ລະຂົງເຂດ.</p>



<div class="box-login">



<a href="review_order_print.php?id=<?php echo $this->invoice_order->invoice_id?>&member_id=<?php echo $this->invoice_order->member_id?>&reference_number=<?php echo $this->invoice_order->req_reference_number?>" target="_blank" class="btn-back"><i class="fa fa-print" aria-hidden="true"></i>



 Print Order </a>



</div>



<?php }else{ ?>

<h1><span>ການສັ່ງຊື້ຂອງທ່ານບໍ່<span style="color:#f00">ສຳເລັດ!</span></span></h1>

<p><a href="products.php">ກະລຸນາເລືອກສິນຄ້າຄືນໃຫມ່</a><br>

</p>

<?php } ?>



             </div>



            <div class="clear"></div>



  



  



  </div>



      <!--Model--> 



      



    </div>



  </div>



  <!--end content--> 



  </div>



  <!--footer-->



  <div id="footer" >



    <?php include('inc_footer.php');?>



  </div>



  <!--end footer--> 



  



</div>



 



</html>



