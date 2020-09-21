<?php
$baseurl=base_url();
$base_url=base_url();
?>

<div class="wrapper" ng-controller="canCtrl">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right"></div>
						<h4 class="page-title">Cancel Your Account ?</h4>
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
									<a class="nav-link active" href="<?php echo $baseurl.'preferences'?>">Preferences</a>
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
									<a class="nav-link" href="<?php echo $base_url . 'change_password' ?>">Change Password</a>
								</li>
							</ul>
						</div>
						<div class="h4">
							Promotions
						</div>
						<div class="ml-2">
							<ul class="nav flex-column">
								<li class="nav-item hover hover-nav">
									<a class="nav-link" href="<?php echo $base_url . 'manage_referal' ?>">Refer a friend</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-10">
					<div class="card-box">
						<div class="page-title-box">
							<div class="page-title-right"></div>
							<h4 class="page-title">Put your account on hold</h4>
							<p>You have an option to put your account on Hold for few days/months</p>
						</div>
						<hr>
						<form name="hold-account" class="hold-account" id="hold-account">
							<div class="col-sm-2 mg-top-10">
								<?php if($hold == 0) { ?>
									<button ng-click="holdAccount()" class="btn btn-block btn-info" name="hold">Hold Account</button>
								<?php } ?>
								<?php if($hold == 1) { ?>
									<button class="btn btn-block btn-info" name="hold-sent" disabled>Hold Request Sent</button>
								<?php } ?>
								<?php if($hold == 2) { ?>
									<button class="btn btn-block btn-info" name="hold-active" disabled>Account on hold</button>
								<?php } ?>
							</div>
						</form>
						<div class="col-12">
							<div class="page-title-box">
								<div class="page-title-right"></div>
								<h4 class="page-title">Request Account Cancellation</h4>
								<p>Raise a request for account cancellation and out team will get back to you.</p>
							</div>
						</div>
						<hr>
						<form name="cancel-account" class="cancel-account" id="cancel-account">
							<div class="col-sm-2 mg-top-10">
								<?php if($cancel == 0) { ?>
									<button ng-click="cancelAccount()" class="btn btn-block btn-info" name="cancel">Cancel Account</button>
								<?php } ?>
								<?php if($cancel == 1) { ?>
									<button class="btn btn-block btn-info" name="cancel-sent" disabled>Cancel Request Sent</button>
								<?php } ?>
								<?php if($cancel == 2) { ?>
									<button class="btn btn-block btn-info" name="cancel-active" disabled>Account Cancelled</button>
								<?php } ?>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	crawlApp.factory("acFactory", function ($http, $q) {
		var hold_account = function () {
			var dataset_path = "<?php echo $baseurl.'cancel/hold_account'?>";
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
    var cancel_account = function () {
			var dataset_path = "<?php echo $baseurl.'cancel/cancel_account'?>";
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
		return {
      hold_account: hold_account,
      cancel_account: cancel_account,
		};
	});
	crawlApp.controller("canCtrl", function canCtrl($window, $scope, acFactory, $sce, $q, $timeout, Upload) {
		$scope.holdAccount = function () {
			swal({

					title: "Are you sure want to put your account on hold ?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: '#DD6B55',
					confirmButtonText: 'Yes, I am sure!',
					cancelButtonText: "No, cancel it!",
					closeOnConfirm: true,
					closeOnCancel: true
				},
				function (isConfirm) {
					if (isConfirm) {
						var promise = acFactory.hold_account();
						promise.then(
							function(response) {
								if (response.status_code == '1') {

								} else {
									swal('Error!', response.status_text, 'error');
								}
							},
							function(reason) {
								$scope.serverErrorHandler(reason);
							}
						);
					} else {
						swal("Cancelled", "Delete cancelled:)", "error");
					}
				});
		}
    $scope.cancelAccount = function () {
			swal({

					title: "Are you sure want to cancel your account ?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: '#DD6B55',
					confirmButtonText: 'Yes, I am sure!',
					cancelButtonText: "No, cancel it!",
					closeOnConfirm: true,
					closeOnCancel: true
				},
				function (isConfirm) {
					if (isConfirm) {
						var promise = acFactory.cancel_account()
						promise.then(
							function(response) {
								if (response.status_code == '1') {

								} else {
									swal('Error!', response.status_text, 'error');
								}
							},
							function(reason) {
								$scope.serverErrorHandler(reason);
							}
						);
					} else {
						swal("Cancelled", "Delete cancelled:)", "error");
					}
				});
		}
	});
</script>
