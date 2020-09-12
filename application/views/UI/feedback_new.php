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



 <div class="wrapper"  ng-controller='dashCtrl'>

                <div class="content">



                    <!-- Start Content-->

                    <div class="container">

                        <!-- start page title -->

                        <div class="row">

                            <div class="col-12">

                                <div class="page-title-box">

                                    <div class="page-title-right">



                                    </div>

                                    <h4 class="page-title"></h4>

                                </div>

                            </div>

                        </div>

                        <!-- end page title -->



						<!----------Notification Starts------------>




									<div class="card-box Campaigns">
                    <div class="row">

									  <div class="col-md-12 col-lg-2 col-sm-12">
											<h4 class="page-title">Feedback </h4>
										</div>

											<div class="col-md-12 col-lg-10 col-sm-12">
                        <div class="row">
                          <div class="col-md-10 col-xs-10 col-sm-10">
                            <ul class="nav nav-tabs nav-bordered">

                              <li ng-click="filter('all')" class="nav-item">

                                <a href="#all" data-toggle="tab" aria-expanded="false" class="nav-link active">

                                  All

                                </a>

                              </li>

                              <li ng-click="filter('pos')" class="nav-item">

                                <a href="#positive" data-toggle="tab" aria-expanded="true" class="nav-link text-success">

                                  <img src="<?php echo $baseurl.'/assets/img/positive_smile.png'?>" width="20px"> Positive

                                </a>

                              </li>

                              <li ng-click="filter('neut')" class="nav-item">

                                <a href="#netural" data-toggle="tab" aria-expanded="true" class="nav-link">

                                  <img src="<?php echo $baseurl.'/assets/img/neutral_smile.png'?>" width="20px"> Neutral

                                </a>

                              </li>

                              <li ng-click="filter('neg')" class="nav-item">

                                <a href="#negative" data-toggle="tab" aria-expanded="true" class="nav-link text-danger">

                                  <img src="<?php echo $baseurl.'/assets/img/negative_smile.png'?>" width="20px"> Negative

                                </a>

                              </li>

                              <li ng-click="filter('bad')" class="nav-item">

                                <a href="#all_bad" data-toggle="tab" aria-expanded="true" class="nav-link text-danger">

                                  All Bad

                                </a>

                              </li>



                            </ul>
                          </div>
                          <div class="col-md-2 col-xs-2 col-sm-2 text-right">

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



                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 492.994px;"><div class="slimscroll noti-scroll" style="overflow: hidden; width: auto; height: 492.994px;">



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





                                </div><div class="slimScrollBar" style="background: rgb(158, 165, 171); width: 8px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 124.764px;"></div><div class="slimScrollRail" style="width: 8px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>



                                <!-- All-->

                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">

                                  View all

                                  <i class="fi-arrow-right"></i>

                                </a>



                              </div>

                            </div>

                          </div>
                      </div>
                      </div>
                      </div>




										<hr>

										<form>

											<div class="row">

												<div class="col-md-3">

													<div class="form-group">

													<label for="search" class="sr-only">Search</label>

													<input type="text" class="form-control" placeholder="Search Order ID or Buyer Email">

												</div>

												</div>

												<!--<div class="col-md-3">

													<div class="form-group mx-sm-3">

													<div class="dropdown">

														<a class="btn btn-primary btn-block dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

															Select a campaign<i class="mdi mdi-chevron-down"></i>

														</a>



														<div class="dropdown-menu icon_menu_size" aria-labelledby="dropdownMenuLink" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">

															<a class="dropdown-item" href="#">All Campaigns</a>

															<a class="dropdown-item" href="#">Live Campaigns</a>

															<a class="dropdown-item" href="#">Paused Campaigns</a>

															<a class="dropdown-item" href="#">Test Campaigns</a>

															<a class="dropdown-item" href="#">Activity Campaigns</a>

															<a class="dropdown-item" href="#">Feedback Rating</a>

														</div>

													</div>

												</div>

												</div>-->

												<div class="col-md-6">

													<!----------------------------------------->

													<div class="form-group">

														<div id="reportrange" class="form-control pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">

															<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;

															<span id="calendar-date"></span> <b class="caret"></b>

														</div>

													</div>

												</div>

												<div class="col-md-3 text-right">

													<div class="form-group">

														<a ng-click="get_predata()" class="btn btn-primary  text-light"> Filter </a>

													</div>

												</div>

											</div>

										</form>







													<!----------------------------------------->



											</form>

                      <div class="table-responsive">
                      	<table class="text-center table-bordered table-striped table table-hover">
                      		<thead class="">
                      			<tr>
                      				<th>Product</th>
                      				<th>Date</th>
                      				<th>Buyer </th>
                      				<th>Sent</th>
                      				<th>Rating</th>
                      				<th>Comment</th>
                      			</tr>
                      		</thead>
                      		<tbody>
                      			<tr ng-repeat="idx in feedback_all track by $index">
                              <td>
                                {{idx.itm_title}}
                              </td>
                              <td>
                                {{idx.fbk_date}}
                              </td>
                              <td>
                                {{idx.rater_email}}
                              </td>
                              <td>
                                {{idx.rater_email}}
                              </td>
                              <td>
                                <div class="text-warning mb-2 font-13">
                                  <i ng-repeat="i in setRound(idx.fbk_rating) track by $index" class='fa fa-star'></i>
                                </div>
                              </td>
                              <td>
                                {{idx.asin}}
                              </td>
                      			</tr>
                      		</tbody>
                      	</table>
                      </div>

										</div>

											<br>

											<hr>

											<div class="row">

												<div class="col-md-12">

												</div>

											</div>

											<div class="tab-content">

												<!-----------------------------all----------------------------->

												<div class="tab-pane" id="all">



												</div>

												<!-----------------------------positive----------------------------->

												<div class="tab-pane" id="positive">



												</div>

												<!-----------------------------neutral----------------------------->

												<div class="tab-pane" id="neutral">



												</div>

												<!-----------------------------negative----------------------------->

												<div class="tab-pane" id="negative">



												</div>

												<!-----------------------------all bad----------------------------->

												<div class="tab-pane" id="all_bad">



												</div>

												<!-----------------------------all bad----------------------------->



											</div>




									</div> <!-- end card-box-->

                        <!----------Notification Ends------------>

						<!------------------------------------------------->

						<!------------------------------------------------->





                    </div> <!-- container -->



                </div> <!-- content -->





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



