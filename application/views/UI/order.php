 <?php
$baseurl=base_url();
$base_url=base_url();
?>
 
            <div class="wrapper" ng-controller='transactionCtrl'>
			    <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <?php
                     if($store_count[0]['ttl'] == 0)
                      {
                   ?> 
                        
                        <!-- start page title -->
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
									  <p>Please connect a store to start importing your orders.  <a class="btn btn-info" href="<?php echo $base_url.'manage_stores'?>">Connect Stores...</a><p>
								  	
									  </div>
                                  </div>
                            </div>
                        </div>
									
									
						
						

                   <?php
					}
                   ?> 						
						
						
					 <?php
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
                                    <h4 class="page-title">Orders</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-lg-10">
                                                <form class="form-inline">
                                                    <div class="form-group mb-2">
                                                        <label for="inputPassword2" class="sr-only">Search</label>
                                                        <input type="search"  ng-model = 'filter.search' class="form-control" id="search" placeholder="Search..." ng-enter='filtergrid()'>
                                                    </div>
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <label for="status-select" class="mr-2">Status</label>
                                                        <select class="custom-select" id="status-select" ng-change="filtergrid()" ng-model='filter.order_status'>
                                                              <option value="ALL">ALL</option>
                                                                 <option value="SHI">Shipped</option>
                                                                 <option value="PEN">Unshipped & Pending</option>
                                                                 <option value="CAN">Cancelled</option>
                                                                
                                                        </select>
                                                    </div>
													 <div class="form-group mx-sm-2 mb-2">
													<button style="margin-top:10px;"  ng-click="filtergrid()" type="button" class="btn btn-info waves-effect waves-light mb-2 mr-2">Search</button>
													 </div>
                                                </form>                            
                                            </div>
                                       </div>
                
                                        <div class="table-responsive">
                                            <table class="table table-stripped table-hover table-bordered table-centered mb-0">
                                                <thead class="thead-light">
                                                    <tr>
                                                 <th ng-click="change_order('order_no')" style="width:170px;">Order ID <i class="mdi mdi-sort-numeric "></i></th>
                                                 <th style="width:60px;">Image</th>
												 <th ng-click="change_order('seller_sku')" style="width:170px;">SKU  <i class="mdi mdi-sort-alphabetical "></i></th>
												 <th ng-click="change_order('asin')" style="width:120px;">ASIN <i class="mdi mdi-sort-alphabetical "></i></th>
                                                 <th ng-click="change_order('itm_title')" style="width:280px;" >Title <i class="mdi mdi-sort-alphabetical "></i></th>
                                                 <th ng-click="change_order('itm_qty')" style="width:70px;">Qty <i class="mdi mdi-sort-numeric "></i></th>
                                                 <th ng-click="change_order('itm_price')" style="width:90px;">Price <i class="mdi mdi-sort-numeric "></i></th>
                                                 <th ng-click="change_order('purchase_date')" style="width:100px;">PO Date <i class="mdi mdi-sort-numeric "></i></th>
                                                 <th ng-click="change_order('order_status')" style="width:110px;">Status <i class="mdi mdi-sort-alphabetical "></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="lst in transactionList ">
                                                      <td class="text-body font-weight-bold">{{lst.order_no}}</td>
													 <td> <img ng-if="lst.prod_image.length > 0" src="{{lst.prod_image}}" alt="" width='50' height="50">
                <img ng-if="lst.prod_image==''" src="<?php echo base_url().'asset/img/no_image.gif'?>" width='50' height='50'alt=""></td>
													    <td  >{{lst.seller_sku}}</td>
												<td style="width:120px;"><a href="https://www.{{lst.amz_domain}}/dp/{{lst.asin}}" target="_blank">{{lst.asin}}</a></td>
                                              
                                                <td  ng-click='show_order_details(lst)' data-target="#modal" data-toggle="modal" >
												{{lst.itm_title | limitTo:80}}<span ng-if="lst.itm_title.length >=80 ">...</span>
                                                </td>
                                                <td>{{lst.no_of_item}}</td>
                                                
                                                <td>{{lst.itm_price}}</td>
                                                <td>{{lst.purchase_date}}</td>
                                                
                                                <td ><span class="badge badge-info">{{lst.order_status}}</span></td>
                                                       
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
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->





