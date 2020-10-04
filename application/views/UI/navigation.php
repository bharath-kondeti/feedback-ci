<?php
$baseurl=base_url();
$base_url=base_url();
?>
	<div class="topbar-menu">
		<div class="container">
			<div id="navigation">
				<!-- Navigation Menu-->
				<ul class="navigation-menu">
					<li class="dashboard find-active">
						<a class="stop-nav" href="<?php echo $baseurl.'dashboard_new'?>">
							<i class="fe-airplay mr-1"></i>
							<span> Dashboard </span>
						</a>
					</li>

					<li class="campaign find-active">
						<a class="stop-nav" href="<?php echo $baseurl.'Campaigns_new'?>">
							<i class="fe-activity mr-1"></i>
							<span> Campaigns </span>
						</a>
					</li>

					<li class="fb find-active">
						<a class="stop-nav" href="<?php echo $baseurl.'Feedback_new'?>">
							<i class="fe-check-square"></i>
							<span> Feedback </span>
						</a>
					</li>

					<li class="review find-active">
						<a class="stop-nav" href="<?php echo $baseurl.'Reviews_new'?>">
							<i class="fe-star"></i>
							<span> Reviews </span>
						</a>
					</li>

					<li class="has-submenu products find-active">
						<a href="#">
							<i class="fe-box"></i>Products <div class="arrow-down"></div></a>
							<ul class="submenu">
							<li class=inventory>
								<a href="<?php echo $baseurl.'inventory'?>">
								   <i class="fas fa-boxes"></i>
									<span> Inventory </span>
								</a>
							</li>
							<li class="orders">
								<a href="<?php echo $baseurl.'order'?>">
									<i class="fe-shopping-bag"></i>
									<span> Order </span>
								</a>
							</li>
							<li class="buyers">
								<a href="<?php echo $baseurl.'buyers'?>">
									<i class="fe-user"></i>
									<span>Buyers</span>
								</a>
							</li>
							<li class="feedbacks">
								<a href="<?php echo $baseurl.'feedback'?>">
									<i class="fe-send"></i>
									<span> Feedback</span>
								</a>
							</li>
							<li class="hijack">
								<a href="<?php echo $baseurl.'hijack'?>">
									<i class="fe-alert-triangle"></i>
									<span> Hijack Check</span>
								</a>
							</li>
						</ul>
					</li>

					<li class="has-submenu channels find-active">
						<a class="stop-nav" href="#"><i class="fe-file-text"></i>Channels<div class="arrow-down"></div></a>
						<ul class="submenu">
							<li class="stores">
								<a href="<?php echo $baseurl.'manage_stores'?>">
								  <i class="mdi mdi-store"></i>
									<span>Manage Stores </span>
								</a>
							</li>
						</ul>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</header>

<style type="text/css">
	.menu-active {
		background-color: #431c4a;
	}
</style>
<script type="text/javascript">
	$(document).ready(function () {
		if($("#dashboard").hasClass('dashboard')) {
			$('ul.navigation-menu').find('li.dashboard').addClass('menu-active');
		}

		if($("#campaign").hasClass('campaign')) {
			$('ul.navigation-menu').find('li.campaign').addClass('menu-active');
		}

		if($("#fb").hasClass('fb')) {
			$('ul.navigation-menu').find('li.fb').addClass('menu-active');
		}

		if($("#fb").hasClass('fb')) {
			$('ul.navigation-menu').find('li.fb').addClass('menu-active');
		}

		if($("#review").hasClass('review')) {
			$('ul.navigation-menu').find('li.review').addClass('menu-active');
		}

		if($("#inventory").hasClass('inventory')) {
			$('ul.navigation-menu').find('li.products').addClass('menu-active');
		}

		if($("#order").hasClass('order')) {
			$('ul.navigation-menu').find('li.products').addClass('menu-active');
		}

		if($("#buyers").hasClass('buyers')) {
			$('ul.navigation-menu').find('li.products').addClass('menu-active');
		}

		if($("#fbs").hasClass('fbs')) {
			$('ul.navigation-menu').find('li.products').addClass('menu-active');
		}

		if($("#hijack").hasClass('hijack')) {
			$('ul.navigation-menu').find('li.products').addClass('menu-active');
		}

		if($("#manage_stores").hasClass('manage_stores')) {
			$('ul.navigation-menu').find('li.channels').addClass('menu-active');
		}
	});
</script>
