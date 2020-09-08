 <?php
$baseurl=base_url();
$base_url=base_url();
?>
 
            <div class="wrapper" ng-controller='invCtrl'>
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
                                    <h4 class="page-title">Hijack </h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-lg-12">
                                                <form class="form-inline">
                                                    <div class="form-group mb-2">
                                                        <label for="inputPassword2" class="sr-only">Search</label>
                                                        <input type="search"  ng-model = 'filter.search' class="form-control" id="search" placeholder="Search..." ng-enter='filtergrid()'>
                                                    </div>
                                                    <div class="form-group mx-sm-2 mb-2">
                                                        
														<select class="custom-select"  style="width:100px" ng-model='filter.list_status'>
                                <option value="ALL">ALL</option>
                                <option value="ACT">Hijack Alert Active</option>
                                <option value="INAC">Hijack Alert Inactive</option>
                              </select>
                                                        
                                                    </div>
													<div class="form-group mx-sm-2 mb-2">
                                                       
														<select class="custom-select" ng-model='filter.is_hijacked'>
                                <option value="ALL">ALL</option>
                                <option value="YES">Yes</option>
                                <option value="NO">No</option>
                              </select>
													
                                                    </div>
													<div class="form-group mx-sm-2 mb-2">
                                                        
													 <select  class="custom-select" style="width:100px" ng-model='filter.prod_brand'>
                              <option value='ALL'>ALL</option> 
                              <option ng-repeat="x in brand_list" value='{{x.prod_brand}}'>{{x.prod_brand}}</option>
                            </select>
							  </div>
													 <div class="form-group mx-sm-1 mb-2">
													<button style="margin-top:10px;"  ng-click="filtergrid()" type="button" class="btn btn-info waves-effect waves-light mb-2 mr-2">Search</button>
													 </div>
													 
													 
<div class="form-group mx-sm-4 mb-2">
                           <a href='#' class="btn btn-info"  ng-click='set_hijack_alert()'>Set Hijack </a>
                           <a href='#' style="margin-left:10px;" class="btn btn-danger"  ng-click='remove_hijack_alert()'>Remove Hijack </a>
                            </div>	
                                                </form>  

											
                                            </div>
											
										
                                        </div>
                
                                        <div class="table-responsive">
                                            <table class="table table-stripped table-hover table-bordered table-centered mb-0">
                                                <thead class="thead-light">
                                                    <tr>
													 <th>
                                             <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1"  ng-model="sel.checkStatus" ng-change="statusCheck()" ng-true-value="'Y'" ng-false-value="'N'"/>
                                                  <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                                </div>
                                                </th>
                                        
                                                <th >Image</th>
                                                <th  ng-click="change_order('prod_sku')">SKU <i class="mdi mdi-sort-alphabetical "></i></th>
                                                <th  ng-click="change_order('prod_asin')" >ASIN <i  class="mdi mdi-sort-alphabetical "></i></th>
                                                <th  ng-click="change_order('prod_brand')" >Brand <i  class="mdi mdi-sort-alphabetical "></i></th>
                                                <th  ng-click="change_order('prod_title')" >Title <i  class="mdi mdi-sort-alphabetical "></i></th>
										        <th>Hijack Status</th>
                                                <!-- <th ng-click="change_order('last_hijack_check')" >Updated on <i class="mdi mdi-sort-alphabetical "></i></th> -->
												  <th >Hijacked<i class="mdi mdi-sort-alphabetical "></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="lst in transactionList ">
													 <td>
                                            <div class="custom-control custom-checkbox">
                                               <input type="checkbox"  checklist-value="lst" checklist-model="selectedOrder" class="custom-control-input" id="customCheck2-{{$index+1}}">
                                                <label class="custom-control-label" for="customCheck2-{{$index+1}}">&nbsp;</label>
                                                   </div>
                                               </td>
													  <td> <img ng-if="lst.prod_image.length > 0" src="{{lst.prod_image}}" alt="" width='25' height="25">
                <img ng-if="lst.prod_image==''" src="<?php echo base_url().'asset/img/no_image.gif'?>" width='25' height='25'alt=""></td>
                                           <td>{{lst.prod_sku}}</td>
                                                <td ><a class="text-body font-weight-bold" target="_blank" href="https://www.{{lst.amz_domain}}/dp/{{lst.prod_asin}}">{{lst.prod_asin}}</a></td>
                                                <td >{{lst.prod_brand}}</td>
                                                <td >
												{{lst.prod_title |limitTo:80}} <span ng-if="lst.prod_title.length >=81 ">...</span></td>
                                                </td>
                                               <td > <span ng-if="lst.check_hijack=='1'" class="badge badge-info">Active</span>
												<span ng-if="lst.check_hijack=='0'" class="badge badge-danger">Inactive</span></td>
												
                                               
                                               <!-- <td>{{lst.last_hijack_check}}</td> -->
												
												 <td>
                <span class="badge badge-info " ng-if="lst.hijacked_count=='0'">No</span>
                 <span class="badge badge-danger " ng-if="lst.hijacked_count!='0'">Yes</span>
                
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
crawlApp.directive('onFinishRender', function ($timeout) {
    return {
        restrict: 'A',
        link: function (scope, element, attr) {
            if (scope.$last === true) {
                $timeout(function () {
                    scope.$emit('ngRepeatFinished');
                });
            }
        }
    }
});

