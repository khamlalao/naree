<!doctype html>

<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>ຕິດຕໍ່ | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="Contact|  |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women,nareehandbags, Naree Hangbags">
<meta name="description" content="NAREE SHOWROOM & HEAD OFFICE : Nongbone Village (Horm 1), Saysettha District, Vientiane Capital, Lao PDR.">
<?php include('inc_css.php');?>
<script language="javascript" type="text/javascript">

$(document).ready(function(){ 



  $("#secure_code").bind('keyup', function (e) {



    if (e.which >= 97 && e.which <= 122) {



      var newKey = e.which - 32;



      // I have tried setting those



      e.keyCode = newKey;



      e.charCode = newKey;



    }



    $("#secure_code").val(($("#secure_code").val()).toUpperCase());



  });



	



  $("#secure_code").keyup(function () {



    $("#check_validate_captchar_result").load('ajax_check_captcha.php?time=<?php echo  time() ?>&secure_code=' + document.getElementById('secure_code').value)



  });



});

</script>

<!-- BEGIN Form. -->

<script language="javascript" type="text/javascript">

function checkForm(){



  with(document.formContact){



    // Check







    if ((document.getElementById('name').value == '')||(document.getElementById('name').value == 'name')) {	



      alert(' ກະລຸນາປ້ອນຊື່ :');



      document.getElementById('name').focus();



      return false;



    }	



    if ((document.getElementById('email').value == '')||(document.getElementById('email').value == 'อีเมล์')) {		  



      alert(' ກະລຸນາປ້ອນອີເມລ :');



      document.getElementById('email').focus();



      return false;



    }



    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById('email').value)) {



      alert(' ຮູບແບບອີເມລບໍ່ຖືກຕ້ອງ :');



      document.getElementById('email').focus();



      return false;



    }	



    if ((document.getElementById('mobile').value == '')||(document.getElementById('mobile').value == 'mobile')) {	



      alert(' ກະລຸນາປ້ອນເບີໂທລະສັບ :');



      document.getElementById('mobile').focus();



      return false;



    }	



    if ((document.getElementById('description').value == '')||(document.getElementById('description').value == 'description')) {	



      alert(' ກະລຸນາປ້ອນຂໍ້ຄວາມ :');



      document.getElementById('description').focus();



      return false;



    }	





    if (document.getElementById('secure_code').value == '') {	



      alert(' ກະລຸນາປ້ອນລະຫັດຄວາມປອດໄພ :');



      document.getElementById('secure_code').focus();



      return false;



    }



    if (document.getElementById('validate_captchar').value == 'false') {



      alert(' ກະລຸນາປ້ອນລະຫັດຄວາມປອດໄພຄືນໃຫມ່ :');



      document.getElementById('secure_code').focus();



      return false;



    }	



		



    SetAction('contact_complete.php');



    //return true;



  }



}







function SetAction(url) {

//	alert(url);

	document.getElementById('formContact').action = url;

	document.getElementById('formContact').target = '_self';

	document.getElementById('formContact').submit();

	

	

}



</script>

<!-- END Form. -->

<!-- BEGIN Captcha. -->

<script language="javascript" type="text/javascript">



//function refreshus(){      



//  $("#captchaimage").load("recaptcha.php");



//}



</script>

<!-- END Captcha. -->

</head>

