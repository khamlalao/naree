<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>NAREE</title>

<?php include('inc_css.php');?>

</head>



<body onLoad="get_step(2);">

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

      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>Shipping</span> </div>

      <!--end nav--> 

      

      <!--New-->

      <div class="product_model">

        <?php include('inc_cart_step.php');?>

        <div class="box-content ">

          <h1><span>Choose Your Shipping Method</span></h1>

          <div class="box-login" >

            <ul class="form-all">

              <!--<li>

                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td><label>

                        <input type="radio" name="radio1" id="radio1" value="radio1"> 

                        รับสินค้าด้วยตัวเอง

                    </label></td>

                    <td align="right">&nbsp;</td>

                  </tr>

                </table>

              </li> -->

              <li>

                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td><label>

                      <input type="radio" name="radio1" id="radio2" value="radio1" checked>

                      EMS</label></td>

                    <td align="right">&nbsp;</td>

                  </tr>

                </table>

              </li>

              <!--<li>

                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td><label>

                      <input type="radio" name="radio1" id="radio3" value="radio1">

                      EMS</label></td>

                    <td align="right">&nbsp;</td>

                  </tr>

                </table>

              </li> -->

              <li> <a href="cart_confirm.php?id=<?php echo $this->id?>" class="btn-login">Continue</a> </li>

              <li> <a href="cart_shipping.php" class="btn-back">Back</a> </li>

            </ul>

            <div class="clear"></div>

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