crawlApp.factory('invFactory', ['$http', '$q','limitToFilter', function($http,$q,limitToFilter) {
    
    var inv_list_url        =   "<?php echo $baseurl."hijack/get_inventory_list/"?>";
    
    var get_data = function () {
        var dataset_path="<?php echo $baseurl.'hijack/brand_list'?>";
        var deferred = $q.defer();
        var path =dataset_path;
        
        $http.get(path)
        .success(function(data,status,headers,config){deferred.resolve(data);})
        .error(function(data, status, headers, config) { deferred.reject(status);});
        
        return deferred.promise;
    };

    var get_transaction_list = function (orderby,direction,offset,limit,search) 
    {
          var deferred = $q.defer();
          var path =inv_list_url+orderby+'/'+direction+'/'+offset+'/'+limit+'/'+search;
          $http.get(path)
          .success(function(data,status,headers,config){deferred.resolve(data);})
          .error(function(data, status, headers, config) { deferred.reject(status);});
          return deferred.promise;
    };
   
   var set_hijack_alert=function(selectedOrder)
    {
       return $http({
                      method: "post",
                      url:"<?php echo $baseurl.'hijack/set_hijack_alert'?>",
                      data:{
                          selected_order:angular.toJson(selectedOrder)
                      }
                     }); 
                   
    };

    var remove_hijack_alert=function(selectedOrder)
    {
       return $http({
                      method: "post",
                      url:"<?php echo $baseurl.'hijack/remove_hijack_alert'?>",
                      data:{
                          selected_order:angular.toJson(selectedOrder)
                      }
                     }); 
                   
    };



    
   
    
    return {
        get_transaction_list:get_transaction_list,
        set_hijack_alert:set_hijack_alert,
        remove_hijack_alert:remove_hijack_alert,
        get_data:get_data
        
        
    };
    
}]);
crawlApp.controller('invCtrl', ['$scope','$parse','$window','invFactory','$http','limitToFilter',function($scope,$parse,$window,invFactory,$http,limitToFilter) {        
      $scope.transactionList=[];
      $scope.orderList=[];
      $scope.asin='';
      $scope.filter={};
      $scope.filter.search='';
      $scope.filter.list_status='ALL';
	   $scope.filter.active_status='ALL';
      $scope.filter.is_hijacked='ALL';
      $scope.filter.prod_brand='ALL';
      $scope.selectedOrder=[];
      $scope.sel={};
      $scope.sel.checkStatus='N';
	  $scope.paginate={};
      $scope.paginate.go_to=$scope.currentPage;
      $scope.reset=function()
      {
        $scope.cpn={};
        $scope.cpn.prod_title='';
        $scope.cpn.prod_asin='';
        $scope.cpn.prod_sku='';
        $scope.cpn.act_price='';
        $scope.cpn.itm_price='';
        $scope.cpn.profit='';
        $scope.cpn.prod_id='';

      }
      $scope.reset();
   $scope.$on('ngRepeatFinished', function (ngRepeatFinishedEvent) {
      $('.collapse').on('show.bs.collapse', function () {
          $('.collapse.in').collapse('hide');
      });
  });

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
    $scope.sortorder='GEN';
    $scope.direction='DESC';
    $scope.searchJSON=[];
    $scope.filterquery=[];
    
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

   $scope.change_item_per_page=function()
   {
    
    $scope.itemsPerPage=parseInt($scope.itm_per);
    $scope.get_transaction_list($scope.currentPage);
   }

          $scope.get_predata = function()
         {
            var promise=invFactory.get_data();
              promise.then(
                             function(response)
                             {
                                if(response.status_code == '1')
                                {
                                   $scope.brand_list=response.brand_list;
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

   

    
   $scope.get_transaction_list=function(currentPage)
   {
      $scope.block_site();
      var promise= invFactory.get_transaction_list($scope.sortorder,$scope.direction,currentPage*$scope.itemsPerPage,$scope.itemsPerPage,$scope.searchJSON);
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
     $scope.filterquery=[
                          {searchtext:$scope.filter.search},
                          {list_status:$scope.filter.list_status},
                          {is_hijacked:$scope.filter.is_hijacked},
                          {brand:$scope.filter.prod_brand},
						  {active_status:$scope.filter.active_status},
                          
                        ];
    var argum=JSON.stringify($scope.filterquery);
    $scope.searchJSON=encodeURIComponent(argum);
    $scope.get_transaction_list(0);
  
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
   

     $scope.select_all=function()
   {
      for(i=0;i< $scope.transactionList.length;i++)
      {
		  //console.log($scope.selectedOrder);
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

   
   $scope.go_to_page=function()
    {
      $scope.currentPage=parseInt($scope.paginate.go_to -1); 
    }   
	
	
   $scope.$watch("selectedOrder.length",
           function(newValue, oldValue) 
           {
             if(newValue < $scope.transactionList.length)
             {
              $scope.sel.checkStatus='N';
             }
            });

      
       $scope.statusCheck=function()
      {
       
           console.log("checkStatus");
           console.log($scope.sel.checkStatus);

           if($scope.sel.checkStatus=='Y')
           {

            $scope.select_all();
           }
           else if($scope.sel.checkStatus=='N')
           {
            $scope.clear_all();
           }
      }      

      $scope.set_hijack_alert=function()
      {
          if($scope.selectedOrder.length>0)
            {

              swal({
                title: "Are you sure to set for hijack alert?",
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
                  invFactory.set_hijack_alert($scope.selectedOrder)
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
        swal('Error!',"There is no product selected",'error');
     } 
     
   }

   $scope.remove_hijack_alert=function()
  {
          if($scope.selectedOrder.length>0)
            {

              swal({
                title: "Are you sure to remove hijack alert?",
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
                  invFactory.remove_hijack_alert($scope.selectedOrder)
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
  
  


       

}]);
</script>
					