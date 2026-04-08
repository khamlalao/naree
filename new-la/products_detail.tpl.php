<!doctype html>
<html lang="en">

<head>
  <meta http-equiv="content-type" charset="utf-8">
  <title>ສິນຄ້າ | NAREE : Blending traditional craftsmanship with modern style</title>
  <meta name="title" content="NAREE : Blending traditional craftsmanship with modern style">
  <meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women">
  <meta name="description" content="website naree.co">

  <?php include('inc_css.php'); ?>



  <script type="text/javascript">
    jQuery(document).ready(function($) {

      $.get('order_alert.php', {

        session: '<?php echo $_SESSION['session_login'] ?>',

        time: new Date().getTime()

      }, function(data) {

        //	alert(data);
        if (data != '') {

          $('#yourcart-num').html('<span id="yourcart-num" class="num-items">' + data + '</span>'); //cartnum
        }
        // $('#yourcart-num').html(data);
        //	$('#cartnum').html(data);
      });

      /*	setInterval(function(){
      		$.get('order_alert.php', {
      				session : '<?php //=$_SESSION['session_login']
                          ?>',
      				time : new Date().getTime()
      				}, function(data) {
      				//	alert(data);
      				  $('#yourcart-num').html(data);
      			  });
      		}, 0);
      */
      $('#add2Cart').click(function() {

        var num = document.getElementById('amount').value;

        //alert(num);	

        var id = '<?php echo $this->id ?>';

        $.get('inc_cart_add.php', {
          id: id,
          action: 'additem',
          amount: num,
          time: new Date().getTime()

        }, function(data) {
          //alert(data);
        });


        $.get('inc_cart_render.php', {
          id: id,
          time: new Date().getTime()
        }, function(data) {
          //	alert(data);
          $('#default_cart').html(data);
          //  $('#amount_incart').html(data)
          //	alert(data);

        });


        $.get('inc_your_item.php', {
          id: id,
          time: new Date().getTime()
        }, function(data) {
          //alert(data);
          $('#yourcart-item').html(data);
          $('#yourcart-num').html('<span id="yourcart-num" class="num-items">' + data + '</span>');
        });


        $.get('inc_cash_amount.php', {
          rate: 'USD',
          time: new Date().getTime()
        }, function(data) {
          //alert(data);
          $('#cashAmount').html(data);
        });
        $.get('inc_cash_amount.php', {
          rate: 'LAK',
          time: new Date().getTime()
        }, function(data) {
          //alert(data);
          $('#cashAmount_KIP').html(data);
        });

        MyCart();

      });
    });

    function addtocart(obj) {

      // alert(obj);



      var num = document.getElementById('amount').value;

      //alert($('#amount').val());

      // alert(num);

      //amount : $("#amount").val();

      //var delItem = $("#amount").val();

      if (obj == 'add') {

        //	alert('+');

        var num = document.getElementById('amount').value;

        //alert(num);

        var new_add = new Number(num) + 1;

        //alert(new_add);

        //$('#amount').val(new_add); 

        document.getElementById('amount').value = new_add;





      }

      if (obj == 'del') {

        //	alert('-');

        var num = document.getElementById('amount').value;

        //alert(num);

        if (num > 1) {

          var new_add = new Number(num) - 1;

          //alert(new_add);

          //$('#amount').val(new_add); 

          document.getElementById('amount').value = new_add;

        }



      }



    }



    function removeItem(id) {
      //alert(id);
      jQuery(document).ready(function($) {
        //	alert("xx");
        $.get('inc_cart_remove.php', {
          id: id,
          action: 'remove',
          time: new Date().getTime()
        }, function(data) {
          $('#default_cart').html(data);
          //  alert(data);
        });
      });

      jQuery(document).ready(function($) {
        $.get('inc_cash_amount.php', {
          rate: 'LAK',
          time: new Date().getTime()
        }, function(data) {
          //	alert(data);
          $('#cashAmount_KIP').html(data);
        });
      });
    }

    function addcart(obj, id) {

      // alert(obj+id);

      var amount = 'amount' + id;

      var num = document.getElementById(amount).value;

      // alert(num);

      if (obj == 'add') {

        var num = document.getElementById(amount).value;

        var newAmount = new Number(num) + 1;

        document.getElementById(amount).value = newAmount;



        jQuery(document).ready(function($) {

          $.get('inc_cart_render.php', {

            id: id,

            action: 'insert',

            amount: newAmount,

            time: new Date().getTime()

          }, function(data) {
            //	alert(data);

            $('#default_cart').html(data);

          });

          $.get('inc_cash_amount.php', {
            id: id,
            time: new Date().getTime()
          }, function(data) {
            //alert(data);
            $('#cashAmount').html(data);
          });
        });


      }

      if (obj == 'del') {

        var num = document.getElementById(amount).value;

        if (num > 1) {

          var newAmount = new Number(num) - 1;

          document.getElementById(amount).value = newAmount;

          //	$('#cashAmount').html('2');


          jQuery(document).ready(function($) {
            $.get('inc_cart_render.php', {

              id: id,
              action: 'delete',
              amount: newAmount,

              time: new Date().getTime()
            }, function(data) {
              //	alert(data);

              $('#default_cart').html(data);
            });

            $.get('inc_cash_amount.php', {
              id: id,
              time: new Date().getTime()
            }, function(data) {
              //alert(data);
              $('#cashAmount').html(data);
            });

          });




        }

      }



      //alert(newAmount);





    }



    function MyCart() {



      jQuery("#box-cart-app").animate({
        right: '0'
      }, 300);

      jQuery(".dim").fadeIn();

      jQuery("body").addClass('has-active-menu');

    }
  </script>
  <script type="text/javascript">
    jQuery(function() {

      //$('.menu').hide();
      $('#mn-mobile-close-login').hide();
      $('#mn-mobile-login').click(function() {

        $('.menu').slideDown();
        $('#mn-mobile-login').hide();
        $('#mn-mobile-close-login').show();
      });
      $('#mn-mobile-close-login').click(function() {

        $('.menu').slideUp();
        $('#mn-mobile-login').show();
        $('#mn-mobile-close-login').hide();
      });

      $('#click-member-subpro').click(function() {

        $('.dropdown ul#product-member-sub').slideToggle();
        //$('#mn-mobile').hide();
        //$('#mn-mobile-close').show();
      });

      $('#click-submember').click(function() {

        $('.dropdown ul#member-sub').slideToggle();
        //$('#mn-mobile').hide();
        //$('#mn-mobile-close').show();
      });

      $('#click-menber-subpromo').click(function() {

        $('.dropdown ul#promo-menber-sub').slideToggle();
        //$('#mn-mobile').hide();
        //$('#mn-mobile-close').show();
      });

      <
      !--2-- >
      $('#mn-mobile-close-pro').hide();
      $('#mn-mobile-pro').click(function() {

        $('.menu').slideDown();
        $('#mn-mobile-pro').hide();
        $('#mn-mobile-close-pro').show();
      });
      $('#mn-mobile-close-pro').click(function() {

        $('.menu').slideUp();
        $('#mn-mobile-pro').show();
        $('#mn-mobile-close-pro').hide();
      });
      $('#click-subpro').click(function() {

        $('.dropdown ul#product-sub').slideToggle();
        //$('#mn-mobile').hide();
        //$('#mn-mobile-close').show();
      });


      $('#click-subpromo').click(function() {

        $('.dropdown ul#promo-sub').slideToggle();
        //$('#mn-mobile').hide();
        //$('#mn-mobile-close').show();
      });
    });
  </script>
