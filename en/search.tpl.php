<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>Search Products | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="Search Products |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women,Register">
<meta name="description" content="search products on website naree.co">


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

      <div class="nav post"> <a href="index.php" class="home">Home</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <a href="products.php">Products</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>Search Result</span> </div>

      <!--end nav--> 

    <!--product search-->

    <form action="search.php" method="get" enctype="multipart/form-data">

       <div class=" box-content post">

      <h1><span>Advance Search</span></h1>

      <div class="colum-pay" style="text-align:left;">

      <ul class="form-all">

      	<li><label>Categories</label>

   <select name="parent_id" id="parent_id">

   	<option value="">All Collection</option>

   			 <?php $i = 0; ?>

           <?php foreach ($this->itemCateList as $val) { ?> 

           <option value="<?php echo $val['id']?>"<?php echo (($this->parent_id == $val['id']) ? ' selected' : '')?>><?php echo $val['title_la']?></option>

           <?php } ?>

   </select> 

        </li>

        <li><label>Key search</label> <input type="text" name="keyword" id="keyword" value="<?php echo $this->keyword?>"> </li>

      </ul>

      </div>

      

      <div class="colum-pay" style="text-align:left;">

      <ul class="form-all">

      	<li><label>Rete Price</label>

   <select name="order_by" id="order_by">

     <option value="1"<?php echo (($this->order_by == '1') ? ' selected' : '')?>>0 - 10 USD</option>

     <option value="2"<?php echo (($this->order_by == '2') ? ' selected' : '')?>>11 - 20 USD</option>

     <option value="3"<?php echo (($this->order_by == '3') ? ' selected' : '')?>>21 - 30 USD</option>

     <option value="4"<?php echo (($this->order_by == '4') ? ' selected' : '')?>>31 USD Up</option>

   </select> 

        </li>

          <li><input name="Submit" type="submit" class="btn-login" value="Search"></li>

      </ul>

      </div>
<div  class="clear"></div>
      

       <h1><span>Search Result <span style="color:#f00; font-size:16px;">[Found <?php echo $this->itemListCount?> Item ]</span></span></h1>

      

      	</div>

    </form>

    <!--// product search--> 

        

        

      <!--Model-->

      <div class="product_model">

        <ul class="model">

        <?php $i =0; ?>

        <?php foreach ($this->itemList as $val) { ?>     

        <?php $i++; ?>   

          <li class="post">

            <div class="box-model"> <a href="products_detail.php?id=<?php echo $val['id']?>"><img src="../img_product/<?php echo $val['image']?>" alt=""/></a>

              <h2> <a href="products_detail.php?id=<?php echo $val['id']?>"><?php echo $val['title_la']?></a></h2>

              <div class="txt-model-l">Product code : &nbsp; </div>

              <div class="txt-model-r"><?php echo $val['code']?></div>

              <div class="clear"></div>

              <div class="txt-model-l"><strong>Price :</strong> &nbsp;</div>

 <?php if($val['discount'] != ''){?>
  <div class="txt-model-r  txt-model-price">
 <span><?php echo number_format($val['price'],2);?> USD</span><br>
 <span class="special"><?php echo number_format($val['discount'],2);?> USD</span>

<span><?php echo Lang::eXchangeRate('lak',$val['price'])?>  LAK</span><br>
<span class="special"><?php echo Lang::eXchangeRate('lak',$val['discount'])?>  LAK</span></div>
  <?php }else{ ?>
  <div class="txt-model-r  txt-model-price"><?php echo $val['price']?> USD<br>
  <?php echo Lang::eXchangeRate('lak',$val['price'])?> LAK</div>
 <?php } ?> 
 <div class="clear"></div>

            </div>

          </li>

          <?php if($i%4 == 0){?><div class="clear"></div><?php } ?>

        <?php } ?>

        <div class="clear"></div>

        </ul>

      </div>

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

