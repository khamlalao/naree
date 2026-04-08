<?php
require_once "common.inc.php";
require_once DIR . "library/config/sessionstart.php";
require_once DIR . "library/adodb5/adodb.inc.php";
require_once DIR . "library/adodb5/adodb-active-record.inc.php";
require_once DIR . "library/class/class.GenericEasyPagination.php";
require_once DIR . "library/config/config.php";
require_once DIR . "library/config/connect.php";
require_once DIR . "library/extension/extension.php";
require_once DIR . "library/extension/utility.php";
require_once DIR . "library/extension/lang.php";
require_once DIR . "library/config/rewrite.php";
require_once DIR . "library/Savant3.php";
?>
<?php

global $db;

#$db->debug=1;

#print_r($_SESSION);



ADOdb_Active_Record::SetDatabaseAdapter($db);

// status 1 = 'la' , 2 = 'en' , 3 = 'all'

$sql = "SELECT * FROM product_categories m WHERE 1 = 1 AND (m.status = '1' OR  m.status = '3') ORDER BY m.sequence ASC";
$rs = $db->Execute($sql);
$itemList = $rs ? $rs->GetAssoc() : [];
$itemListCount = $rs ? $rs->maxRecordCount() : 0;



if (isset($_SESSION['session_login']) && $_SESSION['session_login'] != NULL) {

  //$sql2 = "SELECT * FROM session_orders m WHERE 1 = 1 AND m.session_code =  ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ";

  //$stmt2 = $db->Prepare($sql2);

  //$rs2 = $db->Execute($stmt2,array($_SESSION['session_login']));

  //$gettmp["your-item"] = $rs2->maxRecordCount();
  $sql = "SELECT sum(m.amount) as total_amount FROM session_orders m WHERE 1 = 1 AND m.session_code =  ? AND (m.invoice_id = '' OR m.invoice_id IS NULL) AND (m.invoice_code = '' OR m.invoice_code IS NULL) ";
  $stmt = $db->Prepare($sql);
  $rs = $db->Execute($stmt, array($_SESSION['session_login']));
  $itemOrder = $rs->GetAssoc();
  $gettmp['total_amount'] = $rs->fields['total_amount'];
  //$template->total_amount = $gettmp['total_amount'];	

}

?>
<script type="text/javascript">
  jQuery(document).ready(function($) {

    // ===============================
    // ✅ UPDATE CART NUMBER FUNCTION
    // ===============================
    function updateCartNum() {
      $.get('inc_your_item.php', {
        time: new Date().getTime()
      }, function(data) {
        var count = parseInt(data) || 0;

        if (count <= 0) {
          $('.yourcart-num').hide();
        } else {
          $('.yourcart-num').show().text(count);
        }
      });
    }

    // ===============================
    // ✅ LOAD CART ON PAGE LOAD
    // ===============================
    updateCartNum();

    // ===============================
    // ✅ ADD TO CART BUTTON
    // ===============================
    $('#add2Cart').click(function() {

      var num = parseInt($('#amount').val()) || 1;
      var id = '<?php echo isset($_GET["id"]) ? htmlspecialchars($_GET["id"]) : "" ?>';

      $.get('inc_cart_add.php', {
        id: id,
        action: 'additem',
        amount: num,
        time: new Date().getTime()
      }, function() {

        // Refresh cart UI
        $.get('inc_cart_render.php', {
          time: new Date().getTime()
        }, function(data) {
          $('#default_cart').html(data);
        });

        // Refresh totals
        $.get('inc_cash_amount.php', {
          rate: 'USD',
          time: new Date().getTime()
        }, function(data) {
          $('#cashAmount').html(data || '');
        });

        $.get('inc_cash_amount.php', {
          rate: 'LAK',
          time: new Date().getTime()
        }, function(data) {
          $('#cashAmount_KIP').html(data || '');
        });

        // ✅ UPDATE CART NUMBER
        updateCartNum();
      });

    });

    // ===============================
    // ✅ REMOVE ITEM FROM CART
    // ===============================
    window.removeItem = function(id) {

      $.get('inc_cart_remove.php', {
        id: id,
        action: 'remove',
        time: new Date().getTime()
      }, function() {

        // Refresh cart
        $.get('inc_cart_render.php', {
          time: new Date().getTime()
        }, function(data) {
          $('#default_cart').html(data);
        });

        // Update totals
        $.get('inc_cash_amount.php', {
          rate: 'USD',
          time: new Date().getTime()
        }, function(data) {
          $('#cashAmount').html(data || '');
        });

        $.get('inc_cash_amount.php', {
          rate: 'LAK',
          time: new Date().getTime()
        }, function(data) {
          $('#cashAmount_KIP').html(data || '');
        });

        // ✅ UPDATE CART NUMBER
        updateCartNum();
      });
    };

    // ===============================
    // ✅ CHANGE QUANTITY INSIDE CART
    // ===============================
    window.addcart = function(action, id) {

      var input = $('#amount' + id);
      var value = parseInt(input.val()) || 1;

      if (action === 'add') value++;
      if (action === 'del' && value > 1) value--;

      input.val(value);

      $.get('inc_cart_render.php', {
        id: id,
        amount: value,
        time: new Date().getTime()
      }, function(data) {
        $('#default_cart').html(data);
        updateCartNum();
      });
    };

    // ===============================
    // ✅ CHANGE AMOUNT BEFORE ADD
    // ===============================
    window.addtocart = function(type) {

      var input = $('#amount');
      var value = parseInt(input.val()) || 1;

      if (type === 'add') value++;
      if (type === 'del' && value > 1) value--;

      input.val(value);
    };

  });
