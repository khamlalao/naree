<!doctype html>



<html lang="en">

<head>

<meta http-equiv="content-type" charset="utf-8">

<title>ຢືນຢັນສັ່ງຊື້ | NAREE : Blending traditional craftsmanship with modern style</title>

<meta name="title" content="Shpping Cart |  NAREE : Blending traditional craftsmanship with modern style">

<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women">

<meta name="description" content="Shpping Cart on website naree.co">

<?php include('inc_css.php');?>

<script type="text/javascript">















function delItem(id){















	//alert(id);















				$.get('inc_order_list.php', {







				id : id,







				action : 'remove',







				time : new Date().getTime()















				}, function(data) {















				  $('#ordet_list').html(data);







				 // alert(data);







			  });	















			  $.get('inc_order_cash.php', {







				id : id,







				time : new Date().getTime()















				}, function(data) {















				  $('#cash_order').html(data);







				 // alert(data);







			  });	















}















jQuery(document).ready(function($) {







	var id = $("[name^='shipping_method']:checked").val();







	//alert(id);







	if(id == 5){







	$.get('inc_cash_order.php', {



		id : <?php echo $_GET['id']?>,



		type : id,



		time : new Date().getTime()



		}, function(data) {



		// alert(data);



		 $('#cash_order').html(data);



		});







	 }// End IF







$('[name^="shipping_method"]').click(function() {







    if ($('[name^="shipping_method"]').is(':checked')) {







		//alert("OK");







		var id = $("[name^='shipping_method']:checked").val();







		//alert(id);







		







		//if(id == 1){







			$.get('inc_cash_order.php', {







					id : <?php echo $_GET['id']?>,







					type : id,







					time : new Date().getTime()







	







					}, function(data) {







					 // alert(data);







					  $('#cash_order').html(data);







				  });







		//}







	}







	







});















			  







});  







</script>

<script language="javascript" type="text/javascript">







function checkForm(){















  with(document.form1){







	//  alert("ok");







	 // return false;















    // Check















//	  if(document.getElementById('shipping_method').checked == false){







//      alert(' ກະລຸນາເລືອກວິທີສົ່ງສິນຄ້າ :');







//      return false;







//      }	







		var shipping_method_count = 0;







		$('[name^="shipping_method"]').each(function() {







		  if ($(this).is(':checked')) {







			shipping_method_count++;







		  }







		});







		if (shipping_method_count <= 0) {







		  alert(' ກະລຸນາເລືອກວິທີສົ່ງສິນຄ້າ :');







		//  alert(shipping_method_count);







		//  document.getElementById('shipping_method').focus();







		  return false;







		}else{







		  







         SetAction('cart_confirm_payment.php');







		}







		







		







    //return true;















  }















}































function SetAction(url) {







	//alert(url);







	document.getElementById('form1').action = url;







	document.getElementById('form1').target = '_self';







	document.getElementById('form1').submit();







	







	







}















</script>

</head>



<body onLoad="get_step(2);">

<?php //include('inc_cart_left.php')?>