</head>



<body onLoad="getMN(2);">

  <?php //if($this->OrderrecordCount > 0){ 
  ?>
  <div class="dim"></div>

  <div id="box-cart-app">

    <div class="box-cart-titlebar">

      <div class="icon-close" id="close-cart" title="Close"><img src="images/icon/i_close.png" alt="" /></div>

      <h2>ກະຕ່າສິນຄ້າຂອງຂ້ອຍ</h2>

      <!--<div class="your-item" id="yourcart-item"><?php //=$this->total_amount
                                                    ?></div> -->

    </div>

    <!--Item cart-->

    <!--  <div class="box-overflow">-->

    <div id="default_cart" class="contentHolder_cart">

      <ul class="cart-right">

        <?php $i = 0; ?>

        <?php foreach ($this->itemOrder as $data) { ?>

          <?php $i++; ?>

          <li>

            <div class="delete-item"><a href="#nogo" title="Remove" id="remove-cart" onclick="return removeItem(<?php echo $data['id'] ?>);"><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>

            <div class="cart-right-img"> <a href="products_detail.php?id=<?php echo $data['pid'] ?>"><img src="../img_product/<?php echo Lang::getProductOrder($data['pid'], 'image', 'la') ?>" alt="" /></a>

              <div class="cart-right-name">

                <h2 class="txt-mdel"><a href="products_detail.php?id=<?php echo $data['pid'] ?>"><?php echo Lang::getProductOrder($data['pid'], 'title_la', 'la') ?></a>
                  <div class="numberEN"><?php echo Lang::getProductOrder($data['pid'], 'code', 'la') ?></span>
                </h2>

              </div>

            </div>

            <div class="cart-right-price">

              <h3 class="txt-price">ລາຄາ: <br><?php if ($data['discount'] != '') { ?><span><span class="numberEN"><?php echo Lang::getProductOrder($data['pid'], 'price', 'la') ?></span> ໂດລາ</span> <br>
                  <span class="special"><span class="numberEN"><?php echo Lang::getProductOrder($data['pid'], 'discount', 'la') ?></span> ໂດລາ</span><?php } else { ?><span class="numberEN"><?php echo Lang::getProductOrder($data['pid'], 'price', 'la') ?></span> ໂດລາ<?php } ?>
              </h3>

              <table border="0" cellspacing="0" cellpadding="0">

                <tr>

                  <td style="padding-bottom:5px; text-transform:uppercase">ຈຳນວນ </td>

                </tr>

                <tr>

                  <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                      <tr>

                        <td width="20" align="center" bgcolor="#8C7D77"><a href="javascript:void(0);" title="Minus" onClick="return addcart('del','<?php echo $data['id'] ?>');" style="color:#fff"><i class="fa fa-minus" aria-hidden="true"></i></a></td>

                        <td><input type="text" value="<?php echo $data['amount'] ?>" name="amount<?php echo $data['id'] ?>" id="amount<?php echo $data['id'] ?>" class="txtbox-quantity"></td>

                        <td width="20" align="center" bgcolor="#8C7D77"><a href="javascript:void(0);" title="Add" onClick="return addcart('add','<?php echo $data['id'] ?>');" style="color:#fff"><i class="fa fa-plus" aria-hidden="true"></i>

                          </a></td>

                      </tr>

                    </table>
                  </td>

                </tr>

              </table>

            </div>

            <div class="clear"></div>

          </li>

        <?php } ?>





      </ul>

    </div>

    <?php // if($this->OrderrecordCount > 0){ 
    ?>
    <div class="cart-right-total">
      <div class="pad">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>ຍອດລວມ</td>
            <td align="right"><span id="cashAmount"><span class="numberEN"><?php echo $this->totalPay ?></span></span> ໂດລາ</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="right"><span id="cashAmount_KIP"><span class="numberEN"><?php echo Lang::eXchangeRate('lak', $this->totalPay) ?></span></span> ກີບ</td>
          </tr>
        </table>
      </div>
      <a href="products.php" class="continue-shop">ສືບຕໍ່ເລືອກສິນຄ້າ</a>
      <a href="cart_session.php" class="check-out">ສັ່ງຊື້ເລີຍ</a>
      <div class="clear"></div>
    </div>
    <?php // } 
    ?>


    <!--Item cart-->



    <!--no item-->

    <div class="cart-no-item" style="display:none">

      Your Shopping Bag is Empty

      <div class="box-btn">

        <a href="products.php" class="shop-now "> Start Shopping Now </a>

        <div class="clear"></div>

      </div>

    </div>

    <!--//no item-->

  </div>

  <?php //} 
  ?>

  <div id="wrapper">
    <header class="header">
      <div class="header-top">
        <div class="brand-logo">
          <a href="index.php" target="_blank">
            <img
              src="/underrenovation/images/Naree_Logo.svg"
              alt="NR NAREE" />
          </a>
        </div>

        <div class="header-right-group">
          <div class="nav-right">
            <div class="top-icons">
              <a href="index.php" class="home">
                <img
                  src="/underrenovation/images/home_header-icon.svg" />
              </a>

              <div class="banner-social">
                <a href="https://www.facebook.com/nareehandbags" target="_blank">
                  <img
                    src="/underrenovation/images/facebook_icons.svg" />
                </a>
                <a
                  href="https://www.instagram.com/nareehandbags/?hl=th"
                  target="_blank">
                  <img
                    src="/underrenovation/images/instagram.svg" />
                </a>
                <a href="https://www.tiktok.com/@naree.official" target="_blank">
                  <img
                    src="/underrenovation/images/tiktok-icon.png" />
                </a>
                <a href="https://wa.me/8562023071333" target="_blank">
                  <img
                    src="/underrenovation/images/whatsapp-line-1.svg" />
                </a>
                <a href="https://line.me/R/ti/p/nareehandbag" target="_blank">
                  <img
                    src="/underrenovation/images/line.svg" />
                </a>
              </div>
              <a href="member_login.php" target="_blank">
                <img
                  src="/underrenovation/images/user_add_icons.svg" />
              </a>

              <div class="mn-desktop-cart" ;>
                <a href="#nogo" id="mycart">

                  <img src="/underrenovation/images/register.svg" class="cart-icon" alt="Cart" />

                  <!-- RED BADGE -->

                  <span id="yourcart-num"></span>


                </a>
              </div>

              <?php
              $current_page = basename($_SERVER['PHP_SELF']);

              function isActive($link_name, $current_page)
              {
                return ($link_name == $current_page) ? 'active' : '';
              }
              ?>
              <li class="lang-switch"><a href="<?php echo str_replace('/new-la/', '/new-en/',  $_SERVER['REQUEST_URI']) ?>" style="text-align:center;">ENGLISH </a></li>
            </div>
            <nav class="main-nav">
              <ul class="nav-links">
                <li class="dropdown">
                  <button class="dropbtn">
                    ສິນຄ້າທັງໝົດ <i class="fa-solid fa-chevron-up"></i>
                  </button>
                  <div class="dropdown-content">
                    <a href="products_all.php">ກະເປົາ <span class="arrow">→</span></a>
                    <a href="#">ເສື້ອຜ້າ <span class="arrow">→</span></a>
                    <a href="#">ເຄື່ອງປະດັບ <span class="arrow">→</span></a>
                  </div>
                </li>
                <li><a href="" class="pill-btn <?php echo isActive('', $current_page); ?>">ສິດທິພິເສດ</a></li>
                <li><a href="" class="pill-btn <?php echo isActive('', $current_page); ?>">ເຄັດລັບ</a></li>
                <li><a href="promotion-all.php" class="pill-btn <?php echo isActive('promotion-all.php', $current_page); ?>">ໂປຣໂມຊັ່ນ</a></li>
                <li><a href="naree_story.php" class="pill-btn <?php echo isActive('naree_story.php', $current_page); ?>">ປະຫວັດນາຣີ</a></li>
                <li><a href="lookbook.php" class="pill-btn <?php echo isActive('lookbook.php', $current_page); ?>">ແບບຢ່າງກະເປົາ</a></li>
                <li><a href="contact.php" class="pill-btn <?php echo isActive('contact.php', $current_page); ?>">ຕິດຕໍ່ພວກເຮົາ</a></li>
              </ul>
            </nav>
          </div>
          <div class="right-fa-bars">
            <input type="checkbox" id="menu-toggle" class="dropdown-checkbox" />
            <div class="mn-mobile-cart"><a href="#nogo" id="mycart">
                <?php if ($gettmp['total_amount'] != 0) { ?>
                  <div class="yourcart-num num-items">
                    <?php echo $gettmp['total_amount'] ?>
                  </div>
                <?php } ?>


                <!-- // Amount No of Order -->
                <img src="/underrenovation/images/register.svg" class="cart-icon" alt="Cart" />
                <span class="num-items yourcart-num"></span>

              </a></div>
            <label for="menu-toggle" class="menu-btn">
              <i class="fa fa-bars"></i>
              <i class="fa fa-times"></i>
            </label>
            <div class="menu">
              <ul>
                <li class="dropdown">
                  <input type="checkbox" id="products-toggle" />

                  <label for="products-toggle" class="dropbtn">
                    ສິນຄ້າທັງໝົດ <i class="fa-solid fa-chevron-up"></i>
                  </label>
                  <div class="dropdown-content">
                    <a href="products_all.php">ກະເປົາ <span class="arrow">→</span></a>
                    <a href="#">ເສື້ອຜ້າ <span class="arrow">→</span></a>
                    <a href="#">ເຄື່ອງປະດັບ <span class="arrow">→</span></a>
                  </div>
                </li>
                <div class="icon-name-menu">
                  <li><a href="index.php">ໜ້າຫຼັກ</a></li>
                  <li><a href="login.php">ເຂົ້າສູ່ລະບົບ</a></li>
                  <li><a href="https://www.facebook.com/nareehandbags">ເຟສບຸກ</a></li>
                  <li><a href="https://www.instagram.com/nareehandbags/?hl=th">ອິນສະຕາແກຣມ</a></li>
                  <li><a href="https://www.tiktok.com/@naree.official">ຕິກຕັອກ</a></li>
                  <li><a href="https://wa.me/8562023071333">ວັອດແອັບ</a></li>
                  <li><a href="https://line.me/R/ti/p/nareehandbag">ໄລນ໌</a></li>
                  <li><a href="#">ເພີ່ມຜູ້ໃຊ້</a></li>
                </div>

                <li><a href="#">ສິດທິພິເສດ</a></li>
                <li><a href="#">ເຄັດລັບ</a></li>
                <li><a href="promotion-all.php">ໂປຣໂມຊັນ</a></li>
                <li><a href="naree_story.php">ເລື່ອງລາວຂອງພວກເຮົາ</a></li>
                <li><a href="lookbook.php">ກະເປົາແບບຢ່າງ</a></li>
                <li><a href="contact.php">ຕິດຕໍ່ພວກເຮົາ</a></li>
                <li class="lang-switch"><a href="<?php echo str_replace('/new-la/', '/new-en/',  $_SERVER['REQUEST_URI']) ?>" style="text-align:center;">ENGLISH </a></li>

              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!--Header-->

    <div id="header">

      <!--Header-->

      <?php if (isset($_SESSION['member_id'])) { ?>

        <?php // include('inc_header_login.php')
        ?>

        <div class="content">
          <div class="mn-mobile" id="mn-mobile-close-login">
            <div class="boxclose"></div>
          </div>
          <div class="mn-mobile-cart"><a href="#nogo" id="mycart">
              <?php if ($gettmp['total_amount'] != 0) { ?>
                <div class="num-items" id="yourcart-num">
                  <?php echo $gettmp['total_amount'] ?>
                </div>
              <?php } ?>

              <!-- // Amount No of Order -->

              <img src="/underrenovation/images/Register.svg" alt="Cart" />
            </a></div>
          <!--//mobile-->

          <div class="header_left">

            <!--mene top-->

            <ul class="menu_top dropdown">
              <?php
              $go = "../new-en/" . htmlspecialchars(basename($_SERVER['PHP_SELF']));
              if ($_SERVER['QUERY_STRING'] != "") {
                $go .= "?" . htmlspecialchars($_SERVER['QUERY_STRING']);
              }
              ?>

              <li><a href="<?php echo str_replace('/new-la/', '/new-en/', $_SERVER['REQUEST_URI']) ?>" style="  text-align:center">English</a></li>


              <li><a href="member_login.php" class="txt-nohover"><img src="images/profile.png" alt="" /><?php echo $_SESSION['member_name'] ?></a>

                <ul style="left:-40px;">

                  <!--<li><a href="#nogo" class="txt-select">Your Account</a></li> -->

                  <BR />

                  <li><a href="member.php">ລາຍລະອຽດບັນຊີ</a></li>

                  <li><a href="member_address.php">ທີ່ຢູ່ສົ່ງສິນຄ້າ</a></li>

                  <li><a href="member_order.php">ປະຫວັດການສັ່ງສິນຄ້າ</a></li>

                  <li><a href="member_wishlist.php">ສິນຄ້າທີ່ຢາກໄດ້</a></li>

                  <!-- <li><a href="member_notifer.php">Notify Money Transfer</a></li> -->

                  <li><a href="logout.php">ອອກລະບົບ</a></li>

                </ul>

              </li>



              <li><a href="shop.php" class="txt-hover" id="nav_top2" title="Shops"><img src="images/icon/i_map.png" alt="Shops" /> ຮ້ານຄ້າ</a></li>

              <li><a href="where-to-buy.php" class="txt-hover" id="nav_top1" title="How to buy online"><img src="images/icon/i_how.png" alt="How to buy online" /> ວິທີສັ່ງຊື້ອອນລາຍ</a></li>

            </ul>



            <!-- <li><a href="register.php" class="txt-hover" id="nav_top4"><img src="images/icon/i_regis.png"   alt=""/> Register</a></li>-->



            </ul>

            <!--//memu top-->

            <div class="clear"></div>

            <!--menu-->

            <div class="menu">

              <ul class="dropdown">
                <!--mobile-->
                <li class="show-mobile"><a href="member_login.php" class="txt-nohover"><img src="images/profile.png" alt="" /><?php echo $_SESSION['member_name'] ?></a>
                  <div class="subpro" id="click-submember">+</div>

                  <ul id="member-sub">


                    <li><a href="member.php">ລາຍລະອຽດບັນຊີ</a></li>

                    <li><a href="member_address.php">ທີ່ຢູ່ສົ່ງສິນຄ້າ</a></li>

                    <li><a href="member_order.php">ປະຫວັດການສັ່ງສິນຄ້າ</a></li>

                    <li><a href="member_wishlist.php">ສິນຄ້າທີ່ຢາກໄດ້</a></li>
                    <!-- <li><a href="member_notifer.php">Notify Money Transfer</a></li> -->

                    <li><a href="logout.php">ອອກລະບົບ</a></li>

                  </ul>
                  <!--//mobile-->

                <li><a href="index.php" id="mn7">ໜ້າຫຼັກ</a></li>
                <li><a href="news.php" id="mn4">ຂ່າວ</a></li>
                <li><a href="products_all.php" id="mn2 ">ສິນຄ້າ</a>
                  <div class="subpro" id="click-subpro">+</div>

                  <ul id="product-sub">

                    <li><a href="products_all.php">ລວມທຸກແບບ</a></li>

                    <?php $i = 0; ?>

                    <?php foreach ($this->itemList as $val) { ?>

                      <li><a href="products.php?parent_id=<?php echo $val['id'] ?>"><?php echo $val['title_la'] ?></a></li>

                    <?php } ?>

                  </ul>

                </li>
                <li><a href="promotion-all.php" id="mn3">ໂປຣໂມຊັ່ນ</a>
                  <div class="subpro" id="click-subpromo">+</div>
                  <ul id="promo-sub">
                    <li><a href="promotion-banner.php">ໂປຣໂມຊັ່ນລວມ</a></li>
                    <li><a href="promotion.php">ສິນຄ້າຫຼຸດລາຄາ</a></li>
                  </ul>
                </li>


                <li><a href="naree_story.php" id="mn1">ປະຫວັດນາຣີ</a></li>

                <li><a href="lookbook.php" id="mn5">ແບບຢ່າງກະເປົາ</a></li>

                <li><a href="contact.php" id="mn6">ຕິດຕໍ່</a></li>
                <!--mobile-->

                <li class="show-mobile"><a href="shop.php" title="ຮ້ານຄ້າ"> ຮ້ານຄ້າ</a></li>

                <li class="show-mobile"><a href="where-to-buy.php" title=" ວິທີສັ່ງຊື້ອອນລາຍ"> ວິທີສັ່ງຊື້ອອນລາຍ</a></li>

                <li class="show-mobile"><a href="<?php echo str_replace('/la/', '/en/', $_SERVER['REQUEST_URI']) ?>" style="  text-align:center">
                    English </a></li>
                <!--//mobile-->

              </ul>

            </div>

          </div>

          <div class="clear"></div>

        </div>
      <?php } else { ?>

        <?php //include('inc_header.php') 
        ?>

      <?php } ?>

      <!--End Header-->

    </div>

    <!--//header-->



    <!--content-->

    <div id="Containner">

      <div class="content">

        <!--nav-->

        <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12" alt="" /> <a href="products.php">ສິນຄ້າ</a> <img src="images/icon/i_av.png" width="20" height="12" alt="" /> <a href="products.php?parent_id=<?php echo $this->parent_id ?>"><?php echo $this->category->title_la ?></a> <img src="images/icon/i_av.png" width="20" height="12" alt="" /> <span><?php echo $this->item->title_la ?></span> </div>

        <!--end nav-->



        <?php include('inc_search_product.php'); ?>





        <!--Model detail-->

        <div id="model-detail" class="post">

          <!--page-->

          <div id="page" style="width:100%; margin:0 0 10px 0">

            <ul>

              <li><a href="javascript:history.back();" class="left">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td><img src="images/icon/arrow_left_2.png" alt="" /> </td>

                      <td>&nbsp;</td>



                      <td>ກັບຄືນ</td>

                    </tr>

                  </table>

                </a></li>



              <div class="clear"></div>



            </ul>

          </div>

          <div class="clear"></div>

          <!--//page-->

          <div class="model-detail-left ">

            <div id="default" class="contentHolder">

              <?php if ($this->listImageCount != 0) { ?>

                <ul class="model-gallery">

                  <?php foreach ($this->listImage as $val) { ?>

                    <li><img src="/img_product_gallery/<?php echo $val['file_name'] ?>" alt="<?php echo $val['title_la'] ?>" /> </li>

                  <?php } ?>

                </ul>

              <?php } ?>

            </div>

            <p> * ວາງມາວສເທິງຮູບແລ້ວເລື່ອນລົງເພື່ອເບິ່ງຮູບອື່ນໆ</p>

          </div>

          <div class="model-detail-right">

            <h2 class="txt-mdel"> <?php echo $this->item->title_la ?><span class="numberEN"><?php echo $this->item->code ?></span></h2>


            <?php if ($this->item->size_la != null) { ?>
              <p>ຂະໜາດ: <span class="numberEN"><?php echo $this->item->size_la ?></span></p>
            <?php } ?>
            <?php /*?> <p>ຂະໜາດ (ຊມ): <span class="numberEN"><?php echo $this->item->size_cm?></span></p>
            <p>ຂະໜາດ (ນິ້ວ): <span class="numberEN"><?php echo $this->item->size_inch?></span></p>
            <p>ນໍ້າໜັກ (ກິໂລ): <span class="numberEN"><?php echo $this->item->weight?></span></p>
            <p>ສີ: <?php echo $this->item->color_la?></p>
            <p>ປະເພດຜ້າ: <?php echo $this->item->fabric_la?></p>
            <p>ອຸປະກອນ: <?php echo $this->item->material_la?></p><?php */ ?>

            <div class="tbl-detail">
              <table border="0" cellspacing="0" cellpadding="0">
                <tbody>

                  <tr>
                    <td width="23%">ຂະໜາດ (ຊມ)</td>
                    <td width="3%" align="center">:</td>
                    <td width="73%"><span class="numberEN"><?php echo $this->item->size_cm ?></span> </td>
                  </tr>
                  <tr>
                    <td>ຂະໜາດ (ນິ້ວ)</td>
                    <td width="3%" align="center">:</td>
                    <td><span class="numberEN"><?php echo $this->item->size_inch ?></span></td>
                  </tr>
                  <tr>
                    <td>ນໍ້າໜັກ (ກິໂລ)</td>
                    <td width="4%" align="center">:</td>
                    <td> <span class="numberEN"><?php echo $this->item->weight ?></span></td>
                  </tr>
                  <tr>
                    <td>ສີ</td>
                    <td width="3%" align="center">:</td>
                    <td><?php echo $this->item->color_la ?></td>
                  </tr>
                  <tr>
                    <td>ປະເພດຜ້າ </td>
                    <td width="3%" align="center">:</td>
                    <td><?php echo $this->item->fabric_la ?></td>
                  </tr>
                  <tr>
                    <td>ອຸປະກອນ</td>
                    <td width="3%" align="center">:</td>
                    <td><?php echo $this->item->material_la ?></td>
                  </tr>
                </tbody>
              </table>

            </div>



            <BR>
            <?php echo  convTextFromDB(encodeFromDB($this->item->detail_la)) ?>


            <div class="box-price">
              <table border="0" cellpadding="3" cellspacing="0">
                <tbody>
                  <?php if ($this->item->discount != '') { ?>
                    <tr>
                      <td>ລາຄາ ໂດລາ </td>
                      <td>:</td>
                      <td><span class="normalprice"><?php echo number_format($this->item->price, 2); ?></span> ໂດລາ</td>
                    </tr>
                    <tr>
                      <td> </td>
                      <td>:</td>
                      <td><span class="specialprice"><?php echo number_format($this->item->discount, 2); ?></span> ໂດລາ</td>
                    </tr>
                  <?php } else { ?>
                    <tr>
                      <td>ລາຄາ ໂດລາ</td>
                      <td>:</td>
                      <td><span class="txt-model-price"><span class="numberEN"><?php echo number_format($this->item->price, 2); ?></span> ໂດລາ</span></td>
                    </tr>
                  <?php } ?>
                  <?php if ($this->item->discount != '') { ?>
                    <tr>
                      <td>ລາຄາ ກີບ</td>
                      <td>:</td>
                      <td><span class="normalprice"><?php echo Lang::eXchangeRate('lak', $this->item->price); ?></span> ກີບ</td>
                    </tr>
                    <tr>
                      <td> </td>
                      <td>:</td>
                      <td><span class="specialprice"><?php echo Lang::eXchangeRate('lak', $this->item->discount); ?></span> ກີບ</td>
                    </tr>
                  <?php } else { ?>
                    <tr>
                      <td>ລາຄາ ກີບ</td>
                      <td>:</td>
                      <td><span class="txt-model-price"><span class="numberEN"><?php echo Lang::eXchangeRate('lak', $this->item->price); ?></span> ກີບ</span></td>
                    </tr>
                  <?php } ?>

                </tbody>
              </table>
            </div>


            <div class="box-quantity">

              <table border="0" cellspacing="0" cellpadding="0">

                <tr>

                  <td style="padding-right:10px">ຈຳນວນ </td>

                  <td>
                    <table border="0" cellspacing="0" cellpadding="0">

                      <tr>

                        <td width="30" align="center" bgcolor="#8C7D77"><a href="javascript:void(0);" title="Minus" onClick="return addtocart('del');"><i class="fa fa-minus" aria-hidden="true"></i></a></td>

                        <td><input type="text" value="1" class="txtbox-quantity" name="amount" id="amount"></td>

                        <td width="30" align="center" bgcolor="#8C7D77"><a href="javascript:void(0);" title="Add" onClick="return addtocart('add');"><i class="fa fa-plus" aria-hidden="true"></i>

                          </a></td>

                      </tr>

                    </table>

                  </td>

                </tr>

              </table>



            </div>



            <div class="box-btn">

              <!--<a href="javascript:void(0);" class="bth-cart" id="add2Cart" onClick="return addtocart('cart');"> -->
              <a href="javascript:void(0);" class="bth-cart" id="add2Cart"><img src="images/icon/i_cart.png" alt="" /> ເພີ່ມໃສ່ກະຕ່າ </a>

              <a href="member_wishlist.php?id=<?php echo $this->item->id ?>" class="bth-wishlist "><img src="images/icon/i_wishlist_2.png" alt="" />ສິນຄ້າທີ່ຢາກໄດ້</a>

              <div class="clear"></div>

            </div>











          </div>

          <div class="clear"></div>

        </div>

        <!--//Model detail-->







      </div>

    </div>

    <!--end content-->



    <!--footer-->

    <div id="footer">

      <?php include('inc_footer.php'); ?>

    </div>

    <!--end footer-->



  </div>



  <!--  <script>

      var $ = document.querySelector.bind(document);

      window.onload = function () {

       Ps.initialize($('#default'));

 
        Ps.initialize($('#no-keyboard'), {

          handlers: ['click-rail', 'drag-scrollbar', 'wheel', 'touch']

        });

        Ps.initialize($('#click-and-drag'), {

          handlers: ['click-rail', 'drag-scrollbar']

        });

      };
    </script>-->

</body>

</html>