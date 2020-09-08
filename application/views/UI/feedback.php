 <?php
$baseurl=base_url();
$base_url=base_url();
?>
 
            <div class="wrapper" ng-controller='feedbackCtrl'>
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
									  <p>Please connect a store to start importing your inventory.  <a class="btn btn-info" href="<?php echo $base_url.'manage_stores'?>">Connect Stores...</a><p>
								  	
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
                         
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                          
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Feedback</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-lg-5">
                                                <form class="form-inline">
                                                    <div class="form-group mb-2">
                                                        <label for="inputPassword2" class="sr-only">Search</label>
                                                        <input type="search"  ng-model = 'filter.search' class="form-control" id="search" placeholder="Search..." ng-enter='filtergrid()'>
                                                    </div>
                                                 
													 <div class="form-group mx-sm-3 mb-2">
													<button style="margin-top:10px;"  ng-click="filtergrid()" type="button" class="btn btn-info waves-effect waves-light mb-2 mr-2">Search</button>
													 </div>
                                                </form>                            
                                            </div>
                                       
                                        </div>
                
                                        <div class="table-responsive">
                                            <table class="table table-stripped table-hover table-bordered table-centered mb-0">
                                                <thead class="thead-light">
                                                    <tr>
                                                <th >Image</th>
                                                <th >Review<i ng-click="change_order('fbk_rating')" class="mdi mdi-sort-numeric "></i></th>
                                                <th >Order ID<i ng-click="change_order('order_id')" class="mdi mdi-sort-numeric "></i></th>
                                                <th >Date<i ng-click="change_order('fbk_date')" class="mdi mdi-sort-numeric "></i></th>
                                                <th >ASIN <i ng-click="change_order('prod_asin')" class="mdi mdi-sort-alphabetical "></i></th>
                                                <th >Comment  <i ng-click="change_order('prod_asin')" class="mdi mdi-sort-alphabetical"></i></th>
                                                <th >Status</th>
                                              
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="lst in transactionList ">
                                          <td> <img ng-if="lst.prod_image.length > 0" src="{{lst.prod_image}}" alt="" width='50' height="50">
                <img ng-if="lst.prod_image==''" src="<?php echo base_url().'asset/img/no_image.gif'?>" width='50' height='50'alt=""></td>
				
				 <td >
                                                <span ng-if="tnx.fbk_rating=='1'" style='color:red;font-weight:600;'><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></span>
                                                <span ng-if="tnx.fbk_rating=='2'" style='color:red;font-weight:600;'><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></span>
                                                <span ng-if="tnx.fbk_rating=='3'" style='color:red;font-weight:600;'><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></span>
                                                <span ng-if="tnx.fbk_rating=='4'" style='color:green;font-weight:600;'><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></span>
                                                <span ng-if="tnx.fbk_rating=='5'" style='color:green;font-weight:600;'><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                                                                  
                                            </td>
											
											  <td style="width:110px"><a  target='_blank' href="https://sellercentral.amazon.in/hz/orders/details?_encoding=UTF8&orderId={{tnx.order_id}}">{{tnx.order_id}}</a></td>
                                                <td style="width:70px" ng-click='show_order_details(tnx)' data-target="#modal" data-toggle="modal" >{{tnx.fbk_date}}</td>
                                                <td style="width:80px"><a target="_blank" href="https://www.amazon.in/dp/{{tnx.prod_asin}}">{{tnx.prod_asin}}</a></td>
                                              
               
			    <td style="width:100px">
				 <div class="select">
				  <select class="select__field" ng-model="tnx.fbk_status" ng-change='set_to_wip(tnx)'>
				  <option  value='1'>New</option>
				  <option  value='2'>Pending</option>
				  <option  value='3'>Done</option>
			     </select>
				 </div>
				 </td>
				
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

