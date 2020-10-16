 <?php
$baseurl=base_url();
$base_url=base_url();
?>
<script src="<?php echo $baseurl.'/asset/js/chart.bundle.min.js'?>"></script>

 <div class="wrapper"  ng-controller='dashCtrl'>
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">

                                    </div>
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
						<!----------Dashboard Notice Starts------------>
						<div class="row">
							<div class="col-md-12">
								<div class="alert alert-primary" role="alert">
									<div class="col-md-6 offset-3">
										<h4 class="text-center">Welcome to FeedbackExpress, vamshi thogaru</h4>
										<p class="text-center">To increase your seller feedback and/or product reviews,
let’s create your first email campaign with our 40 second setup wizard.</p>
										<div class="text-center">
											<button type="button" class="btn btn-md btn-primary waves-effect waves-light">Add your first email campaign</button>
										</div>

									</div>
								</div>
							</div>
						</div>
                        <!----------Dashboard Notice Ends------------>
                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                                <i class="fe-heart font-22 avatar-title text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="text-dark mt-1">{{revenue.revenue_total}}</h3>
                                                <p class="text-muted mb-1 text-truncate">Total Revenue</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                                <i class="fe-shopping-cart font-22 avatar-title text-success"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="text-dark mt-1"><span>{{revenue.order_count}}</span></h3>
                                                <p class="text-muted mb-1 text-truncate">Total Orders</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                                <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="text-dark mt-1"><span>{{metrics.total_cmp}}</span></h3>
                                                <p class="text-muted mb-1 text-truncate">Campaigns</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                                <i class="fe-eye font-22 avatar-title text-warning"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="text-dark mt-1"><span >{{fbk_data.feedback_count}}</span></h3>
                                                <p class="text-muted mb-1 text-truncate">Feebacks</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->

                        <div class="row">


                            <div class="col-xl-12">
                                <div class="card-box">
                                    <h4 class="header-title mb-3">Sales Analytics</h4>

                                     <!--<div id="chartBig1" class="flot-chart mt-4 pt-1" style="height: 375px;"></div> --->
									 <canvas id="chartBig1" style="display: block;width:1043px;height: 300px;"></canvas>
                                </div> <!-- end card-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card-box">
                                    <h4 class="header-title mb-3">Recent Orders</h4>

                                    <div class="table-responsive">
                                        <table style="border: 1px solid #DEE2E6; text-align: center;" class="table table-hover table-centered mb-0">

                                            <thead class="thead-color">
                                                <tr>
                                              <th style="width:100px">SKU</th>
                                              <th>ASIN</th>
                                              <th>Order No</th>
     										  <th style="width:100px">PO Date</th>
                                              <th style="width:300px">Title</th>
                                              <th>Price</th>
                                              <th>Qty</th>
                                              <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                <tr ng-repeat="ord in recent_ten_orders">
												<td>{{ord.seller_sku}} </td>
						  <td>{{ord.asin}} </td>
						  <td>{{ord.order_no}} </td>
                          <td>{{ord.po_date}} </td>
                          <td>{{ord.itm_title | limitTo:50}}</td>
                          <td>{{ord.itm_price}}</td>
						  <td>{{ord.itm_qty}}</td>
						  <td><span ng-if="ord.order_status=='Shipped'" class="badge badge-success">{{ord.order_status}}</span>
						      <span ng-if="ord.order_status=='Canceled'"  class="badge badge-danger">{{ord.order_status}}</span>
							  <span ng-if="ord.order_status=='Pending'"  class="badge badge-info">{{ord.order_status}}</span></td>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-xl-12">
                                <div class="card-box">
                                    <h4 class="header-title mb-3">Best Selling Products</h4>

                                    <div class="table-responsive">
                                        <table style="border: 1px solid #DEE2E6; text-align: center;" class="table table-hover table-centered mb-0">

                                            <thead class="thead-color">
                                                <tr>
                                                    <th style="width:100px">SKU</th>
													<th style="width:100px">ASIN</th>
                                                    <th>Title</th>
                                                    <th>Price</th>
                                                    <th>Qty</th>
                                                    <th>Sold Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="tnx in transactionList ">
                                                    <td>{{tnx.prod_sku}}</td>
													<td>{{tnx.prod_asin}}</td>
													<td>{{tnx.prod_title}}</td>
													<td>{{tnx.itm_price}}</td>
													<td style="text-align:center">{{tnx.itm_qty}}</td>
													<td style="text-align:center">{{tnx.sold_qty}}</td>


                                                </tr>



                                            </tbody>
                                        </table>
                                    </div> <!-- end .table-responsive-->
                                </div> <!-- end card-box-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->



				<script type="text/javascript">

