 <?php
    $baseurl = base_url();
    $base_url = base_url();
    ?>


 <div class="wrapper" ng-controller='profileCtrl'>
     <div class="content">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <div class="page-title-box">
                         <div class="page-title-right">
                             <ol class="breadcrumb m-0">
                             </ol>
                         </div>
                         <h4 class="page-title">User Profile</h4>
                     </div>
                 </div>
             </div>
             <div class="row" id="country_selection">
                 <div class="col-12">
                     <div class="">
                         <div class="card-box">
                             <div class="col-sm-12">
								<!---------------------------------------------------------->
								<form novalidate="" name="amzForm" ng-submit="update_amazon_api()" class="ng-pristine ng-valid ng-valid-required">
									<h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>
									<div class="row">

										<div class="col-md-6" ng-class="{ 'has-error' : amzForm.user_name.$invalid &amp;&amp; amz_submitted  }">
											<div class="form-group">
												<label for="user_name">Full Name</label>
												<input type="text" ng-model="amz_api.user_name" placeholder="User Name" name="user_name" class="form-control">
											</div>
										</div>
										<div class="col-md-6" ng-class="{ 'has-error' : amzForm.scr_uname.$invalid &amp;&amp; amz_submitted  }">
											<div class="form-group">
												<label for="scr_uname">Email</label>
												<input type="text" ng-model="amz_api.scr_uname" placeholder="Email" name="scr_uname" class="form-control">
											</div>
										</div> <!-- end col -->
									</div> <!-- end row -->

									<div class="row">
										<div class="col-12" ng-class="{ 'has-error' : amzForm.scr_add_email.$invalid &amp;&amp; amz_submitted  }">
											<div class="form-group">
												<label for="userbio">Additional Emails for Notifications</label>
												<input type="text" ng-model="amz_api.scr_add_email" placeholder="Additional Email" name="scr_add_email" class="form-control">
											</div>
										</div> <!-- end col -->
									</div> <!-- end row -->

									<div class="row">
										<div class="col-md-6" ng-class="{ 'has-error' : amzForm.mobile_no.$invalid &amp;&amp; amz_submitted  }">
											<div class="form-group">
												<label for="mobile_no">Contact Phone Number</label>
												<input type="text" ng-model="amz_api.mobile_no" placeholder="Mobile No" name="mobile_no" class="form-control">
											</div>
										</div>

									</div> <!-- end row -->

									<h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building mr-1"></i> Company Info</h5>
									<div class="row">
										<div class="col-md-6" ng-class="{ 'has-error' : amzForm.com_addr.$invalid &amp;&amp; amz_submitted  }">
											<div class="form-group">
												<label for="com_name">Company Name</label>
												<input type="text" ng-model="amz_api.com_name" placeholder="Company Name" name="com_name" class="form-control">
											</div>
										</div> <!-- end col -->

										<div class="col-md-6" ng-class="{ 'has-error' : amzForm.com_addr.$invalid &amp;&amp; amz_submitted  }">
											<div class="form-group">
												<label for="com_addr">Company Address</label>
												<input type="text" ng-model="amz_api.com_addr" placeholder="Company Address" name="com_addr" class="form-control">
											</div>
										</div> <!-- end col -->

										<div class="col-md-6">
											<div class="form-group">
												<label for="com_addr">Home Country VAT No</label>
												<input type="text" ng-model="amz_api.home_vat" placeholder="VAT No" name="home_vat" class="form-control">
											</div>
										</div> <!-- end col -->

										<div class="col-md-6">
											<div class="form-group">
												<label for="com_addr">All EU VAT Nos</label>
												<input type="text" ng-model="amz_api.eur_vat" placeholder="VAT No" name="eur_vat" class="form-control">
											</div>
										</div> <!-- end col -->

									</div> <!-- end row -->

									<div class="text-right">
										<button type="submit" class="btn btn-success waves-effect waves-light mt-2" ng-click="amz_submitted=true" value="Update" name="submit"><i class="mdi mdi-content-save"></i> Save</button>
									</div>
								</form>
								<!---------------------------------------------------------->
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <script type="text/javascript">
         crawlApp.factory("profileFactory", function($http, $q) {
             var get_profile_info = function() {
                 var deferred = $q.defer();
                 var path = "<?php echo $baseurl . 'user_profile/get_profile_info' ?>";
                 $http.get(path)
                     .success(function(data, status, headers, config) {
                         deferred.resolve(data);
                     })
                     .error(function(data, status, headers, config) {
                         deferred.reject(status);
                     });
                 return deferred.promise;
             };
             var update_amazon_api = function(api) {
                 return $http({
                     method: "post",
                     url: "<?php echo $baseurl . 'user_profile/update_amazon_api' ?>",
                     data: {
                         api_detail: angular.toJson(api)
                     }
                 });

             };


             return {
                 get_profile_info: get_profile_info,
                 update_amazon_api: update_amazon_api
             };

         });
         crawlApp.controller("profileCtrl", function profileCtrl($window, $scope, profileFactory, $sce, $q, $timeout, Upload) {
             $scope.amz_api = {};
             $scope.amz_api.is_edit = 0;
             $scope.block_site = function() {
                 $.blockUI({
                     css: {
                         border: 'none',
                         padding: '3px',
                         backgroundColor: '#000',
                         '-webkit-border-radius': '10px',
                         '-moz-border-radius': '10px',
                         opacity: .9,
                         color: '#fff'
                     },
                     baseZ: 9999
                 });

             }




             $scope.update_amazon_api = function() {
                 $scope.block_site();
                 profileFactory.update_amazon_api($scope.amz_api)
                     .success(
                         function(html) {
                             $.unblockUI();
                             if (html.status_code == 0) {
                                 swal("Error!", html.status_text, 'error');
                             } else if (html.status_code == 1) {
                                 $scope.msg = html.msg;
                                 swal("Success!", html.status_text, 'success');
                             }
                         }
                     )
                     .error(
                         function(data, status, headers, config) {
                             $.unblockUI();

                         }

                     );
             }

             $scope.get_profile_info = function() {
                 var promise = profileFactory.get_profile_info();
                 promise.then(function(response) {

                         if (response.api_details.length > 0)
                             $scope.amz_api = response.api_details[0];

                         console.log($scope.amz_api);

                     },
                     function(reason) {
                         console.log("Reason" + reason);
                     });
             }
             $scope.get_profile_info();


         });
     </script>
