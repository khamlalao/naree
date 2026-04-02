<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title> Log in | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="  Log in |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women">
<meta name="description" content="  Log in on website naree.co">


<?php include('inc_css.php');?>

<script language="javascript" type="text/javascript">

function checkForm(val){

	//alert("OK");

  with(document.formL){

    // Check	

    if ((document.getElementById('username').value == '')||(document.getElementById('username').value == 'อีเมล์')) {	

      alert('Please enter E-mail::');

      document.getElementById('username').focus();

      return false;

    }

	if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById('username').value)) {

      alert('Email is not in a correct format :');

      document.getElementById('username').focus();

      return false;

    }

    if (document.getElementById('password').value == '') {	

      alert(' Please enter Password :');

      document.getElementById('pwd').focus();

      return false;

    }	

      SetAction('login.php','formL');

  //  return true;

	  }

   } // END Login Form



function SetAction(url,fname) {

	document.getElementById(fname).action=url;

	document.getElementById(fname).target='_self';

	document.getElementById(fname).submit();

}

</script> 

<script language="javascript" type="text/javascript">

			function dynamicElm()

			{

			  document.getElementById('pwd').style.display='none';

			  document.getElementById('passtxt').style.display='block';

			  document.getElementById('password').focus();

			}

</script>

</head>



<body onLoad="getNavTop(3);">

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

      <div class="nav post"> <a href="index.php" class="home">Home</a>   <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>Login</span> </div>

      <!--end nav--> 

      

       

      <!--New-->

      <div class="post">

          

            	

                

                <!--<div style="margin:30px 0">

                	<a href="" class="btn-facebook"><i class="fa fa-facebook" aria-hidden="true"></i>

 Connect with facebook</a>

                </div>

                

                <div class="box-or"><div class="box-or-txt">OR</div></div> -->

                 <div class="box-login-colum">

                 <h1><span>Log In</span></h1>

               <form action="" name="formL" id="formL" method="post" style="margin:0">

                	 <ul class="form-all">

                     	<li> <label>E-mail</label><input type="text" name="username" id="username" value="<?php echo  ($_COOKIE['username'] != null) ? $_COOKIE['username'] : '' ?>" /></li>

                        <li> <label>Password</label>

                        <div id="passtxt" style="display:none"><input name="password" id="password" type="password" value="<?php echo  ($_COOKIE['password'] != null) ? $_COOKIE['password'] : '' ?>" /></div>

                  <input type="text" name="pwd" id="pwd" onkeydown="dynamicElm()" /><input name="MM_action" type="hidden" id="MM_action" value="login" /></li>

					<?php if (!empty($_REQUEST['msg'])) :?>
                     <li>
                     <span style="color:#F00"><?php echo urlsafe_b64decode($_REQUEST['msg'])?></span>
                     </li>
                    <?php endif; ?>
                        <li><input type="submit" class="btn-login" value="Login" onClick="return checkForm('login')" ></li>

                       <!-- <li>Forgot password? <a href="forgot.php">Reset Here</a></li>

                        <li>Not a Member yet? <a href="register.php">Register Now</a></li>-->

                     </ul>

                     </form>

                </div>

                <div class="box-login-colum-r">

                <ul class="map">

	<li><a href="forgot.php">

    	<div class="box-map">

    	<img src="images/icon/i_forgot_3.png"   alt=""/>

        <p>FORGOT PASSWORD</p>

    </div></a></li>

    <li><a href="register.php"><div class="box-map">

    <img src="images/icon/i_register_3.png"  alt=""/>

        <p>REGISTER NOW</p>

    </div></a></li>

    

    

</ul>

                </div>

                <div class="clear"></div>

                

             

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



</body>

</html>