<body onLoad="getMN(6);">
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
      
      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>ຕິດຕໍ່</span> </div>
      
      <!--end nav--> 
      
      <!--New-->
      
      <div class="product_model post">
        
        <div class="contact-address">
          <h2>ຮ້ານ ນາຣີ ກະເປົາລາວປະຍຸກ</h2>
          ບ້ານໜອງບອນ (ຮ່ອມ 1), ເມືອງໄຊເສດຖາ, ນະຄອນຫຼວງວຽງຈັນ, ສປປ ລາວ<br>
          <br>
          <br>
          <table width="100%" border="0" cellspacing="5" cellpadding="0">
            <tbody>
              <tr>
                <td width="4%"><img src="images/icon/i_tel.png"  alt=""/></td>
                <td width="96%"><a href="tel:+856212616133"><span class="numberEN">+856 21-261 613</span></a></td>
              </tr>
              <tr>
                <td><img src="images/icon/i_mobile.png"  alt=""/></td>
                <td><span class="numberEN">+856 20-5930 9333</span></td>
              </tr>
              <tr>
                <td><img src="images/icon/i_mobile.png" width="28" height="28" alt=""/></td>
                <td><span class="numberEN">+856 20-2307 1333</span></td>
              </tr>
              <tr>
                <td><img src="images/icon/i_mail.png" width="28" height="28" alt=""/></td>
                <td><a href="mailto:naree.laos@gmail.com">naree.laos@gmail.com</a></td>
              </tr>
              <tr>
                <td><img src="images/icon/i_instagram.png" width="28" height="28" alt=""/></td>
                <td>nareehandbags</td>
              </tr>
              <tr>
                <td><img src="images/icon/i_line_s.png" width="28" height="28" alt=""/></td>
                <td>nareehandbags</td>
              </tr>
              <tr>
                <td><img src="images/icon/i_facebook_s.png" width="28" height="28" alt=""/></td>
                <td>Naree Hangbags</td>
              </tr>
            </tbody>
          </table>
          
          <ul class="map">
            <li><a href="images/map.jpg" class="fancybox">
              <div class="box-map"> <img src="images/icon/i_mapgraphic.png"    alt=""/>
                <p>ແຜນທີ່ຮ້ານຄ້າ</p>
              </div>
              </a></li>
            <li><a href="https://goo.gl/maps/5XUCSZBLNer" target="_blank">
              <div class="box-map"> <img src="images/icon/i_map_google.png"   alt=""/>
                <p> ແຜນທີ່ Google</p>
              </div>
              </a></li>
            <li><a href="shop.php">
              <div class="box-map"> <img src="images/icon/i_map_pin.png"  alt=""/>
                <p>ຮ້ານຕົວແທນຈໍາໜ່າຍ</p>
              </div>
              </a></li>
              <div class="clear"></div>
          </ul>
        </div>
        
        <form name="formContact" id="formContact" action="" method="post" enctype="multipart/form-data">
          <div class="contact-form ">
            <h1>ຟອມຕິດຕໍ່</h1>
            <ul class="form-all">
              <li>
                <label>ຫົວຂໍ້</label>
                <input type="text" name="subject" id="subject" value="<?php echo  ($_SESSION['contactus_form']['subject'] != null) ? $_SESSION['contactus_form']['subject'] : '' ?>" />
              </li>
              <li>
                <label>ຊື່ - ນາມສະກຸນ <span>*</span></label>
                <input type="text" name="name" id="name" value="<?php echo  ($_SESSION['contactus_form']['name'] != null) ? $_SESSION['contactus_form']['name'] : '' ?>" />
              </li>
              <li>
                <label>ທີ່ຢູ່</label>
                <input type="text" name="address" id="address" value="<?php echo  ($_SESSION['contactus_form']['address'] != null) ? $_SESSION['contactus_form']['address'] : '' ?>" />
              </li>
              <li>
                <label>ອີເມລ <span>*</span></label>
                <input type="text" name="email" id="email" value="<?php echo  ($_SESSION['contactus_form']['email'] != null) ? $_SESSION['contactus_form']['email'] : '' ?>" />
              </li>
              <li>
                <label>ໂທລະສັບມືຖື <span>*</span></label>
                <input type="text" name="mobile"  class="numberEN" id="mobile" value="<?php echo  ($_SESSION['contactus_form']['mobile'] != null) ? $_SESSION['contactus_form']['mobile'] : '' ?>" />
              </li>
              <li>
                <label>ຂໍ້ຄວາມ <span>*</span></label>
                <textarea name="description" id="description"><?php echo  ($_SESSION['contactus_form']['description'] != null) ? $_SESSION['contactus_form']['description'] : '' ?>
</textarea>
              </li>
              <li>
                <div id="captchaimage">
                  <?php include('recaptcha.php'); ?>
                </div>
                <a href="#nogo">ຄຼິກເພື່ອປ່ຽນລະຫັດຄວາມປອດໄພ</a> <span id="check_validate_captchar_result">
                <input type="hidden" name="validate_captchar" id="validate_captchar" value="false" />
                </span>
                <label>ລະຫັດຄວາມປອດໄພ <span>*</span></label>
                <input type="text" name="secure_code" class="numberEN" id="secure_code" onblur="if(this.value=='')this.value='Security Code';" onclick="if(this.value=='Security Code')this.value='';" value="" />
              </li>
              <li style="margin:20px 0;">
                <h3>
                  <input name="submit" type="submit" class="btn-submit" id="submit" value="ສົ່ງ" onclick="return checkForm()">
                  <input name="reset" type="reset" class="btn-reset" id="reset" value="ຍົກເລີກ" onclick="document.getElementById('formContact').reset();">
                  <input name="do" type="hidden" value="insert">
                </h3>
              </li>
              <li style="margin:20px 0;">
                <div class="clear"></div>
              </li>
              <li><span style="color:#f00; font-size:22px; line-height:0px;"> * </span> ກະລຸນາຕື່ມຂໍ້ມູນທີ່ຈຳເປັນເຊິ່ງໝາຍດ້ວຍເຄື່ອງໝາຍດອກຈັນ  (*).</li>
            </ul>
          </div>
        </form>
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
