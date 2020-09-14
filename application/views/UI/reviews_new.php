 <?php
$baseurl=base_url();
$base_url=base_url();
?>
<script src="<?php echo $baseurl.'/asset/js/chart.bundle.min.js'?>"></script>

<div class="wrapper"  ng-controller='invCtrl'>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <div class="page-title-right"></div>
            <h4 class="page-title"></h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card-box">
            <div class="row">
              <div class="col-md-3">
                <h4 class="page-title">Amazon Product Reviews </h4>
              </div>
              <div class="col-md-8"></div>
              <div class="col-md-1 text-right">
                <div class="dropdown notification-list">
                  <a class="dropdown-toggle waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="true">
                    <i class="fe-video noti-icon"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-lg" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-269px, 5px, 0px);">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                      <h5 class="m-0">
                        <span class="float-right">
                          <a href="#" class="text-dark">
                            <small>Clear All</small>
                          </a>
                        </span>Knowledge Base Videos
                      </h5>
                    </div>
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 492.994px;">
                      <div class="slimscroll noti-scroll" style="overflow: hidden; width: auto; height: 492.994px;">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                          <div class="notify-icon bg-primary">
                            <i class="fe-video"></i>
                          </div>
                          <p class="notify-details">Feedback Outlook Software Demo
                            <span>A short introduction to Feedback Outlook and how it works</span>
                            <small class="text-muted">12mins 42secs</small>
                          </p>
                        </a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                          <div class="notify-icon bg-primary">
                            <i class="fe-video"></i>
                          </div>
                          <p class="notify-details">Feedback Outlook Software Demo
                            <span>A short introduction to Feedback Outlook and how it works</span>
                            <small class="text-muted">12mins 42secs</small>
                          </p>
                        </a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                          <div class="notify-icon bg-primary">
                            <i class="fe-video"></i>
                          </div>
                          <p class="notify-details">Feedback Outlook Software Demo
                            <span>A short introduction to Feedback Outlook and how it works</span>
                            <small class="text-muted">12mins 42secs</small>
                          </p>
                        </a>
                      </div>
                      <div class="slimScrollBar" style="background: rgb(158, 165, 171); width: 8px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 124.764px;"></div>
                      <div class="slimScrollRail" style="width: 8px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
                    </div>
                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">View all
                      <i class="fi-arrow-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="container-fluid">
              <div class="row">
                <div class="col-xl-12">
                  <div class="table-responsive">
                    <table class="table table-stripped table-hover table-bordered table-centered mb-0">
                      <thead class="thead-light">
                        <tr>
                          <th>Channel</th>
                          <th>SKU</th>
                          <th>Image</th>
                          <th>Title</th>
                          <th>ASIN</th>
                          <th>Today Reviews</th>
                          <th>Last 7 days Reviews</th>
                          <th>Positive Reviews</th>
                          <th>Negative Reviews</th>
						              <th>Total Reviews</th>
                        </tr>
                      </thead>
                      <tbody ng-repeat="idx in reviews_data.reviews track by $index">
 						<tr>
 							<td>Channel</td>
							<td>{{idx.item_sku}}</td>
							<td>
 								<img src="{{idx.item_image}}" height="32" width="32" alt="">
							</td>
							<td>
								<div ng-click="expand($index)">
									{{idx.item_title}}
								</div>
							</td>
							<td>{{idx.item_asin}}</td>
							<td>{{idx.today_review_count}}</td>
							<td>{{idx.seven_days_count}}</td>
							<td>{{idx.positive_review_count}}</td>
							<td>{{idx.negative_review_count}}</td>
							<td>{{idx.item_total_reviews}}</td>
						 </tr>
						 <tr class="remove-hover" ng-if="idx.expanded">
						 	<td colspan="10">
							 <div class="row">
								<div class="col-xl-4">
								<img src="{{idx.item_image}}" height="300" width="300" alt="">
								</div>
								<div class="col-xl-4">
									{{idx.item_title}}
									{{idx.item_asin}}
								</div>
							 	<div class="col-xl-4">
									<div class="row">
										<div class="col-xs-12 col-md-12">
											<div class="well well-sm">
												<div class="row">
													<div class="col-xs-12 col-md-4 text-center rating-block">
														<h4 class="header-title mb-3">Customer Reviews</h4>
														<h1 class="rating-num">
															4.0</h1>
														<div class="rating">
															<span class="fa fa-star"></span><span class="fa fa-star">
															</span><span class="fa fa-star"></span><span class="fa fa-star">
															</span><span class="fa fa-star-empty"></span>
														</div>
														<div>
															<span class="fa fa-user"></span> {{idx.item_total_reviews}} Total Reviews
														</div>
													</div>
													<div class="col-xs-12 col-md-8 rating-block">
														<h4 class="header-title mb-3">Rating Breakdown</h4>
														<div class="pull-left">
															<div class="pull-left" style="width:35px; line-height:1;">
																<div style="height:9px; margin:5px 0;">5 <span
																		class="text-warning fa fa-star"></span></div>
															</div>
															<div class="pull-left" style="width:180px;">
																<div class="progress" style="height:9px; margin:8px 0;">
																	<div class="progress-bar progress-bar-success" role="progressbar"
																		aria-valuenow="5" aria-valuemin="0" aria-valuemax="5"
																		style="width: 1000%">
																		<span class="sr-only">80% Complete (danger)</span>
																	</div>
																</div>
															</div>
															<div class="pull-right" style="margin-left:10px;">1</div>
														</div>
														<div class="pull-left">
															<div class="pull-left" style="width:35px; line-height:1;">
																<div style="height:9px; margin:5px 0;">4 <span
																		class="text-warning fa fa-star"></span></div>
															</div>
															<div class="pull-left" style="width:180px;">
																<div class="progress" style="height:9px; margin:8px 0;">
																	<div class="progress-bar progress-bar-primary" role="progressbar"
																		aria-valuenow="4" aria-valuemin="0" aria-valuemax="5"
																		style="width: 80%">
																		<span class="sr-only">80% Complete (danger)</span>
																	</div>
																</div>
															</div>
															<div class="pull-right" style="margin-left:10px;">1</div>
														</div>
														<div class="pull-left">
															<div class="pull-left" style="width:35px; line-height:1;">
																<div style="height:9px; margin:5px 0;">3 <span
																		class="text-warning fa fa-star"></span></div>
															</div>
															<div class="pull-left" style="width:180px;">
																<div class="progress" style="height:9px; margin:8px 0;">
																	<div class="progress-bar progress-bar-info" role="progressbar"
																		aria-valuenow="3" aria-valuemin="0" aria-valuemax="5"
																		style="width: 60%">
																		<span class="sr-only">80% Complete (danger)</span>
																	</div>
																</div>
															</div>
															<div class="pull-right" style="margin-left:10px;">0</div>
														</div>
														<div class="pull-left">
															<div class="pull-left" style="width:35px; line-height:1;">
																<div style="height:9px; margin:5px 0;">2 <span
																		class="text-warning fa fa-star"></span></div>
															</div>
															<div class="pull-left" style="width:180px;">
																<div class="progress" style="height:9px; margin:8px 0;">
																	<div class="progress-bar progress-bar-warning" role="progressbar"
																		aria-valuenow="2" aria-valuemin="0" aria-valuemax="5"
																		style="width: 40%">
																		<span class="sr-only">80% Complete (danger)</span>
																	</div>
																</div>
															</div>
															<div class="pull-right" style="margin-left:10px;">0</div>
														</div>
														<div class="pull-left">
															<div class="pull-left" style="width:35px; line-height:1;">
																<div style="height:9px; margin:5px 0;">1 <span
																		class="text-warning fa fa-star"></span></div>
															</div>
															<div class="pull-left" style="width:180px;">
																<div class="progress" style="height:9px; margin:8px 0;">
																	<div class="progress-bar progress-bar-danger" role="progressbar"
																		aria-valuenow="1" aria-valuemin="0" aria-valuemax="5"
																		style="width: 20%">
																		<span class="sr-only">80% Complete (danger)</span>
																	</div>
																</div>
															</div>
															<div class="pull-right" style="margin-left:10px;">0</div>
														</div>

														<!-- end row -->
													</div>
												</div>
											</div>
										</div>
									</div>
							 	</div>
							 </div>
						 		<table class="table table-stripped table-bordered table-centered mb-0 mt-3">
						 			<thead class="thead-light">
						 				<tr>
						 					<th>Date</th>
						 					<th>Reviewer</th>
						 					<th>Rating</th>
						 					<th>Title </th>
						 					<th>Review</th>
						 				</tr>
						 			</thead>
						 			<tbody>
						 				<tr ng-repeat="rid in reviews_data.reviews[$index].review_data">
						 					<td>
						 						{{rid.review_date}}
						 					</td>
						 					<td>
						 						{{rid.cust_name}}
						 					</td>
						 					<td>
						 						<div class="text-warning mb-2 font-13">
						 							<i ng-repeat="i in setRound(idx.review_rating) track by $index"
						 								class='fa fa-star'></i>
						 						</div>
						 					</td>
						 					<td>
						 						{{rid.review_title}}
						 					</td>
						 					<td width="20%">
						 						{{rid.review_desc}}
						 					</td>
						 				</tr>
								</tbody>
							</table>
							 </td>
						 </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class=""></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
