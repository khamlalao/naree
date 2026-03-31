<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>Register | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="Register |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women,Register">
<meta name="description" content="Register on website naree.co">

<?php include('inc_css.php');?>

 <link rel="stylesheet" href="js/datepicker/jquery-ui.css">

  <script src="js/datepicker/jquery-1.10.2.js"></script>

  <script src="js/datepicker/jquery-ui.js"></script>

   <script>

  $(function() {

    $( "#datepicker" ).datepicker({

      changeMonth: true,

      changeYear: true

    });

  });

  </script>

<script language="javascript">
function chkEmail(email){
	//alert("CHECK"+email);
	$.get('ajax_check_username.php', {
       email : email,
	    time : new Date().getTime()
      }, function(data) {
		//  alert(data);
        if (data == 'true') {
          $('#username_check').html('<img src="images/icon/true.gif" width="30" height="30">');
		  document.getElementById('password').disabled = false;
		  document.getElementById('re_password').disabled = false;
        } else {
          $('#username_check').html('<img src="images/icon/false.gif" width="30" height="30">');
		  document.getElementById('password').disabled = true;
		  document.getElementById('re_password').disabled = true;
        }
    });
}

function fncKeyPassword(_val,num){

// document.getElementById("sp_text").innerHTML = _val.length+"/4";

	var key = _val.length;

	var elem = document.getElementById('password').value;

	

	if(key < num){ 

		  alert("Password use 6 character"); 

	}

	if(!elem.match(/^([a-z0-9\_])+$/i)){

	alert("รหัสผ่านใช้ 5 ถึง 20 ตัวอักษร เฉพาะอักษรภาษาอังกฤษและ/หรือตัวเลขร่วมกันได้ ");

	document.getElementById('password').focus();

	}

}

function fncKeyRePassword(pass){

   with(document.form1){

	if (document.getElementById('re_password').length == document.getElementById('password').length) {

	  if (document.getElementById('re_password').value == document.getElementById('password').value) {	

     // alert(' การยืนยันรหัสผ่านไม่ถูกต้อง :');

//	  		document.getElementById("sp_text").innerHTML = "True";

          $('#sp_text').html('<img src="images/icon/true.gif" width="30" height="30">');
		//  document.getElementById('password').disabled = false;
		//  document.getElementById('re_password').disabled = false;

   //   document.getElementById('re_password').focus();

   //   return false;

    }else{
		
        $('#sp_text').html('<img src="images/icon/false.gif" width="30" height="30">');

	//	document.getElementById("sp_text").innerHTML = "False";

	    document.getElementById('re_password').value == '';

		document.getElementById('re_password').focus();



		

	}

	}else{ 		

		document.getElementById("sp_text").innerHTML = "False"; 

	    document.getElementById('re_password').value == '';

		document.getElementById('re_password').focus();	

	}

   }

}

</script>

<!-- BEGIN Form. -->

<script language="javascript" type="text/javascript">

function checkForm(){

  with(document.form1){

    // Check

	if (document.getElementById('name').value == '') {	

      alert(' Please enter Name-Surname :');

      document.getElementById('name').focus();

      return false;

    }	

	  if (document.getElementById('email').value == '') {	

      alert('Please enter E-mail::');

      document.getElementById('email').focus();

      return false;

    }

    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById('email').value)) {

      alert(' Email is not in a correct format :');

      document.getElementById('email').focus();

      return false;

    }

		



    if (document.getElementById('password').value == '') {	

      alert(' Please enter Password :');

      document.getElementById('password').focus();

      return false;

    }

    if (document.getElementById('re_password').value == '') {	

      alert(' Please enter Confirm Password :');

      document.getElementById('re_password').focus();

      return false;

    }	



	

    if (document.getElementById('bd_date').value == '') {	

      alert(' Please enter your birthdate :');

      document.getElementById('bd_date').focus();

      return false;

    }
    if (document.getElementById('bd_month').value == '') {	

      alert(' Please enter your birthdate :');

      document.getElementById('bd_month').focus();

      return false;

    }
    if (document.getElementById('bd_year').value == '') {	

      alert(' Please enter your birthdate :');

      document.getElementById('bd_year').focus();

      return false;

    }	
    SetAction('register_thank.php');

    //return true;

  }

}