//$('.ranges li').addClass('btn').css( "width", "100%" );;

</script>

				<script type="text/javascript">



//crawlApp.factory("dashFactory", function($http,$q) {

crawlApp.factory('dashFactory', function($http,$q,limitToFilter) {





   var get_data = function (frm_date,to_date) {

        var dataset_path="<?php echo $baseurl.'dashboard/get_feedbacks'?>";

        var deferred = $q.defer();

        var path =dataset_path+'/'+frm_date+'/'+to_date;



        $http.get(path)

        .success(function(data,status,headers,config){deferred.resolve(data);})

        .error(function(data, status, headers, config) { deferred.reject(status);});



        return deferred.promise;

    };

	var inv_list_url        =   "<?php echo $baseurl."dashboard/get_top_product/"?>";

    var get_transaction_list = function (orderby,direction,offset,limit,search)

    {

          var deferred = $q.defer();

          var path =inv_list_url+orderby+'/'+direction+'/'+offset+'/'+limit+'/'+search;

          $http.get(path)

          .success(function(data,status,headers,config){deferred.resolve(data);})

          .error(function(data, status, headers, config) { deferred.reject(status);});

          return deferred.promise;

    };





  return {

    get_data:get_data,

    get_transaction_list:get_transaction_list,

  };

});