<div id="wrapper"> 

  

  <!--Header-->

  

  <div id="header"  >

    <?php include('inc_header_cart.php')?>

  </div>

  

  <!--//header--> 

  

  <!--content-->

  

  <div id="Containner">

    <div class="content"> 

      

      <!--nav-->

      

      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span> ຢືນຢັນສັ່ງຊື້</span> </div>

      

      <!--end nav--> 

      

      <!--New-->

      

      <div class="product_model">

        <?php include('inc_cart_step.php');?>

        <form name="form1" id="form1" action="" method="post" enctype="multipart/form-data">

          <div class="box-content post"  id="cart-confirm"  style="width:100%; ">

            <h1><span> ທີ່ຢູ່ ແລະ ການຈ່າຍເງິນ</span></h1>

            <div class="colum-pay" style="text-align:left">

              <h2 class="txt-topic-address post">ວິທີສົ່ງເຄື່ອງ</h2>

              <ul class="form-all post">

                <li>

                  <table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <?php if(($this->item->location_zone == '1')||($this->item->location_zone == '2')){?>

                    <tr>

                      <td>&nbsp;</td>

                    </tr>

                    <tr>

                      <?php if($this->item->location_zone == '1'){ ?>

                    

                      <li>

                        <label>

                          <input type="radio" name="shipping_method" id="shipping_method[]" value="1">

                          ມາຮັບທີ່ຮ້ານນາຣີ</label>

                      </li>

                    <li>

                        <label>

                          <input type="radio" name="shipping_method" id="shipping_method[]" value="2">

                          ຈັດສົ່ງໂດຍທາງລົດ</label>

                      </li>

                      <?php }else if($this->item->location_zone == '2'){ ?>

                    

                      <li>

                        <label>

                          <input type="radio" name="shipping_method" id="shipping_method[]" value="3">

                          ຈັດສົ່ງໂດຍທາງລົດເມ</label>

                      </li>

                    

                      <li>

                        <label>

                          <input type="radio" name="shipping_method" id="shipping_method[]" value="4">

                          ຈັດສົ່ງໂດຍທາງລົດຕູ້</label>

                      </li>

                    <li>

                        <label>

                          <input type="radio" name="shipping_method" id="shipping_method[]" value="6">

                          ຈັດສົ່ງໂດຍທາງຍົນ</label>

                      </li>

                      <?php } ?>

                        </td>

                    </tr>

                    <tr>

                      <td>&nbsp;</td>

                    </tr>

                    <?php }else{?>

                    <tr>

                      <td><input type="radio" name="shipping_method" id="shipping_method[]" value="5" checked>

                        EMS</td>

                    </tr>

                    <?php } ?>

                  </table>

                </li>

              </ul>

              <h2 class="txt-topic-address post">ທີ່ຢູ່ສົ່ງສິນຄ້າ

                <input type="hidden" name="shipping_address" id="shipping_address" value="<?php echo $this->id?>">

                <div class="box-edit-address"><a href="cart_shipping.php"><i class="fa fa-pencil" aria-hidden="true"></i> ແກ້ໄຂ </a> </div>

              </h2>

              <div class="box-address post">

                <ul class="form-all">

                  <li>

                    <label>

                      <?php echo $this->item->name?>

                      <?php echo $this->item->surname?>

                    </label>

                  </li>

                  <li>

                    <label>

                      <?php echo $this->item->address1?>

                    </label>

                  </li>

                  <li>

                    <label>

                      <?php echo $this->item->country?>

                    </label>

                  </li>

                  <li><span class="numberEN">

                    <label>

                      <?php echo $this->item->postcode?>

                    </label>

                    </span></li>

                </ul>

                <h3>ເບີໂທຕິດຕໍ່</h3>

                <ul class="form-all">

                  <li>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                      <tbody>

                        <tr>

                          <td width="12%"> ເບີໂທ </td>

                          <td width="88%" class="numberEN"> 1 :

                            <?php echo $this->item->phone1?></td>

                        </tr>

                      </tbody>

                    </table>

                  </li>

                  <li>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                      <tbody>

                        <tr>

                          <td width="12%"> ເບີໂທ </td>

                          <td width="88%" class="numberEN"> 2 :

                            <?php echo $this->item->phone2?></td>

                        </tr>

                      </tbody>

                    </table>

                  </li>

                </ul>

              </div>

              <div class="box-address  post " id="show-pc-800"  >

                <div   style="text-align:left; font-size:14px;">

                  <h2 class="txt-topic-address">ນະໂຍບາຍການສັ່ງຊື້ສິນຄ້າຜ່ານເວບໄຊ໌ຂອງຮ້ານ ນາຣີ ກະເປົາລາວປະຍຸກ</h2>

                 <ol>

          <li style="padding-bottom:10px;"> ການຂົນສົ່ງ:

             <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tbody>

    <tr>

      <td width="2%" valign="top">1.1</td>

      <td width="97%"> ການຂົນສົ່ງສິນຄ້າຈະນໍາໃຊ້ເວລາ 3 - 40 ວັນ ອີງຕາມແຕ່ລະຂົງເຂດ.</td>

    </tr>

  </tbody>

