<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>Products  | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="Products  | NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women">
<meta name="description" content="Products on website naree.co">

<?php include('inc_css.php');?>

</head>



<body onLoad="getMN(2);">

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

      <div class="nav post"> <a href="index.php" class="home">Home</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <a href="products.php">Products</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span><?php echo (($this->category->title_en != NULL)? $this->category->title_en : 'ALL COLLECTIONS');?></span> </div>

      <!--end nav--> 

      

<?php include('inc_search_product.php');?>

                 

      <!--Model-->
      <?php if($this->itemListCount > 0){ ?>

      <div class="product_model">

        <ul class="model">

        <?php $i =0; ?>

        <?php foreach ($this->itemList as $val) { ?>     

        <?php $i++; ?>   

          <li class="post">

            <div class="box-model"> <a href="products_detail.php?id=<?php echo $val['id']?>"><img src="../img_product/<?php echo $val['image']?>" alt=""/></a>

              <h2> <a href="products_detail.php?id=<?php echo $val['id']?>"><?php echo $val['title_en']?></a></h2>

              <div class="txt-model-l"> Product code :   &nbsp; </div>

              <div class="txt-model-r"> <?php echo $val['code']?> </div>

              <div class="clear"></div>

              <div class="txt-model-l"> Price :  &nbsp;</div>

 <?php if($val['discount'] != ''){?>

 <div class="txt-model-r  txt-model-price">
 <span><?php echo number_format($val['price'],2);?> USD</span><br>
 <span class="special"><?php echo number_format($val['discount'],2);?> USD</span>

<span><?php echo Lang::eXchangeRate('lak',$val['price'])?>  LAK</span><br>
<span class="special"><?php echo Lang::eXchangeRate('lak',$val['discount'])?>  LAK</span>
</div>
<?php }else{ ?>

 <div class="txt-model-r  txt-model-price"><?php echo number_format($val['price'],2);?> USD<br>
<?php echo Lang::eXchangeRate('lak',$val['price'])?>  LAK</div>
 
 
 

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

