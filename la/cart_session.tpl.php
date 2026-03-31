<!doctype html>

<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>ກວດຄືນ | NAREE : Blending traditional craftsmanship with modern style</title>
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
      
      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>ກວດຄືນ</span> </div>
      
      <!--end nav--> 
      
      <!--New-->
      
      <div class="product_model">
        <?php include('inc_cart_step.php');?>
        <div class="box-content post" >
          <h1 class="txt-topic-member ">ກວດຄືນ </h1>
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
                  <div > ລາຄາ:<br>
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
                    <span class="numberEN " style="color:#000">
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
                  <td align="right"><span><span class="numberEN">
                    <?php echo Lang::eXchangeRate('lak',$this->totalPay)?>
                    </span> ກີບ</span></td>
                </tr>
              </tbody>
            </table>
          </h3>
          <div class="clear"></div>
          <div style="width:100%;">
            <div class="clear"></div>
          </div>
          <div class="clear"></div>
          <a href="cart_shipping.php" class="btn-login">ຢືນຢັນ</a>
          <div class="box-login" style="width:100%;">
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