crawlApp.controller('dashCtrl',function($scope,$parse,$window,dashFactory,$http,$sce,$q,$timeout,Upload,limitToFilter) {

     $scope.date_filter_tmpl="date_filter_tmpl.html";

 	 $scope.transactionList=[];

     $scope.cpn={};

     $scope.cpn.frm_date='';

	 $scope.filter={};

     $scope.filter.search='';

     $scope.cpn.to_date='';

     $scope.top_10=[];

     $scope.revenue_graph=1;

     $scope.sale_graph=0;

     $scope.campaign_graph=1;
    $scope.feedback_all = [];
    $scope.feedback_negative = [];
    $scope.feedback_positive = [];
    $scope.feedback_neutral = [];
    $scope.feedback_temp = [];


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

            }});



        }



	$scope.itemsPerPage = 10;

    $scope.currentPage = 0;

	$scope.itm_per='10';

    $scope.sortorder='GEN';

    $scope.direction='DESC';

    $scope.searchJSON=[];

    $scope.filterquery=[];

    $scope.selectedCamp=[];

    $scope.checkStatus='N';

    $scope.campList=[];



    $scope.range = function()

    {

        var rangeSize = 4;

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

   $scope.filter = function(n) {
     console.log(n)
    if(n === 'all') {
      $scope.feedback_all = $scope.feedback_temp;
    } else if (n=== 'pos') {
      $scope.feedback_all = $scope.feedback_positive;
    } else if (n === 'neg') {
      $scope.feedback_all = $scope.feedback_negative;
    } else if (n === 'neut') {
      $scope.feedback_all = $scope.feedback_neutral;
    } else if (n === 'bad') {
      var arr = [];
      var arr  = arr.concat($scope.feedback_neutral, $scope.feedback_negative);
      $scope.feedback_all = arr;
    }
   };
   $scope.setRound = function(n) {
      return new Array(parseInt(n));
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





   $scope.get_transaction_list=function(currentPage)

   {

      $scope.block_site();

      var promise= dashFactory.get_transaction_list($scope.sortorder,$scope.direction,currentPage*$scope.itemsPerPage,$scope.itemsPerPage,$scope.searchJSON);

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



         $scope.get_predata = function()

         {
            var ele = document.getElementById('calendar-date');
            var text = ele.innerHTML;
            var dates = text.split("-");
            var date1 = moment(dates[0], 'MMMM DD, YYYY').format('YYYY-MM-DD');
            var date2 = moment(dates[1], 'MMMM DD, YYYY').format('YYYY-MM-DD');
            console.log(date1, date2)
            var promise=dashFactory.get_data(date1,date2);

              promise.then(

                             function(response)

                             {

                                if(response.status_code == '1')

                                {
                                  var resp = response;
                                  var negOb = [], posOb = [], neuOb = [], all = [], pos = [], neg = [], neut = [];
                                  if ('positive' in response.fbks) {
                                    posOb = Object.entries(response.fbks.positive);
                                    pos = posOb.map((item) => {
                                      return item['1']
                                    })
                                    $scope.feedback_positive = pos;
                                  }
                                  if('negative' in response.fbks) {
                                    negOb = Object.entries(response.fbks.negative);
                                    neg = negOb.map((item) => {
                                      return item['1']
                                    })
                                    $scope.feedback_negative = neg;
                                  }
                                  if('neutral' in response.fbks) {
                                    neuOb = Object.entries(response.fbks.neutral);
                                    neut = neuOb.map((item) => {
                                      return item['1']
                                    })
                                    $scope.feedback_neutral = neut;
                                  }

                                  all = all.concat(pos,neg,neut);
                                  $scope.feedback_all = all;
                                  $scope.feedback_temp = all;
                                  
                                 
                                  
                                }

                                else

                                {

                                 swal('Error!',response.status_text,'error');

                                }

                             },

                             function(reason)

                             {



                             }

                          );

        }

        $scope.get_predata();





  //     $scope.visualise_data=function()

  //     {

  //       var ctx = document.getElementById("chartBig1").getContext('2d');

  //       var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

  //       gradientStroke.addColorStop(1, 'rgba(72,72,176,0.1)');

  //       gradientStroke.addColorStop(0.4, 'rgba(72,72,176,0.0)');

  //       gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

  //       var config = {

  //                     type: 'line',

  //                     data: {

  //                       labels: [],

  //                       datasets: [{

  //                        label: "Graph Data",

  //                         fill: true,

  //                         backgroundColor: gradientStroke,

  //                         borderColor: '#0e76bd',

  //                         borderWidth: 2,

  //                         borderDash: [],

  //                         borderDashOffset: 0.0,

  //                         pointBackgroundColor: '#00acc1',

  //                         pointBorderColor: 'rgba(255,255,255,0)',

  //                         pointHoverBackgroundColor: '#00acc1',

  //                         pointBorderWidth: 20,

  //                         pointHoverRadius: 4,

  //                         pointHoverBorderWidth: 15,

  //                         pointRadius: 4,

  //                         data: [],

  //                       }]

  //                     },

  //                    options: {

  //       scales: {

  //             xAxes: [{

  //           gridLines: {

  //               color: "rgba(0, 0, 0, 0)",

  //           },

	// 		 offset: true,

	// 		stacked: true,

	// 		ticks: {

  //                   beginAtZero:true

  //               }

  //       }],

  //       yAxes: [{

  //           gridLines: {

  //               color: "rgba(0, 0, 0, 0)",



  //           },

	// 		stacked: true,

	// 		 offset: true,

  //           gridThickness: 1,



  //            ticks: {

  //                   beginAtZero:true

  //               }

	// 	}],

	// }



  //   }

  //                   };

  //       $scope.myChartData = new Chart(ctx,config);



  //     }



  //     $scope.visualise_data();

  //     $scope.show_revenue_graph=function()

  //     {

	// 	   $scope.myChartData.config.data.datasets.length > 1?$scope.myChartData.config.data.datasets.pop():'';

	// 	    $scope.myChartData.config.data.datasets.length > 2?$scope.myChartData.config.data.datasets.pop():'';

  //        $scope.revenue_graph=1;

  //        $scope.sale_graph=0;

  //        $scope.campaing_graph=0;

  //        var lnth=$scope.graph_data.length;

  //        var chart_data=[];

  //        var chart_labels=[];

  //        for(var i=0;i<lnth;i++)

  //        {

  //         chart_data[i] =$scope.graph_data[i].total_amt ;

  //         chart_labels[i] =$scope.graph_data[i].order_date ;

  //        }

  //        $scope.chart_for="Revenue";

  //        $scope.chart_desc="Total Revenue";

	// 	  $scope.myChartData.config.type='line';

  //        $scope.myChartData.config.data.datasets[0].label="Revenue";

  //        $scope.myChartData.config.data.labels=chart_labels;

  //        $scope.myChartData.config.data.datasets[0].data = chart_data;

  //        $scope.myChartData.config.data.datasets.length > 1?$scope.myChartData.config.data.datasets.pop():'';

  //        $scope.myChartData.update();

  //     }









});

</script>

<script>

</script>



<script>

$(document).ready(function(){

    $('[data-toggle="popover"]').popover({

    html: true,



});

});

$('#search_select').select2({

    placeholder: 'Select a campaign'

});

</script>

