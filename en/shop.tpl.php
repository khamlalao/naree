<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>Shops | Naree partner shop in Vientiane Capital & Provinces</title>
<meta name="title" content="Shops | Naree partner shop in Vientiane Capital & Provinces">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women">
<meta name="description" content="How to buy online on website naree.co">


<?php include('inc_css.php');?>

</head>



<body onLoad="getNavTop(2);">

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

      <div class="nav post"> <a href="index.php" class="home">Home</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>Shops</span> </div>

      <!--end nav--> 

      

      <!--New-->

      <div class="product_model post">

        <div class=" box-content">

          <h1><span>Naree partner shopS in Vientiane Capital & Provinces</span></h1>

         <!-- <p></p>-->

        </div>

        <div id="shop-list">

         <!-- <h2 class="txt-shop-list">vientiane</h2>-->

          <ul class="news-list">
          <?php $i =0; ?>
  
          <?php foreach ($this->itemList as $val) { ?>     

          <?php $i++; ?>

            <li class="post shop-list-w">

              <div class="box-news"> 

                <div class="date"><?php echo $val['title_en']?></div>

                <p class="topic-shop"><?php echo $val['address_en']?></p>

                <div class="icon-shop">

                  <table  border="0" cellspacing="4" cellpadding="0">

                    <tbody>
                    <?php if($val['phone'] != null){?>

                      <tr>

                        <td width="8%"><img src="images/icon/i_tel.png"  alt="" width="28" height="28"/></td>

                        <td width="92%"><span class="topic-news"><?php echo $val['phone']?></span></td>

                      </tr>
                      <?php } ?>
                       <?php if($val['mobile'] != null){?>
                      <tr>

                        <td><img src="images/icon/i_mobile.png"  alt="" width="28" height="28"/></td>

                        <td><span class="topic-news"><?php echo $val['mobile']?></span></td>

                      </tr>
                      <?php } ?>
                      <?php if($val['whatsapp'] != null){?>
                      <tr>
                        <td><img src="images/icon/i_whatsapp.png" width="28" height="28" alt=""/></td>

                        <td><span class="topic-news"><?php echo $val['whatsapp']?></span></td>

                      </tr>
                      <?php } ?>
                      <?php if($val['instagram'] != null){?>
                       <tr>
                        <td><img src="images/icon/i_instagram.png" width="28" height="28" alt=""/></td>
                        <td><span class="topic-news"><?php echo $val['instagram']?></span></td>
                      </tr>
                      <?php } ?>
                      <?php if($val['facebook'] != null){?>
                      <tr>
                        <td><img src="images/icon/i_facebook_s.png" width="28" height="28" alt=""/></td>
                        <td><span class="topic-news"><?php echo $val['facebook']?></span></td>
                      </tr>
                      <?php } ?>
                      <?php if($val['line_id'] != null){?>
                      <tr>
                        <td><img src="images/icon/i_line_s.png" width="28" height="28" alt=""/></td>
                        <td><span class="topic-news"><?php echo $val['line_id']?></span></td>
                      </tr>
                      <?php } ?>
                      <?php if($val['gmap'] != null){?>
                      <tr>
                        <td><img src="images/icon/i_pin.png" width="28" height="28" alt=""/></td>
                        <td><a href="<?php echo $val['gmap']?>" target="_blank">Google map</a></td>
                      </tr>
                      <?php } ?>
                    </tbody>

                  </table>

                </div>

              </div>

            </li>

            

           <?php if($i%3 == 0){?><div class="clear"></div><?php } ?>
           <?php } ?>   
            
          </ul>

          <div class="clear"></div>

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

<script type="text/javascript">

 $(document).ready(function() {

	$(".fancybox").fancybox({

		openEffect	: 'none',

		closeEffect	: 'none'

	});

});



 

</script>

</body>

</html>