<?php
					}
                   ?> 						
						










 <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="margin-left:-200px;width:1000px">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Order Details</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body p-4">
                                                	<!-- start -->
                                                    <div class="row">
                                                      <div class="col-sm-12">
                                <p><b>Product Name </b>: {{ord.itm_title}}</p>

                                <p><b>Seller SKU </b>: {{ord.seller_sku}}</p>
                                <p><b>Order NO </b>: {{ord.order_no}}</p>
                                


                              </div>  
							  
							  <div class="col-sm-6">
                                 <table class="table table-condensed table-striped">
                                   <tr><th colspan="2" class="text-center">Product Details</th></tr>
                                   <tr><td>Order No</td><td class="text-right">{{ord.order_no}}</td></tr>
                                   <tr><td>Purchase Date</td><td class="text-right">{{ord.purchase_date}}</td></tr>
                                   <tr><td>Expected Ship Date</td><td class="text-right">{{ord.calc_shipdate}}</td></tr>
                                   <tr><td>Expected Delivery Date</td><td class="text-right">{{ord.calc_deliverydate}}</td></tr>
                                   <tr><td>Seller SKU</td><td class="text-right">{{ord.seller_sku}}</td></tr>
                                   <tr><td>Quantity</td><td class="text-right">{{ord.no_of_item}}</td></tr>
                                   <tr><td>ASIN</td><td class="text-right">{{ord.asin}}</td></tr>
                                   <tr><td>Item Price</td><td class="text-right">{{ord.itm_price}}</td></tr>
                                   <tr><td>Shipping Price</td><td class="text-right">{{ord.itm_ship_price}}</td></tr>
                                   
                                   <tr><td>Order Status</td><td class="text-right"> <span ng-if="ord.order_status=='Shipped'" class='label label-success'>{{ord.order_status}}</span>
                                                <span ng-if="ord.order_status=='Unshipped'" class='label label-warning'>{{ord.order_status}}</span>
                                                <span ng-if="ord.order_status=='Canceled'" class='label label-danger'>{{ord.order_status}}</span>
                                                <span ng-if="ord.order_status=='PartiallyShipped'" class='label label-info'>{{ord.order_status}}</span>
                                                <span ng-if="ord.order_status=='Pending'" class='label label-danger'>{{ord.order_status}}</span></td></tr>

                                   <tr><td>Order Insight</td><td class="text-right"><span ng-if="ord.tfm_status=='Delivered'" class='label label-success'>{{ord.tfm_status}}</span>
                                            <span ng-if="ord.tfm_status=='OutForDelivery'" class='label label-success'>{{ord.tfm_status}}</span>
                                            <span ng-if="ord.tfm_status=='RejectedByBuyer'" class='label label-danger'>{{ord.tfm_status}}</span>
                                            <span ng-if="ord.tfm_status=='Undeliverable'" class='label label-danger'>{{ord.tfm_status}}</span>
                                            <span ng-if="ord.tfm_status=='LabelCanceled'" class='label label-danger'>{{ord.tfm_status}}</span>
                                            <span ng-if="ord.tfm_status=='ReturnedToSeller'" class='label label-danger'>{{ord.tfm_status}}</span>
                                            <span ng-if="ord.tfm_status=='PickedUp'" class='label label-info'>{{ord.tfm_status}}</span>  
                                            <span ng-if="ord.tfm_status=='PendingPickUp'" class='label label-info'>{{ord.tfm_status}}</span>
                                            </td></tr>
                                 </table>
                                 </div>
                                 <div class="col-sm-6">
                                 <table class="table table-condensed table-striped">
                                   <tr><th colspan="2" class="text-center">Buyer Details</th></tr>
                                   <tr><td>Buyer Name</td><td class="text-right">{{ord.buyer_name}}</td></tr>
                                   <tr><td>Buyer Email</td><td class="text-right">{{ord.buyer_email}}</td></tr>
                                   
                                   <tr><td>Address</td><td class="text-right">{{ord.shipping_addr1}}</td></tr>
                                   <tr><td>City</td><td class="text-right">{{ord.shipping_city}}</td></tr>
                                   <tr><td>Zip</td><td class="text-right">{{ord.shipping_zip}}</td></tr>
                                   <tr><td>State </td><td class="text-right">{{ord.shipping_state}}</td></tr>
                                   <tr><td>Country</td><td class="text-right">{{ord.shipping_country}}</td></tr>
                                 </table>
                                 </div>
							   
							  </div>
							  
							  
                                                  
                                                    <!-- end -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.modal -->
									
