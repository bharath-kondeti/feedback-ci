<?php
$baseurl = base_url();
$base_url = base_url();
?>
<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">
            <li class="dropdown notification-list">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle nav-link">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>
            <?php
            $store_info = $this->session->userdata('store_info');
            $store_country = $store_info['store_country'];
            ?>

			<li class="dropdown d-none d-lg-inline-block topbar-dropdown">
				<?php if($store_country != '') { ?>
                    <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
    				<?php
                    if ($store_country == 'UK') { echo "<img src='http://syndemos.com/app/assets/img/store_icons/Marketplace_UK.png' width='16' height='16'>";}
    				else if ($store_country=='IN') { echo "<img src='http://syndemos.com/app/assets/img/store_icons/Marketplace_IN.png' width='16' height='16'>";}
    				else if ($store_country=='US') { echo "<img src='http://syndemos.com/app/assets/img/store_icons/Marketplace_US.png' width='16' height='16'>";}
    				else if ($store_country=='DE') { echo "<img src='http://syndemos.com/app/assets/img/store_icons/Marketplace_DE.jpg' width='16' height='16'>";}
    				else if ($store_country=='ES') { echo "<img src='http://syndemos.com/app/assets/img/store_icons/Marketplace_ES.jpg' width='16' height='16'>";}
    				else if ($store_country=='FR') { echo "<img src='http://syndemos.com/app/assets/img/store_icons/Marketplace_FR.png' width='16' height='16'>";}
    				else if ($store_country=='IT') { echo "<img src='http://syndemos.com/app/assets/img/store_icons/Marketplace_IT.png' width='16' height='16'>";}
    				else { echo "<img src='http://syndemos.com/app/assets/img/store_icons/Marketplace_UK.png' width='16' height='16'>";}
    					echo " - ".$store_info['store_country'];
                        ?>
                    </a>
                <?php } ?>
				<div class="dropdown-menu dropdown-menu-right">

					<!-- item-->
					<?php
                    $user = $this->session->userdata('user_logged_in');
                    $stores = $this->common_model->get_users_stores($user['id']);
					//echo "<pre>"; print_r($stores);exit;
                    foreach ($stores as $str) {
						echo "<a class='dropdown-item'  href='" . $base_url . "stores/change_store/" . $str['store_id'] . "'>";
if ($str['country_code']=='UK') { echo "<img class='mr-1' src='http://syndemos.com/app/assets/img/store_icons/Marketplace_UK.png' width='16' height='16'>";}
else if ($str['country_code']=='IN') { echo "<img class='mr-1' src='http://syndemos.com/app/assets/img/store_icons/Marketplace_IN.png' width='16' height='16'>";}
else if ($str['country_code']=='US') { echo "<img class='mr-1' src='http://syndemos.com/app/assets/img/store_icons/Marketplace_US.png' width='16' height='16'>";}
else if ($str['country_code']=='DE') { echo "<img class='mr-1' src='http://syndemos.com/app/assets/img/store_icons/Marketplace_DE.jpg' width='16' height='16'>";}
else if ($str['country_code']=='ES') { echo "<img class='mr-1' src='http://syndemos.com/app/assets/img/store_icons/Marketplace_ES.jpg' width='16' height='16'>";}
else if ($str['country_code']=='FR') { echo "<img class='mr-1' src='http://syndemos.com/app/assets/img/store_icons/Marketplace_FR.png' width='16' height='16'>";}
else if ($str['country_code']=='IT') { echo "<img class='mr-1' src='http://syndemos.com/app/assets/img/store_icons/Marketplace_IT.png' width='16' height='16'>";}
else { echo "<img class='mr-1' src='http://syndemos.com/app/assets/img/store_icons/Marketplace_UK.png' width='16' height='16'>";}
echo $str['country_code'];
echo "</a>";
                    }
                    ?>

				</div>
			</li>

            <li class="dropdown d-none d-lg-inline-block topbar-dropdown">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <!--<img src="<?php echo $baseurl . 'assets/img/user-1.jpg' ?>" alt="user-image" class="rounded-circle"> -->
                    <span class="pro-user-name ml-1">
						<i class="fe-user"></i> <?php
						$user = $this->session->userdata('user_logged_in');
						echo $user['fname'];
						?><i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown " style="width:220px;">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <?php
                    $user = $this->session->userdata('user_logged_in');
                    //$this->load->model("dash_model");
                    $stores = $this->common_model->get_users_stores($user['id']);
                    //print_r($stores);
                    //die();

                    //    foreach($stores as $str)
                    //    {
                    //        echo "<a class='dropdown-item notify-item'  href='".$base_url."stores/change_store/".$str['store_id']."'>".$str['country_code']."(".$str['seller_id'].")</a>";
                    //    }

                    ?>
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">My Account</h6>
                    <a href="<?php echo $base_url . 'user_profile' ?>" class="dropdown-item notify-item ml-3 w-auto">
                        <i class="fe-users"></i>
                        <span>Edit Profile</span>
                    </a>
                    <a href="<?php echo $base_url . 'change_password' ?>" class="dropdown-item notify-item ml-3 w-auto">
                        <i class="fe-edit"></i>
                        <span>Change Password</span>
                    </a>
                    <!-- <a href="<?php echo $base_url . 'manage_stores' ?>" class="dropdown-item notify-item ">
                        <i class="mdi mdi-store"></i>
                        <span>Manage Stores</span>
                    </a> -->
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">Billing</h6>
                    <a href="<?php echo $baseurl . 'billing' ?>" class="dropdown-item notify-item ml-3 w-auto">
                        <i class="mdi mdi-credit-card-plus"></i>
                        <span>Billing Info</span>
                    </a>
                    <a href="#" class="dropdown-item notify-item ml-3 w-auto">
                        <i class="mdi mdi-library-books"></i>
                        <span>Invoice</span>
                    </a>
                    <a href="<?php echo $baseurl.'cancel'?>" class="dropdown-item notify-item ml-3 w-auto">
                        <i class="mdi mdi-cancel"></i>
                        <span>Cancel</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?php echo $baseurl.'preferences'?>" class="dropdown-item notify-item">
                        <i class="mdi mdi-settings"></i>
                        <span>Preferences</span>
                    </a>
                    <a href="<?php echo $base_url . 'contact_us' ?>" class="dropdown-item notify-item">
                        <i class="fe-mail"></i>
                        <span>Create Ticket</span>
                    </a>

                    <a href="<?php echo $base_url . 'manage_referal' ?>" class="dropdown-item notify-item">
                        <i class="fe-user-plus"></i>
                        <span>Refer a Friend</span>
                    </a>
                    <a href="<?php echo $base_url . 'user_auth/logout' ?>" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>

                    <!-- <a href="<?php echo $base_url . 'give_us_feedback' ?>" class="dropdown-item notify-item">
                        <i class="fe-star"></i>
                        <span>Feedback</span>
                    </a>

                    <a href="<?php echo $baseurl.'preferences'?>" class="dropdown-item notify-item">
                        <i class="mdi mdi-settings"></i>
                        <span>Settings</span>
                    </a> -->

                    

                    <!-- <a href="<?php echo $base_url . 'alert_manager' ?>" class="dropdown-item notify-item">
                        <i class="fe-alert-circle"></i>
                        <span>Alert</span>
                    </a> -->

                    <!-- item-->
                    



                </div>
            </li>




        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="<?php echo $base_url . 'dashboard_new' ?>" class="logo text-center">
                <span class="logo-lg">
                    <img src="<?php echo $baseurl . 'assets/img/feedback_logo_violet.png' ?>" alt="" height="35">
                </span>
                <span class="logo-sm">
                    <img src="<?php echo $baseurl . 'assets/img/logo_small.png' ?>" alt="" height="24">
                    <!--<a href="<?php echo $base_url . 'dashboard_new' ?>" style="font-weight:600;color:#fff;font-size:18px;margin-bottom:-20px;margin-left:5px;"> FeedbackGrid</a>-->
                </span>
            </a>
        </div>


    </div>
</div>



<div id="feedback" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-left:-200px;width:1000px">
            <div class="modal-header">
                <h4 class="modal-title">Give us a Feedback</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">

                <form id="cform" role="form" action='<?php echo $base_url . "internal_message/send_feedback" ?>'>
                    <div class="form-group">
                        <label for="comments">Feedback Message</label>
                        <textarea name="comment" class="form-control height-100" id="comments" cols="3" rows="5" placeholder="Enter your message…" title="Please enter your message (at least 10 characters)"></textarea>
                        <button name="submit" type="submit" class="btn btn-lg btn-primary" id="submit" style="width:100%;margin-top: 15px;">Send</button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
