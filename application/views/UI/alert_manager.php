<?php
 $baseurl=base_url();
?>

<style type="text/css">
   /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #33c4d4;
}

input:focus + .slider {
  box-shadow: 0 0 1px #33c4d4;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<div class="wrapper" ng-controller='acCtrl'>

	 <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="margin-left:-200px;width:1000px">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{alt.alert_head}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body p-4">
												 <div ng-bind-html="alt.alert_msg"></div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.modal -->
                <div class="content">

                    <div class="container-fluid">


                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">

                                        </ol>
                                    </div>
                                    <h4 class="page-title">Alert Manager</h4>
                                </div>
                            </div>
                        </div>


					  <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
								   <div class="card-panel"> <br> <br>
								   <div class="row">
										<div class="col-sm-4">
										 <table style="border: 1px solid #DEE2E6; text-align: center;" class="table table-hover table-centered mb-0">
                                    <!-- <tr><td><b>Enable ADD-ON:</b></td><td>
                              <label class="switch">

  <input type="checkbox" name='enable_addon' ng-model='setting.auto_addon' ng-true-value="'1'" ng-false-value="'0'" ng-change='change_addon_status()'>
  <span class="slider"></span>
</label></td></tr> -->
 <tr><td><b>Wallet Events:</b></td><td>
                              <label class="switch">

  <input type="checkbox" name='enable_addon' ng-model='setting.wallet' ng-true-value="'1'" ng-false-value="'0'" ng-change='change_wallet_status()'>
  <span class="slider round"></span>
</label></td></tr>
 <tr><td><b>Negative Feedback:</b></td><td>
                              <label class="switch">

  <input type="checkbox" name='enable_addon' ng-model='setting.neg_fbk' ng-true-value="'1'" ng-false-value="'0'" ng-change='change_negative_status()'>
  <span class="slider round"></span>
</label></td></tr>
<tr><td><b>Low Balance:</b></td><td>
                              <label class="switch">

  <input type="checkbox" name='enable_addon' ng-model='setting.low_balance' ng-true-value="'1'" ng-false-value="'0'" ng-change='change_lw_bal_status()'>
  <span class="slider round"></span>
</label></td></tr>
<!-- <tr><td><b>Low Stock</b></td><td>
                              <label class="switch">

  <input type="checkbox" name='enable_addon' ng-model='setting.low_inventory' ng-true-value="'1'" ng-false-value="'0'" ng-change='change_lw_inv_status()'>
  <span class="slider"></span>
</label></td></tr> -->
<tr><td><b>Plan Events:</b></td><td>
                              <label class="switch">

  <input type="checkbox" name='enable_addon' ng-model='setting.plan_ev' ng-true-value="'1'" ng-false-value="'0'" ng-change='change_plan_ev_status()'>
  <span class="slider round"></span>
</label></td></tr>
<tr><td><b>Account Summary:</b></td><td>
<select ng-model='setting.ac_summary' class="form-control" ng-change='change_ac_status()'>
<option value="weekly">Weekly</option>
<option value="daily">Daily</option>
</select>
            </td></tr>
                                    </table>
									</div>
									<div class="col-sm-8">
									<table style="border: 1px solid #DEE2E6; text-align: center;" class="table table-hover table-centered mb-0">
                                    <tr><th></th><th>Alert Type</th><th>Subject</th><th>Timestamp</th></tr>
                                    <tr ng-click='show_alert(alt)' data-target="#myModal" data-toggle="modal"  ng-repeat="alt in alert">
                                    <td><span ng-if="alt.is_important=='1'" class="glyphicon glyphicon-star-empty"></span></td>
                                    <td>{{alt.alert_type}}</td>
                                    <td>{{alt.alert_head}}</td>
                                    <td><span>{{alt.alert_on}}</span></td>
                                    </tr>
                                    </table>
									</div>




										</div>
									</div>
                               </div>
                          </div>
                       </div>






				 </div>
		  </div>
    </div>

<script type="text/javascript">

crawlApp.factory("acFactory", function($http,$q) {

   var get_data = function () {
        var dataset_path="<?php echo $baseurl.'alert_manager/get_recent_alert_data'?>";
        var deferred = $q.defer();
        var path =dataset_path;

        $http.get(path)
        .success(function(data,status,headers,config){deferred.resolve(data);})
        .error(function(data, status, headers, config) { deferred.reject(status);});

        return deferred.promise;
    };
    var change_addon_status=function(addon_status)
    {
       var search_path="<?php echo $baseurl.'subscribe/toggle_addon_status/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        addon_status:addon_status
                      }
                     });

    };
    var change_wallet_status=function(status)
    {
       var search_path="<?php echo $baseurl.'alert_manager/toggle_wallet_status/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        w_status:status
                      }
                     });

    };
    var change_negative_status=function(status)
    {
       var search_path="<?php echo $baseurl.'alert_manager/toggle_negative_feedback_status/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        w_status:status
                      }
                     });

    };
    var change_ac_status=function(status)
    {
       var search_path="<?php echo $baseurl.'alert_manager/toggle_summary_status/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        w_status:status
                      }
                     });

    };
    var change_lw_bal_status=function(status)
    {
       var search_path="<?php echo $baseurl.'alert_manager/toggle_low_balance_status/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        w_status:status
                      }
                     });

    };
    var change_plan_ev_status=function(status)
    {
       var search_path="<?php echo $baseurl.'alert_manager/toggle_plan_status/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        w_status:status
                      }
                     });

    };
    var change_lw_inv_status=function(status)
    {
       var search_path="<?php echo $baseurl.'alert_manager/toggle_low_inventory_status/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        w_status:status
                      }
                     });

    };

    var subscribe=function(plan_id)
    {
       var search_path="<?php echo $baseurl.'subscribe/new_plan/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        plan_id:plan_id
                      }
                     });

    };




  return {
    get_data:get_data,
    subscribe:subscribe,
    change_addon_status:change_addon_status,
    change_wallet_status:change_wallet_status,
    change_negative_status:change_negative_status,
    change_ac_status:change_ac_status,
    change_lw_bal_status:change_lw_bal_status,
    change_plan_ev_status:change_plan_ev_status,
    change_lw_inv_status:change_lw_inv_status
  };
});
  crawlApp.controller("acCtrl",function acCtrl($window,$scope,acFactory,$sce,$q,$timeout,Upload)
  {
       $scope.get_predata = function()
       {
            var promise=acFactory.get_data();
              promise.then(
                             function(response)
                             {

                                if(response.status_code == '1')
                                {
                                    $scope.alert=response.alert;
                                    $scope.setting=response.setting[0];

                                }
                                else
                                {
                                 swal('Error!',response.status_text,'error');
                                }
                             },
                             function(reason)
                             {
                               $scope.serverErrorHandler(reason);
                             }
                          );
        }
        $scope.get_predata();
        $scope.show_alert=function(alt_data)
        {
          $scope.alt={}
          $scope.alt.alert_head=alt_data.alert_head;
          $scope.alt.alert_msg=$sce.trustAsHtml(alt_data.alert_msg);

        }
        $scope.subscribe=function(plan_id)
        {
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
            function(isConfirm) {
                if (isConfirm) {
                      acFactory.subscribe(plan_id)
              .success(
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');

                           }
                           if(html.status_code == '1')
                           {
                            swal('Success!',html.status_text,'success');
                             $scope.get_predata();
                           }
                      }
                );

                } else {
                    swal("Cancelled", "subscription cancelled:)", "error");
                }
            });


        }

        $scope.change_addon_status=function()
        {


           swal({
                title: "Are you sure want to change ADD-ON status?",
                text: "You will not be able to abort!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                      acFactory.change_addon_status($scope.setting.auto_addon)
              .success(
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');

                           }
                           if(html.status_code == '1')
                           {
                            swal('Success!',html.status_text,'success');
                             $scope.get_predata();
                           }
                      }
                );

                } else {
                    swal("Cancelled", "ADD-ON status update cancelled:)", "error");
                }
            });


        }

        $scope.change_wallet_status=function()
        {


           swal({
                title: "Are you sure want to wallet notification?",
                text: "!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                      acFactory.change_wallet_status($scope.setting.wallet)
              .success(
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');

                           }
                           if(html.status_code == '1')
                           {
                            swal('Success!',html.status_text,'success');
                             $scope.get_predata();
                           }
                      }
                );

                } else {
                    swal("Cancelled", "cancelled:)", "error");
                }
            });


        }
        $scope.change_negative_status=function()
        {


           swal({
                title: "Are you sure ?",
                text: "!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                      acFactory.change_negative_status($scope.setting.neg_fbk)
              .success(
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');

                           }
                           if(html.status_code == '1')
                           {
                            swal('Success!',html.status_text,'success');
                             $scope.get_predata();
                           }
                      }
                );

                } else {
                    swal("Cancelled", "cancelled:)", "error");
                }
            });


        }

        $scope.change_ac_status=function()
        {


           swal({
                title: "Are you sure ?",
                text: "!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                      acFactory.change_ac_status($scope.setting.ac_summary)
              .success(
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');

                           }
                           if(html.status_code == '1')
                           {
                            swal('Success!',html.status_text,'success');
                             $scope.get_predata();
                           }
                      }
                );

                } else {
                    swal("Cancelled", "cancelled:)", "error");
                }
            });


        }
        $scope.change_lw_bal_status=function()
        {


           swal({
                title: "Are you sure ?",
                text: "!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                      acFactory.change_lw_bal_status($scope.setting.low_balance)
              .success(
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');

                           }
                           if(html.status_code == '1')
                           {
                            swal('Success!',html.status_text,'success');
                             $scope.get_predata();
                           }
                      }
                );

                } else {
                    swal("Cancelled", "cancelled:)", "error");
                }
            });


        }
         $scope.change_lw_inv_status=function()
        {


           swal({
                title: "Are you sure ?",
                text: "!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                      acFactory.change_lw_inv_status($scope.setting.low_inventory)
              .success(
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');

                           }
                           if(html.status_code == '1')
                           {
                            swal('Success!',html.status_text,'success');
                             $scope.get_predata();
                           }
                      }
                );

                } else {
                    swal("Cancelled", "cancelled:)", "error");
                }
            });


        }
         $scope.change_plan_ev_status=function()
        {


           swal({
                title: "Are you sure ?",
                text: "!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                      acFactory.change_plan_ev_status($scope.setting.plan_ev)
              .success(
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');

                           }
                           if(html.status_code == '1')
                           {
                            swal('Success!',html.status_text,'success');
                             $scope.get_predata();
                           }
                      }
                );

                } else {
                    swal("Cancelled", "cancelled:)", "error");
                }
            });


        }




});
</script>
