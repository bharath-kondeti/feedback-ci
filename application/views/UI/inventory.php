<?php
  $baseurl=base_url();
  $base_url=base_url();
?>
<div class="wrapper" ng-controller='invCtrl'>
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
            <p>Please connect a store to start importing your inventory.  <a class="btn btn-info" href="<?php echo $base_url.'manage_stores'?>">Connect Stores...</a>
            <p>
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
          <h4 class="page-title">Inventory</h4>
        </div>
        <div class="col-md-4 text-center" ng-init="selectedTab = 1;">
            <ul class="nav nav-tabs nav-bordered nav-justified ">
              <li class="nav-item active" ng-class="{active: selectedTab == 1}">
                <a ng-class="{active: selectedTab == 1}" ng-click="selectedTab = 1;" href="#inventory" data-toggle="tab" aria-expanded="false" class="nav-link">
                Inventory
                </a>
              </li>
              <li class="nav-item">
                <a ng-class="{active: selectedTab == 2}"  ng-click="selectedTab = 2;" href="#tracking" data-toggle="tab" aria-expanded="true" class="nav-link">
                  Review Tracking
                </a>
              </li>
            </ul>
          </div>
      </div>
    </div>
    <!-- end page title -->
    <div class="tab-content" ng-show="selectedTab == 1" id="inventory">
      <hr>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row mb-2">
                <div class="col-lg-7">
                  <form class="form-inline">
                    <div class="form-group mb-2">
                      <label for="inputPassword2" class="sr-only">Search</label>
                      <input type="search"  ng-model = 'filter.search' class="form-control" id="search" placeholder="Search..." ng-enter='filtergrid()'>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                      <label for="status-select" class="mr-2">Status</label>
                      <select class="custom-select" id="status-select" ng-change="filtergrid()" ng-model='filter.list_status'>
                        <option value="ALL">ALL</option>
                        <option value="ACT">Active</option>
                        <option value="INAC">Inactive</option>
                      </select>
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
                      <th ng-click="change_order('prod_sku')">SKU <i class="mdi mdi-sort-alphabetical "></i></th>
                      <th>Image  </th>
                      <th ng-click="change_order('prod_asin')">ASIN <i  class="mdi mdi-sort-alphabetical "></i></th>
                      <th style="width:400px;" ng-click="change_order('prod_title')">Title <i  class="mdi mdi-sort-alphabetical "></i></th>
                      <th ng-click="change_order('itm_price')">Sale Price <i  class="mdi mdi-sort-numeric "></i></th>
                      <th ng-click="change_order('itm_qty')">Qty <i  class="mdi mdi-sort-numeric "></i></th>
                      <th ng-click="change_order('open_date')">Open Date <i class="mdi mdi-sort-numeric "></i></th>
                      <th ng-click="change_order('is_active')">Status  <i  class="mdi mdi-sort-alphabetical "></i></th>
                      <th>Review Tracking  <i  class="mdi mdi-sort-alphabetical "></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="lst in transactionList ">
                      <td class="text-body font-weight-bold"><a target="_blank" href="https://catalog-sc.{{lst.amz_domain}}/abis/product/DisplayEditProduct?marketplaceID={{lst.amz_code}}&ref=xx_myiedit_cont_myifba&sku={{lst.prod_sku}}&asin={{lst.prod_asin}}">{{lst.prod_sku}}</a></td>
                      <td> <img ng-if="lst.prod_image.length > 0" src="{{lst.prod_image}}" alt="" width='32' height="32">
                        <img ng-if="lst.prod_image==''" src="<?php echo base_url().'asset/img/no_image.gif'?>" width='32' height='32'alt="">
                      </td>
                      <td><a href="https://www.{{lst.amz_domain}}/dp/{{lst.prod_asin}}" target="_blank">{{lst.prod_asin}}</a></td>
                      <td>{{lst.prod_title | limitTo:100}}<span ng-if="lst.prod_title.length >=101 ">...</span>  </td>
                      <td>{{lst.itm_price}}</td>
                      <td >{{lst.itm_qty}}</td>
                      <td >{{lst.open_date}}</td>
                      <td style="width:90px"><span ng-if="lst.is_active=='1'"class="badge badge-info">Active</span>
                        <span ng-if="lst.is_active=='0'"   class="badge badge-danger">Inactive</span>
                      </td>
                      <td>
                        <div class="form-inline">
                          <label class="switch" style="margin-left: 10px">
                          <input type="checkbox" name='enable_addon' ng-model="lst.review_tracking" ng-true-value="'1'" ng-false-value="'0'" ng-change='change_status(lst.review_tracking,lst.prod_asin,lst.store_id)'>
                          <span class="slider round"></span>
                          </label>
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
            </div>
            <!-- end card-body-->
          </div>
          <!-- end card-->
        </div>
        <!-- end col -->
        <?php
          }
                      ?>
      </div>
    </div>

    <div class="tab-content" ng-show="selectedTab == 2" id="tracking">
      <hr>
      <div class="row">
      </div>
    </div>
  </div>
  <!-- container -->
</div>
<!-- content -->
<script type="text/javascript">
  crawlApp.factory('invFactory', ['$http', '$q','limitToFilter', 'Upload',function($http,$q,limitToFilter,Upload) {


      var inv_list_url = "<?php echo $baseurl ."inventory/get_inventory_list/"?>";


      var get_transaction_list = function (orderby,direction,offset,limit,search)
      {
            var deferred = $q.defer();
            var path =inv_list_url+orderby+'/'+direction+'/'+offset+'/'+limit+'/'+search;
            $http.get(path)
            .success(function(data,status,headers,config){deferred.resolve(data);})
            .error(function(data, status, headers, config) { deferred.reject(status);});
            return deferred.promise;
      };


      var change_status = function(active, asin, storeid)
    {
      var search_path = "<?php echo $baseurl . 'inventory/change_status/'; ?>";
      return $http({
        method: "post",
        url: search_path,
        data:
        {
          status: active,
          asin: asin,
          storeid: storeid,
        }
      });
    };


      return {
          get_transaction_list:get_transaction_list,
          change_status:change_status
      };

  }]);
  crawlApp.controller('invCtrl', ['$scope','$parse','$window','invFactory','$http','limitToFilter','$timeout',function($scope,$parse,$window,invFactory,$http,limitToFilter,$timeout) {
        $scope.transactionList=[];

        $scope.filter={};
        $scope.filter.search='';
      $scope.filter.list_status='ALL';
        $scope.filter.export_type='CSV';
        $scope.reset=function()
        {
        $scope.cpn={};
        $scope.cpn.prod_asin='';
        $scope.cpn.id_type='ASIN';

        }
        $scope.reset();

      $scope.change_status = function(active, asin, storeid)
      {
        if (active == 1)
        {
          var sts = 'Activate';
        } else
        {
          var sts = 'Deactivate';
        }
        var msg = "Are you sure to " + sts + " Review Tracking ?";
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
              invFactory.change_status(active, asin, storeid)
                .success(
                  function(html)
                  {
                    if (html.status_code == '0')
                    {
                      swal('Error!', html.status_text, 'error');

                    }
                    if (html.status_code == '1')
                    {
                      swal('Success!', html.status_text, 'success');
                      $scope.campList = html.get_transaction_list;
                    }
                  }
                );
            } else {
              swal("Cancelled", "cancelled:)", "error");
              $scope.campList = html.get_transaction_list;
            }
          });
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
