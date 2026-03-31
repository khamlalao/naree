<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>Thank for activate member | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="Thank for activate member |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women">
<meta name="description" content=" Thank for activate member on website naree.co">


<?php include('inc_css.php');?>

</head>



<body onLoad="getNavTop(4);">

<?php //include('inc_cart_left.php')?>

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

    <div class="nav post"> <a href="index.php" class="home">Home</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>Activate Member</span> </div>

    <!--end nav--> 

    

    <!--New-->

    <div class="product_model">

       <div class="box-content post" style="width:100%; ">

       

        

             <div class="box-message">

             	 <h1><span>Thank you for register.</span></h1>

                <!-- <p> Please check your email for recive and click link for Activate Member<br>

 </p>-->

<div class="box-login">

<a href="member_login.php" class="btn-back"> 

 LOG IN NOW</a>

</div>

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



</body>

</html>

