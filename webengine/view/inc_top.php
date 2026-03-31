<?php @session_start();?>
<div id="navbar" class="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>
             <script>
        setInterval(function(){
		// $('#order_alert').html("43");
				$.get('order_alert.php', {
				action : 'ACCEPT',
				time : new Date().getTime()
				}, function(data) {
				//	alert(data);
				  $('#order_complete').html(data);
			  });
			  
			  $.get('order_alert.php', {
				action : 'ACCEPT',
				time : new Date().getTime()
				}, function(data) {
				//	alert(data);
				  $('#order_new').html(data);
			  });	
			  
			  $.get('member_count.php', {
				action : 'ACCEPT',
				time : new Date().getTime()
				}, function(data) {
				//	alert(data);
				  $('#member_new').html(data);
			  });
			  
			  	
		}, 5000);
		</script>

			<div class="navbar-container" id="navbar-container">
				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<!--<span class="sr-only">Toggle sidebar</span> -->

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href="#" class="navbar-brand">
						<small>
							<!--<i class="fa fa-leaf"></i>
							Ace Admin -->
                        <img src="../assets/img/logo_naree.jpg" height="25" />
                        BACKOFFICE </small>
					</a>

					<!-- /section:basics/navbar.layout.brand -->

					<!-- #section:basics/navbar.toggle -->

					<!-- /section:basics/navbar.toggle -->
				</div>

				<!-- #section:basics/navbar.dropdown -->
			  <div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="grey">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-money"></i>
								<span class="badge badge-grey" id="order_complete">0</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-money"></i>
									Order to complete
								</li>
								<li class="dropdown-footer">
									<a href="#">
										See All Order with details
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="purple">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important" id="order_new">0</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-bell"></i>
									Notification for New Order !
								</li>
								<li class="dropdown-footer">
									<a href="#">
										See Notification with details
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="green">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-users icon-animated-vertical"></i>
								<span class="badge badge-success" id="member_new">0</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-users"></i>
									New Member Register !
								</li>

		<!--						<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<li>
											<a href="#" class="clearfix">
                                            <img src="../assets/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Katarwut Ruangrit:</span>
														<BR />Register 02.07.2016 15:32
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>waiting for Activate</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="../assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Katarwut Ruangrit:</span>
														<BR />Register 02.07.2016 15:32
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>waiting for Activate</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="../assets/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Katarwut Ruangrit:</span>
														<BR />Register 02.07.2016 15:32
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>waiting for Activate</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
                                            <img src="../assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
                                            <span class="msg-body">
													<span class="msg-title">
														<span class="blue">Katarwut Ruangrit:</span>
														<BR />Register 02.07.2016 15:32
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>waiting for Activate</span>
													</span>
												</span>
											</a>
										</li>
                                        <li>
											<a href="#" class="clearfix">
                                            <img src="../assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
                                            <span class="msg-body">
													<span class="msg-title">
														<span class="blue">Katarwut Ruangrit:</span>
														<BR />Register 02.07.2016 15:32
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>waiting for Activate</span>
													</span>
												</span>
											</a>
										</li>
                                        <li>
											<a href="#" class="clearfix">
                                            <img src="../assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
                                            <span class="msg-body">
												<span class="msg-title">
														<span class="blue">Katarwut Ruangrit:</span>
														<BR />Register 02.07.2016 15:32
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>waiting for Activate</span>
													</span>
												</span>
											</a>
										</li>
                                        <li>
											<a href="#" class="clearfix">
                                            <img src="../assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
                                            <span class="msg-body">
													<span class="msg-title">
														<span class="blue">Katarwut Ruangrit:</span>
														<BR />Register 02.07.2016 15:32
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>waiting for Activate</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
                                            <img src="../assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
                                            <span class="msg-body">
													<span class="msg-title">
														<span class="blue">Katarwut Ruangrit:</span>
														<BR />Register 02.07.2016 15:32
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>waiting for Activate</span>
													</span>
												</span>
											</a>
										</li>
									</ul>
								</li>
 -->
								<li class="dropdown-footer">
									<a href="member_list.php">
										See all Member
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

					  <!-- #section:basics/navbar.user_menu -->
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="../assets/avatars/user.jpg" alt="<?php echo  $_SESSION['nameadmin']?>'s Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php echo  $_SESSION['nameadmin']?> <?php echo $_SESSION['surnameadmin']?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
						  </a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="admin_list.php?listitem=admin_edit&id=<?php echo $_SESSION['adminid']?>&menu=4Lij4Liy4Lii4LiK4Li34LmI4Lit4LmA4LiI4LmJ4Liy4Lir4LiZ4LmJ4Liy4LiX4Li14LmI&active=7">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="logout.php">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
					  </li>

						<!-- /section:basics/navbar.user_menu -->
					</ul>
				</div>

				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>