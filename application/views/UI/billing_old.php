 <?php
$baseurl=base_url();
$base_url=base_url();
?>
 
   <script src="https://checkout.razorpay.com/v1/checkout.js"></script>        
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
                            <select ng-model='load_amt' class="form-control" >
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
                                      <button style="float:right;margin-right:13px" data-toggle="modal" data-target="#load_money" class="btn btn-primary waves-effect waves-light mt-4 mb-2 width-sm">Pay</button>  
                                    </div>
                                    <h4 class="page-title">Billing</h4>
                                </div>
                            </div>
                        </div>     
						
						<div class="row">
                            <div class="col-md-12">
                           <div class="col-md-12">
                            <div class="row">
							
							
							<div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body" style="padding: 20px;">
                                        <div class="media justify-content-between">
                                            <div>
                                               <p class="">Current Plan</p>
											   
                                                <h2 ng-if="plan.plan_name.length > 0" class="font-size-28 font-weight-light">{{plan.plan_name}}</h2>
												<h2 ng-if="plan.plan_name.length <= 0" class="font-size-28 font-weight-light">None</h2>
												
												<p style="margin-top:-35px;float:right;margin-left:250px" ng-if="plan.plan_status =='Paid'"  class="font-size-28 font-weight-light">Paid</p>
												<p style="margin-top:-35px;float:right;margin-left:210px" ng-if="plan.plan_status =='Free Trail'"  class="font-size-28 font-weight-light">Free Trail</p>
												
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
                                                <h2 ng-if="plan.subscribed_on.length > 0" class="font-size-28 font-weight-light">{{plan.subscribed_on}}</h2>
												<h2 ng-if="plan.subscribed_on.length <= 0" class="font-size-28 font-weight-light">None</h2>
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
                                                <h2 ng-if="plan.valid_till.length > 0" class="font-size-28 font-weight-light">{{plan.valid_till}}</h2>
												<h2 ng-if="plan.valid_till.length <= 0" class="font-size-28 font-weight-light">None</h2>
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
                                                <h2 ng-if="plan.remaining_email.length > 0" class="font-size-28 font-weight-light">{{plan.remaining_email}}</h2>
												<h2 ng-if="plan.remaining_email.length <= 0" class="font-size-28 font-weight-light">None</h2>
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
                                                <h2 ng-if="plan.sent_count.length > 0" class="font-size-28 font-weight-light">{{plan.sent_count}}</h2>
												<h2 ng-if="plan.sent_count.length <= 0" class="font-size-28 font-weight-light">None</h2>
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
                                               <p class="">Balance</p>
                                                <h2 ng-if="plan.wallet_balance.length > 0" class="font-size-28 font-weight-light">£{{plan.wallet_balance}}</h2>
												<h2 ng-if="plan.wallet_balance.length <= 0" class="font-size-28 font-weight-light">£0.00</h2>
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
                            <div class="col-xl-10">

                                

                                <!-- Plans -->
                                <div class="row my-3">
                                    <div class="col-md-3">
                                        <div class="card card-pricing">
                                            <div class="card-body text-center">
                                               <!-- <p class="card-pricing-plan-name font-weight-bold text-uppercase">Professional Pack</p>  -->
                                                <span class="card-pricing-icon text-primary">
                                                    <i class="fe-award"></i>
                                                </span>
                                                <h2 class="card-pricing-price">£10 <span>/ Month</span></h2>
                                                <ul class="card-pricing-features">
                                                    <li>1,000 Emails </li>
                                                    <li>7 Market Places  </li>
                                                    <li>Unlimited Campaigns  </li>
                                                    <li>Unlimited Orders  </li>
                                                    <li>Negative Feedback Alerts  </li>
                                                    <li>Experience & Expert  </li>
                                                    <li>Support Team  </li>
                                                </ul>
                                                <button   ng-click='subscribe(1)'  class="btn btn-primary waves-effect waves-light mt-4 mb-2 width-sm">Subscribe</button>
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
                                                <h2 class="card-pricing-price">£20 <span>/ Month</span></h2>
                                                <ul class="card-pricing-features">
                                                    <li>4,000 Emails </li>
                                                    <li>7 Market Places  </li>
                                                    <li>Unlimited Campaigns  </li>
                                                    <li>Unlimited Orders  </li>
                                                    <li>Negative Feedback Alerts  </li>
                                                    <li>Experience & Expert  </li>
                                                    <li>Support Team  </li>
                                                </ul>
                                                <button  ng-click='subscribe(2)' class="btn btn-primary waves-effect waves-light mt-4 mb-2 width-sm">Subscribe</button>
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
                                                <h2 class="card-pricing-price text-white">£30 <span>/ Month</span></h2>
                                                <ul class="card-pricing-features">
                                                     <li>10,000 Emails </li>
                                                    <li>7 Market Places  </li>
                                                    <li>Unlimited Campaigns  </li>
                                                    <li>Unlimited Orders  </li>
                                                    <li>Negative Feedback Alerts  </li>
                                                    <li>Experience & Expert  </li>
                                                    <li>Support Team  </li>
                                                </ul>
                                                <button  ng-click='subscribe(3)' class="btn btn-light waves-effect mt-4 mb-2 width-sm">Subscribe</button>
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
                                                <h2 class="card-pricing-price">£50 <span>/ Month</span></h2>
                                                <ul class="card-pricing-features">
                                                    <li>25,000 Emails </li>
                                                    <li>7 Market Places  </li>
                                                    <li>Unlimited Campaigns  </li>
                                                    <li>Unlimited Orders  </li>
                                                    <li>Negative Feedback Alerts  </li>
                                                    <li>Experience & Expert  </li>
                                                    <li>Support Team  </li>
                                                </ul>
                                                <button  ng-click='subscribe(4)' class="btn btn-primary waves-effect waves-light mt-4 mb-2 width-sm">Subscribe</button>
                                            </div>
                                        </div> <!-- end Pricing_card -->
                                    </div> <!-- end col -->
									
							
									
                                </div>
                                <!-- end row -->

                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->
				
				
				
				