</script>

<header class="header">
  <div class="header-top">
    <div class="brand-logo">
      <a href="index.php">
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
                src="/underrenovation/images/tiktok_icon_3.png" />
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
          <a href="member_login.php">
            <img
              src="/underrenovation/images/user_add_icons.svg" />
          </a>
          <div class="mn-desktop-cart" ;>
            <a href="#nogo" id="mycart">

              <img src="/underrenovation/images/register.svg"  alt="Cart" />

              <!-- RED BADGE -->
              <span class="yourcart-num num-items" style="display:none;"></span>

            </a>
          </div>
          <?php
          $current_page = basename($_SERVER['PHP_SELF']);

          function isActive($link_name, $current_page)
          {
            return ($link_name == $current_page) ? 'active' : '';
          }
          ?>

          <li class="lang-switch"><a href="<?php echo str_replace('/new-en/', '/new-la/', $_SERVER['REQUEST_URI']) ?>" style="text-align:center;">ພາສາລາວ </a></li>



        </div>
        <nav class="main-nav">
          <ul class="nav-links">
            <li class="dropdown">
              <button class="dropbtn">
                ALL PRODUCTS <i class="fa-solid fa-chevron-up"></i>
              </button>
              <div class="dropdown-content">
                <a href="products_all.php">BAGS <span class="arrow">→</span></a>
                <a href="#">CLOTHES <span class="arrow">→</span></a>
                <a href="#">ACCESSORIES <span class="arrow">→</span></a>
              </div>
            </li>
            <li><a href="" class="pill-btn <?php echo isActive('', $current_page); ?>">EXCLUSIVE</a></li>
            <li><a href="" class="pill-btn <?php echo isActive('', $current_page); ?>">TIPS</a></li>
            <li><a href="promotion-all.php" class="pill-btn <?php echo isActive('promotion-all.php', $current_page); ?>">PROMOTION</a></li>
            <li><a href="naree_story.php" class="pill-btn <?php echo isActive('naree_story.php', $current_page); ?>">STORY</a></li>
            <li><a href="lookbook.php" class="pill-btn <?php echo isActive('lookbook.php', $current_page); ?>">LOOK BOOK</a></li>
            <li><a href="contact.php" class="pill-btn <?php echo isActive('contact.php', $current_page); ?>">CONTACT US</a></li>
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
                ALL PRODUCTS <i class="fa-solid fa-chevron-up"></i>
              </label>
              <div class="dropdown-content">
                <a href="products_all.php">BAGS <span class="arrow">→</span></a>
                <a href="#">CLOTHES <span class="arrow">→</span></a>
                <a href="#">ACCESSORIES <span class="arrow">→</span></a>
              </div>
            </li>
            <div class="icon-name-menu">
              <li><a href="index.php">HOME</a></li>
              <li><a href="login.php">LOGIN</a></li>
              <li><a href="https://www.facebook.com/nareehandbags">FACEBOOK</a></li>
              <li><a href="https://www.instagram.com/nareehandbags/?hl=th">INSTAGRAM</a></li>
              <li><a href="https://www.tiktok.com/@naree.official">TIKTOK</a></li>
              <li><a href="https://wa.me/8562023071333">WHATSAPP</a></li>
              <li><a href="https://line.me/R/ti/p/nareehandbag">LINE</a></li>
              <li><a href="register.php">ADD USER</a></li>

            </div>

            <li><a href="#">EXCLUSIVE</a></li>
            <li><a href="#">TIPS</a></li>
            <li><a href="promotion-all.php">PROMOTION</a></li>
            <li><a href="naree_story.php">STORY</a></li>
            <li><a href="lookbook.php">LOOK BOOK</a></li>
            <li><a href="contact.php">CONTACT US</a></li>
            <li class="lang-switch-2"><a href="<?php echo str_replace('/new-en/', '/new-la/', $_SERVER['REQUEST_URI']) ?>" style="text-align:center;">ພາສາລາວ </a></li>
            <li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>