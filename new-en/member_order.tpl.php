<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>Order History | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="Order History |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women">
<meta name="description" content=" Order History on website naree.co">

<?php include('inc_css.php');?>

</head>



<body onLoad="get_account(3);">

<?php include('inc_cart_left.php')?>

<div id="wrapper"> 

  <!--Header-->

  <div id="header"  >

    <?php include('inc_header_login.php');?>

  </div>

  <!--//header--> 

  

  <!--content-->

  <div id="Containner">

    <div class="content"> 

      <!--nav-->

      <div class="nav post"> <a href="index.php" class="home">Home</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <a href="member.php">Member</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>Order History</span> </div>

      <!--end nav--> 

      

       

      <!--Model-->

      <div class="product_model post">

         	  <?php include('inc_account.php');?>

        <div class="box-member-right ">

        	<div class="box-content" style="width:100%">

            	<h1><span>Order History</span></h1>

            	<ul class="box-order-tbl">

                 <!--table head order-->

                <li class="order-first">

                        <ul>

                          <li class="tdhead">  Order Numer  </li>

                           <li class="tdhead">Order    Date  </li>

                          <li class="tdhead"> Grand Total </li>

                        <li class="tdhead"> Delivery Status</li>

                         <li class="tdhead">  Payment Status </li>

                           <li class="tdhead">   Preview  </li>

                           <div class="clear"></div>

                           </ul>

                   </li>

                    <!--//table head order-->

                    <?php if($this->invoiceCount > 0){?>

				<?php $i =0; ?>

                <?php foreach ($this->invoiceOrder as $val) { ?>     

                <?php $i++; ?>                    

                   <!--list order-->

                    <li>

                    <ul>

                   <li><span class="txt-his">Order Numer : </span> 
<?php echo $val['invoice_id']?>  </li>
                   <li><span class="txt-his">Order Date : </span>
<?php echo ($val['order_date'] != null) ? date('d-m-Y H:i:s', strtotime($val['order_date'])) : '' ?> </li>
                   <li><span class="txt-his">Grand Total : </span>

				   <?php echo number_format($val['grand_total'],2)?> USD <BR>
                   <?php echo Lang::eXchangeRate('lak',$val['grand_total'])?> LAK 
                    </li>

                   <li><span class="txt-his"> Delivery Status : </span>

				   <?php if($val['decision'] == 'ACCEPT'){
						switch($val['status_delivery']){
						case'1' : echo 'Complete'; break;
						case'0' : echo 'wait'; break;
						}
					}else{ echo "Cancel"; }
					?> 
                   </li>

                   <li> <span class="txt-his">Payment Status : </span>

                     <?php echo ($val['status_payment'] == '1')? 'Complete' : 'Cancel'?> 
                   </li>

                   <li><a href="review_order_print.php?id=<?php echo $val['invoice_id']?>&member_id=<?php echo $val['member_id']?>&reference_number=<?php echo $val['req_reference_number']?>" target="_blank">Click <BR>Order Preview</a>  </li>

                   <div class="clear"></div>

                    </ul>

                    </li>

                   <!--//list order-->

                   <?php } ?>

                   <?php } ?>

                   

          	  </ul>

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