</table>



          </li>

          <li style="padding-bottom:10px;">  ການລົບລ້າງສິນຄ້າ:

             <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tbody>

    <tr>

      <td width="2%" valign="top">2.1</td>

      <td> ຫຼັງຈາກສັ່ງຊື້ສິນຄ້າແລ້ວ, ລູກຄ້າມີສິດລົບລ້າງການສັ່ງຊື້ພາຍໃນເວລາ 72 ຊົ່ວໂມງ      ( 3 ວັນ ) ຫຼັງຈາກກົດປຸ່ມສັ່ງຈ່າຍ ໂດຍການສົ່ງຂໍ້ຄວາມການລົບລ້າງຫາທີມງານນາຣີ Email: <a href="mailto:naree.laos@gmail.com">naree.laos@gmail.com</a>  </td>

    </tr>

    <tr>

      <td valign="top">2.2</td>

      <td> ກໍລະນີທີ່ມີການລົບລ້າງການສັ່ງຊື້ສິນຄ້າເກີດຂຶ້ນພາຍໃນເວລາ 24 ຊົ່ວໂມງ, ຈະບໍ່ມີການເກັບຄ່າທໍານຽມ.</td>

    </tr>

    <tr>

      <td valign="top">2.3</td>

      <td> ກໍລະນີທີ່ມີການລົບລ້າງການສັ່ງຊື້ສິນຄ້າເກີດຂຶ້ນພາຍໃນເວລາ 24 - 72 ຊົ່ວໂມງ ຜູ້ສັ່ງຊື້ຈະຖືກປັບໄໝເປັນມູນຄ່າ 10% ຈາກລາຄາໃນໃບບິນ.</td>

    </tr>

    <tr>

      <td valign="top">2.4 </td>

      <td> ລະບົບການສັ່ງຊື້ຈະສາມາດຮັບໄດ້ສະເພາະບັດເຄຣດິດ ແລະ ບັດເດບິດ ຂອງບັນດາ ປະເທດທີ່ຖືກກໍານົດໃນລາຍການ Shipping ທີ່ທາງຮ້ານກໍານົດໄວ້ເທົ່ານັ້ນ.</td>

    </tr>

  </tbody>

</table></li>



          <li style="padding-bottom:10px;"> ຄວາມຮັບຜິດຊອບຕໍ່ສິນຄ້າ:

             <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tbody>

    <tr>

      <td width="2%" valign="top">3.1</td>

      <td>  ກໍລະນີທີ່ສິນຄ້າເກີດເສຍຫາຍກ່ອນ ຫຼື ໃນລະຫວ່າງການຂົນສົ່ງ (ຕົ້ນທາງ) ທາງເຮົາຈະຮັບຜິດຊອບທົດແທນສິນຄ້າຄືນໃຫ້.  </td>

    </tr>

    <tr>

      <td valign="top">3.2</td>

      <td> ກໍລະນີທີ່ສິນຄ້າເກີດເສຍຫາຍຫຼັງຈາກທີ່ລູກຄ້າໄດ້ຮັບສິນຄ້າ ແລະ ຖືກນໍາໃຊ້ແລ້ວ, ແມ່ນຈະເປັນຄວາມຮັບຜິດຊອບຂອງທາງລູກຄ້າເອງ, ທາງຮ້ານຈະບໍ່ຮັບຜິດຊອບໃດໆທັງໝົດ.</td>

    </tr>

    <tr>

      <td valign="top">3.3</td>

      <td> ກໍລະນີທີ່ມີການເສຍຫາຍຂອງສິນຄ້າເກີດຂຶ້ນ, ລູກຄ້າສາມາດສົ່ງຂໍ້ມູນ ແລະ ລາຍລະອຽດເພື່ອປຶກສາກັບທີມງານທີ່ Email: <a href="mailto:naree.laos@gmail.com">naree.laos@gmail.com</a>.</td>

    </tr>

  </tbody>

