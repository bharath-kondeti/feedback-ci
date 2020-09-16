 <?php
$baseurl=base_url();
$base_url=base_url();
//print_r($stripe_client_token);
//die();
?>
 <script src="https://checkout.stripe.com/checkout.js"></script>

 <style type="text/css">
 	.pricing .card {
 		border: none;
 		border-radius: 1rem;
 		transition: all 0.2s;
 		box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
 	}

 	.pricing hr {
 		margin: 1.5rem 0;
 	}

 	.pricing .card-title {
 		margin: 0.5rem 0;
 		font-size: 20px;
 		letter-spacing: .1rem;
 		font-weight: bold;
 	}

 	.pricing .card-price {
 		font-size: 3rem;
 		margin: 0;
 	}

 	.pricing .card-price .period {
 		font-size: 0.8rem;
 	}

 	.pricing ul li {
 		margin-bottom: 1rem;
 	}

 	.pricing .text-muted {
 		opacity: 0.7;
 	}

 	.pricing .btn {
 		font-size: 80%;
 		border-radius: 5rem;
 		letter-spacing: .1rem;
 		font-weight: bold;
 		padding: 1rem;
 		opacity: 0.7;
 		transition: all 0.2s;
 	}

 	/* Hover Effects on Card */

 	@media (min-width: 992px) {
 		.pricing .card:hover {
 			margin-top: -.25rem;
 			margin-bottom: .25rem;
 			box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
 		}

 		.pricing .card:hover .btn {
 			opacity: 1;
 		}
 	}

 	.pb-5,
 	.py-5 {
 		padding-bottom: 15px !important;
 		padding-top: 15px !important;
 	}

 	.stripe-button-el {
 		background-image: linear-gradient(#007bff, #007bff 85%, #007bff);
 		margin-left: 31px;
 		border-radius: 50px;
 	}

 	.stripe-button-el span {
 		width: 227px;
 		position: relative;
 		height: 49px;
 		line-height: 49px;
 		background: #007bff;
 		background-image: -webkit-linear-gradient(#007bff, #007bff 85%, #007bff);
 		background-image: -moz-linear-gradient(#007bff, #007bff 85%, #007bff);
 		background-image: -ms-linear-gradient(#007bff, #007bff 85%, #007bff);
 		background-image: -o-linear-gradient(#007bff, #007bff 85%, #007bff);
 		background-image: -webkit-linear-gradient(#007bff, #007bff 85%, #007bff);
 		background-image: -moz-linear-gradient(#007bff, #007bff 85%, #007bff);
 		background-image: -ms-linear-gradient(#007bff, #007bff 85%, #007bff);
 		background-image: -o-linear-gradient(#007bff, #007bff 85%, #007bff);
 		background-image: linear-gradient(#007bff, #007bff 85%, #007bff);
 		font-size: 16px;
 		color: #FFFFFF;
 		font-weight: bold;
 		font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
 		text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
 		-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25);
 		-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25);
 		-ms-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25);
 		-o-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25);
 		box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25);
 		-webkit-border-radius: 0px;
 		-moz-border-radius: 0px;
 		-ms-border-radius: 0px;
 		-o-border-radius: 0px;
 		border-radius: 0px;
 		font-size: 80%;
 		border-radius: 5rem;
 		letter-spacing: .1rem;
 		font-weight: bold;
 		transition: all 0.2s;
 		padding: .0px;
 	}

 </style>

 <div class="wrapper" ng-controller='acCtrl'>

 	<div class="modal fade" id="load_money">
 		<div class="modal-dialog" role="document">
 			<div class="modal-content">
 				<div class="modal-header">
 					<h4>Load Money</h4>
 				</div>
 				<div class="modal-body">
 					<div class="row">
 						<div class="col-sm-12">
 							<b>Select Amount</b><br>
 							<select ng-model='load_amt' class="form-control">
 								<option value='10'>10</option>
 								<option value='20'>20</option>
 								<option value='30'>30</option>
 								<option value='50'>50</option>
 								<option value='10'>100</option>
 								<option value='200'>200</option>
 							</select>

 							<br>


 						</div>
 					</div>
 				</div>
 				<div class="modal-footer no-border">
 					<button class="btn btn-info" ng-click='load_money_using_razor_pay()'>Pay</button>
 				</div>
 			</div>
 		</div>
 	</div>
 	<div class="content">

 		<!-- Start Content-->
 		<div class="container-fluid">

 			<!-- start page title -->
 			<div class="row">
 				<div class="col-12">
 					<div class="page-title-box">
 						<div class="page-title-right">
 							<!-- <button style="float:right;margin-right:13px" data-toggle="modal" data-target="#load_money" class="btn btn-primary waves-effect waves-light mt-4 mb-2 width-sm">Pay</button>   -->
 						</div>
 						<h4 class="page-title">Billing</h4>
 					</div>
 				</div>
 			</div>

 			<div class="row">
 				<div class="col-sm-2">
 					<div class="card-box">
 						<div class="h4">
 							App
 						</div>
 						<div class="ml-2">
 							<ul class="nav flex-column">
 								<li class="nav-item  hover-nav">
 									<a class="nav-link" href="#">Blacklist</a>
 								</li>
 								<li class="nav-item hover-nav">
 									<a class="nav-link active"
 										href="<?php echo $baseurl.'preferences'?>">Preferences</a>
 								</li>
 							</ul>
 						</div>
 						<div class="h4">
 							Billing
 						</div>
 						<div class="ml-2">
 							<ul class="nav flex-column">
 								<li class="nav-item hover-nav">
 									<a class="nav-link" href="<?php echo $baseurl . 'billing' ?>">Billing Info</a>
 								</li>
 								<li class="nav-item hover-nav">
 									<a class="nav-link" href="#">Invoices</a>
 								</li>
 								<!-- <li class="nav-item hover-nav">
                  <a class="nav-link" href="#">My Plan</a>                  
                </li> -->
 								<li class="nav-item hover-nav">
 									<a class="nav-link" href="<?php echo $baseurl.'cancel'?>">Cancel</a>
 								</li>
 							</ul>
 						</div>
 						<div class="h4">
 							My Account
 						</div>
 						<div class="ml-2">
 							<ul class="nav flex-column">
 								<li class="nav-item hover-nav">
 									<a class="nav-link" href="<?php echo $base_url . 'change_password' ?>">Change
 										Password</a>
 								</li>
 							</ul>
 						</div>
 						<div class="h4">
 							Promotions
 						</div>
 						<div class="ml-2">
 							<ul class="nav flex-column">
 								<li class="nav-item hover hover-nav">
 									<a class="nav-link" href="<?php echo $base_url . 'manage_referal' ?>">Refer a
 										friend</a>
 								</li>
 							</ul>
 						</div>
 					</div>
 				</div>
 				<div class="col-10">
 					<div class="row">
 						<div class="col-md-12">
 							<div class="col-md-12">
 								<div class="row">


 									<div class="col-sm-4">
 										<div class="card">
 											<div class="card-body" style="padding: 20px;">
 												<div class="media justify-content-between">
 													<div>
 														<p class="">Subscription</p>
 														<h2 ng-if="stripe_plan.sub_status_new.length > 0"
 															class="font-size-28 font-weight-light">
 															{{stripe_plan.sub_status_new}}</h2>
 														<h2 ng-if="stripe_plan.status_new2=='Inactive' && paypal_details.status_new=='Inactive'"
 															class="font-size-28 font-weight-light">Inactive
 														</h2>
 														<h2 ng-if="paypal_details.sub_status_new2.length > 0"
 															class="font-size-28 font-weight-light">
 															{{paypal_details.sub_status_new2}}</h2>
 													</div>

 												</div>
 											</div>
 										</div>
 									</div>

 									<div class="col-sm-4">
 										<div class="card">
 											<div class="card-body" style="padding: 20px;">
 												<div class="media justify-content-between">
 													<div>
 														<p class="">Current Plan</p>

 														<h2 ng-if="plan.plan_name.length > 0"
 															class="font-size-28 font-weight-light">
 															{{plan.plan_name}}</h2>
 														<h2 ng-if="plan.plan_name.length <= 0"
 															class="font-size-28 font-weight-light">None</h2>

 														<p style="margin-top:-35px;float:right;margin-left:250px"
 															ng-if="plan.plan_status =='Paid'"
 															class="font-size-28 font-weight-light">Paid</p>
 														<p style="margin-top:-35px;float:right;margin-left:210px"
 															ng-if="plan.plan_status =='Free Trail'"
 															class="font-size-28 font-weight-light">Free
 															Trail</p>

 													</div>

 												</div>
 											</div>
 										</div>
 									</div>



 									<div class="col-sm-4">
 										<div class="card">
 											<div class="card-body" style="padding: 20px;">
 												<div class="media justify-content-between">
 													<div>
 														<p class="">Start Date</p>
 														<h2 ng-if="plan.subscribed_on.length > 0"
 															class="font-size-28 font-weight-light">
 															{{plan.subscribed_on}}</h2>
 														<h2 ng-if="plan.subscribed_on.length <= 0"
 															class="font-size-28 font-weight-light">None</h2>
 													</div>

 												</div>
 											</div>
 										</div>
 									</div>

 									<div class="col-sm-4">
 										<div class="card">
 											<div class="card-body" style="padding: 20px;">
 												<div class="media justify-content-between">
 													<div>
 														<p class="">End Date</p>
 														<h2 ng-if="plan.valid_till.length > 0"
 															class="font-size-28 font-weight-light">
 															{{plan.valid_till}}</h2>
 														<h2 ng-if="plan.valid_till.length <= 0"
 															class="font-size-28 font-weight-light">None</h2>
 													</div>

 												</div>
 											</div>
 										</div>
 									</div>


 									<div class="col-sm-4">
 										<div class="card">
 											<div class="card-body" style="padding: 20px;">
 												<div class="media justify-content-between">
 													<div>
 														<p class="">Email Available</p>
 														<h2 ng-if="plan.remaining_email.length > 0"
 															class="font-size-28 font-weight-light">
 															{{plan.remaining_email}}</h2>
 														<h2 ng-if="plan.remaining_email.length <= 0"
 															class="font-size-28 font-weight-light">None</h2>
 													</div>

 												</div>
 											</div>
 										</div>
 									</div>

 									<div class="col-sm-4">
 										<div class="card">
 											<div class="card-body" style="padding: 20px;">
 												<div class="media justify-content-between">
 													<div>
 														<p class="">Email Sent</p>
 														<h2 ng-if="plan.sent_count.length > 0"
 															class="font-size-28 font-weight-light">
 															{{plan.sent_count}}</h2>
 														<h2 ng-if="plan.sent_count.length <= 0"
 															class="font-size-28 font-weight-light">None</h2>
 													</div>

 												</div>
 											</div>
 										</div>
 									</div>










 								</div>
 							</div>
 						</div>
 					</div>
 					<div class="row justify-content-center">
 						<div class="col-xl-11">



 							<!-- Plans -->
 							<div class="row my-3">
 								<div class="col-md-3">
 									<div class="card card-pricing">
 										<div class="card-body text-center">
 											<!-- <p class="card-pricing-plan-name font-weight-bold text-uppercase">Professional Pack</p>  -->
 											<span class="card-pricing-icon text-primary">
 												<i class="fe-award"></i>
 											</span>
 											<h2 class="card-pricing-price">1 <span>/ Month</span></h2>
 											<ul class="card-pricing-features">
 												<li>1,000 Emails </li>
 												<li>7 Market Places </li>
 												<li>Unlimited Campaigns </li>
 												<li>Unlimited Orders </li>
 												<li>Negative Feedback Alerts </li>
 												<li>Experience & Expert </li>
 												<li>Support Team </li>
 											</ul>

 											<button
 												ng-if="stripe_plan.sub_status=='active' && stripe_plan.plan_name=='Micro'"
 												ng-click='cancel_stripe_subscription()'
 												class="btn btn-success waves-effect waves-light mt-4 mb-2 width-sm">Active
 												Plan</button>

 											<button
 												ng-if="paypal_details.status =='ACTIVE' && paypal_details.plan_name=='Micro'"
 												ng-click='cancel_payapal_subscription()'
 												class="btn btn-success waves-effect waves-light mt-4 mb-2 width-sm">Active
 												Plan</button>

 											<button ng-if="stripe_plan.status_new2 =='Inactive'"
 												ng-click='load_money_using_razor_pay(1)'
 												class="btn btn-primary waves-effect waves-light mt-4 mb-2 width-sm">Pay
 												With Stripe</button>

 											<button ng-if="paypal_details.status_new =='Inactive' "
 												ng-click='subscribe(1)'
 												class="btn btn-warning waves-effect waves-light mt-4 mb-2 width-sm">Pay
 												With Paypal</button>

 										</div>
 									</div> <!-- end Pricing_card -->
 								</div> <!-- end col -->


 								<div class="col-md-3">
 									<div class="card card-pricing">
 										<div class="card-body text-center">
 											<!-- <p class="card-pricing-plan-name font-weight-bold text-uppercase">Professional Pack</p>  -->
 											<span class="card-pricing-icon text-primary">
 												<i class="fe-award"></i>
 											</span>
 											<h2 class="card-pricing-price">2 <span>/ Month</span></h2>
 											<ul class="card-pricing-features">
 												<li>4,000 Emails </li>
 												<li>7 Market Places </li>
 												<li>Unlimited Campaigns </li>
 												<li>Unlimited Orders </li>
 												<li>Negative Feedback Alerts </li>
 												<li>Experience & Expert </li>
 												<li>Support Team </li>
 											</ul>
 											<button
 												ng-if="stripe_plan.sub_status=='active' && stripe_plan.plan_name=='Small'"
 												ng-click='cancel_stripe_subscription()'
 												class="btn btn-success waves-effect waves-light mt-4 mb-2 width-sm">Active
 												Plan</button>

 											<button
 												ng-if="paypal_details.status =='ACTIVE' && paypal_details.plan_name=='Small'"
 												ng-click='cancel_payapal_subscription()'
 												class="btn btn-success waves-effect waves-light mt-4 mb-2 width-sm">Active
 												Plan</button>

 											<button ng-if="stripe_plan.plan_name!='Small'"
 												ng-click='load_money_using_razor_pay(1)'
 												class="btn btn-primary waves-effect waves-light mt-4 mb-2 width-sm">Pay
 												With Stripe</button>

 											<button ng-if="paypal_details.status_new =='Inactive' "
 												ng-click='subscribe(1)'
 												class="btn btn-warning waves-effect waves-light mt-4 mb-2 width-sm">Pay
 												With Paypal</button>
 										</div>
 									</div> <!-- end Pricing_card -->
 								</div> <!-- end col -->


 								<div class="col-md-3">
 									<div class="card card-pricing card-pricing-recommended">
 										<div class="card-body text-center">
 											<!--   <p class="card-pricing-plan-name font-weight-bold text-uppercase">Business Pack</p> -->
 											<span class="card-pricing-icon text-white">
 												<i class="fe-award"></i>
 											</span>
 											<h2 class="card-pricing-price text-white">3 <span>/ Month</span>
 											</h2>
 											<ul class="card-pricing-features">
 												<li>10,000 Emails </li>
 												<li>7 Market Places </li>
 												<li>Unlimited Campaigns </li>
 												<li>Unlimited Orders </li>
 												<li>Negative Feedback Alerts </li>
 												<li>Experience & Expert </li>
 												<li>Support Team </li>
 											</ul>

 											<button
 												ng-if="stripe_plan.sub_status=='active' && stripe_plan.plan_name=='Medium'"
 												ng-click='cancel_stripe_subscription()'
 												class="btn btn-light waves-effect waves-effect mt-4 mb-2 width-sm">Active
 												Plan</button>

 											<button
 												ng-if="paypal_details.status =='ACTIVE' && paypal_details.plan_name=='Medium'"
 												ng-click='cancel_payapal_subscription()'
 												class="btn btn-light waves-effect waves-effect mt-4 mb-2 width-sm">Active
 												Plan</button>


 											<button ng-if="stripe_plan.plan_name!='Medium'"
 												ng-click='load_money_using_razor_pay(1)'
 												class="btn btn-light waves-effect waves-light mt-4 mb-2 width-sm">Pay
 												With Stripe</button>

 											<button ng-if="paypal_details.status_new =='Inactive'"
 												ng-click='subscribe(1)'
 												class="btn btn-light waves-effect waves-light mt-4 mb-2 width-sm">Pay
 												With Paypal</button>



 										</div>
 									</div> <!-- end Pricing_card -->
 								</div> <!-- end col -->




 								<div class="col-md-3">
 									<div class="card card-pricing">
 										<div class="card-body text-center">
 											<!-- <p class="card-pricing-plan-name font-weight-bold text-uppercase">Professional Pack</p>  -->
 											<span class="card-pricing-icon text-primary">
 												<i class="fe-award"></i>
 											</span>
 											<h2 class="card-pricing-price">4 <span>/ Month</span></h2>
 											<ul class="card-pricing-features">
 												<li>25,000 Emails </li>
 												<li>7 Market Places </li>
 												<li>Unlimited Campaigns </li>
 												<li>Unlimited Orders </li>
 												<li>Negative Feedback Alerts </li>
 												<li>Experience & Expert </li>
 												<li>Support Team </li>
 											</ul>
 											<button
 												ng-if="stripe_plan.sub_status=='active' && stripe_plan.plan_name=='Large'"
 												ng-click='cancel_stripe_subscription()'
 												class="btn btn-success waves-effect waves-light mt-4 mb-2 width-sm">Active
 												Plan</button>

 											<button
 												ng-if="paypal_details.status =='ACTIVE' && paypal_details.plan_name=='Large'"
 												ng-click='cancel_payapal_subscription()'
 												class="btn btn-success waves-effect waves-light mt-4 mb-2 width-sm">Active
 												Plan</button>

 											<button ng-if="stripe_plan.plan_name!='Large'"
 												ng-click='load_money_using_razor_pay(1)'
 												class="btn btn-primary waves-effect waves-light mt-4 mb-2 width-sm">Pay
 												With Stripe</button>

 											<button ng-if="paypal_details.status_new =='Inactive' "
 												ng-click='subscribe(1)'
 												class="btn btn-warning waves-effect waves-light mt-4 mb-2 width-sm">Pay
 												With Paypal</button>
 										</div>
 									</div> <!-- end Pricing_card -->
 								</div> <!-- end col -->



 							</div>
 							<!-- end row -->

 						</div> <!-- end col-->
 					</div>
 				</div>
 			</div>
 			<!-- end row -->

 		</div> <!-- container -->

 	</div> <!-- content -->




 	<script type="text/javascript">
 		crawlApp.factory("acFactory", function ($http, $q) {

 			var get_data = function () {
 				var dataset_path = "<?php echo $baseurl.'billing/get_plan_data'?>";
 				var deferred = $q.defer();
 				var path = dataset_path;

 				$http.get(path)
 					.success(function (data, status, headers, config) {
 						deferred.resolve(data);
 					})
 					.error(function (data, status, headers, config) {
 						deferred.reject(status);
 					});

 				return deferred.promise;
 			};
 			var subscribe = function (plan_id) {
 				var search_path = "<?php echo $baseurl.'billing/new_plan/';?>";
 				return $http({
 					method: "post",
 					url: search_path,
 					data: {
 						plan_id: plan_id
 					}
 				});

 			};
 			var load_money = function (amount) {
 				var search_path = "<?php echo $baseurl.'billing/load_money/';?>";
 				return $http({
 					method: "post",
 					url: search_path,
 					data: {
 						amount: amount
 					}
 				});

 			};

 			var buy_addon = function (amount) {
 				var search_path = "<?php echo $baseurl.'billing/buy_addon/';?>";
 				return $http({
 					method: "post",
 					url: search_path,
 					data: {
 						amount: amount
 					}
 				});

 			};

 			var change_addon_status = function (addon_status) {
 				var search_path = "<?php echo $baseurl.'billing/toggle_addon_status/';?>";
 				return $http({
 					method: "post",
 					url: search_path,
 					data: {
 						addon_status: addon_status
 					}
 				});

 			};

 			var capture_payment = function (load_amt, tax_amt, payment_id, plan_id) {
 				var search_path = "<?php echo $baseurl.'billing/capture_payment/';?>";
 				return $http({
 					method: "post",
 					url: search_path,
 					data: {
 						load_amt: load_amt,
 						tax_amt: tax_amt,
 						payment_id: payment_id,
 						plan_id: plan_id
 					}
 				});

 			};

 			var get_subscription_id = function (plan_id) {
 				var search_path = "<?php echo $baseurl.'billing/get_subscription_id/';?>";
 				return $http({
 					method: "post",
 					url: search_path,
 					data: {
 						plan_id: plan_id
 					}
 				});

 			};

 			var authorize_subscription = function (subscription_id, razorpay_payment_id, razorpay_subscription_id,
 				razorpay_signature) {
 				var search_path = "<?php echo $baseurl.'billing/authorize_subscription/';?>";
 				return $http({
 					method: "post",
 					url: search_path,
 					data: {
 						subscription_id: subscription_id,
 						payment_id: razorpay_payment_id,
 						r_subscription_id: razorpay_subscription_id,
 						razorpay_signature: razorpay_signature
 					}
 				});
 			};

 			var cancel_stripe_subscription = function () {
 				var search_path = "<?php echo $baseurl.'billing/cancel_stripe_subscription/';?>";
 				return $http({
 					method: "post",
 					url: search_path,
 					data: {
 						1: 1
 					}
 				});

 			};
 			var cancel_payapal_subscription = function () {
 				var search_path = "<?php echo $baseurl.'billing/cancel_payapal_subscription/';?>";
 				return $http({
 					method: "post",
 					url: search_path,
 					data: {
 						1: 1
 					}
 				});

 			};


 			return {
 				get_data: get_data,
 				subscribe: subscribe,
 				capture_payment: capture_payment,
 				cancel_payapal_subscription: cancel_payapal_subscription,
 				cancel_stripe_subscription: cancel_stripe_subscription
 			};
 		});
 		crawlApp.controller("acCtrl", function acCtrl($window, $scope, acFactory, $sce, $q, $timeout, Upload) {
 			$scope.load_amt = '30';
 			$scope.tax_amt = ($scope.load_amt * (18 / 100));
 			$scope.addon_amt = '500';
 			$scope.selected_plan = '3';
 			$scope.cur_bal = '';

 			$scope.plan_history = [];
 			$scope.plan = {};
 			$scope.get_predata = function () {
 				var promise = acFactory.get_data();
 				promise.then(
 					function (response) {

 						if (response.status_code == '1') {
 							$scope.plan = response.plan[0];
 							$scope.addon = response.addon[0];
 							$scope.plan_history = response.plan_history;
 							$scope.plan_manager = response.plan_manager;
 							$scope.cur_bal = response.current_bal;
 							$scope.pay_history = response.pay_history;
 							$scope.razorpay = response.razorpay[0];
 							//$scope.razorpay_plan=response.razorpay_plan[0];
 							console.log($scope.razorpay);
 							$scope.stripe = response.stripe[0];
 							//$scope.razorpay_plan=response.razorpay_plan[0];
 							console.log($scope.stripe);
 							$scope.setting = response.setting[0];
 							$scope.stripe_plan = response.stripe_plan[0];
 							$scope.paypal_details = response.paypal_details[0];

 						} else {
 							swal('Error!', response.status_text, 'error');
 						}
 					},
 					function (reason) {
 						$scope.serverErrorHandler(reason);
 					}
 				);
 			}
 			$scope.get_predata();
 			$scope.subscribe = function (plan_id) {
 				swal({
 						title: "Are you sure to subscribe?",
 						text: "You will not be able to abort !",
 						type: "warning",
 						showCancelButton: true,
 						confirmButtonColor: '#DD6B55',
 						confirmButtonText: 'Yes, I am sure!',
 						cancelButtonText: "No, cancel it!",
 						closeOnConfirm: false,
 						closeOnCancel: false
 					},
 					function (isConfirm) {
 						if (isConfirm) {
 							acFactory.subscribe(plan_id)
 								.success(
 									function (html) {
 										if (html.status_code == '0') {
 											swal('Error!', html.status_text, 'error');

 										}
 										if (html.status_code == '1') {
 											//swal('Success!',html.status_text,'success');
 											location.href = html.download_url;
 											//$scope.get_predata();
 										}
 									}
 								);

 						} else {
 							swal("Cancelled", "subscription cancelled:)", "error");
 						}
 					});


 			}
 			$scope.load_money_using_razor_pay = function (plan_id) {

 				if (plan_id == '1') {

 					$scope.load_amt = '100';
 					$scope.tax_amt = ($scope.load_amt * (18 / 100));
 					$scope.plan_name = 'Micro';

 				}
 				if (plan_id == '2') {

 					$scope.load_amt = '200';
 					$scope.tax_amt = ($scope.load_amt * (18 / 100));
 					$scope.plan_name = 'Small';

 				}
 				if (plan_id == '3') {

 					$scope.load_amt = '300';
 					$scope.tax_amt = ($scope.load_amt * (18 / 100));
 					$scope.plan_name = 'Medium';

 				}
 				if (plan_id == '4') {

 					$scope.load_amt = '400';
 					$scope.tax_amt = ($scope.load_amt * (18 / 100));
 					$scope.plan_name = 'Large';

 				}
 				var handler = StripeCheckout.configure({
 					key: $scope.stripe.publishable_key,
 					image: "<?php echo $baseurl?>" + $scope.stripe.display_logo,
 					locale: 'auto',
 					token: function (response) {
 						$scope.block_site('Creating Subscription');
 						// var amt=parseInt($scope.load_amt)+parseInt($scope.tax_amt);
 						acFactory.capture_payment($scope.load_amt, $scope.tax_amt, response.id,
 								plan_id)
 							.success(
 								function (html) {
 									$.unblockUI();
 									if (html.status_code == '0') {
 										swal('Error!', html.status_text, 'error');

 									}
 									if (html.status_code == '1') {
 										swal('Success!', html.status_text, 'success');
 										$scope.get_predata();
 									}
 								}
 							);
 					}
 				});

 				handler.open({
 					panelLabel: 'Subscribe',
 					amount: $scope.load_amt,
 					name: $scope.plan_name,
 					//description : $scope.plan_name+.'-'.+$scope.load_amt,
 					//description : $scope.load_amt,
 					//email : 'testuser@gmail.com',
 					zipCode: false,
 					allowRememberMe: true
 				});
 			};





 			$scope.cancel_stripe_subscription = function () {

 				var msg = "Are you sure to cancel the stripe subscription?";
 				swal({
 						title: msg,
 						text: "!",
 						type: "warning",
 						showCancelButton: true,
 						confirmButtonColor: '#DD6B55',
 						confirmButtonText: 'Yes, I am sure!',
 						cancelButtonText: "No, cancel it!",
 						closeOnConfirm: false,
 						closeOnCancel: false
 					},
 					function (isConfirm) {
 						if (isConfirm) {
 							acFactory.cancel_stripe_subscription()
 								.success(
 									function (response) {
 										if (response.status_code == '0') {
 											swal('Error!', response.status_text, 'error');

 										}
 										if (response.status_code == '1') {
 											swal('Success!', response.status_text, 'success');
 											$scope.get_predata();
 										}
 									}
 								);

 						} else {
 							swal("Cancelled", "cancelled:)", "error");
 						}
 					});


 			}

 			$scope.cancel_payapal_subscription = function () {

 				var msg = "Are you sure to cancel the paypal subscription?";
 				swal({
 						title: msg,
 						text: "!",
 						type: "warning",
 						showCancelButton: true,
 						confirmButtonColor: '#DD6B55',
 						confirmButtonText: 'Yes, I am sure!',
 						cancelButtonText: "No, cancel it!",
 						closeOnConfirm: false,
 						closeOnCancel: false
 					},
 					function (isConfirm) {
 						if (isConfirm) {
 							acFactory.cancel_payapal_subscription()
 								.success(
 									function (response) {
 										if (response.status_code == '0') {
 											swal('Error!', response.status_text, 'error');

 										}
 										if (response.status_code == '1') {
 											swal('Success!', response.status_text, 'success');
 											$scope.get_predata();
 										}
 									}
 								);

 						} else {
 							swal("Cancelled", "cancelled:)", "error");
 						}
 					});


 			}

 			$scope.block_site = function (message = 'Please wait') {

 				$.blockUI({
 					message: message,
 					css: {
 						border: 'none',
 						padding: '3px',
 						backgroundColor: '#000',
 						'-webkit-border-radius': '10px',
 						'-moz-border-radius': '10px',
 						opacity: .5,
 						color: '#fff'
 					},
 					baseZ: 9999
 				});

 			}


 			// $scope.block_site('Loading Wait');












 		});

 	</script>
