 <!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
 <?php
$baseurl=base_url();
$base_url=base_url();
?>
<script src="<?php echo $baseurl.'/asset/js/chart.bundle.min.js'?>"></script>

<div class="wrapper"  ng-controller='invCtrl'>
  <div ng-cloak class="content review" id="review">
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
                <h4 class="page-title">Product Reviews </h4>
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
              <div class="col-md-3">
                <div class="form-group">
                  <label for="search" class="sr-only">Search</label>
                  <input ng-model="reviews_search" type="text" class="form-control" placeholder="Search Order ID or Buyer Email">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div id="reportrange" class="form-control pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp; <span id="calendar-date"></span>  <b class="caret"></b>
                  </div>
                </div>
              </div>
              <div class="col-md-3 text-left">
                <div class="form-group">  <a ng-click="get_predata()" class="btn btn-primary  text-light"> Filter </a>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
                <ul class="pagination pagination-rounded justify-content-end my-2">
                  <li ng-class="prevPageDisabled()" class="page-item">  <a href="javascript:void(0)" ng-click="prevPage()" class="page-link">Previous</a>
                  </li>
                  <li ng-repeat="n in range()" ng-class="{active: n == currentPage}" ng-click="setPage(n)" class="page-item"> <a href="javascript:void(0)" class="page-link">{{n+1}}</a>
                  </li>
                  <li ng-class="nextPageDisabled()" class="page-item">  <a href="javascript:void(0)" ng-click="nextPage()" class="page-link">Next</a>
                  </li>
                </ul>
              </div>
            
              <div class="row">
                <div class="col-xl-12">
                  <div class="table-responsive">
                    <table style="border: 1px solid #DEE2E6; text-align: center;" class="table table-hover table-centered mb-0">
                      <thead class="thead-color">
                        <tr class="">
                          <th>Channel</th>
                          <th>ASIN</th>
                          <th>SKU</th>
                          <th>Product Name</th>
                          <th>Today Reviews</th>
                          <th>Last 7 days Reviews</th>
                          <th>Positive Reviews</th>
                          <th>Negative Reviews</th>
                          <th>Total Reviews</th>
                          <th>Expand</th>
                        </tr>
                      </thead>
                      <tbody ng-repeat="idx in reviews_data.reviews track by $index">
 						<tr>
 							<?php if($store_country == 'IN') { ?>
                <td><img width="20" height="20" src="<?php echo $base_url . 'assets/img/amazon_logo.png' ?> "><span style="color:#a3afb7;font-weight:300">.in</span></td>
              <?php } ?>
              <?php if($store_country == 'US') { ?>
                <td><img width="20" height="20" src="<?php echo $base_url . 'assets/img/amazon_logo.png' ?> "><span style="color:#a3afb7;font-weight:300">.com</span></td>
              <?php } ?>
              <?php if($store_country == 'UK') { ?>
                <td><img width="20" height="20" src="<?php echo $base_url . 'assets/img/amazon_logo.png' ?> "><span style="color:#a3afb7;font-weight:300">.co.uk</span></td>
              <?php } ?>
              <?php if($store_country == 'IT') { ?>
                <td><img width="20" height="20" src="<?php echo $base_url . 'assets/img/amazon_logo.png' ?> "><span style="color:#a3afb7;font-weight:300">.it</span></td>
              <?php } ?>
              <?php if($store_country == 'DE') { ?>
                <td><img width="20" height="20" src="<?php echo $base_url . 'assets/img/amazon_logo.png' ?> "><span style="color:#a3afb7;font-weight:300">.de</span></td>
              <?php } ?>
              <?php if($store_country == 'FR') { ?>
                <td><img width="20" height="20" src="<?php echo $base_url . 'assets/img/amazon_logo.png' ?> "><span style="color:#a3afb7;font-weight:300">.fr</span></td>
              <?php } ?>
              <?php if($store_country == 'ES') { ?>
                <td><img width="20" height="20" src="<?php echo $base_url . 'assets/img/amazon_logo.png' ?> "><span style="color:#a3afb7;font-weight:300">.es</span></td>
              <?php } ?>
              <td>{{idx.item_asin}}</td>
							<td>
                {{idx.item_sku}}
                <img src="{{idx.item_image}}" height="32" width="32" alt="">
              </td>
							<td>
								<div class="cur-pointer" ng-click="expand($index)">
									{{idx.item_title}}
								</div>
							</td>
							<td class="text-center">{{idx.today_review_count}}</td>
							<td class="text-center">{{idx.seven_days_count}}</td>
							<td class="text-center">{{idx.positive_review_count}}</td>
							<td class="text-center">{{idx.negative_review_count}}</td>
              <td class="text-center">{{idx.item_total_reviews}}</td>
              <td ng-click="expand($index)" class="text-center"><i class=" fas fa-chevron-down"></i></td>
						 </tr>
						 <tr class="remove-hover" ng-if="idx.expanded">
						 	<td style="border-top: none;" colspan="11">
							 <div class="row p-2">
								<div class="col-xl-3 align-center">
								<img src="{{idx.item_image}}" height="250" width="250" alt="">
								</div>
								<div class="col-xl-5 align-center">
                  <div class="mb-4">
                    <span class="h5">Title</span> : {{idx.item_title}}
                  </div>
									<div class="mt-4">
                  <span class="h5">ASIN</span> : {{idx.item_asin}}
                  </div>
								</div>
							 	<div class="col-xl-4 align-center">
									<div class="row">
										<div class="col-xs-12 col-md-12">
											<div class="well well-sm">
												<div class="row">
													<div class="col-xs-12 col-md-4 text-center rating-block">
														<h4 class="header-title mb-3">Customer Reviews</h4>
														<h1 class="rating-num">
															{{idx.avg_count}}</h1>
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
																		aria-valuenow="{{idx.five_star}}" aria-valuemin="0" aria-valuemax="5"
																		style="width: 1000%">
																		<span class="sr-only">80% Complete (danger)</span>
																	</div>
																</div>
															</div>
															<div class="pull-right" style="margin-left:10px;">{{idx.five_star}}</div>
														</div>
														<div class="pull-left">
															<div class="pull-left" style="width:35px; line-height:1;">
																<div style="height:9px; margin:5px 0;">4 <span
																		class="text-warning fa fa-star"></span></div>
															</div>
															<div class="pull-left" style="width:180px;">
																<div class="progress" style="height:9px; margin:8px 0;">
																	<div class="progress-bar progress-bar-primary" role="progressbar"
																		aria-valuenow="{{idx.four_star}}" aria-valuemin="0" aria-valuemax="5"
																		style="width: 80%">
																		<span class="sr-only">80% Complete (danger)</span>
																	</div>
																</div>
															</div>
															<div class="pull-right" style="margin-left:10px;">{{idx.four_star}}</div>
														</div>
														<div class="pull-left">
															<div class="pull-left" style="width:35px; line-height:1;">
																<div style="height:9px; margin:5px 0;">3 <span
																		class="text-warning fa fa-star"></span></div>
															</div>
															<div class="pull-left" style="width:180px;">
																<div class="progress" style="height:9px; margin:8px 0;">
																	<div class="progress-bar progress-bar-info" role="progressbar"
																		aria-valuenow="{{idx.three_star}}" aria-valuemin="0" aria-valuemax="5"
																		style="width: 60%">
																		<span class="sr-only">80% Complete (danger)</span>
																	</div>
																</div>
															</div>
															<div class="pull-right" style="margin-left:10px;">{{idx.three_star}}</div>
														</div>
														<div class="pull-left">
															<div class="pull-left" style="width:35px; line-height:1;">
																<div style="height:9px; margin:5px 0;">2 <span
																		class="text-warning fa fa-star"></span></div>
															</div>
															<div class="pull-left" style="width:180px;">
																<div class="progress" style="height:9px; margin:8px 0;">
																	<div class="progress-bar progress-bar-warning" role="progressbar"
																		aria-valuenow="{{idx.two_star}}" aria-valuemin="0" aria-valuemax="5"
																		style="width: 40%">
																		<span class="sr-only">80% Complete (danger)</span>
																	</div>
																</div>
															</div>
															<div class="pull-right" style="margin-left:10px;">{{idx.two_star}}</div>
														</div>
														<div class="pull-left">
															<div class="pull-left" style="width:35px; line-height:1;">
																<div style="height:9px; margin:5px 0;">1 <span
																		class="text-warning fa fa-star"></span></div>
															</div>
															<div class="pull-left" style="width:180px;">
																<div class="progress" style="height:9px; margin:8px 0;">
																	<div class="progress-bar progress-bar-danger" role="progressbar"
																		aria-valuenow="{{idx.one_star}}" aria-valuemin="0" aria-valuemax="5"
																		style="width: 20%">
																		<span class="sr-only">80% Complete (danger)</span>
																	</div>
																</div>
															</div>
															<div class="pull-right" style="margin-left:10px;">{{idx.one_star}}</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
							 	</div>
							 </div>
						 		<table style="border: 1px solid #DEE2E6; text-align: center;" class="table table-hover table-centered mb-0">
						 			<thead class="thead-color">
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
						 							<i ng-repeat="i in setRound(rid.review_rating) track by $index"
						 								class='fa fa-star'></i>
                         </div>
                         <div>
                           {{rid.review_rating}}
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
                  <ul class="pagination pagination-rounded justify-content-end my-2">
                    <li ng-class="prevPageDisabled()" class="page-item">  <a href="javascript:void(0)" ng-click="prevPage()" class="page-link">Previous</a>
                    </li>
                    <li ng-repeat="n in range()" ng-class="{active: n == currentPage}" ng-click="setPage(n)" class="page-item"> <a href="javascript:void(0)" class="page-link">{{n+1}}</a>
                    </li>
                    <li ng-class="nextPageDisabled()" class="page-item">  <a href="javascript:void(0)" ng-click="nextPage()" class="page-link">Next</a>
                    </li>
                </ul>
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
  function cb(start, end) {
    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  }
  cb(moment().subtract(29, 'days'), moment());

  $('#reportrange').daterangepicker({
    ranges: {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
  }, cb);
</script>

<script type="text/javascript">
crawlApp.factory('invFactory', ['$http', '$q','limitToFilter', 'Upload',function($http,$q,limitToFilter,Upload) {


    var inv_list_url  =   "<?php echo $baseurl ."reviews_new/get_reviews"?>";


    var get_transaction_list = function (offset,limit,date1,date2,search_var,search_param)
    {
          var deferred = $q.defer();
          var path = inv_list_url;
          $http.get(path+'/'+offset+'/'+limit+'/'+date1+'/'+date2+'/'+search_var+'/'+search_param)
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
    $scope.searchTerm = '';
    $scope.selectedRange = '';
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
                backgroundColor: 'white',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: 0.9,
                color: '#fff'

            },baseZ:9999});

        }

    $scope.itemsPerPage = 15;
    $scope.itm_per ='25';
    $scope.currentPage = 0;
    $scope.sortorder='open_date';
    $scope.direction='DESC';
    $scope.searchJSON=[];
    $scope.filterquery=[];
    $scope.order={};
    $scope.total = 0;

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
     console.log(id)
	  $scope.reviews_data.reviews[id].expanded = !$scope.reviews_data.reviews[id].expanded;
   }
   $scope.get_transaction_list=function(currentPage)
   {
      $scope.block_site();
      var ele,text,dates,date1,date2,search_var,search_param,isOrder;
      ele = document.getElementById('calendar-date');
      text = ele.innerHTML;
      dates = text.split("-");
      date1 = moment(dates[0], 'MMMM DD, YYYY').format('YYYY-MM-DD');
      date2 = moment(dates[1], 'MMMM DD, YYYY').format('YYYY-MM-DD');
      search_term = $scope.searchTerm;
      if(search_term != '') {
        isOrder = /^\d+\-\d+\-\d+$/.test(search_term);
        if(isOrder) {
          search_var = search_term;
          search_param = "order";
        } else {
          search_var = search_term;
          search_param = "email";
        }
      } else {
        search_var = "empty";
        search_param = "empty";
      }
      var promise= invFactory.get_transaction_list(currentPage*$scope.itemsPerPage,$scope.itemsPerPage,date1,date2,search_var,search_param);
         promise.then(function(value){
		  $.unblockUI();
         if(value.status_text === "Success")
         {
			    $scope.reviews_data = value;
          $scope.total = value.total_records;
         }
         else
         {
            $scope.transactionList=[];
            $scope.total=0;
         }
       },
      function(reason)
      {
        console.log("Reason"+reason);
      });
   }

   $scope.setRound = function(n) {
      return new Array(parseInt(n));
    };
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
