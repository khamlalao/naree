<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>ລືມລະຫັດຜ່ານ</title>

<?php include('inc_css.php');?>

</head>



<body>
		
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

      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a>   <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>ລືມລະຫັດຜ່ານ</span> </div>

      <!--end nav--> 

      

       

      <!--New-->

      <div class="product_model">

         	<div class="box-content ">

            	<h1><span>ລືມລະຫັດຜ່ານ? </span></h1>
                 <div style=" margin-bottom:30px;">ກະລຸນາປ້ອນອີເມລທີ່ທ່ານໃຊ້ລົງທະບຽນ. ພວກເຮົາຈະສົ່ງລະຫັດຜ່ານໃຫມ່ໃຫ້ທ່ານ.</div><div class="box-login">

                 <form action="member_action.php" name="form1" id="form1" method="post" style="margin:0">

                	 <ul class="form-all">

                     	<li> <label>ອີເມລ</label><input type="text" name="email" id="email"></li>

                         

                        <li><input type="submit" class="btn-login" value="ສົ່ງ"></li>

                      <input type="hidden" name="do" id="do" value="forgot">

                        <li><a href="index.php">ກັບຄືນ</a></li>

                     </ul>

                     </form>

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

 </html>