<script type="text/javascript">
crawlApp.factory('transactionFactory', ['$http', '$q','limitToFilter', 'Upload',function($http,$q,limitToFilter,Upload) {

    
    var order_list_url        =   "<?php echo $baseurl."order/get_order_list/"?>";
	    
    var get_transaction_list = function (orderby,direction,offset,limit,search) 
    {
          var deferred = $q.defer();
          var path =order_list_url+orderby+'/'+direction+'/'+offset+'/'+limit+'/'+search;
          $http.get(path)
          .success(function(data,status,headers,config){deferred.resolve(data);})
          .error(function(data, status, headers, config) { deferred.reject(status);});
          return deferred.promise;
    };
	
	return {
        get_transaction_list:get_transaction_list
        
    };
    
}]);
crawlApp.controller('transactionCtrl', ['$scope','$parse','$window','transactionFactory','$http','limitToFilter','$timeout',function($scope,$parse,$window,transactionFactory,$http,limitToFilter,$timeout) {
      $scope.transactionList=[];
      $scope.date_filter_tmpl="date_filter_tmpl.html";
      $scope.outstanding='';
      $scope.filter={};
      $scope.filter.search='';
      $scope.filter.date_rng='';
      $scope.filter.order_status='ALL';
      $scope.filter.tfm_status='ALL';
      $scope.dt_text='';
	  $scope.paginate={};
      $scope.paginate.go_to=$scope.currentPage;
      $scope.ord={};
      $scope.show_order_details=function(tnx)
      {
        $scope.ord=tnx;
		console.log($scope.ord);

      }
      $scope.reset=function()
      {
        $scope.order={};
        $scope.order_items=[];
		 $scope.cpn={};
		 $scope.cpn.ship_type='';
		 $scope.cpn.ship_service='';
		 $scope.cpn.tracking_number='';
		   

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
            }});

        }
    $scope.itemsPerPage = 25;
    $scope.itm_per='25';
    $scope.currentPage = 0;
    $scope.sortorder='purchase_date';
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
   
   $scope.get_transaction_list=function(currentPage)
   {
      $scope.block_site();
      var promise= transactionFactory.get_transaction_list($scope.sortorder,$scope.direction,currentPage*$scope.itemsPerPage,$scope.itemsPerPage,$scope.searchJSON);
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
     
   $scope.filtergrid=function()
   {
    
    if(angular.isDefined($scope.filter.frm_date) && angular.isDefined($scope.filter.to_date) && $scope.filter.frm_date.length > 0 && $scope.filter.to_date.length > 0)
    {
      $scope.dt_text="ORDERS BETWEEN ["+$scope.filter.frm_date+"] To ["+$scope.filter.to_date+"]";
    }
    
     $scope.filterquery=[
                          {searchtext:$scope.filter.search},
                          {order_status:$scope.filter.order_status},
                          {from_date:$scope.filter.frm_date},
                          {to_date:$scope.filter.to_date},
                          {tfm_status:$scope.filter.tfm_status},
                          {date_rng:$scope.filter.date_rng}
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
   
$scope.go_to_page=function()
    {
      $scope.currentPage=parseInt($scope.paginate.go_to - 1); 
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
  

	$scope.get_details=function(lst)
      {
        $scope.cpn=lst;
		console.log(lst);
	   $('#Tracking_details').modal('show');

      }
	  
	  
	  
   

}]);
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover({
    html: true, 
  content: function() {
          return $('#popover-content').html();
        }
});   
});
</script>

									
									