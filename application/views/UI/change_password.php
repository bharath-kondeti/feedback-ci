<?php
$base_url = base_url();
$baseurl = $base_url;
?>
<div class="wrapper" ng-controller='profileCtrl'>
    <div class="content">

        <div class="container">


            <div class="row">
               <div class="col-sm-3"></div>
				<div class="col-6">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                            </ol>
                        </div>
                        <h4 class="page-title">Change Password</h4>
                    </div>
                </div>
            </div>

            <div class="row" id="country_selection">
                <div class="col-sm-3"></div>
				<div class="col-6">
                    <div class="">
                        <div class="card-box">
                            <div class="col-sm-12">
                                <form novalidate="" name="pwdForm" ng-submit="update_password()" class="ng-pristine ng-valid ng-valid-required">
									<div class="col-md-12">
										<div class="form-group">
											<label for="email">Email</label>
											<p class="font-bold">{{usr.email}}</p>
										</div>
									</div>
								   
								   	
									<div class="col-md-12" ng-class="{ 'has-error' : pwdForm.cur_pwd.$invalid &amp;&amp; pwd_submitted  }">
										<div class="form-group">
											<label for="cur_pwd">Current Password</label>
											<input type="password" required="" ng-model="pwd.cur_pwd" placeholder="Current Password" name="cur_pwd" class="form-control">
										</div>
									</div>
									
									<div class="col-md-12" ng-class="{ 'has-error' : pwdForm.new_pwd.$invalid &amp;&amp; pwd_submitted  }">
										<div class="form-group">
											<label for="new_pwd">New Password</label>
											<input type="password" required="" ng-model="pwd.new_pwd" placeholder="New Password" name="new_pwd" class="form-control">
										</div>
									</div>
									
									<div class="col-md-12" ng-class="{ 'has-error' : pwdForm.reenter_pwd.$invalid &amp;&amp; pwd_submitted  }">
										<div class="form-group">
											<label for="reenter_pwd">Re-Enter New Password</label>
											<input type="password" required="" ng-model="pwd.reenter_pwd" placeholder="Re-Enter Password" name="reenter_pwd" class="form-control">
										</div>
									</div>
									
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2" ng-click="pwd_submitted=true" value="Change Password" name="submit"><i class="mdi mdi-content-save"></i> Change Password </button>
                                    </div>
                                </form>

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
                var path = "<?php echo $baseurl . 'change_password/get_profile_info' ?>";
                $http.get(path)
                    .success(function(data, status, headers, config) {
                        deferred.resolve(data);
                    })
                    .error(function(data, status, headers, config) {
                        deferred.reject(status);
                    });
                return deferred.promise;
            };


            var update_password = function(pwd) {
                return $http({
                    method: "post",
                    url: "<?php echo $baseurl . 'change_password/update_password' ?>",
                    data: {
                        pwd_detail: angular.toJson(pwd)
                    }
                });

            };



            return {
                get_profile_info: get_profile_info,
                update_password: update_password
            };

        });
        crawlApp.controller("profileCtrl", function profileCtrl($window, $scope, profileFactory, $sce, $q, $timeout, Upload) {

            $scope.pwd = {};
            $scope.com_info = {};


            $scope.block_site = function() {
                $.blockUI({
                    css: {
                        border: 'none',
                        padding: '3px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff'
                    }
                });

            }


            $scope.update_password = function() {

                profileFactory.update_password($scope.pwd)
                    .success(
                        function(html) {
                            console.log(html);
                            if (html.status_code == 0) {
                                swal("Error!", html.status_text, 'error');
                            } else if (html.status_code == 1) {
                                // $scope.msg=html.msg;
                                swal("Success!", html.status_text, 'success');
                                $scope.pwd.cur_pwd = '';
                                $scope.pwd.new_pwd = '';
                                $scope.pwd.reenter_pwd = '';
                            }
                        }
                    )
                    .error(
                        function(data, status, headers, config) {

                        }

                    );

            }
            $scope.get_profile_info = function() {
                var promise = profileFactory.get_profile_info();
                promise.then(function(response) {
                        $scope.usr = response.details[0];


                    },
                    function(reason) {
                        console.log("Reason" + reason);
                    });
            }
            $scope.get_profile_info();

        });
    </script>