<script type="text/javascript">

crawlApp.factory("acFactory", function($http,$q) {
   
   var get_data = function () {
        var dataset_path="<?php echo $baseurl.'billing/get_plan_data'?>";
        var deferred = $q.defer();
        var path =dataset_path;
        
        $http.get(path)
        .success(function(data,status,headers,config){deferred.resolve(data);})
        .error(function(data, status, headers, config) { deferred.reject(status);});
        
        return deferred.promise;
    };
    var subscribe=function(plan_id)
    {
       var search_path="<?php echo $baseurl.'billing/new_plan/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data: 
                      {
                        plan_id:plan_id
                      }
                     }); 
                   
    };
    var load_money=function(amount)
    {
       var search_path="<?php echo $baseurl.'billing/load_money/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data: 
                      {
                        amount:amount
                      }
                     }); 
                   
    };

    var buy_addon=function(amount)
    {
       var search_path="<?php echo $baseurl.'billing/buy_addon/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data: 
                      {
                        amount:amount
                      }
                     }); 
                   
    };

    var change_addon_status=function(addon_status)
    {
       var search_path="<?php echo $baseurl.'billing/toggle_addon_status/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data: 
                      {
                        addon_status:addon_status
                      }
                     }); 
                   
    };

    var capture_payment=function(load_amt,tax_amt,payment_id)
    {
       var search_path="<?php echo $baseurl.'billing/capture_payment/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data: 
                      {
                        load_amt:load_amt,
                        tax_amt:tax_amt,
                        payment_id:payment_id
                      }
                     }); 
                   
    };

    var get_subscription_id=function(plan_id)
    {
       var search_path="<?php echo $baseurl.'billing/get_subscription_id/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data: 
                      {
                        plan_id:plan_id
                      }
                     }); 
                   
    };

    var authorize_subscription=function(subscription_id,razorpay_payment_id,razorpay_subscription_id,razorpay_signature)
    {
       var search_path="<?php echo $baseurl.'billing/authorize_subscription/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data: 
                      {
                        subscription_id:subscription_id,
                        payment_id:razorpay_payment_id,
                        r_subscription_id:razorpay_subscription_id,
                        razorpay_signature:razorpay_signature
                      }
                     }); 
    };

 var change_subscription_status=function(status)
    {
       var search_path="<?php echo $baseurl.'billing/toggle_subscription_status/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data: 
                      {
                        w_status:status
                      }
                     }); 
                   
    };

    
  return {
    get_data:get_data,
    subscribe:subscribe,
    load_money:load_money,
    buy_addon:buy_addon,
    change_addon_status:change_addon_status,
    capture_payment:capture_payment,
	change_subscription_status:change_subscription_status,
    get_subscription_id:get_subscription_id,
    authorize_subscription:authorize_subscription
  };
});
  crawlApp.controller("acCtrl",function acCtrl($window,$scope,acFactory,$sce,$q,$timeout,Upload) 
  {
    $scope.load_amt='30';
    $scope.tax_amt=($scope.load_amt*(18/100));
    $scope.addon_amt='500';
    $scope.selected_plan='3';
    $scope.cur_bal='';
    
    $scope.plan_history=[];
    $scope.plan={};
       $scope.get_predata = function()
         {
            var promise=acFactory.get_data();
              promise.then(
                             function(response)
                             {

                                if(response.status_code == '1')
                                {
                                    $scope.plan=response.plan[0]; 
                                    $scope.addon=response.addon[0]; 
                                    $scope.plan_history=response.plan_history;
									$scope.plan_manager=response.plan_manager;
                                    $scope.cur_bal=response.current_bal;
                                    $scope.pay_history=response.pay_history;
                                    $scope.razorpay=response.razorpay[0];
                                    //$scope.razorpay_plan=response.razorpay_plan[0];
                                    console.log($scope.razorpay);
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
        $scope.change_plan=function()
        {
          $scope.subscribe($scope.selected_plan);
        }
        $scope.load_money=function()
        {
          if($scope.load_amt.length > 0)
          {


           swal({
                title: "Are you sure to load money?",
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
                      acFactory.load_money($scope.load_amt)
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
                    swal("Cancelled", "Loading Money cancelled:)", "error");
                }
            });
         }
         else
         {
          swal("Please enter some amount");
         }
         
           
        }
        $scope.calc_tax=function()
        {
          if($scope.load_amt.length>0)
          {
            $scope.tax_amt=($scope.load_amt*(18/100));
          }
        }

        $scope.load_money_using_razor_pay=function()
        {
          if($scope.load_amt.length > 0)
           {
           	$('#load_money').modal('hide');

        	$scope.conf_opt = {
		    "key": $scope.razorpay.key_id,
		    "amount": (parseInt($scope.load_amt)+parseInt($scope.tax_amt))*100, // 2000 paise = INR 20
		    "name": $scope.razorpay.display_name,
		    "description": $scope.razorpay.display_desc,
		    "image": "<?php echo $baseurl?>"+$scope.razorpay.display_logo,
		    "handler":function(response)
		        {
		        	// alert(response.razorpay_payment_id);
		        	$scope.block_site('Capturing Payment');
              // var amt=parseInt($scope.load_amt)+parseInt($scope.tax_amt);
		        	 acFactory.capture_payment($scope.load_amt,$scope.tax_amt,response.razorpay_payment_id)
              		.success(
                      function( html )
                      {
                      	   $.unblockUI();
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
		        }
			 ,
		    "prefill":{
		        "name": $scope.razorpay.customer_name,
		        "email": $scope.razorpay.scr_uname,
		        "contact":$scope.razorpay.mobile_no
		    },
		    "notes": {
		        "Wallet":"Load money to wallet"
		    },
		    "theme": {
		        "color":$scope.razorpay.display_theme
		    }
		    };
	        var rzp1 = new Razorpay($scope.conf_opt);
    		rzp1.open();
    	  }
    	  else
    	  {
    	  	swal('Error!','Choose amount from the dropdown','error');
    	  }
        }
        
        $scope.buy_addon=function()
        {
          if($scope.addon_amt.length > 0)
          {


           swal({
                title: "Are you sure top-up ADD-ON?",
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
                      acFactory.buy_addon($scope.addon_amt)
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
                    swal("Cancelled", "ADD-ON cancelled:)", "error");
                }
            });
         }
         
           
        }

        $scope.create_subscription_using_razor_pay=function()
        {
          if($scope.subscribe_plan_id.length > 0)
           {
            $('#subscribe_money').modal('hide');
         $scope.conf_opt = {
        "key": $scope.razorpay.key_id,
        "subscription_id":$scope.subscription_id,
        "name": $scope.razorpay.display_name,
        "description": $scope.razorpay.display_desc,
        "image": "<?php echo $baseurl?>"+$scope.razorpay.display_logo,
        "handler":function(response)
            {
              console.log(response);
              $scope.block_site('Authorizing Subscription');
              // var amt=parseInt($scope.load_amt)+parseInt($scope.tax_amt);
               acFactory.authorize_subscription($scope.subscription_id,response.razorpay_payment_id,response.razorpay_subscription_id,response.razorpay_signature)
                  .success(
                      function( html )
                      {
                           $.unblockUI();
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
            }
       ,
        "prefill":{
            "name": $scope.razorpay.customer_name,
            "email": $scope.razorpay.scr_uname,
            "contact":$scope.razorpay.mobile_no
        },
        "notes": {
            "Wallet":"Subscribe to load money in wallet"
        },
        "theme": {
            "color":$scope.razorpay.display_theme
        }
        };
          var rzp1 = new Razorpay($scope.conf_opt);
        rzp1.open();
        }
        else
        {
          swal('Error!','Choose Plan from the dropdown','error');
        }
        }
        
        $scope.buy_addon=function()
        {
          if($scope.addon_amt.length > 0)
          {


           swal({
                title: "Are you sure top-up ADD-ON?",
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
                      acFactory.buy_addon($scope.addon_amt)
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
                    swal("Cancelled", "ADD-ON cancelled:)", "error");
                }
            });
         }
         
           
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
                      acFactory.change_addon_status($scope.addon.auto_addon)
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
        $scope.get_subscription_id=function()
        {
          $scope.block_site('Fetching Subscription');
                      acFactory.get_subscription_id($scope.subscribe_plan_id)
              .success(
                      function( html )
                      {
                           $.unblockUI();
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');
                           }
                           if(html.status_code == '1')
                           { 
                            // swal('Success!',html.status_text,'success');
                            $scope.subscription_id=html.subscription_id;
                             // $scope.get_predata();
                           }
                      }
                );              
                    
                
         
           
        }


$scope.change_subscription_status=function(subscription_status)
        {
           if(subscription_status==1)
			{
		    var sts='Activate';		
			}else
			{
			var sts='Deactivate';	
			}
		  var msg= "Are you sure to "+sts+" Subscription?";
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
            function(isConfirm) {
                if (isConfirm) {
                      acFactory.change_subscription_status($scope.setting.subscription_status)
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
                             $scope.get_data();
                           }
                      }
                );              
                    
                } else {
                    swal("Cancelled", "cancelled:)", "error");
                }
            });
         
           
        }

        $scope.block_site=function(message='Please wait')
        {

            $.blockUI({ message:message,css: { 
                border: 'none', 
                padding: '3px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity: .5, 
                color: '#fff' 
            },baseZ:9999});

        }


        // $scope.block_site('Loading Wait');
    





	
  


       

});
</script>



				

               