<div id="sidebar" class="sidebar responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
					   <h5>Naree Hand Bags</h5>
						<!-- /section:basics/sidebar.layout.shortcuts -->
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="<?php echo ($_GET["mn"] == '1') ? "active" : ""?>">
						<a href="index.php?mn=1&menu=<?php echo urlsafe_b64encode('Home');?>">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Home </span>
						</a>
					  <b class="arrow"></b>
					</li>
					<li class="<?php echo ($_GET["mn"] == '2') ? "active" : ""?>">
						<a href="banner_list.php?mn=2&menu=<?php echo urlsafe_b64encode('Banner Management');?>">
							<i class="menu-icon fa fa-picture-o"></i>
							<span class="menu-text">Banner</span>
						</a>
						<b class="arrow"></b>
					</li> 
					<li class="<?php echo ($_GET["mn"] == '3') ? "active" : ""?>">
						<a href="news_list.php?mn=3&menu=<?php echo urlsafe_b64encode('News');?>">
							<i class="menu-icon fa fa-newspaper-o"></i>
							<span class="menu-text"> News </span>
						</a>
						<b class="arrow"></b>
					</li>
                     <li class="<?php echo ($_GET["mn"] == '6') ? "active" : ""?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-briefcase"></i>
							<span class="menu-text"> Product </span>
						<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
						<li class="<?php echo ($_GET["sub"] == '1') ? "active" : ""?>">
							<a href="product_cate_list.php?mn=6&sub=1&parent_id=1&menu=<?php echo urlsafe_b64encode('Catelog');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Product Category
							  </a>
                              <b class="arrow"></b>
						</li>

						</ul>
					</li> 
                    <li class="<?php echo ($_GET["mn"] == '12') ? "active" : ""?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-briefcase"></i>
							<span class="menu-text"> Promotion </span>
						<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
						<li class="<?php echo ($_GET["sub"] == '1') ? "active" : ""?>">
                        <a href="promotion_cover.php?mn=12&sub=1&menu=<?php echo urlsafe_b64encode('Cover');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Promotion Cover
							  </a>
                              <b class="arrow"></b>
						</li>
                        <li class="<?php echo ($_GET["sub"] == '2') ? "active" : ""?>">
                        <a href="promotion_list.php?mn=12&sub=2&menu=<?php echo urlsafe_b64encode('Promotion');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Promotion List
							  </a>
                              <b class="arrow"></b>
						</li>

						</ul>
					</li> 
                    <li class="<?php echo ($_GET["mn"] == '10') ? "active" : ""?>">
						<a href="story_list.php?mn=10&menu=<?php echo urlsafe_b64encode('story Management');?>">
							<i class="menu-icon fa fa-share-alt"></i>
							<span class="menu-text"> Story</span>
						</a>
						<b class="arrow"></b>
					</li> 
					<li class="<?php echo ($_GET["mn"] == '4') ? "active" : ""?>">
						<a href="lookbook_list.php?mn=4&menu=<?php echo urlsafe_b64encode('Lookbook');?>">
							<i class="menu-icon fa fa-camera-retro"></i>
							<span class="menu-text"> Lookbook </span>
						</a>
						<b class="arrow"></b>
					</li>
                     <li class="<?php echo ($_GET["mn"] == '11') ? "active" : ""?>">
						<a href="shop_list.php?mn=11&menu=<?php echo urlsafe_b64encode('Shop Management');?>">
							<i class="menu-icon fa fa-map-marker"></i>
							<span class="menu-text"> Shop</span>
						</a>
						<b class="arrow"></b>
					</li> 
                    <li class="<?php echo ($_GET["mn"] == '5') ? "active" : ""?>">
					<a href="member_list.php?mn=5&menu=<?php echo urlsafe_b64encode('Member Management');?>">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> Member </span>
					</a>
						<b class="arrow"></b>
					</li> 
                   
                    <li class="<?php echo ($_GET["mn"] == '7') ? "active" : ""?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-shopping-cart"></i>
							<span class="menu-text"> Order </span>
						<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
						<li class="<?php echo ($_GET["sub"] == '1') ? "active" : ""?>">
								<a href="invoice_list.php?mn=7&sub=1&menu=<?php echo urlsafe_b64encode('Invoice');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Invoice List
							  </a>
                              <b class="arrow"></b>
						</li>
						</ul>
					</li>   
                    
                    <li class="<?php echo ($_GET["mn"] == '9') ? "active" : ""?>">
						<a href="admin_list.php?mn=9&listitem=admin&menu=<?php echo urlsafe_b64encode('User Management');?>">
							<i class="menu-icon fa fa-lock"></i>
							<span class="menu-text"> User Management </span>
						</a>
						<b class="arrow"></b>
					</li> 
                   <li class="<?php echo ($_GET["mn"] == '8') ? "active" : ""?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-money"></i>
							<span class="menu-text"> Config </span>
						<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>

						<ul class="submenu">
						<li class="<?php echo ($_GET["sub"] == '1') ? "active" : ""?>">
								<a href="exchange_rate.php?mn=8&sub=1&menu=<?php echo urlsafe_b64encode('Exchange Rate');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Exchange Rate
							  </a>
                              <b class="arrow"></b>
						</li>
                        <li class="<?php echo ($_GET["sub"] == '2') ? "active" : ""?>">
								<a href="delivery_fee.php?mn=8&sub=2&menu=<?php echo urlsafe_b64encode('Shipping Fee');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Shipping Fee
							  </a>
                              <b class="arrow"></b>
						</li>
						</ul>
					</li>    
                    
                    
				</ul><!-- /.nav-list -->

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>    
			</div>
            