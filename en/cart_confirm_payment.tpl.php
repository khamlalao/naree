<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>NAREE LAOS BRAND</title>

<?php include('inc_css.php');?>

<script language="javascript" type="text/javascript">

$(document).ready(function() {

  //$('#loadingpage').delay(1000).fadeOut();

  $('#sendform').submit();

});

</script>

</head>



<body onLoad="get_step(3);">

<?php include('inc_cart_left.php')?>

<div id="wrapper">

<!--Header-->

<div id="header">

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

    <div class="nav post"> <a href="index.php" class="home">Home</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>Confirm</span> </div>

    <!--end nav--> 

    

    <!--New-->

    <div class="product_model">

      <?php include('inc_cart_step.php');?>

      <div class="box-content post" style="width:100%; ">

           

        

             <div class="box-message">

             	 <h1><span>... PLEASE WAIT FOR PAYMENT GATEWAY ...</span></h1>

                 <p>Thank you for your order.</p>

            </div>

            <div class="clear"></div>

  

      <form action='https://testsecureacceptance.cybersource.com/oneclick/pay' method='post' name="sendform" id="sendform">

        

		<?php foreach ($this->params as $key => $val){ 

			echo "<input type='hidden' name='$key' value='$val' />\r\n";

		 } ?>

		<!-- <input type='submit' value='Make Payment' /> -->

		</form>

		

		<p style='background:url(https://h.online-metrix.net/fp/clear.png?org_id=k8vif92e&session_id=<?php echo $this->secure_merchant?>&m=1)'></p>

		<img src='https://h.online-metrix.net/fp/clear.png?org_id=k8vif92e&session_id=<?php echo $this->secure_merchant?>&m=2' alt=''>

		<object type='application/x-shockwave-flash' data='https://h.onlinemetrix.net/fp/fp.swf?org_id=k8vif92e&session_id=<?php echo $this->secure_merchant?>' width='1' height='1' id='thm_fp'>

		<param name='movie' value='https://h.online-metrix.net/fp/fp.swf?org_id=k8vif92e&session_id=<?php echo $this->secure_merchant?>' />

		<div></div></object>

		<script src='https://h.online-metrix.net/fp/check.js?org_id=k8vif92e&session_id=<?php echo $this->secure_merchant?>' type='text/javascript'></script>

    

  

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

