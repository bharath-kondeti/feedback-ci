 <?php
$baseurl=base_url();
$base_url=base_url();
?>
<link href="<?php echo $baseurl.'/asset/css/datepicker.css'?>" rel="stylesheet">
<script src="<?php echo $baseurl.'/asset/js/jquery_ui_core_1_10.js'?>"></script>
<script src="<?php echo $baseurl.'/asset/js/jq_datepicker_1_10.js'?>"></script>
<script>
  $( function() {
    $(".date_selector").datepicker({minDate:0, dateFormat: "yy-mm-dd",});
  } );
</script>

<div class="wrapper" ng-controller='emailjunctionCtrl'>
	<div class="content">
		<div class="container-fluid">
		<?php
			if($store_count[0]['ttl'] == 0)
            {
			 ?>
				<div class="row">
					<div class="col-12">
						<div class="page-title-box">
							<div class="page-title-right">
								<ol class="breadcrumb m-0">
								</ol>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
							  <p>Please connect a store to start importing your inventory.  <a class="btn btn-info" href="<?php echo $base_url.'manage_stores'?>">Connect Stores...</a></p>

							  </div>
						  </div>
					</div>
				</div>
			<?php
			}
			?><?php
			 if($store_count[0]['ttl'] > 0)
			{
				?>
				<div class="row">
					<div class="col-12">
						<div class="page-title-box">
							<div class="page-title-right">
								<ol class="breadcrumb m-0">

								</ol>
							</div>
							<h4 class="page-title">Emails</h4>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<div id="basicwizard">
									<ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-4">
										<li class="nav-item">
											<a href="#basictab1" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2"  ng-click="get_campaign_list('schduled_mail')">
												<i class="mdi mdi-account-circle mr-1"></i>
												<span class="d-none d-sm-inline">Scheduled Emails</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="#basictab2" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2" ng-click="get_campaign_list('sent_mail')">
												<i class="mdi mdi-face-profile mr-1"></i>
												<span class="d-none d-sm-inline">Sent Emails</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="#basictab3" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2" ng-click="get_campaign_list('blocked_mail')">
												<i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
												<span class="d-none d-sm-inline">Blocked Emails</span>
											</a>
										</li>
									</ul>


									<div class="tab-content b-0 mb-0">
										<div class="tab-pane" id="basictab1">
											<div class="row">
											   <div class="col-sm-2">
													<form role="form">
														<div class="form-group contact-search m-b-30">
															<input type="text" placeholder="Search..." ng-model = 'filter.search' ng-enter='filtergrid()' class="form-control" id="search">
														 </div>
														<!-- form-group -->
													</form>
												</div>
												<div class="col-sm-3">
													<select class="form-control" ng-model='filter.camp_id'>
														<option value='ALL' >ALL Campaign</option>
														<option ng-repeat="x in campList" value='{{x.campaign_id}}'>{{x.campaign_name}}</option>
													</select>
												</div>
												<div class="col-sm-2 no-padding">
													  <input type='text' class='form-control date_selector'  jqdatepicker name='from' placeholder='From' ng-model='filter.frm_date'>
												</div>
												<div class="col-sm-2 no-padding">
														<input type='text' class='form-control date_selector'  jqdatepicker name='to' placeholder='To' ng-model='filter.to_date'>
												</div>
												<div class="col-sm-1 no-padding">
												  <a class='btn btn-info' ng-click='filtergrid()'>Search</a>
												</div>
											</div>

											<div class="table-responsive">
												<table style="border: 1px solid #DEE2E6; text-align: center;" class="table table-hover table-centered mb-0">
													<thead class="thead-color">
														<tr>
															<th style="width: 20px;">
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck1" ng-model="checkStatus" ng-change="statusCheck()" ng-true-value="'Y'" ng-false-value="'N'"/>
																	<label class="custom-control-label" for="customCheck1">&nbsp;</label>
																</div>
															</th>
															<th>Order #</th>
															<th>PO Date</th>
															<th >Date to Send</th>
															<th style='width:40px'>DNS</th>
															<th>Mail</th>
															<th >Campaign Name</th>
															<th >Buyer</th>
															<th >SKU</th>
															<th >Feedback</th>
														</tr>
													</thead>
													<tbody>
														<tr ng-repeat="tnx in transactionList ">
															<td>
																<div class="custom-control custom-checkbox">
																<input type="checkbox"  checklist-value="tnx" checklist-model="selectedOrder" class="custom-control-input" id="customCheck2-{{$index+1}}">
																<label class="custom-control-label" for="customCheck2-{{$index+1}}">&nbsp;</label>
																</div>
															</td>
															<td>{{tnx.order_no}}</td>
															<td>{{tnx.purchase_date}}</td>
															<td>{{tnx.trigger_on}}</td>
															<td>
																<span ng-if="tnx.dns_status=='0'" class='label label-success'>N</span>
																<span ng-if="tnx.dns_status=='1'" class='label label-danger'>Y</span>
															</td>
															<td>
															  <span ng-if="tnx.is_sent=='0'" class='label label-warning'>Not sent</span>
																<span ng-if="tnx.is_sent=='1'" class='label label-success'>Sent</span>
															</td>
															<td >{{tnx.campaign_name}}</td>
															<td>{{tnx.buyer_name}}<span ng-if="tnx.buyer_name.length==0 ">-------</span></td>
															<td>{{tnx.seller_sku}}</td>
															<td>{{tnx.fbk_comment}}<span ng-if='tnx.fbk_comment.length==0'>------</span></td>
														</tr>
													</tbody>
												</table>
											</div>

											<ul class="pagination pagination-rounded justify-content-end my-2">
												<li ng-class="prevPageDisabled()" class="page-item">
													<a  href="javascript:void(0)" ng-click="prevPage()"  class="page-link">Previous</a>
												</li>
												<li ng-repeat="n in range()" ng-class="{active: n == currentPage}" ng-click="setPage(n)"  class="page-item">
													<a href="javascript:void(0)" class="page-link">{{n+1}}</a>
												</li>
												<li ng-class="nextPageDisabled()" class="page-item">
													<a href="javascript:void(0)" ng-click="nextPage()" class="page-link">Next</a>
												</li>
											</ul>
										</div>

										<div class="tab-pane" id="basictab2">
											<div class="row">
												<div class="col-sm-2">
													<form role="form">
														<div class="form-group contact-search m-b-30">
															<input type="text" placeholder="Search..." ng-model = 'filter.search' ng-enter='filtergrid()' class="form-control" id="search">
														</div>
														<!-- form-group -->
													</form>
												</div>
												<div class="col-sm-2">
													<select class="form-control" ng-model='filter.camp_id'>
														<option value='ALL' >ALL Campaign</option>
														<option ng-repeat="x in campList" value='{{x.campaign_id}}'>{{x.campaign_name}}</option>
													</select>
												</div>
												<div class="col-sm-1 no-padding">
													  <input type='text' class='form-control date_selector'  jqdatepicker name='from' placeholder='From' ng-model='filter.frm_date'>
												</div>
												<div class="col-sm-1 no-padding">
														<input type='text' class='form-control date_selector'  jqdatepicker name='to' placeholder='To' ng-model='filter.to_date'>
												</div>

												<div class="col-sm-1 no-padding">
												  <a class='btn btn-info' ng-click='filtergrid()'>Search</a>
												</div>

												  <div class="col-sm-2 no-padding" >
												  <a class='btn btn-danger' ng-click='mark_as_dns()'>Mark DNS</a>
												</div>
												<div class="col-sm-2 no-padding">
												  <a class='btn btn-success' ng-click='send_now()'>Send Now</a>
												</div>
											</div>

											<div class="table-responsive">
												<table style="border: 1px solid #DEE2E6; text-align: center;" class="table table-hover table-centered mb-0">
													<thead class="thead-color">
														<tr>
															<th style="width: 20px;">
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck1" ng-model="checkStatus" ng-change="statusCheck()" ng-true-value="'Y'" ng-false-value="'N'"/>
																	<label class="custom-control-label" for="customCheck1">&nbsp;</label>
																</div>
															</th>
															<th>Order #</th>
															<th>PO Date</th>
															<th style='width:40px'>DNS</th>
															<th>Mail</th>
															<th >Campaign Name</th>
															<th >Buyer</th>
															<th >SKU</th>
															<th >Feedback</th>
														</tr>
													</thead>
													<tbody>
														<tr ng-repeat="tnx in transactionList ">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox"  checklist-value="tnx" checklist-model="selectedOrder" class="custom-control-input" id="customCheck2-{{$index+1}}">
																	<label class="custom-control-label" for="customCheck2-{{$index+1}}">&nbsp;</label>
																</div>
															</td>
															<td>{{tnx.order_no}}</td>
															<td>{{tnx.purchase_date}}</td>
															<td>
																<span ng-if="tnx.dns_status=='0'" class='label label-success'>N</span>
																<span ng-if="tnx.dns_status=='1'" class='label label-danger'>Y</span>
															</td>
															<td>
															  <span ng-if="tnx.is_sent=='0'" class='label label-warning'>Not sent</span>
																<span ng-if="tnx.is_sent=='1'" class='label label-success'>Sent</span>
															</td>
															<td >{{tnx.campaign_name}}</td>
															<td >{{tnx.buyer_name}}<span ng-if="tnx.buyer_name.length==0 ">-------</span></td>
															<td>{{tnx.seller_sku}}</td>
															<td>{{tnx.fbk_comment}}<span ng-if='tnx.fbk_comment.length==0'>------</span></td>
														</tr>
													</tbody>
												</table>
											</div>

											<ul class="pagination pagination-rounded justify-content-end my-2">
												<li ng-class="prevPageDisabled()" class="page-item">
													<a  href="javascript:void(0)" ng-click="prevPage()"  class="page-link">Previous</a>
												</li>
												<li ng-repeat="n in range()" ng-class="{active: n == currentPage}" ng-click="setPage(n)"  class="page-item">
													<a href="javascript:void(0)" class="page-link">{{n+1}}</a>
												</li>
												<li ng-class="nextPageDisabled()" class="page-item">
													<a href="javascript:void(0)" ng-click="nextPage()" class="page-link">Next</a>
												</li>
											</ul>
										</div>

										<div class="tab-pane" id="basictab3">
											<div class="row">
												<div class="col-sm-2">
													<form role="form">
														<div class="form-group contact-search m-b-30">
															<input type="text" placeholder="Search..." ng-model = 'filter.search' ng-enter='filtergrid()' class="form-control" id="search">
														</div>
													</form>
												</div>
												<div class="col-sm-2">
													<select class="form-control" ng-model='filter.camp_id'>
														<option value='ALL' >ALL Campaign</option>
														<option ng-repeat="x in campList" value='{{x.campaign_id}}'>{{x.campaign_name}}</option>
													</select>
												</div>
												<div class="col-sm-1 no-padding">
													<input type='text' class='form-control date_selector'  jqdatepicker name='from' placeholder='From' ng-model='filter.frm_date'>
												</div>
												<div class="col-sm-1 no-padding">
													<input type='text' class='form-control date_selector'  jqdatepicker name='to' placeholder='To' ng-model='filter.to_date'>
												</div>
												<div class="col-sm-1 no-padding">
													<a class='btn btn-info' ng-click='filtergrid()'>Search</a>
												</div>
												<div class="col-sm-2 no-padding" >
													<a class='btn btn-danger' ng-click='mark_as_dns()'>Mark DNS</a>
												</div>
												<div class="col-sm-2 no-padding">
													<a class='btn btn-success' ng-click='rmv_dns()'>Remove DNS</a>
												</div>
											</div>
											<div class="table-responsive">
												<table style="border: 1px solid #DEE2E6; text-align: center;" class="table table-hover table-centered mb-0">
													<thead class="thead-color">
														<tr>
															<th style="width: 20px;">
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck1" ng-model="checkStatus" ng-change="statusCheck()" ng-true-value="'Y'" ng-false-value="'N'"/>
																	<label class="custom-control-label" for="customCheck1">&nbsp;</label>
																</div>
															</th>
															<th>Order #</th>
															<th>PO Date</th>
															<th >Date to Send</th>
															<th >DNS</th>
															<th>Mail</th>
															<th >Campaign Name</th>
															<th >Buyer</th>
															<th >SKU</th>
															<th >Feedback</th>
														</tr>
													</thead>
													<tbody>
                                                    <tr ng-repeat="tnx in transactionList ">
														<td>
															<div class="custom-control custom-checkbox">
																<input type="checkbox"  checklist-value="tnx" checklist-model="selectedOrder" class="custom-control-input" id="customCheck2-{{$index+1}}">
																<label class="custom-control-label" for="customCheck2-{{$index+1}}">&nbsp;</label>
															</div>
														</td>
														<td>{{tnx.order_no}}</td>
														<td>{{tnx.purchase_date}}</td>
														<td>{{tnx.trigger_on}}</td>
														<td>
															<span ng-if="tnx.dns_status=='0'" class='label label-success'>N</span>
															<span ng-if="tnx.dns_status=='1'" class='label label-danger'>Y</span>
														</td>
														<td>
														  <span ng-if="tnx.is_sent=='0'" class='label label-warning'>Not sent</span>
															<span ng-if="tnx.is_sent=='1'" class='label label-success'>Sent</span>
														</td>

														<td style='width:200px'>{{tnx.campaign_name}}</td>

														<td style='width:200px'>{{tnx.buyer_name}}<span ng-if="tnx.buyer_name.length==0 ">-------</span></td>
														<td>{{tnx.seller_sku}}</td>
														<td>{{tnx.fbk_comment}}<span ng-if='tnx.fbk_comment.length==0'>------</span></td>
													 </tr>
												</tbody>
											</table>
                                        </div>
                                        <ul class="pagination pagination-rounded justify-content-end my-2">
											<li ng-class="prevPageDisabled()" class="page-item">
												<a  href="javascript:void(0)" ng-click="prevPage()"  class="page-link">Previous</a>
											</li>
											<li ng-repeat="n in range()" ng-class="{active: n == currentPage}" ng-click="setPage(n)"  class="page-item">
												<a href="javascript:void(0)" class="page-link">{{n+1}}</a>
											</li>
											<li ng-class="nextPageDisabled()" class="page-item">
												<a href="javascript:void(0)" ng-click="nextPage()" class="page-link">Next</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			}
			?>
		</div>
	</div>