</table>



          </li>

          </li>

        </ol>

                </div>

              </div>

              

              <!-- <h2 class="txt-topic-member post">Payment Method















                <div class="box-edit-address"><a href="cart_payment.php"><i class="fa fa-pencil" aria-hidden="true"></i> Edit </a> </div>















            </h2>















              <ul class="form-all post">















            <li>















              <label>















                <input type="radio" checked="checked">















                Credit card Visa, Mastercard, etc... </label>















            </li>















                  















     </ul>--> 

              

            </div>

            <div class="colum-pay post">

              <h2 class="txt-topic-member post" style="text-align:right">ລາຍການສິນຄ້າໃນກະຕ່າ</h2>

              <div id="ordet_list">

                <ul class="cart post"  id="confirm-cart">

                  <?php $i = 0; $gettmp['weight_total'] = 0; ?>

                  <?php foreach ($this->itemOrder as $data) { ?>

                  <?php 







		   $gettmp['weight'] = Lang::getProductOrder($data['pid'],'weight','en'); 







		   $gettmp['weight'] = $gettmp['weight']*$data['amount'];







           $gettmp['weight_total'] = $gettmp['weight_total']+$gettmp['weight']; 







		 ?>

                  <?php $i++; ?>

                  <li> 

                    

                    <!--Remove--> 

                    

                    <!--<div class="delete-item"><a href="#nogo" title="Remove" onclick="return delItem(<?php echo $data['id']?>);" ><i class="fa fa-times-circle" aria-hidden="true"></i></a></div> --> 

                    

                    <!--//Remove--> 

                    

                    <!--Img-->

                    

                    <div class="cart-img"  style="padding-top:20px;"> <a href="products_detail.php?id=<?php echo $data['pid']?>"><img src="../img_product/<?php echo Lang::getProductOrder($data['pid'],'image','en')?>" alt=""/></a> </div>

                    

                    <!--//Img--> 

                    

                    <!--/Name-->

                    

                    <div class="cart-name" style="width:30%">

                      <h2 class="txt-mdel"><a href="products_detail.php?id=<?php echo $data['pid']?>">

                        <?php echo Lang::getProductOrder($data['pid'],'title_la','en')?>

                        </a> <span class="numberEN">

                        <?php echo Lang::getProductOrder($data['pid'],'code','en')?>

                        </span></h2>

                      <div class="cart-price-confirm "> ລາຄາ:<br>

                        <span class="numberEN">

                        <?php echo ($data['discount'] != '') ? $data['discount'] : $data['unit_price'] ?>

                        </span> ໂດລາ<br>

                        <span class="numberEN">

                        <?php echo ($data['discount'] != '') ? Lang::eXchangeRate('lak',$data['discount']) : Lang::eXchangeRate('lak',$data['unit_price']) ?>

                        </span> ກີບ </div>

                    </div>

                    

                    <!--//name--> 

                    

                    <!--Price-->

                    

                    <div class="cart-price" style="width:25%; text-align:center">

                      <h3 class="txt-price">ຈ/ນ: <span class="numberEN" style="color:#000">

                        <?php echo $data['amount']?>

                        </span> ໜ່ວຍ</h3>

                    </div>

                    

                    <!--//Price--> 

                    

                    <!--Price-->

                    

                    <div class="cart-price" style="width:25%">

                      <h3 class="txt-price"> ຍອດລວມ: <BR>

                        <span class="numberEN" style="color:#000">

                        <?php echo number_format($data['total'],2) ?>

                        </span> ໂດລາ<br>

                        <span class="numberEN" style="color:#000">

                        <?php echo Lang::eXchangeRate('lak',$data['total'])?>

                        </span> ກີບ </h3>

                    </div>

                    

                    <!--//Price-->

                    

                    <div class="clear"></div>

                  </li>

                  <?php } ?>

                </ul>

              </div>

              <div  id="cash_order">

                <div class="box-summary">

                  <h2 class="txt-topic-member">ສະຫຼຸບລາຍການສັ່ງຊື້</h2>

                  <ul>

                    <li>ຍອດລວມ

                      <div><span class="numberEN">

                        <?php echo number_format($this->totalPay,2)?>

                        </span> ໂດລາ<BR>

                        <span class="numberEN">

                        <?php echo Lang::eXchangeRate('lak',$this->totalPay)?>

                        </span> ກີບ</div>

                      <div class="clear"></div>

                    </li>

                    <li>ການສົ່ງສິນຄ້າ

                      <div><span class="numberEN"> 00.00</span></div>

                      <div class="clear"></div>

                    </li>

                    <li>ຍອດລວມທັງໝົດ

                      <div><span class="numberEN">

                        <?php echo number_format($this->totalPay+$delivery_fee)?>

                        </span> ໂດລາ<BR>

                        <span class="numberEN">

                        <?php echo Lang::eXchangeRate('lak',$this->totalPay+$delivery_fee)?>

                        </span> ກີບ</div>

                      <div class="clear"></div>

                    </li>

                  </ul>

                  <input type="hidden" name="delivery_fee" id="delivery_fee" value="<?php echo Lang::DeliveryFee($this->zone,$gettmp['weight_total'])?>">

                  <input type="hidden" name="sub_total" id="sub_total" value="<?php echo $this->totalPay?>">

                  <input type="hidden" name="grand_total" id="grand_total" value="<?php echo $this->totalPay+Lang::DeliveryFee($this->zone,$gettmp['weight_total'])?>">

                  <input name="submit" type="submit" class="btn-login" id="submit" value="ຢືນຢັນສັ່ງຊື້" onclick="return checkForm();">

                  <a href="products.php" class="btn-login">ເລືອກສິນຄ້າເພີ່ມ</a> </div>

              </div>

            </div>

            <div class="clear"></div>

            <div class="box-address  post " id="show-mobile-800"  >

              <div   style="text-align:left; font-size:14px;">

                <h2 class="txt-topic-address">ນະໂຍບາຍການສັ່ງຊື້ສິນຄ້າຜ່ານເວບໄຊ໌ຂອງຮ້ານ ນາຣີ ກະເປົາລາວປະຍຸກ</h2>

                <ol>

                  <li> ຫຼັງຈາກສັ່ງຊື້ສິນຄ້າແລ້ວ ລູກຄ້າມີສິດລົບລ້າງການສັ່ງຊື້ພາຍໃນເວລາ 24 ຊົ່ວໂມງ ຫຼັງຈາກກົດປຸ່ມສັ່ງຈ່າຍ, ໂດຍການສົ່ງຂໍ້ຄວາມການຂໍລົບລ້າງຫາ email: naree.laos@gmail.com</li>

                  <li> ໃນກໍລະນີມີການລົບລ້າງການສັ່ງຊື້ເກີດຂຶ້ນ, ຜູ້ສັ່ງຊື້ຈະຖືກປັບໄໝເປັນມູນຄ່າ 10% ຂອງມູນຄ່າສິນຄ້າ ຫຼື ໃບບິນທີ່ຖືກລົບລ້າງ</li>

                  <li> ນະໂຍບາຍດັ່ງກ່າວມີຜົນນຳໃຊ້ກັບສິນຄ້າທຸກປະເພດຂອງ ນາຣີ</li>

                  </li>

                </ol>

              </div>

            </div>

          </div>

        </form>

        

        <!--Model-->

        

        <div class="clear"></div>

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

</body>

</html>

