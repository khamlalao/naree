<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>NAREE</title>


 <link rel="stylesheet" type="text/css" href="font-face/stylesheet.css">
<style type="text/css">



body { background:#ffffff;   font-family: 'saysettha_otregular'; font-size:14px; color:#111111;   }

.content { width:80%; margin:0 auto; padding:10px; border:1px solid #111111}

.logo-print { width:200px}
 
.title { font-size:18px; color:#111111; background:#111111; text-align:center; padding:10px; color:#ffffff; font-weight:bold}

.box { border-top:0; padding:10px 0 0 0; margin:10px 0 0 0;}



.cart-img { width:110px;   margin:0 10px;}

.cart-img img { width:100%;}

.cart-name  {  margin:0; padding:0 0 0 0}

.cart-name h2 { color:#111111; text-align:left; font-size:14px; line-height:15px;font-family: 'saysettha_otregular' font-weight: normal; letter-spacing:2px; text-transform:uppercase;}

.cart-price {   margin:0; font-size:14px; background:#fffff;color:#000; text-align:right;  padding:0 0 0 0 }

.cart-price.total { width:12% !important}

.cart-price h3.txt-price { color:#000000;  font-weight:normal; text-transform:uppercase; margin:0;font-family: 'saysettha_otregular'font-size:14px;}

.cart-price h3.txt-price span { text-decoration:line-through}

.cart-price h3.txt-price span.special { color:#ff0000; text-decoration:none; font-size:14px}

.cart-quantity  { width:23%; float:left; margin:0 auto; padding:30px 0 0 0}

@media print {

	.content { width:100%; border:none; padding:0; }



	}

</style>





</head>



<body style="background:#fff">

<div class="content">





<table width="100%"  cellspacing="0" cellpadding="0">

  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>
        <td><div class="logo-print"><img src="images/logo_print.png"  alt=""/></div></td>
        <td align="right" valign="top"><strong> ຮ້ານ ນາຣີ ກະເປົາລາວປະຍຸກ </strong> <br>
          ບ້ານຫນອງບອນ (ຮ່ອມ 1), ເມືອງໄຊເສດຖາ, ນະຄອນຫລວງວຽງຈັນ, ສປປ ລາວ<br>
          <strong>ໂທລະສັບມືຖື : </strong> +856 20-5930 9333<br>
          <strong> ອີເມລ  : </strong>naree.laos@gmail.com</td>
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
                  <td><strong>ໃບສັ່ງຊື້ເລກທີ</strong></td>

                  <td><?php echo $this->invoice->invoice_id?></td>

                </tr>

                <tr>
                  <td><strong> ວັນທີສັ່ງຊື້</strong></td>

                  <td><?php echo $this->invoice->order_date?></td>

                </tr>

              </table></td>

              <td><table border="0" cellpadding="2" cellspacing="0">

                <tr>
                  <td width="121"><strong>ວິທີສົ່ງສິນຄ້າ:</strong></td>

                  <td>EMS</td>

                </tr>

                <tr>
                  <td><strong>ວິທີຈ່າຍເງິນ :</strong></td>

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
                  <td><strong>ຂໍ້ມູນຜູ້ຊື້</strong></td>
                </tr>

                <tr>
                  
                  <td><?php echo $this->member->name?><br>
                    
                    ອີເມລ: <?php echo $this->member->email?></td>
                  
                </tr>

              </table></td>

              <td valign="top"><table border="0" cellpadding="2" cellspacing="0">

                <tr>
                  <td><strong>ທີ່ຢູ່ສົ່ງສິນຄ້າ</strong></td>
                </tr>

                <tr>
                  
                  <td><?php echo $this->location->name?> <?php echo $this->location->surname?><br>
                    
                    <?php echo $this->location->address1?> <br>
                    
                    ເບີໂທ 1: <?php echo $this->location->phone1?><br>
                    
                   ເບີໂທ  2: <?php echo $this->location->phone2?></td>
                  
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

    <td><span style="font-size:14px; color:#000000"><strong>ຂໍ້ມູນເຂົ້າລະບົບ</strong></span></td>

  </tr>

  <tr>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td>

    <table width="100%" border="1" cellspacing="0" cellpadding="3">

          <tr>
            <td colspan="2" align="center" bgcolor="#999999">ລາຍລະອຽດ</td>
            <td align="center" bgcolor="#999999"><span class="txt-price">ລາຄາ</span></td>
            <td align="center" bgcolor="#999999"><span class="txt-price">ຈ/ນ (ສິນຄ້າ)</span></td>
            <td align="center" bgcolor="#999999">ລວມທັງໝົດ</td>
          </tr>

          <?php $i =0; $gettmp['sub_total']=0; ?>

        <?php foreach ($this->orderList as $data) { ?>     

        <?php $i++; ?> 

  <tr>

    <td width="16%"><div class="cart-img"><img src="../img_product/<?php echo Lang::getProductOrder($data['pid'],'image','en')?>" alt=""/></div></td>

    <td width="35%" align="center">  <!--/Name-->

      <div class="cart-name">

        <h2 class="txt-mdel"><?php echo Lang::getProductOrder($data['pid'],'title_la','la')?> <br>

          <span><?php echo Lang::getProductOrder($data['pid'],'code','la')?></span></h2>

        </div>

      <!--//name--> </td>

    <td width="20%">  

      <div class="cart-price">

        <h3 class="txt-price"><?php if($data['discount'] != ''){?><span><?php echo Lang::getProductOrder($data['pid'],'price','en')?> ໂດລາ</span> <span class="special"><?php echo Lang::getProductOrder($data['pid'],'discount','en')?> ໂດລາ</span><?php }else{ ?><?php echo Lang::getProductOrder($data['pid'],'price','en')?> ໂດລາ<?php } ?></h3>

        </div>

      </td>

    <td width="15%" align="center"><?php echo $data['amount']?></td>

    <td width="14%"><div class="cart-price">

      <h3 class="txt-price"><?php echo $data['total']?> ໂດລາ</h3>

      </div></td>

  </tr>

  <?php

  

  $gettmp['sub_total'] = $gettmp['sub_total']+$data['total'];

  ?>

  <?php } ?>

  <tr>
    <td colspan="4" align="right"> ຍອດລວມ</td>

    <td align="right"><?php echo $gettmp['sub_total']?> ໂດລາ</td>

  </tr>

  <tr>
    <td colspan="4" align="right">ການສົ່ງສິນຄ້າ </td>

    <td align="right">0 ໂດລາ</td>

  </tr>

  <tr>
    <td colspan="4" align="right"><strong>ຍອດລວມທັງຫມົດ</strong></td>

    <td align="right"><strong><?php echo $gettmp['sub_total']?> ໂດລາ</strong></td>

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
      <td><strong>ນະໂຍບາຍການສັ່ງຊື້ສິນຄ້າຜ່ານເວບໄຊ໌ຂອງຮ້ານ ນາຣີ </strong></td>
    </tr>
    <tr>
      <td>
        <ol style="margin:0; padding:10px 0 0 20px">
          <li>ຫຼັງຈາກສັ່ງຊື້ສິນຄ້າແລ້ວ ລູກຄ້າມີສິດລົບລ້າງການສັ່ງຊື້ພາຍໃນເວລາ 24 ຊົ່ວໂມງ ຫຼັງຈາກກົດປຸ່ມສັ່ງຈ່າຍ, ໂດຍການສົ່ງຂໍ້ຄວາມການຂໍລົບລ້າງຫາ ອີເມລ: <a href="mailto:naree.laos@gmail.com">naree.laos@gmail.com</a></li>
<li>
  ໃນກໍລະນີມີການລົບລ້າງການສັ່ງຊື້ເກີດຂຶ້ນ, ຜູ້ສັ່ງຊື້ຈະຖືກປັບໄໝເປັນມູນຄ່າ 10% ຂອງມູນຄ່າສິນຄ້າ ຫຼື ໃບບິນທີ່ຖືກລົບລ້າງ</li>
<li>
  ນະໂຍບາຍດັ່ງກ່າວມີຜົນນຳໃຊ້ກັບສິນຄ້າທຸກປະເພດຂອງ ນາຣີ</li>
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

