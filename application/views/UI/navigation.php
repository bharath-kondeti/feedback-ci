	<?php
	$baseurl=base_url();
	$base_url=base_url();
	?>
	<div class="topbar-menu">
		<div class="container">
			<div id="navigation">
				<!-- Navigation Menu-->
				<ul class="navigation-menu">
					<li>
						<a href="<?php echo $baseurl.'dashboard_new'?>">
							<i class="fe-airplay mr-1"></i>
							<span> Dashboard </span>
						</a>
					</li>
					<!-----------------General Menu-------------------->
					<li>
						<a href="<?php echo $baseurl.'Campaigns_new'?>">
							<i class="fe-activity mr-1"></i>
							<span> Campaigns </span>
						</a>
					</li>
					<li>
						<a href="<?php echo $baseurl.'Feedback_new'?>">
							<i class="fe-check-square"></i>
							<span> Feedback </span>
						</a>
					</li>

					<li>
						<a href="<?php echo $baseurl.'Reviews_new'?>">
							<i class="fe-star"></i>
							<span> Reviews </span>
						</a>
					</li>
					<li class="has-submenu">
						<a href="#">
							<i class="fe-box"></i>Products <div class="arrow-down"></div></a>
							<ul class="submenu">
							<li>
								<a href="<?php echo $baseurl.'inventory'?>">
								   <i class="fas fa-boxes"></i>
									<span> Inventory </span>
								</a>
							</li>
							<li>
								<a href="<?php echo $baseurl.'order'?>">
									<i class="fe-shopping-bag"></i>
									<span> Order </span>
								  <!--  <span class="menu-arrow"></span> --->
								</a>
							</li>
							<li>
								<a href="<?php echo $baseurl.'buyers'?>">
									<i class="fe-user"></i>
									<span>Buyers</span>
								</a>
							</li>
							<li>
								<a href="<?php echo $baseurl.'feedback'?>">
									<i class="fe-send"></i>
									<span> Feedback</span>
								</a>
							</li>
							<li>
								<a href="<?php echo $baseurl.'hijack'?>">
									<i class="fe-alert-triangle"></i>
									<span> Hijack Check</span>
								</a>
							</li>
						</ul>
					</li>
					<!-----------------Stores Data-------------------->
					<li class="has-submenu">
						<a href="#"><i class="fe-file-text"></i>Channels<div class="arrow-down"></div></a>
						<ul class="submenu">
							<li>
								<a href="<?php echo $baseurl.'manage_stores'?>">
								  <i class="mdi mdi-store"></i>
									<span>Manage Stores </span>
								</a>
							</li>
						</ul>
					</li>
					<!-----------------Settings-------------------->

					<!-----------------Users-------------------->
					<!--<li class="has-submenu">
						<a href="#">
							<i class="fe-user"></i>My Account <div class="arrow-down"></div></a>
						<ul class="submenu">
							<li>
								<a href="<?php echo $baseurl.'user_profile'?>">
								  <i class="fe-users"></i>
									<span>Edit Profile </span>
								</a>
							</li>
							 <li>
								<a href="<?php echo $baseurl.'billing'?>">
								  <i class="mdi mdi-credit-card-plus"></i>
									<span>Billing</span>
								</a>
							</li>
						</ul>
					</li>-->



				</ul>
				<!-- End navigation menu -->

				<div class="clearfix"></div>
			</div>
			<!-- end #navigation -->
		</div>
		<!-- end container -->
	</div>
</header>
        <!-- End Navigation Bar-->
