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
                          <th>S.No</th>
                          <th>SKU</th>
                          <th>Item ID</th>
                          <th>Customer Name</th>
                          <th>Review Title</th>
                          <th>Rating</th>
                          <th>Reviewed On</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
    				          <?php
                        $serial_no = 1;
                        foreach($reviews as $review) {
                      ?>
      					         <tr>
                          <td><?php echo $serial_no; ?></td>
                          <td><?php echo $review['item_SKU']; ?></td>
                          <td><?php echo $review['item_id']; ?></td>
                          <td><?php echo $review['cust_name']; ?></td>
                          <td>
                            <a href="<?php echo "https://".$review['item_url']; ?>" target="_blanck"><?php echo $review['review_title']; ?></a>
                          </td>
                          <td>
                            <div class="text-warning mb-2 font-13">
                              <strong><?php echo $review['review_rating'];?><strong> -
                              <?php $r_count = round($review['review_rating']);?>
                              <?php
                                for ($x = 1; $x <= $r_count; $x++) {
                                  echo "<i class='fa fa-star'></i>";
                                }
                              ?>
                            </div>
                          </td>
                          <td>
                            <?php
                              $date=date_create($review['review_date']);
      								        echo date_format($date,"d-M-Y");
                            ?>
                          </td>
                          <td>
                            <?php
                              if ($review['is_active']==1) {
                            ?>
                              <span class="badge badge-info">Active</span>
                            <?php } else { ?>
                              <span class="badge badge-warning">In Active</span>
                            <?php }?>
                          </td>
                          <td><a href="#">View</a></td>
                        </tr>
                        <?php $serial_no++; } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="">\</div>
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
