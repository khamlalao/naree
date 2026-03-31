<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>NAREE</title>

<?php include('inc_css.php');?>

</head>



<body onLoad="get_step(2);">

<?php include('inc_cart_left.php')?>

<div id="wrapper">

<!--Header-->

<div id="header"  >

  <?php include('inc_header.php');?>

</div>

<!--//header--> 



<!--content-->

<div id="Containner">

  <div class="content"> 

    <!--nav-->

    <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>Shipping</span> </div>

    <!--end nav--> 

    

    <!--New-->

    <div class="product_model">

      <?php include('inc_cart_step.php');?>

      <div class="box-content ">

        <h1><span>Select Your Payment Method</span></h1>

        <div class="box-login" >

          <ul class="form-all">

            <li>

              <label>

                <input type="radio" checked="checked">

                Credit card Visa, Mastercard, etc... </label>

            </li>

            <li>

              <label>

                <input type="radio">

                Bank Transfer </label>

            </li>

            <li>

              <div class="box-address">

                <h3>Bank Information</h3>

                <ul class="form-all">

                  <li> [1] Bank Lao Account No. 12345678 </li>

                  <li> [2]  Bank Lao Account No. 12345679 </li>

                </ul>

              </div>

            </li>

 

                 <li>

              

                 <a href="cart_confirm.php" class="btn-login">Save &amp; Continue</a>

              </li>

                    <li>

                    <a href="cart_shipping.php" class="btn-back">Back</a>

               

              </li>

     </ul>

          <div class="clear"></div>

        </div>

  

  

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

