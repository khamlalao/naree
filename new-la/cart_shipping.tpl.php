<!doctype html>

<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>ການສົ່ງສິນຄ້າ | NAREE : Blending traditional craftsmanship with modern style</title>
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

</script>
<script language="javascript" type="text/javascript">

function checkForm(val) {  

  with(document.form1) {

	  

//jQuery(document).ready(function($) {



	var addressID = $("[name^='address_id']:checked").val();	  

	//alert(addressID);

	// Check	      

	

	

		var shipping_method_count = 0;



		$('[name^="address_id"]').each(function() {

		  if ($(this).is(':checked')) {

			shipping_method_count++;

		  }

		});

		if (shipping_method_count <= 0) {

        alert("ກະລຸນາເລືອກທີ່ຢູ່ສົ່ງສິນຄ້າ");     

		  return false;



		}else{

        SetAction('cart_confirm.php?id='+addressID);   

		}	

        

//});	                



  }

}



function SetAction(url) {

//	alert(url);

  document.getElementById('form1').action = url;

  document.getElementById('form1').target = '_self';

  document.getElementById('form1').submit();

}

</script>
</head>

<body onLoad="get_step(1);">
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
      
      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>ການສົ່ງສິນຄ້າ</span> </div>
      
      <!--end nav--> 
      
      <!--New-->
      
      <div class="product_model">
        <?php include('inc_cart_step.php');?>
        <div class="box-content post">
          <h1 class="txt-topic-member">ຢືນຢັນສັ່ງຊື້</h1>
          <BR>
          <BR>
          <h1><span>ລາຍການສິນຄ້າໃນກະຕ່າ</h1>
          <div id="ordet_list">
            <ul class="cart post">
              <?php $i =0; ?>
              <?php foreach ($this->itemOrder as $data) { ?>
              <?php $i++; ?>
              <li> 
                
                <!--Remove--> 
                
                <!--<div class="delete-item"><a href="#nogo" title="Remove" onclick="return delItem(<?php echo $data['id']?>);" ><i class="fa fa-times-circle" aria-hidden="true"></i></a></div> --> 
                
                <!--//Remove--> 
                
                <!--Img-->
                
                <div class="cart-img"  style="padding-top:20px;"> <a href="products_detail.php?id=<?php echo $data['pid']?>"><img src="../img_product/<?php echo Lang::getProductOrder($data['pid'],'image','en')?>" alt=""/></a> </div>
                
                <!--//Img--> 
                
                <!--/Name-->
                
                <div class="cart-name">
                  <h2 class="txt-mdel"><a href="products_detail.php?id=<?php echo $data['pid']?>">
                    <?php echo Lang::getProductOrder($data['pid'],'title_la','en')?>
                    </a> <span class="numberEN">
                    <?php echo Lang::getProductOrder($data['pid'],'code','en')?>
                    </span></h2>
                </div>
                
                <!--//name--> 
                
                <!--Price-->
                
                <div class="cart-price">
                  <div >ລາຄາ:<br>
                    <span class="numberEN">
                    <?php echo ($data['discount'] != '') ? number_format($data['discount'],'2') : number_format($data['unit_price'],'2') ?>
                    </span> ໂດລາ<BR>
                    <span class="numberEN">
                    <?php echo ($data['discount'] != '') ? Lang::eXchangeRate('lak',$data['discount']) : Lang::eXchangeRate('lak',$data['unit_price']) ?>
                    </span> ກີບ</div>
                </div>
                
                <!--//Price--> 
                
                <!--Price-->
                
                <div class="cart-price">
                  <h3 class="txt-price" style="padding:0; margin:0">ຈ/ນ: <span class="numberEN" style="color:#000">
                    <?php echo $data['amount']?>
                    </span> ໜ່ວຍ</h3>
                </div>
                
                <!--//Price--> 
                
                <!--Total-->
                
                <div class="cart-price">
                  <h3 class="txt-price">ຍອດລວມ: <BR>
                    <span class="numberEN" style="color:#000">
                    <?php echo number_format($data['total'],2) ?>
                    </span> ໂດລາ<br>
                    <span class="numberEN" style="color:#000">
                    <?php echo Lang::eXchangeRate('lak',$data['total'])?>
                    </span> ກີບ </h3>
                </div>
                
                <!--//Total-->
                
                <div class="clear"></div>
              </li>
              <?php } ?>
            </ul>
          </div>
          <h3 align="right" id="cash_order" style="padding-right:20px">
            <table border="0" align="right" cellpadding="3" cellspacing="0">
              <tbody>
                <tr>
                  <td>ຍອດລວມ:</td>
                  <td align="right"><span ><span class="numberEN">
                    <?php echo number_format($this->totalPay,2)?>
                    </span> ໂດລາ</span></td>
                </tr>
                <tr>
                  <td></td>
                  <td align="right"><span> <span class="numberEN">
                    <?php echo Lang::eXchangeRate('lak',$this->totalPay)?>
                    </span> ກີບ</span></td>
                </tr>
              </tbody>
            </table>
          </h3>
          <div class="clear"></div>
          <p>&nbsp;</p>
          <h1><span>ເລືອກທີ່ຢູ່ສົ່ງສິນຄ້າ</span></h1>
          <form method="post" enctype="multipart/form-data" name="form1" id="form1" action="">
            <div class="box-login" style="width:100%;">
              <?php $i =0; ?>
              <?php foreach ($this->itemList as $val) { ?>
              <?php $i++; ?>
              <div class="colum-pay"> 
                
                <!--address 1-->
                
                <h2 class="txt-topic-address">ທີ່ຢູ່ <span class="numberEN">
                  <?php echo $i?>
                  </span>
                  <div class="box-edit-address"><a href="member_create_address.php"><i class="fa fa-plus" aria-hidden="true"></i> ເພີ່ມ </a> | <a href="member_edit_address.php?id=<?php echo $val['id']?>"><i class="fa fa-pencil" aria-hidden="true"></i> ແກ້ໄຂ</a> | <a href="member_address_action.php?id=<?php echo $val['id']?>&do=delete"><i class="fa fa-times-circle" aria-hidden="true"></i> ລຶບອອກ</a></div>
                </h2>
                <div class="box-address">
                  <ul class="form-all">
                    <li>
                      <label>
                        <?php echo $val['name']?>
                        <?php echo $val['surname']?>
                      </label>
                    </li>
                    <li>
                      <label>
                        <?php echo $val['address1']?>
                      </label>
                    </li>
                    <li>
                      <label>
                        <?php echo $val['country']?>
                      </label>
                    </li>
                    <li><span class="numberEN">
                      <label>
                        <?php echo $val['postcode']?>
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
                              <?php echo $val['phone1']?></td>
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
                              <?php echo $val['phone2']?></td>
                          </tr>
                        </tbody>
                      </table>
                    </li>
                    <li>
                    <li style="margin-top:20px;" class="btn-select">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><label>
                              <input type="radio" name="address_id[]" id="address_id" value="<?php echo  $val['id'] ?>" />
                              ເລືອກທີ່ຢູ່ນີ້</label></td>
                          <td align="right">&nbsp;</td>
                        </tr>
                      </table>
                    </li>
                    
                    <!--  <a href="cart_confirm.php?id=<?php echo $val['id']?>" class="btn-login">Ship to this address</a>-->
                    
                    </li>
                  </ul>
                </div>
                
                <!--//address 1--> 
                
              </div>
              <?php } ?>
              <div class="clear"></div>
              <a href="javascript:void(0);" class="btn-login" style=" width:30%; margin:0 auto" onClick="return checkForm('update');">ຕົກລົງ</a> </div>
          </form>
          <?php // if($this->itemListCount == 0){?>
          <div class="box-shipping-pad"> <a class="box-add-address" href="member_create_address.php"><i class="fa fa-plus" aria-hidden="true"></i>ເພີ່ມທີ່ຢູ່ສົ່ງເຄື່ອງ </a></div>
          <?php // } ?>
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
