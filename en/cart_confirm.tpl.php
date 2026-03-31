<!doctype html>

<html lang="en">

<head>

<meta http-equiv="content-type" charset="utf-8">

<title>Shpping Cart | NAREE : Blending traditional craftsmanship with modern style</title>

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



//      alert(' Please Select Shipping Method :');



//      return false;



//      }	



		var shipping_method_count = 0;



		$('[name^="shipping_method"]').each(function() {



		  if ($(this).is(':checked')) {



			shipping_method_count++;



		  }



		});



		if (shipping_method_count <= 0) {



		  alert(' Please Select Shipping Method :');



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

      

      <div class="nav post"> <a href="index.php" class="home">Home</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>Confirm</span> </div>

      

      <!--end nav--> 

      

      <!--New-->

      

      <div class="product_model">

        <?php include('inc_cart_step.php');?>

        <form name="form1" id="form1" action="" method="post" enctype="multipart/form-data">

          <div class="box-content post" id="cart-confirm" style="width:100%; ">

            <h1><span>SHIPPING & PAYMENT</span></h1>

            <div class="colum-pay" style="text-align:left">

              <h2 class="txt-topic-address post">Shipping Method</h2>

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

                          Take at Naree shop</label>

                      </li>

                    <li>

                        <label>

                          <input type="radio" name="shipping_method" id="shipping_method[]" value="2">

                          Delivery By Car</label>

                      </li>

                      <?php }else if($this->item->location_zone == '2'){ ?>

                    

                      <li>

                        <label>

                          <input type="radio" name="shipping_method" id="shipping_method[]" value="3">

                          Delivery By Bus</label>

                      </li>

                    

                      <li>

                        <label>

                          <input type="radio" name="shipping_method" id="shipping_method[]" value="4">

                          Delivery By Van</label>

                      </li>

                    <li>

                        <label>

                          <input type="radio" name="shipping_method" id="shipping_method[]" value="6">

                          Delivery By Plane</label>

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

              <h2 class="txt-topic-address post">Shipping Address

                <input type="hidden" name="shipping_address" id="shipping_address" value="<?php echo $this->id?>">

                <div class="box-edit-address"><a href="cart_shipping.php"><i class="fa fa-pencil" aria-hidden="true"></i> Edit </a> </div>

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

                  <li>

                    <label>

                      <?php echo $this->item->postcode?>

                    </label>

                  </li>

                </ul>

                <h3>Contact Number</h3>

                <ul class="form-all">

                  <li>

                    <label>Phone No. 1:

                      <?php echo $this->item->phone1?>

                    </label>

                  </li>

                  <li>

                    <label>Phone No. 2:

                      <?php echo $this->item->phone2?>

                    </label>

                  </li>

                </ul>

              </div>

              <div class="box-address  post " id="show-pc-800"  >

                <div   style="text-align:left; font-size:14px;">

                  <h2 class="txt-topic-address">Naree Handbags Online Order Policy</h2>

                  <ol>

          <li style="padding-bottom:10px">  Delivery

          

          <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tbody>

    <tr>

      <td width="2%" valign="top">1.1</td>

      <td width="98%"> Delivery of merchandise may take 3 – 40 days depend on delivery location. </td>

    </tr>

  </tbody>

</table>



          </li>

           <li style="padding-bottom:10px"> Cancellations

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tbody>

    <tr>

      <td width="2%" valign="top">2.1</td>

      <td> Customers may cancel an order within 72 hours (3 days) after submission of an order by sending an email to naree.laos@gmail.com 

               </td>

    </tr>

    <tr>

      <td valign="top">2.2</td>

      <td> Fees will not apply to cancellations made within 24 hours.</td>

    </tr>

    <tr>

      <td valign="top">2.3 </td>

      <td>A cancellation fee of 10% of purchase price will apply to cancellations made within 24 – 72 hours </td>

    </tr>

    <tr>

      <td valign="top">2.4</td>

      <td> The online payment system accepts only credit cards and debit cards from within the countries determined in the shipping list.</td>

    </tr>

  </tbody>

</table>



          </li>

          <li style="padding-bottom:10px">

          Responsibility Toward Goods

          <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tbody>

    <tr>

      <td width="2%" valign="top">3.1</td>

      <td>  In case merchandise are found to be faulty before or during delivery (from origin), Naree will issue a replacement. 

          </td>

    </tr>

    <tr>

      <td valign="top">3.2</td>

      <td> In case merchandise are damaged after delivery and have already been used, the customer must bear responsibility, and Naree cannot be held responsible.</td>

    </tr>

    <tr>

      <td valign="top">3.3</td>

      <td> Customers may inform Naree of damaged goods at naree.laos@gmail.com</td>

    </tr>

  </tbody>

</table>



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

              <h2 class="txt-topic-member post"  >Items in my shopping bag</h2>

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

                        </a> <span>

                        <?php echo Lang::getProductOrder($data['pid'],'code','en')?>

                        </span></h2>

                      <div class="cart-price-confirm "> PRICE:<br>

                        <?php echo ($data['discount'] != '') ? number_format($data['discount'],'2') : number_format($data['unit_price'],'2'); ?>

                        USD<br>

                        <?php echo ($data['discount'] != '') ? Lang::eXchangeRate('lak',$data['discount']) : Lang::eXchangeRate('lak',$data['unit_price']) ?>

                        LAK </div>

                    </div>

                    

                    <!--//name--> 

                    

                    <!--Price-->

                    

                    <div class="cart-price" style="width:25%; text-align:center">

                      <h3 class="txt-price">QTY:

                        <?php echo $data['amount']?>

                        Item</h3>

                    </div>

                    

                    <!--//Price--> 

                    

                    <!--Price-->

                    

                    <div class="cart-price" style="width:25%">

                      <h3 class="txt-price"> Total: <BR>

                        <?php echo number_format($data['total'],2) ?>

                        USD<br>

                        <?php echo Lang::eXchangeRate('lak',$data['total'])?>

                        LAK </h3>

                    </div>

                    

                    <!--//Price-->

                    

                    <div class="clear"></div>

                  </li>

                  <?php } ?>

                </ul>

              </div>

              <div  id="cash_order">

                <div class="box-summary">

                  <h2 class="txt-topic-member">Order Summary </h2>

                  <ul>

                    <li>Total <span>

                      <?php echo number_format($this->totalPay,2)?>

                      USD<BR>

                      <?php echo Lang::eXchangeRate('lak',$this->totalPay)?>

                      LAK</span>

                      <div class="clear"></div>

                    </li>

                    <li>Shipping <span> 00.00</span>

                      <div class="clear"></div>

                    </li>

                    <li>Grand Total <span>

                      <?php $gettmp['grand_total']=$this->totalPay+$delivery_fees;?>

                      <?php echo number_format($gettmp['grand_total'],'2')?>

                      USD<BR>

                      <?php echo Lang::eXchangeRate('lak',$this->totalPay+$delivery_fee)?>

                      LAK</span>

                      <div class="clear"></div>

                    </li>

                  </ul>

                  <input type="hidden" name="delivery_fee" id="delivery_fee" value="<?php echo Lang::DeliveryFee($this->zone,$gettmp['weight_total'])?>">

                  <input type="hidden" name="sub_total" id="sub_total" value="<?php echo $this->totalPay?>">

                  <input type="hidden" name="grand_total" id="grand_total" value="<?php echo $this->totalPay+Lang::DeliveryFee($this->zone,$gettmp['weight_total'])?>">

                  <input name="submit" type="submit" class="btn-login" id="submit" value="Confirm Order" onclick="return checkForm();">

                  <a href="products.php" class="btn-login">Add more products</a> </div>

              </div>

            </div>

            <div class="clear"></div>

            <div class="box-address  post " id="show-mobile-800"  >

              <div   style="text-align:left; font-size:14px;">

                <h2 class="txt-topic-address">Naree Payment Policy</h2>

                <ol>

                  <li> Cancellation of any purchase can be done with 24 hours after payment, by sending email to naree.laos@gmail.com</li>

                  <li> In case of cancellation, 10% penalty fee of total purchase will be charged directly to buyer</li>

                  <li> This policy applies to all Naree products</li>

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