crawlApp.factory('invFactory', ['$http', '$q','limitToFilter', 'Upload',function($http,$q,limitToFilter,Upload) {


    var inv_list_url  =   "<?php echo $baseurl ."reviews_new/get_reviews"?>";


    var get_transaction_list = function (orderby,direction,offset,limit,search)
    {
          var deferred = $q.defer();
          var path = inv_list_url;
          $http.get(path)
          .success(function(data,status,headers,config){deferred.resolve(data);})
          .error(function(data, status, headers, config) { deferred.reject(status);});
          return deferred.promise;
    };


    return {
        get_transaction_list:get_transaction_list
    };

}]);
crawlApp.controller('invCtrl', ['$scope','$parse','$window','invFactory','$http','limitToFilter','$timeout',function($scope,$parse,$window,invFactory,$http,limitToFilter,$timeout) {
      $scope.transactionList=[];

      $scope.filter={};
      $scope.filter.search='';
    $scope.filter.list_status='ALL';
	  $scope.filter.export_type='CSV';
	  $scope.reviews_data = [];
	  $scope.reviews = [];
	  $scope.expand_b = [];
      $scope.reset=function()
      {
      $scope.cpn={};
      $scope.cpn.prod_asin='';
      $scope.cpn.id_type='ASIN';

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
                opacity: .5,
                color: '#fff'

            },baseZ:9999});

        }

    $scope.itemsPerPage = 25;
  $scope.itm_per ='25';
    $scope.currentPage = 0;
    $scope.sortorder='open_date';
    $scope.direction='DESC';
    $scope.searchJSON=[];
    $scope.filterquery=[];
    $scope.order={};


    $scope.range = function()
    {
        var rangeSize = 5;
        var ret = [];
        var start;

        start = $scope.currentPage;

        if ( start > $scope.pageCount()-rangeSize ) {
          start = $scope.pageCount()-rangeSize;
        }

        for (var i=start; i<start+rangeSize; i++) {
          if(i>=0)
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
   $scope.expand = function(id) {
	$scope.reviews_data.reviews[id].expanded = !$scope.reviews_data.reviews[id].expanded;
   }
   $scope.get_transaction_list=function(currentPage)
   {
      $scope.block_site();
      var promise= invFactory.get_transaction_list();
         promise.then(function(value){
		  $.unblockUI();
		//   console.log(value)
         if(value.status_text === "Success")
         {

            //   $scope.transactionList=value.datalist;
            //   $scope.total=value.total;
			//   $scope.outstanding=value.outstanding;
			$scope.reviews_data = value;

         }
         else
         {
            $scope.transactionList=[];
            $scope.total=0;
			$scope.outstanding=value.outstanding;
            // console.log(value);

         }
       },
      function(reason)
      {
        console.log("Reason"+reason);
      });
   }


   $scope.filtergrid=function()
   {
     $scope.filterquery=[
                          {searchtext:$scope.filter.search},
              {list_status:$scope.filter.list_status}

                          ];
    var argum=JSON.stringify($scope.filterquery);
    $scope.searchJSON=encodeURIComponent(argum);
    $scope.get_transaction_list(0);

   }

  $scope.change_item_per_page=function()
   {
    $scope.itemsPerPage=parseInt($scope.itm_per);
    $scope.get_transaction_list($scope.currentPage);
   }
   $scope.change_order=function(col)
    {
       console.log('roder');
      $scope.sortorder=col;

      if($scope.direction=='ASC')
        $scope.direction='DESC';
      else if($scope.direction=='DESC')
        $scope.direction='ASC';
      $scope.currentPage=0;
      $scope.get_transaction_list($scope.currentPage);

    }


}]);
</script>
