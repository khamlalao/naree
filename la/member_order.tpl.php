<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>ປະຫວັດການສັ່ງຊື້ | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="ປະຫວັດການສັ່ງຊື້ |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women">
<meta name="description" content=" ປະຫວັດການສັ່ງຊື້ on website naree.co">

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

      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <a href="member.php">ລູກຄ້າ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>ປະຫວັດການສັ່ງຊື້</span> </div>

      <!--end nav--> 

      

       

      <!--Model-->

      <div class="product_model post">

         	  <?php include('inc_account.php');?>

        <div class="box-member-right ">

        	<div class="box-content" style="width:100%">

            	<h1><span>ປະຫວັດການສັ່ງຊື້</span></h1>

            	<ul class="box-order-tbl">

                 <!--table head order-->

                <li class="order-first">

                        <ul>

                          <li class="tdhead">  ເລກທີສັ່ງຊື້  </li>

                           <li class="tdhead">ວັນທີສັ່ງຊື້  </li>

                          <li class="tdhead"> ຍອດລວມ </li>

                        <li class="tdhead"> ສະຖານະການສົ່ງສິນຄ້າ</li>

                         <li class="tdhead">  ສະຖານະການຈ່າຍເງິນ </li>

                           <li class="tdhead">   ເບິ່ງໃບສັ່ງຊື້  </li>

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

                   <li><span class="txt-his">ເລກທີສັ່ງຊື້ </span><span class="numberEN"><?php echo $val['invoice_id']?></span> </li>
                   <li><span class="txt-his">ວັນທີສັ່ງຊື້  </span> <span class="numberEN"><?php echo ($val['order_date'] != null) ? date('d-m-Y H:i:s', strtotime($val['order_date'])) : '' ?></span>  </li>
                   <li><span class="txt-his">ຍອດລວມ</span>
				  <span class="numberEN"> <?php echo number_format($val['grand_total'],2)?></span> ໂດລາ <BR>
                  <span class="numberEN"> <?php echo Lang::eXchangeRate('lak',$val['grand_total'])?></span> ກີບ 
                    </li>

                   <li><span class="txt-his"> ສະຖານະການສົ່ງສິນຄ້າ</span>
				   <?php if($val['decision'] == 'ACCEPT'){
						switch($val['status_delivery']){
						case'1' : echo 'ສຳເລັດ'; break;
						case'0' : echo 'ລໍຖ້າ'; break;
						}
					}else{ echo "ຍົກເລີກ"; }
					?> 
                   </li>

                   <li><span class="txt-his"> ສະຖານະການຈ່າຍເງິນ</span>
                     <?php echo ($val['status_payment'] == '1')? 'ສຳເລັດ' : 'ຍົກເລີກ'?> 
                   </li>

                   <li><a href="review_order_print.php?id=<?php echo $val['invoice_id']?>&member_id=<?php echo $val['member_id']?>&reference_number=<?php echo $val['req_reference_number']?>" target="_blank"> ຄລິກ<br>
ເບິ່ງໃບສັ່ງຊື້</a>  </li>

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