<script type="text/javascript">
crawlApp.factory('feedbackFactory', ['$http', '$q','limitToFilter', function($http,$q,limitToFilter) {
    
    var order_list_url        =   "<?php echo $baseurl."feedback/get_review_list/"?>";
    
    
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
        get_transaction_list:get_transaction_list,
           };
    
}]);
crawlApp.controller('feedbackCtrl', ['$scope','$parse','$window','feedbackFactory','$http','limitToFilter',function($scope,$parse,$window,feedbackFactory,$http,limitToFilter) {        
      $scope.transactionList=[];
    $scope.selectedProduct=[];
      $scope.date_filter_tmpl="date_filter_tmpl.html";
      $scope.outstanding='';
      $scope.filter={};
      $scope.filter.search='';
      $scope.filter.date_rng='';
	  $scope.filter.rating='ALL';
      $scope.filter.tfm_status='ALL';
      $scope.filter.ver_status='ALL';
      $scope.filter.asin='';
      $scope.filter.title='';
      $scope.dt_text='';
      $scope.ord={};
      $scope.show_order_details=function(tnx)
      {
        $scope.ord=tnx;

      }
  
  
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
	$scope.itm_per ='25';
    $scope.currentPage = 0;
    $scope.sortorder='fbk_date';
    $scope.direction='DESC';
    $scope.searchJSON=[];
    $scope.asinJSON=[];
    $scope.titleJSON=[];
    $scope.filterquery=[];
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
   $scope.select_all=function()
   {
      $scope.showbar=true;
      console.log("Before Select");
      console.log($scope.selectedProduct);
      
      for(i=0;i< $scope.transactionList.length;i++)
      {
        // $scope.selected.push($scope.pagedItems[i].asin);
        $scope.addToArray($scope.selectedProduct,$scope.transactionList[i].order_id)  
      }
      $scope.selectcount=$scope.selectedProduct.length;
      $scope.totalcount=$scope.total;
      console.log("After Select");
      console.log($scope.selectedProduct);
      
   }

   $scope.clear_all=function()
   {
      console.log("Before Cleared");
      console.log($scope.selectedProduct);
      
      $scope.clearArray($scope.selectedProduct);
      console.log("After Cleared");
      console.log($scope.selectedProduct);
      
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
   $scope.$watch("selectedProduct.length",
           function(newValue, oldValue) 
           {
              console.log($scope.selectedProduct);
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

   $scope.get_transaction_list=function(currentPage)
   {
      $scope.block_site();
      var promise= feedbackFactory.get_transaction_list($scope.sortorder,$scope.direction,currentPage*$scope.itemsPerPage,$scope.itemsPerPage,$scope.searchJSON);
         promise.then(function(value){
          $.unblockUI();
         if(value.status_code==1)
         {
              
              $scope.transactionList=value.datalist;
              $scope.total=value.total;
              
              
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
 
   $scope.filtergrid=function()
   {
    
   
    if(angular.isDefined($scope.filter.frm_date) && angular.isDefined($scope.filter.to_date) && $scope.filter.frm_date.length > 0 && $scope.filter.to_date.length > 0)
    {
      $scope.dt_text="ORDERS BETWEEN ["+$scope.filter.frm_date+"] To ["+$scope.filter.to_date+"]";
    }
    
     $scope.filterquery=[
                          {searchtext:$scope.filter.search},
                          {rating:$scope.filter.rating},
                          {from_date:$scope.filter.frm_date},
                          {to_date:$scope.filter.to_date},
                          {tfm_status:$scope.filter.tfm_status},
                          {date_rng:$scope.filter.date_rng},
                          {ver_status:$scope.filter.ver_status},
                          {searchasin:$scope.filter.asin},
                          {searchprtitle:$scope.filter.title},
                          
                        ];
    var argum=JSON.stringify($scope.filterquery);
    $scope.searchJSON=encodeURIComponent(argum);
    $scope.get_transaction_list(0);
   $scope.preset_option();
   }

    
	$scope.change_item_per_page=function()
   {
    $scope.itemsPerPage=parseInt($scope.itm_per);
    $scope.get_transaction_list($scope.currentPage);
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
							