<script type="text/javascript">
crawlApp.factory('emailjunctionFactory', ['$http', '$q','limitToFilter', function($http,$q,limitToFilter) {

    var order_list_url        =   "<?php echo $baseurl."my_campaign/get_campaign_order/"?>";


    var get_transaction_list = function (cntxt,orderby,direction,offset,limit,search)
    {
          var deferred = $q.defer();
          var path =order_list_url+cntxt+'/'+orderby+'/'+direction+'/'+offset+'/'+limit+'/'+search;
          console.log(path);
          $http.get(path)
          .success(function(data,status,headers,config){deferred.resolve(data);})
          .error(function(data, status, headers, config) { deferred.reject(status);});
          return deferred.promise;
    };
    var get_data = function () {
        var dataset_path="<?php echo $baseurl.'my_campaign/get_pre_data'?>";
        var deferred = $q.defer();
        var path =dataset_path;

        $http.get(path)
        .success(function(data,status,headers,config){deferred.resolve(data);})
        .error(function(data, status, headers, config) { deferred.reject(status);});

        return deferred.promise;
    };
    var send_now=function(tnx)
    {
       return $http({
                      method: "post",
                      url:"<?php echo $baseurl.'my_campaign/send_now'?>",
                      data:{
                        cmp:angular.toJson(tnx)
                      }
                     });

    };
    var mark_as_dns=function(selectedOrder)
    {
       return $http({
                      method: "post",
                      url:"<?php echo $baseurl.'my_campaign/mark_as_dns'?>",
                      data:{
                          selected_order:angular.toJson(selectedOrder)
                      }
                     });

    };

   var rmv_dns=function(selectedOrder)
    {
       return $http({
                      method: "post",
                      url:"<?php echo $baseurl.'my_campaign/rmv_dns'?>",
                      data:{
                          selected_order:angular.toJson(selectedOrder)
                      }
                     });

    };



    return {
        get_transaction_list:get_transaction_list,
        get_data:get_data,
        send_now:send_now,
        mark_as_dns:mark_as_dns,
		rmv_dns:rmv_dns

    };

}]);
crawlApp.controller('emailjunctionCtrl', ['$scope','$parse','$window','emailjunctionFactory','$http','limitToFilter',function($scope,$parse,$window,emailjunctionFactory,$http,limitToFilter) {
      $scope.transactionList=[];
      $scope.context="schduled_mail";
      $scope.outstanding='';
      $scope.filter={};
      $scope.filter.search='';
      $scope.filter.order_status='ALL';
      $scope.filter.tfm_status='ALL';
      $scope.filter.camp_id='ALL';
	  $scope.filter.type='ALL';
      $scope.reset=function()
      {
        $scope.order={};
        $scope.order_items=[];

      }
      $scope.reset();


  $scope.block_site=function()
        {
            $.blockUI({ css: {
                border: 'none',
                padding: '3px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .9,
                color: '#fff'
            }});

        }

    $scope.itemsPerPage = 25;
    $scope.itm_per='25';
    $scope.currentPage = 0;
    $scope.sortorder='camp_id';
    $scope.direction='DESC';
    $scope.searchJSON=[];
    $scope.filterquery=[];
    $scope.selectedOrder=[];
    $scope.order={};

    $scope.range = function()
    {
        var rangeSize = 8;
        var ret = [];
        var start;

        start = $scope.currentPage;

        if ( start > $scope.pageCount()-rangeSize ) {
          start = $scope.pageCount()-rangeSize;
        }

        for (var i=start; i<start+rangeSize; i++) {
          if(i>0)
          ret.push(i);
        }
        return ret;
   };

   $scope.prevPage = function()
   {
        if ($scope.currentPage > 0)
        {
          $scope.currentPage--;
        }
   };



   $scope.prevPageDisabled = function()
   {
        return $scope.currentPage === 0 ? "disabled" : "";
   };

   $scope.nextPage = function()
   {
        if ($scope.currentPage < $scope.pageCount() - 1)
        {
          $scope.currentPage++;
        }
   };

   $scope.nextPageDisabled = function()
   {
        return $scope.currentPage === $scope.pageCount() - 1 ? "disabled" : "";
   };

   $scope.pageCount = function()
   {
        return Math.ceil($scope.total/$scope.itemsPerPage);
   };

   $scope.setPage = function(n)
   {
        if (n > 0 && n < $scope.pageCount())
        {
          $scope.currentPage = n;
        }
   };

   $scope.$watch("currentPage",function(newValue, oldValue)
   {
     $scope.get_transaction_list(newValue);
   });
   $scope.get_campaign_list=function(str)
   {
    $scope.context=str;
    if($scope.currentPage==0)
    {
       $scope.currentPage=0;
       $scope.get_transaction_list(0);
    }
    else
    {
      $scope.currentPage=0;
    }

    //
   }
   $scope.change_item_per_page=function()
   {

    $scope.itemsPerPage=parseInt($scope.itm_per);
    $scope.get_transaction_list($scope.currentPage);
   }

   $scope.get_transaction_list=function(currentPage)
   {
      $scope.block_site();
      var promise= emailjunctionFactory.get_transaction_list($scope.context,$scope.sortorder,$scope.direction,currentPage*$scope.itemsPerPage,$scope.itemsPerPage,$scope.searchJSON);
         promise.then(function(value){
          $.unblockUI();
         if(value.status_code==1)
         {

              $scope.transactionList=value.datalist;
              $scope.total=value.total;
              $scope.outstanding=value.outstanding;

         }
         else
         {
            $scope.transactionList=[];
            $scope.total=0;
            $scope.outstanding=value.outstanding;
            console.log(value);

         }
       },
      function(reason)
      {
        console.log("Reason"+reason);
      });
   }
  $scope.mark_as_dns=function()
  {
          if($scope.selectedOrder.length>0)
            {

              swal({
                title: "Are you sure to mark as DNS?",
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
                  emailjunctionFactory.mark_as_dns($scope.selectedOrder)
              .success(
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');
                           }
                           if(html.status_code == '1')
                           {
                             $scope.get_transaction_list($scope.currentPage);
                              swal('Success!',html.status_text,'success');
                           }
                      }
                )

                } else {
                    swal("Cancelled", "update cancelled:)", "error");
                }
            });


             }
     else
     {
        swal('Error!',"There is no order selected",'error');
     }

   }

   $scope.rmv_dns=function()
  {
          if($scope.selectedOrder.length>0)
            {

              swal({
                title: "Are you sure to Remove DNS?",
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
                  emailjunctionFactory.rmv_dns($scope.selectedOrder)
              .success(
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');
                           }
                           if(html.status_code == '1')
                           {
                             $scope.get_transaction_list($scope.currentPage);
                              swal('Success!',html.status_text,'success');
                           }
                      }
                )

                } else {
                    swal("Cancelled", "update cancelled:)", "error");
                }
            });


             }
     else
     {
        swal('Error!',"There is no order selected",'error');
     }

   }

   $scope.filtergrid=function()
   {
     $scope.filterquery=[
                          {searchtext:$scope.filter.search},
                          {camp_id:$scope.filter.camp_id},
                          {from_date:$scope.filter.frm_date},
                          {to_date:$scope.filter.to_date},
                          {order_status:$scope.filter.order_status},
                          {tfm_status:$scope.filter.tfm_status},
						  {type:$scope.filter.type}
                        ];
    var argum=JSON.stringify($scope.filterquery);
    $scope.searchJSON=encodeURIComponent(argum);
    $scope.get_transaction_list(0);

   }

   $scope.get_predata = function()
         {
            var promise=emailjunctionFactory.get_data();
              promise.then(
                             function(response)
                             {
                                if(response.status_code == '1')
                                {
                                    $scope.campList=response.campaign_list;
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

    $scope.send_now=function()
      {

        if($scope.selectedOrder.length>0 && $scope.selectedOrder.length <=3 )
        {
          swal({
                title: "Are you sure to send mail?",
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
                  $scope.block_site();
                  emailjunctionFactory.send_now($scope.selectedOrder)
                    .success(
                              function( html )
                              {
                                console.log(html);
                                $.unblockUI();
                                  if(html.status_code==0)
                                  {
                                     swal('Error!',html.status_text,'error');
                                  }
                                  else if(html.status_code==1)
                                  {
                                     swal('Success!',html.status_text,'success');
                                  }

                              }
                    )
                    .error(
                           function(data, status, headers, config)
                                {

                                 }

                    );

                } else {
                    swal("Cancelled", "Mail cancelled", "error");
                }
            });
        }
        else
        {
          swal("Error", "Please send 3 mail at a time ", "error");
        }


    }


  $scope.select_all=function()
   {
      for(i=0;i< $scope.transactionList.length;i++)
      {
        $scope.addToArray($scope.selectedOrder,$scope.transactionList[i]);
      }
      $scope.selectcount=$scope.selectedOrder.length;
      $scope.totalcount=$scope.total;
  }

   $scope.clear_all=function()
   {
      $scope.clearArray($scope.selectedOrder);
   }

   $scope.checkExist=function(arr,item)
   {
      if (angular.isArray(arr)) {
      for (var i = arr.length; i--;) {
        if (angular.equals(arr[i], item)) {
          return true;
        }
      }
    }
    return false;
   }

   $scope.addToArray=function(arr,item)
   {
      arr = angular.isArray(arr) ? arr : [];
      if(!$scope.checkExist(arr, item))
      {
          arr.push(item);
      }
   }
   $scope.removeFromArray=function(arr,item)
   {
      arr = angular.isArray(arr) ? arr : [];
      for (var i = arr.length; i--;)
      {
        if (angular.equals(arr[i], item))
        {
          arr.splice(i, 1);
        }
      }
   }

   $scope.clearArray=function(arr)
   {
     if (angular.isArray(arr))
     {
       for (var i = arr.length; i--;)
        {
           arr.splice(i, 1);
        }
     }
   }

   $scope.$watch("selectedOrder.length",
           function(newValue, oldValue)
           {
             if(newValue < $scope.transactionList.length)
             {
              $scope.checkStatus='N';
             }
            });
       $scope.statusCheck=function()
      {

           console.log("checkStatus");
           console.log($scope.checkStatus);

           if($scope.checkStatus=='Y')
           {
            $scope.select_all();
           }
           else if($scope.checkStatus=='N')
           {
            $scope.clear_all();
           }
      }






}]);
</script>
