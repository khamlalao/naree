<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title> Shipping Addresses | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content=" Shipping Addresses |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women">
<meta name="description" content=" Shipping Addresses on website naree.co">


<?php include('inc_css.php');?>

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

    <?php } ?>  </div>

  <!--//header--> 

  

  <!--content-->

  <div id="Containner">

    <div class="content"> 

      <!--nav-->

      <div class="nav post"> <a href="index.php" class="home">Home</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <a href="member.php">Member</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>Shipping Addresses</span> </div>

      <!--end nav--> 

      

      <!--Model-->

      <div class="product_model post">

        <?php include('inc_account.php');?>

        <div class="box-member-right ">

          <div class="box-content">

            <h1><span>Shipping Addresses</span></h1>

            <div class="box-login" style="width:100%">
            <div class="box-message"> 

                <!-- <span class="fontSmall">No default  address available</span>--> 

                

                <a class="box-add-address" href="member_create_address.php"><i class="fa fa-plus" aria-hidden="true"></i> Add New Shipping Address </a> </div>

             <?php $i =0; ?>

			<?php foreach ($this->itemList as $val) { ?>     

            <?php $i++; ?>

            <!--address <?php echo $i?> -->

              <h2 class="txt-topic-address">Address <?php echo $i?> <div class="box-edit-address"><a href="member_create_address.php"><i class="fa fa-plus" aria-hidden="true"></i> Add</a> | <a href="member_edit_address.php?id=<?php echo $val['id']?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a> |  <a href="member_address_action.php?id=<?php echo $val['id']?>&do=delete"><i class="fa fa-times-circle" aria-hidden="true"></i> Remove</a></div></h2> 

              <div class="box-address">

              <ul class="form-all">

                <li>

                  <label><?php echo $val['name']?> <?php echo $val['surname']?> </label>

                </li>

                <li>

                  <label><?php echo $val['address1']?> </label>

                </li>
				<li>

                  <label><?php echo $val['country']?> </label>

                </li>
                <li>

                  <label><?php echo $val['postcode']?></label>

                </li>

              </ul>

              <h3>Contact Number</h3>

              <ul class="form-all">

                <li>

                  <label>Phone No. 1: <?php echo $val['phone1']?></label>

                </li>

                <li>

                  <label>Phone No. 2: <?php echo $val['phone2']?></label>

                </li>
                
                

              </ul>

              </div>

              <!--//address 1-->

              <?php } ?>

              
 <a href="<?php echo $this->url_next?>" class="btn-login">Continue</a> 
              

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

