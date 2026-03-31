<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>NAREE</title>

<link rel="stylesheet" type="text/css" href="font-face/stylesheet.css">



 <style type="text/css">

 strong { font-weight: normal;font-family: 'pt_sansboldSVG', 'pt_sansbold';}

body { background:#fff;  font-family: 'pt_sansregularSVG','pt_sansregular'; font-size:16px; line-height:18px;color:#111}

.content { width:80%; margin:0 auto; padding:10px; border:1px solid #111}

.logo-print { width:200px}

.title { font-size:18px; color:#111; background:#111; text-align:center; padding:10px; color:#fff; font-weight:bold}

.box { border-top:1px solid #555; padding:10px 0 0 0; margin:10px 0 0 0;}



.cart-img { width:110px;   margin:0 10px;}

.cart-img img { width:100%;}

.cart-name  {  margin:0; padding:0 0 0 0}

.cart-name h2 { color:#111; text-align:left; font-size:14px; line-height:15px;font-family: 'pt_sansregularSVG','pt_sansregular'; font-weight: normal; letter-spacing:2px; text-transform:uppercase;}

.cart-price {   margin:0; font-size:14px; background:#fff;color:#000; text-align:right;  padding:0 0 0 0 }

.cart-price.total { width:12% !important}

.cart-price h3.txt-price { color:#000;  font-weight:normal; text-transform:uppercase; margin:0;font-family: 'pt_sansregularSVG','pt_sansregular'; font-size:14px;}

.cart-price h3.txt-price span { text-decoration:line-through}

.cart-price h3.txt-price span.special { color:#f00; text-decoration:none; font-size:14px}

.cart-quantity  { width:23%; float:left; margin:0 auto; padding:30px 0 0 0}

.print { text-align:center; font-size:15px; color:#111; padding:10px 0}

.print  a { color:#fff; background: #111; padding:6px 30px; display:block; width:10%; text-decoration: none; margin:0 auto; }

@media print {

	.content { width:100%; border:none; padding:0; }

.print { display:none}

	}

</style>



</head>



<body style="background:#fff">

<div class="content">





<table width="100%"  cellspacing="0" cellpadding="0">

  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>
        <td width="17%"><div class="logo-print"><img src="images/logo_print.png"  alt=""/></div></td>
        <td width="83%" align="right"><strong>NAREE SHOWROOM & HEAD OFFICE </strong> <br>
          Nongbone Village (Horm 1), Saysettha District, <br>
          Vientiane Capital, Lao PDR. <br>
          <strong>Mobile phone : </strong> +856 20-5930 9333<br>
          <strong>E-mail : </strong>naree.laos@gmail.com</td>
      </tr>

    </table>

</td>

  </tr>

  <tr>

    <td><div class="box">

      <table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

            <tr>

              <td width="50%"><table border="0" cellpadding="2" cellspacing="0">

                <tr>

                  <td><strong>Invoice No.</strong></td>

                  <td><?php echo $this->invoice->invoice_id?></td>

                </tr>

                <tr>

                  <td><strong>Order Date</strong></td>

                  <td><?php echo $this->invoice->order_date?></td>

                </tr>

              </table></td>

              <td><table border="0" cellpadding="2" cellspacing="0">

                <tr>

                  <td><strong>Shipping Method</strong></td>

                  <td>EMS</td>

                </tr>

                <tr>

                  <td><strong>Payment Method</strong></td>

                  <td>Credit Card</td>

                </tr>

              </table></td>

            </tr>

          </table></td>

        </tr>

        <tr>

          <td>&nbsp;</td>

        </tr>

        <tr>

          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

            <tr>

              <td width="50%" valign="top"><table border="0" cellpadding="2" cellspacing="0">

                <tr>

                  <td><strong>Buyer Contact</strong></td>

                </tr>

                <tr>

                  <td><?php echo $this->member->name?><br>

                    E-mail : <?php echo $this->member->email?></td>

                </tr>

              </table></td>

              <td valign="top"><table border="0" cellpadding="2" cellspacing="0">

                <tr>

                  <td><strong>Shipping Address</strong></td>

                </tr>

                <tr>

                  <td><?php echo $this->location->name?> <?php echo $this->location->surname?><br>

                    <?php echo $this->location->address1?> <br>

                    Phone No. 1: <?php echo $this->location->phone1?><br>

                    Phone No. 2: <?php echo $this->location->phone2?></td>

                </tr>

              </table></td>

            </tr>

          </table></td>

        </tr>

      </table>

    </div></td>

  </tr>

  <tr>

    <td>

    <div class="box">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td><strong>Items in My Bag</strong></td>

  </tr>

  <tr>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td>

    <table width="100%" border="1" cellspacing="0" cellpadding="3">

  <tr>

    <td colspan="2" align="center" bgcolor="#999999">Detail</td>

    <td width="20%" align="center" bgcolor="#999999"><span class="txt-price">Price: </span></td>

    <td width="15%" align="center" bgcolor="#999999"><span class="txt-price">QTY (Item)</span></td>

    <td width="14%" align="center" bgcolor="#999999">Total Price</td>

  </tr>

          <?php $i =0; $gettmp['sub_total']=0; ?>

        <?php foreach ($this->orderList as $data) { ?>     

        <?php $i++; ?> 

  <tr>

    <td width="16%"><div class="cart-img"><img src="../img_product/<?php echo Lang::getProductOrder($data['pid'],'image','en')?>" alt=""/></div></td>

    <td width="35%" align="center">  <!--/Name-->

      <div class="cart-name">

        <h2 class="txt-mdel"><?php echo Lang::getProductOrder($data['pid'],'title_en','en')?> <br>

          <span><?php echo Lang::getProductOrder($data['pid'],'code','en')?></span></h2>

        </div>

      <!--//name--> </td>

    <td>  

      <div class="cart-price">

        <h3 class="txt-price"><?php if($data['discount'] != ''){?><span><?php echo Lang::getProductOrder($data['pid'],'price','en')?> USD</span> <span class="special"><?php echo Lang::getProductOrder($data['pid'],'discount','en')?> USD</span><?php }else{ ?><?php echo Lang::getProductOrder($data['pid'],'price','en')?> USD<?php } ?></h3>

        </div>

      </td>

    <td align="center"><?php echo $data['amount']?></td>

    <td><div class="cart-price">

      <h3 class="txt-price"><?php echo $data['total']?> USD</h3>

      </div></td>

  </tr>

  <?php

  

  $gettmp['sub_total'] = $gettmp['sub_total']+$data['total'];

  ?>

  <?php } ?>

  <tr>

    <td colspan="4" align="right">Sub-Total</td>

    <td align="right"><?php echo $gettmp['sub_total']?> USD</td>

  </tr>

  <tr>

    <td colspan="4" align="right">Shipping </td>

    <td align="right">0 USD</td>

  </tr>

  <tr>

    <td colspan="4" align="right"><strong>Grand-Total</strong></td>

    <td align="right"><strong><?php echo $gettmp['sub_total']?> USD</strong></td>

  </tr>

    </table>



     

    </td>

  </tr>

  <tr>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td bgcolor="#E9E9E9" style="padding:5px; font-size:12px; color:#000000">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><strong>Naree Payment Policy</strong></td>
    </tr>
    <tr>
      <td>
        <ol style="margin:0; padding:10px 0 0 20px">
          <li>Cancelllation of any purchase can be done with 24 hours after payment, by sending email to naree.laos@gmail.com</li>

<li>
   In case of cancellation, 10% penalty fee of total purchase will be charged directly to buyer</li>

<li>
   This policy applies to all Naree products</li>
        </ol></td>
    </tr>
  </tbody>
</table>

        </td>

      </tr>

      <tr>

        <td>&nbsp;</td>

      </tr>

    </table></td>

  </tr>

    </table>



    

    </div>

    </td>

  </tr>

  <tr>
    <td style="color:#000; padding:10px; font-size:12px; text-align:center">COPYRIGHT © 2016 NAREE. ALL RIGHTS RESERVED</td>
  </tr>

</table>



 

 

</body>

</html>

