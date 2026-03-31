<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>Create New Shipping Address | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="Create New Shipping Address |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women">
<meta name="description" content=" Create New Shipping Address on website naree.co">

<?php include('inc_css.php');?>



<script language="javascript" type="text/javascript">

function checkForm(val){

	//alert("OK");

   with(document.form1){

    // Check	

    if (document.getElementById('name').value == '') {	

      alert(' Please enter Name:');

      document.getElementById('name').focus();

      return false;

    }

    if (document.getElementById('surname').value == '') {	

      alert(' Please Input Surname :');

      document.getElementById('surname').focus();

      return false;

    }

	if (document.getElementById('address1').value == '') {	

      alert(' Please Input Address :');

      document.getElementById('address1').focus();

      return false;

    }

	if (document.getElementById('location_zone').value == '') {	

      alert(' Please Input Country/Location Zone :');

      document.getElementById('location_zone').focus();

      return false;

    }
	
	//if ((document.getElementById('location_zone').value == '1')||(document.getElementById('location_zone').value == '2')) {	

    //  alert(' Please Input Country/Location Zone :');

   //   document.getElementById('postcode').value = '00000';

   //   return false;

  //  }	

    if (document.getElementById('postcode').value == '') {	

      alert(' Please Input Postcode :');

      document.getElementById('postcode').focus();

      return false;

    }

    if (document.getElementById('contact_no1').value == '') {	

      alert(' Please Input Phone :');

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

      <div class="nav post"> <a href="index.php" class="home">Home</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <a href="member.php">Member</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>Create New Shipping Address</span> </div>

      <!--end nav--> 

      

      <!--Model-->

      <div class="product_model post">

        <?php include('inc_account.php');?>

        <div class="box-member-right ">

          <div class="box-content">

            <h1><span>Create New Shipping Address</span></h1>

            <div class="box-login" style="width:100%">

            <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">

              <ul class="form-all">

                <li>

                  <label>Name <span>*</span></label>

                  <input type="text" value="" name="name" id="name">

                </li>

                <li>

                  <label> Surname <span>*</span> </label>

                  <input type="text" value="" name="surname" id="surname">

                </li>

                 

                <li>

                  <label>Address  <span>*</span></label>

                <textarea rows="4" name="address1" id="address1"></textarea>

                </li>

               <li>

                 <label>Country/Location Zone  <span>*</span></label>

                  <select name="location_zone" id="location_zone">

                  	<option value="">Select Country</option>
                    <?php $i =0; ?>
					<?php foreach ($this->itemList as $val) { ?>     
                    <?php $i++; ?>
                    <option value="<?php echo $val['id']?>"><?php echo ($val['parent_id'] != '')? '  -' : ''?><?php echo $val['name']?>  </option>
                    <?php } ?>

                    

                    

                  </select>

                </li>

                 <!--<li>

                  <label>Capital  <span>*</span></label>

                  <select>

                  	<option>Select Capital</option>

                    <option>Vientiane  </option>

                    

                    

                  </select>

                </li> -->

                <!--<li>

                  <label>District  <span>*</span></label>

                    <select>

                  	<option>Select District</option>

                    <option>Sisattanark </option>

                    <option>Chanthabouly </option>

                    

                  </select>

                </li> -->

               

                <li>

                  <label>Post Code  <span>*</span></label>

                  <input type="text" name="postcode" id="postcode" ><BR>* For Lao PDR please enter 00000 for post code

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

                  <label>Post Code  <span>*</span></label>

                  <input type="text" >

                </li> -->

              </ul>

              <h3>Contact Number</h3>

              <ul class="form-all">

                <li>

                  <label>Phone No. 1  <span>*</span></label>

                  <input type="text" name="contact_no1" id="contact_no1" >

                </li>

                <li>

                  <label>Phone No. 2 [in case Phone No. 1 cannot be reached]</label>

                  <input type="text" name="contact_no2" id="contact_no2" >

                  <input type="hidden" name="do" id="do" value="insert">

                </li>

                <li>

                  <input type="submit" class="btn-login" value="Save address" onClick="return checkForm('save')">

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





</body>

</html>

