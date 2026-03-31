<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title> ລາຍລະອຽດບັນຊີ | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content=" Account Details |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women">
<meta name="description" content=" Account Details on website naree.co">


<?php include('inc_css.php');?>



<script language="javascript" type="text/javascript">

function checkForm(val){

	//alert("OK");

 if(val == 'profile'){ //alert("FORGOT"); 

   with(document.formL){

    // Check	

    if (document.getElementById('name').value == '') {	

      alert(' กรุณากรอก Name-Surname:');

      document.getElementById('name').focus();

      return false;

    }

    if (document.getElementById('email').value == '') {	

      alert(' Please Key Your E-mail :');

      document.getElementById('email').focus();

      return false;

    }

	if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById('email').value)) {

      alert(' Email does not match the pattern :');

      document.getElementById('email').focus();

      return false;

    }



      SetAction('member_action.php','formL');

  //  return true;

	  }



 }

 if(val == 'password'){  

  with(document.formL){

    // Check	



    if (document.getElementById('passwd_old').value == '') {

      alert(' ກະລຸນາປ້ອນລະຫັດຜ່ານເເດີມ :');

      document.getElementById('passwd_old').focus();

      return false;

    }	

    if (document.getElementById('passwd_new').value == '') {	

      alert(' ກະລຸນາປ້ອນລະຫັດຜ່ານໃຫມ່ :');

      document.getElementById('passwd_new').focus();

      return false;

    }

    if (document.getElementById('passwd_re').value == '') {	

      alert(' ກະລຸນາປ້ອນລະຫັດຜ່ານຢືນຢັນ :');

      document.getElementById('passwd_re').focus();

      return false;

    }			

    if ((document.getElementById('passwd_new').value != document.getElementById('passwd_re').value)) {	

      alert(' ລະຫັດຜ່ານຢືນຢັນບໍ່ຖືກຕ້ອງ :');

      document.getElementById('passwd_re').focus();

      return false;

    }    

      SetAction('member_action.php','formL');

  //  return true;

	  }

   } // END Login Form

}



function SetAction(url,fname) {

	document.getElementById(fname).action=url;

	document.getElementById(fname).target='_self';

	document.getElementById(fname).submit();

}

</script> 

</head>



<body onLoad="get_account(1);">



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

      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <a href="member.php">ລູກຄ້າ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>ລາຍລະອຽດບັນຊີ</span> </div>

      <!--end nav--> 

      

       

      <!--Model-->

      <div class="product_model post">

         	  <?php include('inc_account.php');?>

        <div class="box-member-right ">

        	<div class="box-content">

            	<h1><span>ລາຍລະອຽດບັນຊີ</span></h1>

                

               <form action="" name="formL" id="formL" method="post" style="margin:0">

                   <div class="box-login" style="width:100%">

                    <p>ຂໍ້ມູນລູກຄ້າ</p>

                	 <ul class="form-all">

                     	<li> <label>ຊື່ - ນາມສະກຸນ </label><input type="text" name="name" id="name" disabled value="<?php echo $this->members->name?>"></li>

                     	<li> <label>ອີເມລ </label><input type="text" name="email" id="email" disabled value="<?php echo $this->members->email?>"></li>

                      

                          <li style="position:relative;"> <label>ວັນເດືອນປີ ເກີດ <span>*</span></label>
                        
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td style="padding-right:8px" class="numberEN"><?php echo list_day('bd_date','bd_date',$this->bd_date,$class,$condition,'ວັນ');?></td>
                          <td  style="padding-right:8px"  class="select-m"><?php echo list_month('bd_month','bd_month',$this->bd_month,$class,$condition,'la')?></td>
                          <td class="numberEN"><?php echo list_year('bd_year','bd_year',$this->bd_year,$class,$condition,'la')?></td>
                        </tr>
                      </tbody>
                    </table>

                        
                        </i>

					   <li style="position:relative; margin-bottom:30px;">ເພດ<br>

 



                        <label style="width:20%; float:left;">  <input name="sex" id="sex" value="male" type="radio"<?php echo (($this->members->sex == 'male') ? ' checked="checked"' : '')?> disabled>ຊາຍ </label> 

                        <label style="width:30%; float:left;">   <input name="sex" id="sex" value="female" type="radio"<?php echo (($this->members->sex == 'female') ? ' checked="checked"' : '')?> disabled>ຍິງ</label>                        <div class="clear"></div>

                       </li>

                        

                        

                       
<li><a href="member_edit.php" class="btn-login">ແກ້ໄຂຂໍ້ມູນບັນຊີ</a></li>
                         

                     </ul>

                     

                    

                	 

                </div>

                </form>

            </div>

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