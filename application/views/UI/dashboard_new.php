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
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          <div class="col-md-6 offset-3">
            <h4 class="text-center">Welcome to Feedback Outlook, </h4>
            <p class="text-center header-title">To increase your seller feedback and/or product reviews,
              let’s create your first email campaign with our 40 second setup wizard.
            </p>
            <div class="text-center">
              <a href="<?php echo $baseurl.'manage_campaign'?>" class="btn btn-md btn-primary waves-effect waves-light">Add your first email campaign</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!----------Dashboard Notice Ends------------>
    <!----------Sample Dashboard Below Starts------------>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-10 offset-1">
          <h4 class="text-center">Sample Dashboard Below</h4>
          <p class="text-center header-title">When all your Amazon data imports are complete, we’ll replace the sample data below with your own live data.</p>
        </div>
      </div>
    </div>
    <!----------Sample Dashboard BelowEnds------------>
    <!----------Notification Starts------------>
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-light bg-dark text-center text-dark border-1">
          <span class="text-light">vamshi, your trial is ending soon, on 26 March. <a href="" class="text-info">Enter your card details today</a> to keep the positive feedback rolling in.</span>
        </div>
      </div>
    </div>
    <!----------Notification Ends------------>
    <!----------Notification Starts------------>
    <div class="row">
      <div class="col-md-12">
        <div class="card-box">
          <div class="row">
            <div class="col-md-4">
              <h4 class="page-title">Dashboard</h4>
            </div>
            <div class="col-md-4 text-center" ng-init="selectedTab = 1;">
              <ul class="nav nav-tabs nav-bordered nav-justified ">
                <li class="nav-item active" ng-class="{active: selectedTab == 1}">
                  <a ng-class="{active: selectedTab == 1}" ng-click="selectedTab = 1;" href="#feedback" data-toggle="tab" aria-expanded="false" class="nav-link">
                  Feeback
                  </a>
                </li>
                <li class="nav-item">
                  <a ng-class="{active: selectedTab == 2}"  ng-click="selectedTab = 2;" href="#reviews" data-toggle="tab" aria-expanded="true" class="nav-link">
                  Reviews <span class="badge badge-warning badge-pill">New</span>
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-md-4 text-right">
              <div class="dropdown notification-list show">
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
                  <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                  View all
                  <i class="fi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>


          <div class="tab-content" ng-show="selectedTab == 1" id="feedback">
            <hr>
            <div class="row">
              <div class="col-md-2 col-xl-2">
                <div class="widget-rounded-circle card-box">
                  <div class="row">
                    <div class="col-12">
                      <div class="text-center">
                        <h3 class="text-dark mt-1">{{revenue.order_count}}</h3>
                        <p class="text-muted mb-1 text-truncate">Total Revenue</p>
                      </div>
                    </div>
                  </div>
                  <!-- end row-->
                </div>
                <!-- end widget-rounded-circle-->
              </div>
              <!-- end col-->
              <div class="col-md-2 col-xl-2">
                <div class="widget-rounded-circle card-box">
                  <div class="row">
                    <div class="col-12">
                      <div class="text-center">
                        <h3 class="text-dark mt-1"><span>{{revenue.order_count}}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Orders</p>
                      </div>
                    </div>
                  </div>
                  <!-- end row-->
                </div>
                <!-- end widget-rounded-circle-->
              </div>
              <!-- end col-->
              <div class="col-md-2 col-xl-2">
                <div class="widget-rounded-circle card-box">
                  <div class="row">
                    <div class="col-12">
                      <div class="text-center">
                        <h3 class="text-dark mt-1"><span>{{metrics.total_cmp}}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Messages Sent</p>
                      </div>
                    </div>
                  </div>
                  <!-- end row-->
                </div>
                <!-- end widget-rounded-circle-->
              </div>
              <!-- end col-->
              <div class="col-md-2 col-xl-2">
                <div class="widget-rounded-circle card-box">
                  <div class="row">
                    <div class="col-12">
                      <div class="text-center">
                        <h3 class="mt-1 text-success"><span >{{fbk_data.positive_count}}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Positive Feeback</p>
                      </div>
                    </div>
                  </div>
                  <!-- end row-->
                </div>
                <!-- end widget-rounded-circle-->
              </div>
              <!-- end col-->
              <div class="col-md-2 col-xl-2">
                <div class="widget-rounded-circle card-box">
                  <div class="row">
                    <div class="col-12">
                      <div class="text-center">
                        <h3 class="mt-1 text-primary"><span >{{fbk_data.neutral_count}}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Netural Feeback</p>
                      </div>
                    </div>
                  </div>
                  <!-- end row-->
                </div>
                <!-- end widget-rounded-circle-->
              </div>
              <!-- end col-->
              <div class="col-md-2 col-xl-2">
                <div class="widget-rounded-circle card-box">
                  <div class="row">
                    <div class="col-12">
                      <div class="text-center">
                        <h3 class="text-danger mt-1"><span >{{fbk_data.negative_count}}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Negative Feeback</p>
                      </div>
                    </div>
                  </div>
                  <!-- end row-->
                </div>
                <!-- end widget-rounded-circle-->
              </div>
              <!-- end col-->
            </div>
            <!-- end row-->
            <div class="row custom-font">
              <div class="col-xl-6">
                <div class="card-box">
                  <div class="row">
                    <div class="col-xs-12 col-md-12">
                      <div class="well well-sm">
                        <div class="row">
                          <div class="col-xs-12 col-md-4 text-center rating-block">
                            <h4 class="header-title mb-3">Feedback overview</h4>
                            <h1 class="rating-num">
                              {{fbk_data.avg_feedback}}
                            </h1>
                            <div class="rating">
                              <span class="fa fa-star"></span><span class="fa fa-star">
                              </span><span class="fa fa-star"></span><span class="fa fa-star">
                              </span><span class="fa fa-star-empty"></span>
                            </div>
                            <div>
                              <span class="fa fa-user"></span> {{fbk_data.feedback_count}} Total Feedback
                            </div>
                          </div>
                          <div class="col-xs-12 col-md-8 rating-block">
                            <h4 class="header-title mb-3">Rating Breakdown</h4>
                            <div class="pull-left">
                              <div class="pull-left" style="width:35px; line-height:1;">
                                <div style="height:9px; margin:5px 0;">5 <span class="text-warning fa fa-star"></span></div>
                              </div>
                              <div class="pull-left" style="width:180px;">
                                <div class="progress" style="height:9px; margin:8px 0;">
                                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{fbk_data.five_star}}" aria-valuemin="0" aria-valuemax="5" style="width: 100%">
                                    <span class="sr-only">80% Complete (danger)</span>
                                  </div>
                                </div>
                              </div>
                              <div class="pull-right" style="margin-left:10px;">{{fbk_data.five_star}}</div>
                            </div>
                            <div class="pull-left">
                              <div class="pull-left" style="width:35px; line-height:1;">
                                <div style="height:9px; margin:5px 0;">4 <span class="text-warning fa fa-star"></span></div>
                              </div>
                              <div class="pull-left" style="width:180px;">
                                <div class="progress" style="height:9px; margin:8px 0;">
                                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{fbk_data.four_star}}" aria-valuemin="0" aria-valuemax="5" style="width: 80%">
                                    <span class="sr-only">80% Complete (danger)</span>
                                  </div>
                                </div>
                              </div>
                              <div class="pull-right" style="margin-left:10px;">{{fbk_data.four_star}}</div>
                            </div>
                            <div class="pull-left">
                              <div class="pull-left" style="width:35px; line-height:1;">
                                <div style="height:9px; margin:5px 0;">3 <span class="text-warning fa fa-star"></span></div>
                              </div>
                              <div class="pull-left" style="width:180px;">
                                <div class="progress" style="height:9px; margin:8px 0;">
                                  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{fbk_data.three_star}}" aria-valuemin="0" aria-valuemax="5" style="width: 60%">
                                    <span class="sr-only">80% Complete (danger)</span>
                                  </div>
                                </div>
                              </div>
                              <div class="pull-right" style="margin-left:10px;">{{fbk_data.three_star}}</div>
                            </div>
                            <div class="pull-left">
                              <div class="pull-left" style="width:35px; line-height:1;">
                                <div style="height:9px; margin:5px 0;">2 <span class="text-warning fa fa-star"></span></div>
                              </div>
                              <div class="pull-left" style="width:180px;">
                                <div class="progress" style="height:9px; margin:8px 0;">
                                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{fbk_data.two_star}}" aria-valuemin="0" aria-valuemax="5" style="width: 40%">
                                    <span class="sr-only">80% Complete (danger)</span>
                                  </div>
                                </div>
                              </div>
                              <div class="pull-right" style="margin-left:10px;">{{fbk_data.two_star}}</div>
                            </div>
                            <div class="pull-left">
                              <div class="pull-left" style="width:35px; line-height:1;">
                                <div style="height:9px; margin:5px 0;">1 <span class="text-warning fa fa-star"></span></div>
                              </div>
                              <div class="pull-left" style="width:180px;">
                                <div class="progress" style="height:9px; margin:8px 0;">
                                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{fbk_data.one_star}}" aria-valuemin="0" aria-valuemax="5" style="width: 20%">
                                    <span class="sr-only">80% Complete (danger)</span>
                                  </div>
                                </div>
                              </div>
                              <div class="pull-right" style="margin-left:10px;">{{fbk_data.one_star}}</div>
                            </div>
                            <!-- end row -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card-box">
                  <h4 class="header-title mb-3">Positive Feedback</h4>
                  <!--<div id="chartBig1" class="flot-chart mt-4 pt-1" style="height: 375px;"></div> --->
                  <canvas class="chartBig1" style="display: block;width:100%;height: 160px;"></canvas>
                </div>
                <!-- end card-box -->
              </div>
            </div>
            <!-------Messages Graphs--------------->
            <div class="row custom-font">
              <div class="col-md-4">
                <div class="card-box">
                  <h4 class="header-title mb-3">Sales Analytics</h4>
                  <!--<div id="chartBig1" class="flot-chart mt-4 pt-1" style="height: 375px;"></div> --->
                  <canvas class="chartBig1" style="display: block;width:100%;height: 160px;"></canvas>
                </div>
                <!-- end card-box -->
              </div>
              <div class="col-md-4">
                <div class="card-box">
                  <h4 class="header-title mb-3">Orders</h4>
                  <!--<div id="chartBig1" class="flot-chart mt-4 pt-1" style="height: 375px;"></div> --->
                  <canvas class="chartBig1" style="display: block;width:100%;height: 160px;"></canvas>
                </div>
                <!-- end card-box -->
              </div>
              <div class="col-md-4">
                <div class="card-box">
                  <h4 class="header-title mb-3">Messages</h4>
                  <!--<div id="chartBig1" class="flot-chart mt-4 pt-1" style="height: 375px;"></div> --->
                  <canvas class="chartBig1" style="display: block;width:100%;height: 160px;"></canvas>
                </div>
                <!-- end card-box -->
              </div>
            </div>
            <!-------Messages Graphs--------------->
            <!-------Recent Orders--------------->
            <div class="row">
              <div class="col-xl-6 col-xl-6">
                <div class="card-box">
                  <h4 class="header-title mb-3">Recent Orders</h4>
                  <div class="table-responsive">
                    <table class="table table-borderless table-hover table-centered m-0">
                      <thead class="thead-light">
                        <tr>
                          <th style="width:100px">SKU</th>
                          <!--<th>ASIN</th> -->
                          <th>Order No</th>
                          <!--<th style="width:100px">PO Date</th>	 -->
                          <th style="width:300px">Title</th>
                          <!--<th>Price</th>     -->
                          <th>Qty</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody >
                        <tr ng-repeat="ord in recent_ten_orders">
                          <td>{{ord.seller_sku}} </td>
                          <!-- <td>{{ord.asin}} </td> -->
                          <td>{{ord.order_no}} </td>
                          <!-- <td>{{ord.po_date}} </td>	-->
                          <td>{{ord.itm_title | limitTo:50}}</td>
                          <!-- <td>{{ord.itm_price}}</td> -->
                          <td>{{ord.itm_qty}}</td>
                          <td><span ng-if="ord.order_status=='Shipped'" class="badge badge-success">{{ord.order_status}}</span>
                            <span ng-if="ord.order_status=='Canceled'"  class="badge badge-danger">{{ord.order_status}}</span>
                            <span ng-if="ord.order_status=='Pending'"  class="badge badge-info">{{ord.order_status}}</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- end col -->
              <div class="col-xl-6 col-md-6">
                <div class="card-box">
                  <h4 class="header-title mb-3">Best Selling Products</h4>
                  <div class="table-responsive">
                    <table class="table table-borderless table-hover table-centered m-0">
                      <thead class="thead-light">
                        <tr>
                          <!--<th style="width:100px">SKU</th>
                            <th style="width:100px">ASIN</th> -->
                          <th>Title</th>
                          <th>Price</th>
                          <!-- <th>Qty</th> -->
                          <th>Sold Qty</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="tnx in transactionList ">
                          <!-- <td>{{tnx.prod_sku}}</td>
                            <td>{{tnx.prod_asin}}</td> -->
                          <td>{{tnx.prod_title}}</td>
                          <td>{{tnx.itm_price}}</td>
                          <!-- <td style="text-align:center">{{tnx.itm_qty}}</td> -->
                          <td style="text-align:center">{{tnx.sold_qty}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- end .table-responsive-->
                </div>
                <!-- end card-box-->
              </div>
              <!-- end col -->
            </div>
            <!-------Recent Orders--------------->
            <!-- end row-->
          </div>

          <!-- Reviews Tab Starts -->

          <div class="tab-content" ng-show="selectedTab == 2" id="reviews">
            <hr>
            <div class="row">
              <div class="col-md-2 col-xl-2">
                <div class="widget-rounded-circle card-box">
                  <div class="row">
                    <div class="col-12">
                      <div class="text-center">
                        <h3 class="text-dark mt-1">{{revenue.order_count}}</h3>
                        <p class="text-muted mb-1 text-truncate">Total Revenue</p>
                      </div>
                    </div>
                  </div>
                  <!-- end row-->
                </div>
                <!-- end widget-rounded-circle-->
              </div>
              <!-- end col-->
              <div class="col-md-2 col-xl-2">
                <div class="widget-rounded-circle card-box">
                  <div class="row">
                    <div class="col-12">
                      <div class="text-center">
                        <h3 class="text-dark mt-1"><span>{{revenue.order_count}}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Orders</p>
                      </div>
                    </div>
                  </div>
                  <!-- end row-->
                </div>
                <!-- end widget-rounded-circle-->
              </div>
              <!-- end col-->
              <div class="col-md-2 col-xl-2">
                <div class="widget-rounded-circle card-box">
                  <div class="row">
                    <div class="col-12">
                      <div class="text-center">
                        <h3 class="text-dark mt-1"><span>{{metrics.total_cmp}}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Messages Sent</p>
                      </div>
                    </div>
                  </div>
                  <!-- end row-->
                </div>
                <!-- end widget-rounded-circle-->
              </div>
              <!-- end col-->
              <div class="col-md-2 col-xl-2">
                <div class="widget-rounded-circle card-box">
                  <div class="row">
                    <div class="col-12">
                      <div class="text-center">
                        <h3 class="mt-1 text-success"><span >{{reviews_data.positive_count}}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Positive Reviews</p>
                      </div>
                    </div>
                  </div>
                  <!-- end row-->
                </div>
                <!-- end widget-rounded-circle-->
              </div>
              <!-- end col-->
              <div class="col-md-2 col-xl-2">
                <div class="widget-rounded-circle card-box">
                  <div class="row">
                    <div class="col-12">
                      <div class="text-center">
                        <h3 class="mt-1 text-primary"><span >{{reviews_data.neutral_count}}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Netural Reviews</p>
                      </div>
                    </div>
                  </div>
                  <!-- end row-->
                </div>
                <!-- end widget-rounded-circle-->
              </div>
              <!-- end col-->
              <div class="col-md-2 col-xl-2">
                <div class="widget-rounded-circle card-box">
                  <div class="row">
                    <div class="col-12">
                      <div class="text-center">
                        <h3 class="text-danger mt-1"><span >{{reviews_data.negative_count}}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Negative Reviews</p>
                      </div>
                    </div>
                  </div>
                  <!-- end row-->
                </div>
                <!-- end widget-rounded-circle-->
              </div>
              <!-- end col-->
            </div>
            <!-- end row-->
            <div class="row custom-font">
              <div class="col-xl-6">
                <div class="card-box">
                  <div class="row">
                    <div class="col-xs-12 col-md-12">
                      <div class="well well-sm">
                        <div class="row">
                          <div class="col-xs-12 col-md-4 text-center rating-block">
                            <h4 class="header-title mb-3">Reviews overview</h4>
                            <h1 class="rating-num">
                              {{reviews_data.avg_review}}
                            </h1>
                            <div class="rating">
                              <span class="fa fa-star"></span><span class="fa fa-star">
                              </span><span class="fa fa-star"></span><span class="fa fa-star">
                              </span><span class="fa fa-star-empty"></span>
                            </div>
                            <div>
                              <span class="fa fa-user"></span> {{reviews_data.total_review_count}} Total Reviews
                            </div>
                          </div>
                          <div class="col-xs-12 col-md-8 rating-block">
                            <h4 class="header-title mb-3">Rating Breakdown</h4>
                            <div class="pull-left">
                              <div class="pull-left" style="width:35px; line-height:1;">
                                <div style="height:9px; margin:5px 0;">5 <span class="text-warning fa fa-star"></span></div>
                              </div>
                              <div class="pull-left" style="width:180px;">
                                <div class="progress" style="height:9px; margin:8px 0;">
                                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{breakdown.five_star}}" aria-valuemin="0" aria-valuemax="5" style="width: 1000%">
                                    <span class="sr-only">80% Complete (danger)</span>
                                  </div>
                                </div>
                              </div>
                              <div class="pull-right" style="margin-left:10px;">{{breakdown.five_star}}</div>
                            </div>
                            <div class="pull-left">
                              <div class="pull-left" style="width:35px; line-height:1;">
                                <div style="height:9px; margin:5px 0;">4 <span class="text-warning fa fa-star"></span></div>
                              </div>
                              <div class="pull-left" style="width:180px;">
                                <div class="progress" style="height:9px; margin:8px 0;">
                                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{breakdown.four_star}}" aria-valuemin="0" aria-valuemax="5" style="width: 80%">
                                    <span class="sr-only">80% Complete (danger)</span>
                                  </div>
                                </div>
                              </div>
                              <div class="pull-right" style="margin-left:10px;">{{breakdown.four_star}}</div>
                            </div>
                            <div class="pull-left">
                              <div class="pull-left" style="width:35px; line-height:1;">
                                <div style="height:9px; margin:5px 0;">3 <span class="text-warning fa fa-star"></span></div>
                              </div>
                              <div class="pull-left" style="width:180px;">
                                <div class="progress" style="height:9px; margin:8px 0;">
                                  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{breakdown.three_star}}" aria-valuemin="0" aria-valuemax="5" style="width: 60%">
                                    <span class="sr-only">80% Complete (danger)</span>
                                  </div>
                                </div>
                              </div>
                              <div class="pull-right" style="margin-left:10px;">{{breakdown.three_star}}</div>
                            </div>
                            <div class="pull-left">
                              <div class="pull-left" style="width:35px; line-height:1;">
                                <div style="height:9px; margin:5px 0;">2 <span class="text-warning fa fa-star"></span></div>
                              </div>
                              <div class="pull-left" style="width:180px;">
                                <div class="progress" style="height:9px; margin:8px 0;">
                                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{breakdown.two_star}}" aria-valuemin="0" aria-valuemax="5" style="width: 40%">
                                    <span class="sr-only">80% Complete (danger)</span>
                                  </div>
                                </div>
                              </div>
                              <div class="pull-right" style="margin-left:10px;">{{breakdown.two_star}}</div>
                            </div>
                            <div class="pull-left">
                              <div class="pull-left" style="width:35px; line-height:1;">
                                <div style="height:9px; margin:5px 0;">1 <span class="text-warning fa fa-star"></span></div>
                              </div>
                              <div class="pull-left" style="width:180px;">
                                <div class="progress" style="height:9px; margin:8px 0;">
                                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{breakdown.one_star}}" aria-valuemin="0" aria-valuemax="5" style="width: 20%">
                                    <span class="sr-only">80% Complete (danger)</span>
                                  </div>
                                </div>
                              </div>
                              <div class="pull-right" style="margin-left:10px;">{{breakdown.one_star}}</div>
                            </div>
                            <!-- end row -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card-box">
                  <h4 class="header-title mb-3">Positive Review</h4>
                  <!--<div id="chartBig1" class="flot-chart mt-4 pt-1" style="height: 375px;"></div> --->
                  <canvas class="chartBig1" style="display: block;width:100%;height: 160px;"></canvas>
                </div>
                <!-- end card-box -->
              </div>
            </div>
            <!-------Messages Graphs--------------->
            <div class="row custom-font">
              <div class="col-md-4">
                <div class="card-box">
                  <h4 class="header-title mb-3">Sales Analytics</h4>
                  <!--<div id="chartBig1" class="flot-chart mt-4 pt-1" style="height: 375px;"></div> --->
                  <canvas class="chartBig1" style="display: block;width:100%;height: 160px;"></canvas>
                </div>
                <!-- end card-box -->
              </div>
              <div class="col-md-4">
                <div class="card-box">
                  <h4 class="header-title mb-3">Orders</h4>
                  <!--<div id="chartBig1" class="flot-chart mt-4 pt-1" style="height: 375px;"></div> --->
                  <canvas class="chartBig1" style="display: block;width:100%;height: 160px;"></canvas>
                </div>
                <!-- end card-box -->
              </div>
              <div class="col-md-4">
                <div class="card-box">
                  <h4 class="header-title mb-3">Messages</h4>
                  <!--<div id="chartBig1" class="flot-chart mt-4 pt-1" style="height: 375px;"></div> --->
                  <canvas class="chartBig1" style="display: block;width:100%;height: 160px;"></canvas>
                </div>
                <!-- end card-box -->
              </div>
            </div>
            <!-------Messages Graphs--------------->
            <!-------Recent Orders--------------->
            <div class="row">
              <div class="col-xl-6 col-xl-6">
                <div class="card-box">
                  <h4 class="header-title mb-3">Recent Orders</h4>
                  <div class="table-responsive">
                    <table class="table table-borderless table-hover table-centered m-0">
                      <thead class="thead-light">
                        <tr>
                          <th style="width:100px">SKU</th>
                          <!--<th>ASIN</th> -->
                          <th>Order No</th>
                          <!--<th style="width:100px">PO Date</th>	 -->
                          <th style="width:300px">Title</th>
                          <!--<th>Price</th>     -->
                          <th>Qty</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody >
                        <tr ng-repeat="ord in recent_ten_orders">
                          <td>{{ord.seller_sku}} </td>
                          <!-- <td>{{ord.asin}} </td> -->
                          <td>{{ord.order_no}} </td>
                          <!-- <td>{{ord.po_date}} </td>	-->
                          <td>{{ord.itm_title | limitTo:50}}</td>
                          <!-- <td>{{ord.itm_price}}</td> -->
                          <td>{{ord.itm_qty}}</td>
                          <td><span ng-if="ord.order_status=='Shipped'" class="badge badge-success">{{ord.order_status}}</span>
                            <span ng-if="ord.order_status=='Canceled'"  class="badge badge-danger">{{ord.order_status}}</span>
                            <span ng-if="ord.order_status=='Pending'"  class="badge badge-info">{{ord.order_status}}</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- end col -->
              <div class="col-xl-6 col-md-6">
                <div class="card-box">
                  <h4 class="header-title mb-3">Best Selling Products</h4>
                  <div class="table-responsive">
                    <table class="table table-borderless table-hover table-centered m-0">
                      <thead class="thead-light">
                        <tr>
                          <!--<th style="width:100px">SKU</th>
                            <th style="width:100px">ASIN</th> -->
                          <th>Title</th>
                          <th>Price</th>
                          <!-- <th>Qty</th> -->
                          <th>Sold Qty</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="tnx in transactionList ">
                          <!-- <td>{{tnx.prod_sku}}</td>
                            <td>{{tnx.prod_asin}}</td> -->
                          <td>{{tnx.prod_title}}</td>
                          <td>{{tnx.itm_price}}</td>
                          <!-- <td style="text-align:center">{{tnx.itm_qty}}</td> -->
                          <td style="text-align:center">{{tnx.sold_qty}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- end .table-responsive-->
                </div>
                <!-- end card-box-->
              </div>
              <!-- end col -->
            </div>
            <!-------Recent Orders--------------->
            <!-- end row-->
          </div>
        </div>
        <!-- end card-box-->
      </div>
    </div>
    <!----------Notification Ends------------>
    <!------------------------------------------------->
    <!-- end row -->
  </div>
  <!-- container -->
</div>
<!-- content -->
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
  	var inv_list_url = "<?php echo $baseurl."dashboard/get_top_product/"?>";
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
           if(value.status_code==1) {
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
                                        $scope.reviews_data=response.reviews_data[0];
                                        $scope.breakdown=response.breakdown;
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
           //purple colors
           var config = {
            type: 'line',
              data: {
                labels: [],
                datasets: [
                    {
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
                  }
                ]
              },
            options: {
              scales: {
                xAxes: [
                  {
                    gridLines: {
                      color: "rgba(0, 0, 0, 0)",
                    },
                    offset: true,
                    stacked: true,
                    ticks: {
                      beginAtZero:true
                    }
                  }
                ],
                yAxes: [
                  {
                    gridLines: {
                      color: "rgba(0, 0, 0, 0)",
                    },
                    stacked: true,
                    offset: true,
                    gridThickness: 1,
                    ticks: {
                      beginAtZero:true
                    }
                  }
                ],
              }
            }
          };
          var ctx = document.getElementsByClassName("chartBig1");
          console.log(ctx);
          for(var i = 0; i<ctx.length; i++) {
            var gradientStroke = ctx[i].getContext('2d').createLinearGradient(0, 230, 0, 50);
            gradientStroke.addColorStop(1, 'rgba(72,72,176,0.1)');
            gradientStroke.addColorStop(0.4, 'rgba(72,72,176,0.0)');
            gradientStroke.addColorStop(0, 'rgba(119,52,169,0)');
            $scope.myChartData = new Chart(ctx[i],config);
          }
        }
        $scope.visualise_data();

        $scope.show_revenue_graph=function() {
          $scope.myChartData.config.data.datasets.length > 1?$scope.myChartData.config.data.datasets.pop():'';
          $scope.myChartData.config.data.datasets.length > 2?$scope.myChartData.config.data.datasets.pop():'';
          $scope.revenue_graph=1;
          $scope.sale_graph=0;
          $scope.campaing_graph=0;
          var lnth=$scope.graph_data.length;
          var chart_data=[];
          var chart_labels=[];
          for (var i=0; i<lnth; i++) { 
            chart_data[i]=$scope.graph_data[i].total_amt;
            chart_labels[i]=$scope.graph_data[i].order_date; 
          } 
          $scope.chart_for="Revenue" ;
        	$scope.chart_desc="Total Revenue"; 
          $scope.myChartData.config.type='line' ;
        	$scope.myChartData.config.data.datasets[0].label="Revenue";
        	$scope.myChartData.config.data.labels=chart_labels;
        	$scope.myChartData.config.data.datasets[0].data=chart_data; 
          $scope.myChartData.config.data.datasets.length > 1 ? $scope.myChartData.config.data.datasets.pop() : '';
        	$scope.myChartData.update();
        }




  });
</script>
<script></script>
<script>
  $(document).ready(function(){
      $('[data-toggle="popover"]').popover({
      html: true,

  });
  });
</script>
