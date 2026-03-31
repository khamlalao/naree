<header class="header">
  <div class="header-top">
    <div class="brand-logo">
      <a href="index.php" class="ajax-link">
        <img
          src="/underrenovation/images/Naree_Logo.svg"
          alt="NR NAREE" />
      </a>
    </div>
    <div class="header-right-group">
      <div class="nav-right">
        <div class="top-icons">
          <a href="index.php">
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
          <a href="#" target="_blank">
            <img
              src="/underrenovation/images/Register.svg" />
          </a>
          <?php
          $current_page = basename($_SERVER['PHP_SELF']);

          function isActive($link_name, $current_page)
          {
            return ($link_name == $current_page) ? 'active' : '';
          }
          ?>

          <a href="/new-la/<?php echo $current_page; ?>" class="lang-switch">ພາສາລາວ</a>



        </div>
        <nav class="main-nav">
          <ul class="nav-links">
            <li class="dropdown">
              <button class="dropbtn">
                ALL PRODUCTS <i class="fa-solid fa-chevron-up"></i>
              </button>
              <div class="dropdown-content">
                <a href="/new-en/products_all.php">BAGS <span class="arrow">→</span></a>
                <a href="#">CLOTHES <span class="arrow">→</span></a>
                <a href="#">ACCESSORIES <span class="arrow">→</span></a>
              </div>
            </li>
            <li><a href="" class="pill-btn <?php echo isActive('', $current_page); ?>">EXCLUSIVE</a></li>
            <li><a href="" class="pill-btn <?php echo isActive('', $current_page); ?>">TIPS</a></li>
            <li><a href="/new-en/promotion-all.php" class="pill-btn <?php echo isActive('promotion-all.php', $current_page); ?>">PROMOTION</a></li>
            <li><a href="/new-en/naree_story.php" class="pill-btn <?php echo isActive('naree_story.php', $current_page); ?>">STORY</a></li>
            <li><a href="/new-en/lookbook.php" class="pill-btn <?php echo isActive('lookbook.php', $current_page); ?>">LOOK BOOK</a></li>
            <li><a href="/new-en/contact.php" class="pill-btn <?php echo isActive('contact.php', $current_page); ?>">CONTACT US</a></li>
          </ul>
        </nav>
      </div>
      <div class="right-fa-bars">
        <input type="checkbox" id="menu-toggle" class="dropdown-checkbox" />
        <a href="#" target="_blank">
          <img
            src="/underrenovation/images/Register.svg" class="register-icon" />
        </a>
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
                <a href="#">BAGS <span class="arrow">→</span></a>
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
              <li><a href="#">ADD USER</a></li>
            </div>

            <li><a href="#">EXCLUSIVE</a></li>
            <li><a href="#">TIPS</a></li>
            <li><a href="/new-en/promotion-all.php">PROMOTION</a></li>
            <li><a href="/new-en/naree_story.php">STORY</a></li>
            <li><a href="/new-en/lookbook.php">LOOK BOOK</a></li>
            <li><a href="/new-en/contact.php">CONTACT US</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>