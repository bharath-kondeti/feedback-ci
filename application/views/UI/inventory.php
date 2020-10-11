<?php
  $baseurl=base_url();
  $base_url=base_url();
?>
<style type="text/css">
  .switch {
    position: relative;
    display: inline-block;
    width: 40px;
    height: 20px;
  }
  .switch input {
    display: none;
  }
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    border-radius: 10px;
  }
  .slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    border-radius: 50px;
    left: -5px;
    bottom: 1px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }
  input:checked+.slider {
    background-color: #0bb900;
  }
  input:focus+.slider {
    box-shadow: 0 0 1px #0bb900;
  }
  input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }
  .slider.round {
    border-radius: 34px;
  }
  .slider.round:before {
    border-radius: 50%;
  }
</style>
<div class="wrapper" ng-controller='invCtrl'>
<div ng-cloak class="content inventory" id="inventory">
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
          <h4 class="page-title">Products</h4>
        </div>
      </div>
    </div>
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
            <div class="table-responsive">
              <table class="table table-stripped table-hover table-bordered table-centered mb-0" style="text-align: center;">
                <thead class="thead-light">
                  <tr>
                    <th>Channel</th>
                    <th ng-click="change_order('prod_asin')">ASIN <i  class="mdi mdi-sort-alphabetical "></i></th>
                    <th ng-click="change_order('prod_sku')">SKU <i class="mdi mdi-sort-alphabetical "></i></th>
                    <th style="width:400px;" ng-click="change_order('prod_title')">Product Name <i  class="mdi mdi-sort-alphabetical "></i></th>
                    <th ng-click="change_order('is_active')">Status  <i  class="mdi mdi-sort-alphabetical "></i></th>
                    <th>Review Tracking  <i  class="mdi mdi-sort-alphabetical "></i></th>
                  </tr>
                </thead>
                <tbody>
                  <tr ng-repeat="lst in transactionList ">
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
                    <td><a href="https://www.{{lst.amz_domain}}/dp/{{lst.prod_asin}}" target="_blank">{{lst.prod_asin}}</a></td>
                    <td class="text-body font-weight-bold">
                      <p><a target="_blank" href="https://catalog-sc.{{lst.amz_domain}}/abis/product/DisplayEditProduct?marketplaceID={{lst.amz_code}}&ref=xx_myiedit_cont_myifba&sku={{lst.prod_sku}}&asin={{lst.prod_asin}}">{{lst.prod_sku}}</a></p>
                      <img ng-if="lst.prod_image.length > 0" src="{{lst.prod_image}}" alt="" width='32' height="32">
                      <img ng-if="lst.prod_image==''" src="<?php echo base_url().'asset/img/no_image.gif'?>" width='32' height='32'alt="">
                    </td>
                    <td>{{lst.prod_title | limitTo:100}}<span ng-if="lst.prod_title.length >=101 ">...</span>  </td>
                    <td style="width:90px"><span ng-if="lst.is_active=='1'"class="badge badge-info">Active</span>
                      <span ng-if="lst.is_active=='0'"   class="badge badge-danger">Inactive</span>
                    </td>
                    <td>
                      <div class="form-inline">
                        <label class="switch" style="margin-left: 10px">
                        <input type="checkbox" name='enable_addon' ng-model="lst.review_tracking" ng-true-value="'1'" ng-false-value="'0'" ng-change='change_status(lst.review_tracking, lst.prod_asin, lst.store_id, lst.fc_code, lst.prod_sku)'>
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
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
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


      var change_status = function(active, asin, storeid, fc_code, prod_sku)
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
          fc_code: fc_code,
          prod_sku: prod_sku,
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

      $scope.change_status = function(active, asin, storeid, fc_code, prod_sku)
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
              invFactory.change_status(active, asin, storeid, fc_code, prod_sku)
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
                  opacity: .9,
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
