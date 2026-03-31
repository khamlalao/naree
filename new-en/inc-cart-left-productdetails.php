
<?php //if($this->OrderrecordCount > 0){ ?>
<div class="dim"></div>

<div id="box-cart-app">

  <div class="box-cart-titlebar">

    <div class="icon-close" id="close-cart" title="Close"><img src="images/icon/i_close.png"   alt=""/></div>

    <h2>My Shopping Bag</h2>

    <!--<div class="your-item" id="yourcart-item"><?php //=$this->total_amount?></div> -->

  </div>

  <!--Item cart-->

<!--  <div class="box-overflow">-->

  <div id="default_cart" class="contentHolder_cart">

  <ul class="cart-right">

        <?php $i =0; ?>

        <?php foreach ($this->itemOrder as $data) { ?>     

        <?php $i++; ?>   

    <li>

      <div class="delete-item"><a href="#nogo" title="Remove" id="remove-cart" onclick="return removeItem(<?php echo $data['id']?>);" ><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>

      <div class="cart-right-img"> <a href="products_detail.php?id=<?php echo $data['pid']?>"><img src="../img_product/<?php echo Lang::getProductOrder($data['pid'],'image','en')?>" alt=""/></a>

        <div class="cart-right-name">

          <h2 class="txt-mdel"><a href="products_detail.php?id=<?php echo $data['pid']?>"><?php echo Lang::getProductOrder($data['pid'],'title_en','en')?></a> <span><?php echo Lang::getProductOrder($data['pid'],'code','en')?></span></h2>

        </div>

      </div>

      <div class="cart-right-price">

        <h3 class="txt-price">Price: <br><?php if($data['discount'] != ''){?><span><?php echo Lang::getProductOrder($data['pid'],'price','en')?> USD</span> <span class="special"><?php echo Lang::getProductOrder($data['pid'],'discount','en')?> USD</span><?php }else{ ?><?php echo Lang::getProductOrder($data['pid'],'price','en')?> USD<?php } ?></h3>

        <table border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td style="padding-bottom:5px; text-transform:uppercase">Quantity </td>

          </tr>

          <tr>

            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>

                  <td width="20" align="center" bgcolor="#000000"><a href="javascript:void(0);" title="Minus" onClick="return addcart('del','<?php echo $data['id']?>');" style="color:#fff"><i class="fa fa-minus" aria-hidden="true"></i></a></td>

                  <td><input type="text" value="<?php echo $data['amount']?>" name="amount<?php echo $data['id']?>" id="amount<?php echo $data['id']?>" class="txtbox-quantity"></td>

                  <td width="20" align="center"  bgcolor="#000000"><a href="javascript:void(0);" title="Add" onClick="return addcart('add','<?php echo $data['id']?>');" style="color:#fff"><i class="fa fa-plus" aria-hidden="true"></i>

</a></td>

                </tr>

              </table></td>

          </tr>

        </table>

      </div>

       <div class="clear"></div>

    </li>

  <?php } ?>

     

     

  </ul>

 </div>

  <?php // if($this->OrderrecordCount > 0){ ?>
  <div class="cart-right-total">
  <div class="pad">
  	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Sub-Total</td>
    <td align="right"><span id="cashAmount"><?php echo $this->totalPay?></span> USD</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><span id="cashAmount_KIP"><?php echo Lang::eXchangeRate('lak',$this->totalPay)?></span> LAK</td>
  </tr>
    </table>
</div>
 <a href="products.php" class="continue-shop">Continue Shopping</a>
 <a href="cart_session.php" class="check-out">Buy Now</a>
 <div class="clear"></div>
 </div>
<?php // } ?>
  

    <!--Item cart-->

    

  <!--no item-->

  <div class="cart-no-item" style="display:none">

Your Shopping Bag is Empty

<div class="box-btn">

<a href="products.php" class="shop-now " > Start Shopping Now </a>

<div class="clear"></div>

</div>

</div>

<!--//no item-->

</div>

<?php //} ?>