//crawlApp.factory("dashFactory", function($http,$q) {
crawlApp.factory('dashFactory', function($http,$q,limitToFilter) {


   var get_data = function () {
        var dataset_path="<?php echo $baseurl.'dashboard/get_pre_data'?>";
        var deferred = $q.defer();
        var path =dataset_path;

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
            var promise=dashFactory.get_data();
              promise.then(
                             function(response)
                             {
                                if(response.status_code == '1')
                                {

                                      $scope.revenue=response.revenue[0];
									  $scope.metrics=response.metrics;
                                      $scope.fbk_data=response.fbk_data[0];
									  $scope.recent_ten_orders=response.recent_ten_orders;
                                      $scope.graph_data=response.graph_data;
                                      $scope.show_revenue_graph(response.graph_data.order_date,response.graph_data[0].total_amt);


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


      $scope.visualise_data=function()
      {
        var ctx = document.getElementById("chartBig1").getContext('2d');
        var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.1)');
        gradientStroke.addColorStop(0.4, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors
        var config = {
                      type: 'line',
                      data: {
                        labels: [],
                        datasets: [{
                         label: "Graph Data",
                          fill: true,
                          backgroundColor: gradientStroke,
                          borderColor: '#0e76bd',
                          borderWidth: 2,
                          borderDash: [],
                          borderDashOffset: 0.0,
                          pointBackgroundColor: '#00acc1',
                          pointBorderColor: 'rgba(255,255,255,0)',
                          pointHoverBackgroundColor: '#00acc1',
                          pointBorderWidth: 20,
                          pointHoverRadius: 4,
                          pointHoverBorderWidth: 15,
                          pointRadius: 4,
                          data: [],
                        }]
                      },
                     options: {
        scales: {
              xAxes: [{
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            },
			 offset: true,
			stacked: true,
			ticks: {
                    beginAtZero:true
                }
        }],
        yAxes: [{
            gridLines: {
                color: "rgba(0, 0, 0, 0)",

            },
			stacked: true,
			 offset: true,
            gridThickness: 1,

             ticks: {
                    beginAtZero:true
                }
		}],
	}

    }
                    };
        $scope.myChartData = new Chart(ctx,config);

      }

      $scope.visualise_data();
      $scope.show_revenue_graph=function()
      {
		   $scope.myChartData.config.data.datasets.length > 1?$scope.myChartData.config.data.datasets.pop():'';
		    $scope.myChartData.config.data.datasets.length > 2?$scope.myChartData.config.data.datasets.pop():'';
         $scope.revenue_graph=1;
         $scope.sale_graph=0;
         $scope.campaing_graph=0;
         var lnth=$scope.graph_data.length;
         var chart_data=[];
         var chart_labels=[];
         for(var i=0;i<lnth;i++)
         {
          chart_data[i] =$scope.graph_data[i].total_amt ;
          chart_labels[i] =$scope.graph_data[i].order_date ;
         }
         $scope.chart_for="Revenue";
         $scope.chart_desc="Total Revenue";
		  $scope.myChartData.config.type='line';
         $scope.myChartData.config.data.datasets[0].label="Revenue";
         $scope.myChartData.config.data.labels=chart_labels;
         $scope.myChartData.config.data.datasets[0].data = chart_data;
         $scope.myChartData.config.data.datasets.length > 1?$scope.myChartData.config.data.datasets.pop():'';
         $scope.myChartData.update();
      }




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
</script>
