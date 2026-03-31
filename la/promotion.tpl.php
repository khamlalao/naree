<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>ໂປຣໂມຊັ່ນ | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="Promotion |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women,promotion">
<meta name="description" content="promotion on website naree.co">

<?php include('inc_css.php');?>

</head>



<body onLoad="getMN(3);">

<?php include('inc_cart_left.php')?>

<div id="wrapper"> 

  <!--Header-->

  <div id="header"  >

    <!--Header-->

    <?php if(isset($_SESSION['member_id'])){ ?>

    <?php include('inc_header_login.php')?>

    <?php }else{?>

    <?php include('inc_header.php')?>

    <?php } ?>

    <!--End Header-->

  </div>

  <!--//header--> 

  

  <!--content-->

  <div id="Containner">

    <div class="content"> 

      <!--nav-->

      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a>   <img src="images/icon/i_av.png" width="20" height="12"  alt=""/>  <a href="promotion-all.php">ໂປຣໂມຊັ່ນ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/>  <span> ສິນຄ້າຫຼຸດລາຄາ</span>  </div>

      <!--end nav--> 

      

<?php include('inc_search_product.php');?>

      

      <!--Model-->
      <?php if($this->itemListCount > 0){ ?>

      <div class="product_model post">
       <!--page--> 

     <div id="page" style="width:100%; margin:0 0 10px 0">

   		<ul>

        	 <li><a href="promotion-all.php" class="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td><img src="images/icon/arrow_left.png"  alt=""/> </td>

    <td>&nbsp;</td>

    

    <td>

    	  	ກັບຄືນ</td>

  </tr>

</table>

</a></li>

            

      		  <div class="clear"></div>

            

	    </ul>

      </div>

        <div class="clear"></div>

      <!--//page--> 

        <ul class="model">

        <?php $i =0; ?>

        <?php foreach ($this->itemList as $val) { ?>     

        <?php $i++; ?>   

          <li class="post">

            <div class="box-model"> <a href="products_detail.php?id=<?php echo $val['id']?>"><img src="../img_product/<?php echo $val['image']?>" alt=""/></a>

              <h2> <a href="products_detail.php?id=<?php echo $val['id']?>"><?php echo $val['title_la']?></a></h2>

              <div class="txt-model-l">ລະຫັດສິນຄ້າ : &nbsp; </div>

              <div class="txt-model-r"><span class="numberEN"><?php echo $val['code']?></span></div>

              <div class="clear"></div>

              <div class="txt-model-l"> ລາຄາ :  &nbsp;</div>

 <?php if($val['discount'] != ''){?>
   <div class="txt-model-r  txt-model-price">
 <span  ><?php echo number_format($val['price'],2);?></span> ໂດລາ<br>
 <span class="special"><span class="numberEN"><?php echo number_format($val['discount'],2);?></span> ໂດລາ</span>

<span ><?php echo Lang::eXchangeRate('lak',$val['price'])?></span>  ກີບ<br>
<span class="special"><span class="numberEN"><?php echo Lang::eXchangeRate('lak',$val['discount'])?></span>  ກີບ</span></div>
  <?php }else{ ?>
  <div class="txt-model-r  txt-model-price"><span class="numberEN"><?php echo $val['price']?></span> ໂດລາ<br>
  <span class="numberEN"><?php echo Lang::eXchangeRate('lak',$val['price'])?></span> ກີບ</div>
 <?php } ?> 

               

                <div class="clear"></div>

            </div>

          </li>

          <?php if($i%4 == 0){?><div class="clear"></div><?php } ?>

        <?php } ?>

        <div class="clear"></div>

        </ul>

      </div>
      <?php }else{ ?>
      <div class="product_model" style="min-height:450px;">
      <div align="center" style="padding-top:200px;"> NO DATA </div>
      </div>
      <?php } ?>

      <!--Model--> 

      

        <!--page--> 

       <!--page--> 
        <?php if ($this->maxpage > 1){ ?>

      <div id="page">

   		<ul>
			<?php echo paginate_three($this->Pagereload, $this->page, $this->maxpage, '2');?>
             <div class="clear"></div>
	    </ul>

      </div>

      <?php } ?>

        <div class="clear"></div>

      <!--//page--> 

      

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

