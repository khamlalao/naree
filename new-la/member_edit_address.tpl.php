<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>ທີ່ຢູ່ສົ່ງສິນຄ້າ | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="Edit Shipping Address |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women">
<meta name="description" content=" Edit Shipping Address on website naree.co">

<?php include('inc_css.php');?>

<script language="javascript" type="text/javascript">

function checkForm(val){

	//alert("OK");

   with(document.form1){

    // Check	

    if (document.getElementById('name').value == '') {	

      alert(' ກະລຸນາປ້ອນຊື່:');

      document.getElementById('name').focus();

      return false;

    }

    if (document.getElementById('surname').value == '') {	

      alert(' ກະລຸນາປ້ອນນາມສະກຸນ :');

      document.getElementById('surname').focus();

      return false;

    }

	if (document.getElementById('address1').value == '') {	

      alert(' ກະລຸນາປ້ອນທີ່ຢູ່ :');

      document.getElementById('address1').focus();

      return false;

    }

    if (document.getElementById('postcode').value == '') {	

      alert(' ກະລຸນາປ້ອນລະຫັດໄປສະນີ :');

      document.getElementById('postcode').focus();

      return false;

    }

    if (document.getElementById('contact_no1').value == '') {	

      alert(' ກະລຸນາປ້ອນເບີໂທລະສັບ :');

      document.getElementById('contact_no1').focus();

      return false;

    }	



      SetAction('member_address_action.php','form1');

  //  return true;

	  }



}

function SetAction(url,fname) {

	document.getElementById(fname).action=url;

	document.getElementById(fname).target='_self';

	document.getElementById(fname).submit();

}

</script> 

</head>



<body onLoad="get_account(2);">

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

      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <a href="member.php">ລູກຄ້າ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>ທີ່ຢູ່ສົ່ງສິນຄ້າ</span> </div>

      <!--end nav--> 

      

      <!--Model-->

      <div class="product_model post">

        <?php include('inc_account.php');?>

        <div class="box-member-right ">

          <div class="box-content">

            <h1><span>ແກ້ໄຂທີ່ຢູ່ສົ່ງສິນຄ້າ</span></h1>

            <div class="box-login" style="width:100%">

            <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">

              <ul class="form-all">

                <li>

                  <label>ຊື່  <span>*</span></label>

                  <input type="text" name="name" id="name" value="<?php echo $this->item->name?>">

                </li>

                <li>

                  <label> ນາມສະກຸນ <span>*</span> </label>

                  <input type="text" name="surname" id="surname" value="<?php echo $this->item->surname?>">

                </li>

                 

                <li>

                  <label>ທີ່ຢູ່  <span>*</span></label>

                <textarea rows="4" name="address1" id="address1"><?php echo $this->item->address1?></textarea>

                </li>

              <li>

                 <label> ປະເທດ/ໂຊນ  <span>*</span></label>

                  <select name="location_zone" id="location_zone">

                  	<option value="">ເລືອກປະເທດ</option>
                    <?php $i =0; ?>
					<?php foreach ($this->itemList as $val) { ?>     
                    <?php $i++; ?>
                    <option value="<?php echo $val['id']?>"<?php echo ($this->item->location_zone == $val['id']) ? ' selected' : ''?>><?php echo ($val['parent_id'] != '')? '  -' : ''?><?php echo $val['name']?>  </option>
                    <?php } ?>

                    

                    

                  </select>

                </li>

               

                <li>

                  <label>ລະຫັດໄປສະນີ  <span>*</span></label>

                  <input type="text" name="postcode" id="postcode" value="<?php echo $this->item->postcode?>">

                </li>

                

                <li> 

				<br>

				<!--<label>If Select International plese fill form here.</label></li>

                 <li>

                  <label>City <span> *</span></label>

                  <input type="text" >

                </li>

                <li>

                  <label>State  <span>*</span></label>

                  <input type="text" >

                </li>

                <li>

                  <label>ລະຫັດໄປສະນີ  <span>*</span></label>

                  <input type="text" >

                </li> -->

              </ul>

              <h3>ເບີໂທຕິດຕໍ່</h3>

              <ul class="form-all">

                <li>

                  <label>ເບີໂທ 1  <span>*</span></label>

                  <input type="text" name="contact_no1" id="contact_no1" value="<?php echo $this->item->phone1?>">

                </li>

                <li>

                  <label>ເບີໂທ 2</label>

                  <input type="text" name="contact_no2" id="contact_no2" value="<?php echo $this->item->phone2?>" >

                  <input type="hidden" name="do" id="do" value="update">

                  <input type="hidden" name="id" id="id" value="<?php echo $this->item->id?>">

                </li>

                <li>

                  <input type="submit" class="btn-login" value="ບັນທຶກທີ່ຢູ່" onClick="return checkForm('save')">

                </li>

              </ul>

              </form>

            </div>

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



</html>