function SetAction(url) {

	//alert("OK");

	document.getElementById('form1').action = url;

	document.getElementById('form1').target = '_self';

	document.getElementById('form1').submit();

}

</script>

<!-- END Form. -->

<!-- BEGIN Captcha. -->

<script language="javascript" type="text/javascript">

function refreshus(){      

  $("#captchaimage").load("recaptcha.php");

}

</script> 

<!-- END Captcha. -->  

</head>



<body onLoad="getNavTop(4);">

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

      <div class="nav post"> <a href="index.php" class="home">Home</a>   <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>Register</span> </div>

      <!--end nav--> 

      

       

      <!--New-->

      <div class="product_model post">

      <form method="post" enctype="multipart/form-data" name="form1" id="form1" action="">

         	<div class="box-content ">

            	<h1><span>Register</span></h1>

                

                <!--<div style="margin:30px 0">

                	<a href="" class="btn-facebook"><i class="fa fa-facebook" aria-hidden="true"></i>

 Register with facebook</a>

                </div>

                

                <div class="box-or"><div class="box-or-txt">OR</div></div> -->

                 <div class="box-login">

                	 <ul class="form-all">

                     	<li> <label>Name - Surname <span>*</span></label><input type="text" name="name" id="name"></li>

                     	<li> <label>E-mail <span>*</span></label><input type="text" name="email" id="email" onchange="chkEmail(this.value);"></li>
                        <li><span id="username_check"></span></li>

                        <li> <label>Password <span>*</span></label><input type="password" name="password" id="password" onchange="fncKeyPassword(this.value,5);" maxlength="20"></li>

                             <li> <label>Confirm Password <span>*</span></label><input type="password" name="re_password" id="re_password" onchange="fncKeyRePassword(this.value);" maxlength="20">

                             

                          <span style="font-size:12px;"> [Minimum 6 characters with a number and alphabet]</span>

                            <span style="color:#F00;" id="sp_text"></span> </li>

                       <!--  <li style="position:relative;"> <label>Date of Birth Day <span>*</span></label><input type="text" id="datepicker" name="birth_date"> <i class="fa fa-calendar" aria-hidden="true" style="position:absolute; right:10px; top:36px;"></i>

</li>-->

					   <li style="position:relative;"> <label>Date of Birth  <span>*</span></label>
                        
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td style="padding-right:8px"><?php echo list_day('bd_date','bd_date',$this->bd_date,$class,$condition,'DATE');?></td>
      <td  style="padding-right:8px"><?php echo list_month('bd_month','bd_month',$this->bd_month,$class,$condition,'en')?></td>
      <td><?php echo list_year('bd_year','bd_year',$this->bd_year,$class,$condition,'en')?></td>
    </tr>
  </tbody>
</table>

                        
                        </i>

</li>
					   <li style="position:relative; margin-bottom:30px;">Gender<br>

 



                        <label style="width:20%; float:left;">  <input type="radio" name="sex" id="sex" value="male">Male </label> 

                        <label style="width:30%; float:left;">   <input type="radio" name="sex" id="sex" value="female">Female</label>                        <div class="clear"></div>

                       </li>

                         <li><label> <input type="checkbox" name="activate" value="1" id="checkbox" />

By clicking submit, I confirm that I have read and agree to <a href="payment_policy.php">Naree's Payment Policy</a></label>
                         </li>

                        <li><input name="do" type="hidden" value="insert"><input type="button" class="btn-login" value="SUBMIT" onClick="return checkForm()"></li>

                          <li style="text-align:center">or <a href="javascript:void();" onClick="document.getElementById('form1').reset()">Reset</a></li>

                         

                     </ul>

                </div>

                

                

                

            </div>

      </form>      

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

