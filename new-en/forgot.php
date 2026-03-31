<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>NAREE</title>

<?php include('inc_css.php');?>

</head>



<body>


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

      <div class="nav post"> <a href="index.php" class="home">Home</a>   <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>Forgot Password</span> </div>

      <!--end nav--> 

      

       

      <!--New-->

      <div class="product_model">

         	<div class="box-content ">

            	<h1><span>Forgot your password? </span></h1>

                <div style=" margin-bottom:30px;">Please enter the email address you used to register. We will then send you a new password.</div>

                
                <div class="box-login">

                 <form action="member_action.php" name="form1" id="form1" method="post" style="margin:0">

                	 <ul class="form-all">

                     	<li> <label>E-mail</label><input type="text" name="email" id="email"></li>

                         

                        <li><input type="submit" class="btn-login" value="Send"></li>

                      <input type="hidden" name="do" id="do" value="forgot">

                        <li><a href="index.php">Back to Home</a></li>

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

