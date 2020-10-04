<?php
  $baseurl = base_url();

  $base_url = base_url();

  ?>
<link href="<?php echo $baseurl . '/asset/css/datepicker.css' ?>" rel="stylesheet">
<script src="<?php echo $baseurl . '/asset/js/jquery_ui_core_1_10.js' ?>"></script>
<script src="<?php echo $baseurl . '/asset/js/jq_datepicker_1_10.js' ?>"></script>
<script>
  $(function() {

    $(".date_selector").datepicker({
      minDate: 0,
      dateFormat: "yy-mm-dd",
    });

  });
</script>
<style>
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
  /* CSS used here will be applied after bootstrap.css */
  .pad-15 {
  padding: 15px;
  }
</style>
<div class="wrapper">
<div class="content campaign" id="campaign">
  <!-- Start Content-->
  <div class="container">
    <div class="card-box Campaigns">
      <div class="row">
        <div class="col-md-3 col-lg-2 col-sm-12">
          <h4 class="page-title">Campaigns </h4>
        </div>
        <div class="col-md-9 col-lg-10 col-sm-12">
          <div class="row">
            <div class="col-md-10">
              <ul class="nav nav-tabs nav-bordered nav-justified">
                <li class="nav-item">
                  <a href="#my_campaigns" data-toggle="tab" aria-expanded="false" class="nav-link active stop-nav">
                  My Campaigns
                  </a>
                </li>
                <li class="nav-item stop-nav">
                  <a href="#templates" data-toggle="tab" aria-expanded="true" class="nav-link stop-nav">
                  Templates
                  </a>
                </li>
                <li class="nav-item stop-nav">
                  <a href="#sent_messages" data-toggle="tab" aria-expanded="true" class="nav-link stop-nav">
                  Email Junction
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-md-2 text-right">
              <div class="btn-group">
                <div class="dropdown notification-list" style="padding: 7px;">
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
          </div>
        </div>
      </div>
    </div>
    <div class="Campaigns">
      <div class="tab-content">
        <div class="tab-pane active" id="my_campaigns" ng-controller='campaignCtrl'>
          <div class="row">
            <div class="col-md-2">
              <div class="dropdown">
                <a class="btn btn-success btn-block dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{selectedFilterStatus}}<i class="mdi mdi-chevron-down"></i>
                </a>
                <!-- [{name: 'Live', id: 3}, {name: 'Draft', id: 1}, {name: 'Test', id: 2}, {name: 'Paused', id: 4}] -->
                <div class="dropdown-menu icon_menu_size" aria-labelledby="dropdownMenuLink" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
                  <a ng-click="filterCamps('All','status')" class="dropdown-item" href="javascript:void(0);"> <i class="fe-check text-success"></i> All campaigns({{metrics.total_cmp}})</a>
                  <a ng-click="filterCamps('3','status')" class="dropdown-item" href="javascript:void(0);"> <i class="fe-check-circle text-success"></i> Live ({{metrics.live}})</a>
                  <a ng-click="filterCamps('1','status')" class="dropdown-item" href="javascript:void(0);"> <i class="fe-minus-circle text-info"></i> Draft ({{metrics.draft}})</a>
                  <a ng-click="filterCamps('2','status')" class="dropdown-item" href="javascript:void(0);"> <i class="fe-play-circle text-primary"></i> Test ({{metrics.test}})</a>
                  <a ng-click="filterCamps('4','status')" class="dropdown-item" href="javascript:void(0);"> <i class="fe-pause-circle text-warning"></i> Paused ({{metrics.paused}})</a>
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="dropdown">
                <a class="btn btn-warning btn-block dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{selectedFilterGoal}}<i class="mdi mdi-chevron-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
                  <!-- 1: customer service 2: Feedback 3: Review -->
                  <a ng-click="filterCamps('All','goal')" class="dropdown-item" href="#">All Goals</a>
                  <a ng-click="filterCamps('2','goal')" class="dropdown-item" href="#">Seller Feedback</a>
                  <a ng-click="filterCamps('1','goal')" class="dropdown-item" href="#">Customer Service</a>
                  <a ng-click="filterCamps('3','goal')" class="dropdown-item" href="#">Product Review</a>
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="dropdown">
                <a class="btn btn-secondary btn-block dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Actions<i class="mdi mdi-chevron-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
                  <!-- 1: customer service 2: Feedback 3: Review -->
                  <a ng-click="performAction('archive')" class="dropdown-item" href="#"><i class="fa fa-archive mr-2" aria-hidden="true"></i>Archive</a>
                  <a ng-click="performAction('delete')" class="dropdown-item" href="#"><i class="fa fa-trash mr-2" aria-hidden="true"></i>Delete</a>
                  <a ng-click="performAction('pause')" class="dropdown-item" href="#"><i class="fa fa-pause mr-2" aria-hidden="true"></i>Pause</a>
                  <a ng-click="performAction('start')" class="dropdown-item" href="#"><i class="fa fa-play mr-2" aria-hidden="true"></i>Start</a>
                  <h6 class="dropdown-header">Move to Folder...</h6>
                  <a ng-if="folders.length > 0" ng-repeat="fd in folders track by $index" ng-click="performAction(fd.fol_id)" class="dropdown-item" href="#"><i class="fa fa-folder-o mr-2" aria-hidden="true"></i></i>{{fd.folder_name}}</a>
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="dropdown">
                <a class="btn btn-primary btn-block dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                All Folders<i class="mdi mdi-chevron-down"></i>
                </a>
                <div class="dropdown-menu icon_menu_size" aria-labelledby="dropdownMenuLink" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
                  <a ng-click="filterCamps('All','folder')" class="dropdown-item" href="#">All ({{metrics.total}})</a>
                  <!-- <a class="dropdown-item" href="#">Default ({{metrics.total_cmp}})</a> -->
                  <div class="dropdown-divider"></div>
                  <a ng-click="filterCamps('trash','folder')" class="dropdown-item" href="#">Trash ({{metrics.trash}})</a>
                  <a ng-click="filterCamps('archive','folder')" class="dropdown-item" href="#">Archive ({{metrics.archive}})</a>
                  <div class="dropdown-divider"></div>
                  <a ng-click="filterCamps(fd,'folder')" ng-repeat="fd in folders track by $index" class="dropdown-item" href="#">{{fd.folder_name}} ({{fd.camp_count}})</a>
                  <div class="dropdown-divider"></div>
                  <a ng-click="addNewFolder()" class="dropdown-item" href="#"> <i class="fe-folder text-primary"></i> Add New Folder</a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <?php if ($store_count[0]['ttl'] > 0) { ?>
              <a href='' class="btn btn-info pull-right" ng-click='clear_campaign_data();togggle_view(); load_product(0)'>Create Campaign</a>
              <?php }?>
            </div>
          </div>
          <hr>
          <div id="Preview_email_box" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content" style="margin-left:-100px;width:700px">
                <div class="modal-header">
                  <h4 class="modal-title">Preview &amp; Test</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body p-4">
                  <div class="row" style="margin-bottom:10px">
                    <div class="col-sm-10 mg-top-10">
                      <input type="email" placeholder='Email ' ng-model="tst.email" class='form-control'>
                    </div>
                    <div class="col-sm-2 mg-top-10">
                      <button class="btn btn-block btn-info" ng-click='test_email()'>Test</button>
                    </div>
                  </div>
                  <div class="row" style="margin-bottom:10px">
                    <div class="col-sm-10 mg-top-10">
                      <select class="form-control" ng-model='tst.order_id'>
                        <option value="ALL">Select Orderid</option>
                        <option ng-repeat="x in recent_orders" value='{{x.order_no}}'>{{x.order_no}}</option>
                      </select>
                    </div>
                    <div class="col-sm-2 mg-top-10">
                      <button class="btn btn-block btn-info" ng-click='preview_email()'>Preview</button>
                    </div>
                  </div>
                  <div class="row" style="margin-bottom:10px">
                    <div class="col-sm-12 mg-top-10">
                      <table class='table mg-top-10'>
                        <tr>
                          <th>From</th>
                          <th>feedback_mail@feedbackgrid.com</th>
                        </tr>
                        <tr>
                          <th>To</th>
                          <th><span ng-if='tst.email.length > 0'>{{tst.email}}</span><span ng-if='tst.email.length == 0'>preview_mail@feedbackgrid.com</span></th>
                        </tr>
                        <tr>
                          <th>Subject</th>
                          <th>{{tst.subject}}</th>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <div class="" ng-bind-html='tst.email_content'></div>
                          </td>
                        </tr>
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
          </div>
          <!-- /.modal -->
          <div class="content">
            <!-- Start Content-->
            <?php
              if ($store_count[0]['ttl'] == 0) {
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
                    <p>Please connect a store to start importing your inventory. <a class="btn btn-info" href="<?php echo $base_url . 'manage_stores' ?>">Connect Stores...</a></p>
                  </div>
                </div>
              </div>
            </div>
            <?php
              }
              ?>
            <?php
              if ($store_count[0]['ttl'] > 0) {
              ?>
            <div class="" ng-show='show_dash==1' id="myc1">
              <div class="col-12 card-box">
                <div class="table-responsive"><h4>My Campaigns</h4>
                  <table class="text-center table-bordered table-striped table table-hover">
                    <thead class="">
                      <tr>
                        <th style="width: 20px;">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck2" ng-model="checkStatusCamp" ng-change="statusCheckCamp()" ng-true-value="'Y'" ng-false-value="'N'" />
                            <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                          </div>
                        </th>
                        <th>MarketPlace</th>
                        <th>Name</th>
                        <th>Scheduled </th>
                        <th>Sent</th>
                        <!-- <th>Status</th> -->
                        <th>Campaign Status</th>
                        <th>Goal Type</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr ng-repeat="idx in campList track by $index">
                        <td>
                          <div class="custom-control custom-checkbox">
                          <!-- ng-change="campStatusCheck()" -->
                            <input type="checkbox" checklist-value="idx.campaign_id" checklist-model="selectedCampaign.ids"  class="custom-control-input" id="customCheck3-{{$index+1}}">
                            <label class="custom-control-label" for="customCheck3-{{$index+1}}">&nbsp;</label>
                          </div>
                        </td>
                        <td ng-if="store_country=='IN'"><img width="20" height="20" src="<?php echo $base_url . 'assets/img/amazon_logo.png' ?> "><span style="color:#a3afb7;font-weight:300">.in</span></td>
                        <td ng-if="store_country=='US'"><img width="20" height="20" src="<?php echo $base_url . 'assets/img/amazon_logo.png' ?> "><span style="color:#a3afb7;font-weight:300">.com</span></td>
                        <td ng-if="store_country=='UK'"><img width="20" height="20" src="<?php echo $base_url . 'assets/img/amazon_logo.png' ?> "><span style="color:#a3afb7;font-weight:300">.co.uk</span></td>
                        <td ng-if="store_country=='IT'"><img width="20" height="20" src="<?php echo $base_url . 'assets/img/amazon_logo.png' ?> "><span style="color:#a3afb7;font-weight:300">.it</span></td>
                        <td ng-if="store_country=='DE'"><img width="20" height="20" src="<?php echo $base_url . 'assets/img/amazon_logo.png' ?> "><span style="color:#a3afb7;font-weight:300">.de</span></td>
                        <td ng-if="store_country=='FR'"><img width="20" height="20" src="<?php echo $base_url . 'assets/img/amazon_logo.png' ?> "><span style="color:#a3afb7;font-weight:300">.fr</span></td>
                        <td ng-if="store_country=='ES'"><img width="20" height="20" src="<?php echo $base_url . 'assets/img/amazon_logo.png' ?> "><span style="color:#a3afb7;font-weight:300">.es</span></td>
                        <td style="position: relative;">{{idx.campaign_name}}</td>
                        <td><span style="margin-left:5px"> {{idx.total_mail}} </span></td>
                        <td><span style="margin-left:5px"> {{idx.sent_count}} </span></td>
                        <!-- <td>
                          <span ng-if="idx.is_active=='1'" class="badge badge-success">Active</span>
                          <span ng-if="idx.is_active=='0'" class="badge badge-danger">In Active</span>
                        </td> -->
                        <td class="relative">
                          <div ng-click="show_camp_drop($index)" class="relative">
                            <span ng-if="idx.camp_status=='1'" class="badge badge-secondary cur-pointer" style="margin-left:5px; font-size:12px;">Draft</span>
                            <span ng-if="idx.camp_status=='2'" class="badge badge-warning cur-pointer" style="margin-left:5px; font-size:12px;">Test</span>
                            <span ng-if="idx.camp_status=='3'" class="badge badge-success cur-pointer" style="margin-left:5px; font-size:12px;">Live</span>
                            <span ng-if="idx.camp_status=='4'" class="badge badge-danger cur-pointer" style="margin-left:5px; font-size:12px;">Paused</span>
                            <i class="mdi mdi-chevron-down"></i>
                            <div class="d-flex camp-status dir-col" ng-if="showCampDrop[$index]">
                              <div ng-if="idx.camp_status != rid.id" class="camp-opts cur-pointer" ng-repeat="rid in campStatus" ng-click="change_status(rid,idx.campaign_id)">
                                <span ng-class="{'badge badge-secondary': rid.name == 'Draft' , 'badge badge-warning':rid.name == 'Test',
              'badge badge-success': rid.name == 'Live', 'badge badge-danger': rid.name == 'Paused' } ">{{rid.name}}</span>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span ng-if="idx.camp_goaltype=='1'" style="margin-left:5px">Customer Service</span>
                          <span ng-if="idx.camp_goaltype=='2'" style="margin-left:5px">Feedback</span>
                          <span ng-if="idx.camp_goaltype=='3'" style="margin-left:5px">Review</span>
                        </td>
                        <td>
                          <div class="form-inline">
                            <i ng-click='edit_campaign(idx.campaign_id)' style="font-size:20px;margin-left: 10px" class="fe-edit text-info"></i>
                            <i ng-click='delete_campaign(idx.campaign_id)' style="font-size:20px;margin-left: 10px;" class="fe-trash-2 text-danger"></i>
                            <label class="switch" style="margin-left: 10px">
                            <input type="checkbox" name='enable_addon' ng-model="idx.is_active" ng-true-value="'1'" ng-false-value="'0'" ng-change='change_state(idx.is_active,idx.campaign_id)'>
                            <span class="slider round"></span>
                            </label>
                          </div>
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
            <div class="row" ng-show='show_dash==0' id="myc">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="page-title">Campaign Details</h4>
                    <a href="" id="menuToggle" style="margin-top:-15px;" class="pull-right  dropdown-toggle waves-effect waves-light close-template" data-toggle="dropdown" aria-expanded="true" ng-click='togggle_view()'>Close</a>
                    <div class="col-sm-12">
                      <div class="form-inline">
                        <div class="col-sm-12">
                          <div class="form-group mx-sm-12 mb-12">
                            <div class="col-sm-3">
                              <label for="status-select" class="mr-2 justify-start">Enter Campaign Name</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="text" style="width:100%" id="camp_name" name="" class="form-control mr-10" ng-model='cmp.camp_name' placeholder="Enter Campaign Name">
                            </div>
                          </div>
                          <br>
                          <div class="form-group mx-sm-12 mb-12">
                            <div class="col-sm-3">
                              <label for="status-select" class="mr-2 justify-start">Customer Type</label>
                            </div>
                            <div class="col-sm-8">
                              <select style="width:100%" class="form-control" ng-model='cmp.camp_type'>
                                <option value="1">ALL</option>
                                <option value="2">New Customer</option>
                                <option value="3">Returning Customer</option>
                              </select>
                            </div>
                          </div>
                          <br>
                          <div class="form-group mx-sm-12 mb-12">
                            <div class="col-sm-3">
                              <label for="status-select" class="mr-2 justify-start">Fulfillment</label>
                            </div>
                            <div class="col-sm-8">
                              <select style="width:100%" class="form-control" ng-model='cmp.camp_fulfill'>
                                <option value='1'>ALL</option>
                                <option value='2'>Match order fulfilled by Amazon</option>
                                <option value='3'>Match order fulfilled by Merchant</option>
                              </select>
                            </div>
                          </div>
                          <br>
                          <div class="form-group mx-sm-12 mb-12">
                            <div class="col-sm-3">
                              <label for="status-select" class="mr-2 justify-start">Campaign Status</label>
                            </div>
                            <div class="col-sm-8">
                              <select style="width:100%" class="form-control" ng-model='cmp.camp_status'>
                                <option default value='1'>Draft</option>
                                <option value='2'>Test</option>
                                <option value='3'>Live</option>
                                <option value='4'>Paused</option>
                              </select>
                            </div>
                          </div>
                          <br>
                          <div class="form-group mx-sm-12 mb-12">
                            <div class="col-sm-3">
                              <label for="status-select" class="mr-2 justify-start">Goal Type</label>
                            </div>
                            <div class="col-sm-8">
                              <select style="width:100%" class="form-control" ng-model='cmp.camp_goaltype'>
                                <option value='1'>Customer Service</option>
                                <option value='2'>Feedback</option>
                                <option value='3'>Review</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="page-title">Stock Details</h4>
                    <br>
                    <div class="tab-pane" id="basictab3" ng-class="tb.currentTab=='tab3'?'tab-pane fade active in':'tab-pane'">
                      <br>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-3 no-padding">
                              <select class="form-control" ng-model='cmp.camp_brand' ng-change='load_product(0)'>
                                <option value="ALL">ALL</option>
                                <option ng-repeat="x in brand_list" value='{{x.prod_brand}}'>{{x.prod_brand}}</option>
                              </select>
                            </div>
                            <div class="col-sm-3 no-padding">
                              <select class="form-control" ng-model='cmp.fc_code' ng-change='load_product(0)'>
                                <option value="ALL">ALL</option>
                                <option value='FBA'>FBA</option>
                                <option value='FBM'>FBM</option>
                              </select>
                            </div>
                            <div class="col-lg-6 no-padding">
                              <div class="input-group">
                                <div class="input-group-btn">
                                </div>
                                <!-- /btn-group -->
                                <input type="text" ng-model='cmp.prod_search' class="form-control" aria-label="...">
                                <span class="input-group-btn">
                                <button style="margin-left:5px;" class="btn btn-info" ng-click='load_product(0)' type="button">Filter</button>
                                </span>
                              </div>
                              <!-- /input-group -->
                            </div>
                            <!-- /.col-lg-6 -->
                          </div>
                          <!-- /.row -->
                        </div>
                        <div class="form-group">
                          <div class="" id='product_list' style="">
                            <div class="table-responsive">
                              <table class="table table-center table-striped table-bordered table-hover mb-0">
                                <tr>
                                  <th style="width: 20px;">
                                    <div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input" id="customCheck1" ng-model="checkStatus" ng-change="statusCheck()" ng-true-value="'Y'" ng-false-value="'N'" />
                                      <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                  </th>
                                  <th>Image</th>
                                  <th>ASIN</th>
                                  <th>SKU</th>
                                  <th>Fullfillment</th>
                                  <th>Brand</th>
                                  <th>Title</th>
                                </tr>
                                <tr ng-repeat='prd in product_list'>
                                  <td>
                                    <div class="custom-control custom-checkbox">
                                      <input type="checkbox" checklist-value="prd" checklist-model="selectedProduct" class="custom-control-input" id="customCheck2-{{$index+1}}">
                                      <label class="custom-control-label" for="customCheck2-{{$index+1}}">&nbsp;</label>
                                    </div>
                                  </td>
                                  <td><img src='{{prd.prod_image}}' width='50' height='50'></td>
                                  <td class="align-middle">{{prd.prod_asin}}</td>
                                  <td class="align-middle">{{prd.prod_sku}}</td>
                                  <td class="align-middle">{{prd.fc_code}}</td>
                                  <td class="align-middle">{{prd.prod_brand}}</td>
                                  <td class="align-middle">{{prd.prod_title | limitTo:100}}<span ng-if='prd.prod_title.length>100'>...</span></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                          <ul class="pagination pagination-rounded justify-content-end my-2">
                            <li ng-class="prevPageDisabledProduct()" class="page-item">  <a href="javascript:void(0)" ng-click="prevPageProduct()" class="page-link">Previous</a>
                            </li>
                            <li ng-repeat="n in rangeProduct()" ng-class="{active: n == currentPageProduct}" ng-click="setPageProduct(n)" class="page-item"> <a href="javascript:void(0)" class="page-link">{{n+1}}</a>
                            </li>
                            <li ng-class="nextPageDisabledProduct()" class="page-item">  <a href="javascript:void(0)" ng-click="nextPageProduct()" class="page-link">Next</a>
                            </li>
                          </ul>
                        </div>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="page-title">Mailing Details</h4>
                    <br>
                    <div class="tab-pane" id="basictab4" ng-class="tb.currentTab=='tab4'?'tab-pane fade active in':'tab-pane'">
                      <div class="row">
                        <div class="col-sm-4 form-group">
                          <label for="simpleinput">Trigger On</label>
                          <select ng-model='cmp.camp_trigger' class="form-control">
                            <option value='1'>After Order Shipped</option>
                            <option value='2'>After Order Delivered - FBA </option>
                            <!--<option value='3'>After Returned</option>--->
                            <option value='4'>Repeated Buyers</option>
                          </select>
                        </div>
                        <div class="col-sm-2 form-group">
                          <label for="simpleinput">Days</label>
                          <input ng-model='cmp.camp_days' placeholder='Days' class="form-control" type="number">
                        </div>
                        <div class="col-sm-2 form-group">
                          <label for="simpleinput">Hours</label>
                          <input ng-model='cmp.camp_hour' type='number' placeholder="Hour" class="form-control">
                        </div>
                        <div class="col-sm-2 form-group">
                          <label for="simpleinput">Minutes</label>
                          <input ng-model='cmp.camp_min' type='number' placeholder="Minutes" class="form-control">
                        </div>
                        <div class="col-sm-2 form-group">
                          <label for="simpleinput">&nbsp;</label>
                          <select ng-model='cmp.camp_am_pm' class="form-control">
                            <option value="1">AM</option>
                            <option value='2'>PM</option>
                          </select>
                        </div>
                        <div class="col-sm-12">
                          <div style="margin-top: 10px;">
                            <span ng-model='cmp.camp_review'></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="basictab5" ng-class="tb.currentTab=='tab5'?'tab-pane fade active in':'tab-pane'">
                      <div class="row">
                        <div class="form-group col-sm-3">
                          <label for="simpleinput" class="label_new" for="pwd">Picking a Template</label>
                          <select class="form-control" ng-model='tmp' ng-change="load_template(tmp)">
                            <option value='0'>Select a Template</option>
                            <option ng-repeat="x in template_list" value='{{x.template_id}}'>{{x.template_name}}</option>
                          </select>
                        </div>
                        <div class="col-md-9">
                          <label for="simpleinput">&nbsp;</label>
                          <div ng-bind-html="template_content"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="btn btn-info" ng-click='get_template_data()'> Preview &amp; Test </div>
                      </div>
                      <div class="col-md-6">
                        <div class="btn btn-success pull-right" ng-if='cmp.cpgn_id == 0' ng-click='create_campaign()'> Make it Live</div>
                        <div class="btn btn-success pull-right" ng-if='cmp.cpgn_id > "0"' ng-click='create_campaign()'> Update Camapign</div>
                      </div>
                    </div>
                  </div>
                  <?php
                    }
                      ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-----------------------------Templates----------------------------->
        <div class="tab-pane" id="templates" ng-controller='templateCtrl'>
          <div class="row">
            <div class="col-md-2">
              <div class="dropdown">
                <a class="btn btn-primary btn-block dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Amazon Templates<i class="mdi mdi-chevron-down"></i>
                </a>
                <div class="dropdown-menu icon_menu_size" aria-labelledby="dropdownMenuLink" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
                  <a class="dropdown-item" href="#"> Amazon Templates</a>
                  <a class="dropdown-item" href="#"> eBay Templates</a>
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="dropdown">
                <a class="btn btn-primary btn-block dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Any Trigger<i class="mdi mdi-chevron-down"></i>
                </a>
                <div class="dropdown-menu icon_menu_size" aria-labelledby="dropdownMenuLink" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
                  <a class="dropdown-item" href="#">Any Trigger</a>
                  <a class="dropdown-item" href="#">Order Confirmed</a>
                  <a class="dropdown-item" href="#">Order Dispatched</a>
                  <a class="dropdown-item" href="#">Order Delivered</a>
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="dropdown">
                <a class="btn btn-primary btn-block dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                All Goals<i class="mdi mdi-chevron-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
                  <a class="dropdown-item" href="#">All Goals</a>
                  <a class="dropdown-item" href="#">Seller Feedback</a>
                  <a class="dropdown-item" href="#">Customer Service</a>
                  <a class="dropdown-item" href="#">Product Review</a>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <a class="btn btn-info pull-right" ng-click='clear_template();togggle_view_email()'>Create New Template</a>
            </div>
          </div>
          <br>
          <div class="col-md-12 card-box">
            <div class="" ng-show='show_dash_email==1' id="myid">
              <!----------------------------------->
              <div class="table-responsive"><h4>Templates</h4>
                <table class="table-bordered table table-hover table-striped">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Subject</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="idx in template_list track by $index">
                      <td>{{idx.template_name}}</td>
                      <td>{{idx.subject}}</td>
                      <td>
                        <div class="form-inline pull-right"><i ng-click='edit_template(idx.template_id);togggle_view_email()' style="font-size:20px;margin-left: 10px" class="fe-edit"></i>
                          <i ng-if="idx.is_default=='0'" ng-click='delete_template(idx.template_id,idx.is_default)' style="font-size:20px;margin-left: 10px" class="fe-trash-2"></i>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row" ng-show='show_dash_email==0' id="myid1">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="col-sm-12">
                      <a href="" style="margin-right:10px;font-size:15px;" id="menuToggle" class="pull-right  dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true" ng-click='togggle_view_email()'>Close</a>
                      <p class="control-label col-sm-3" style="margin-top:5px;font-weight:700;margin-left:20px;" for="pwd">Template Name</p>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" style="margin-left:20px;" ng-model='tmplt.template_name'>
                      </div>
                      <br>
                      <p class="control-label col-sm-3" style="margin-top:5px;font-weight:700;margin-left:20px;" for="pwd">Subject</p>
                      <div class="col-sm-9">
                        <input type='text' style="margin-left:20px;" class="form-control" ng-model='tmplt.subject'>
                      </div>
                      <br>
                      <div id='editor'></div>
                    </div>
                    <br>
                    <br>
                  </div>
                  <div class="pull-right"> <br>
                    <button class='btn btn-info' style="float:right;margin:-40px 10px 10px 10px" ng-if="tmplt.is_default=='0'" ng-click="save_template()">SAVE</button>
                  </div>
                </div>
              </div>
            </div>
            <!----------------------------------->
          </div>
        </div>
        <!-----------------------------Templates----------------------------->
        <!-----------------------------sent_messages----------------------------->
        <div class="tab-pane" id="sent_messages">
          <div class="row">
            <div class="col-md-3">
              <form>
                <div class="form-group">
                  <input type="password" class="form-control" id="inputPassword2" placeholder="Search Order ID or Buyer Email">
                </div>
            </div>
            <div class="col-md-3">
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
            <!----------------------------------------->
            <div id="navigation">
            <!-- Navigation Menu-->
            </div>
            <!----------------------------------------->
            </form>
            </div>
            <div class="col-md-2 offset-4">
              <a class="btn btn-primary btn-block text-light"> Filter </a>
            </div>
          </div>
          <br>
          <!-----------------------------------------------email Junction Data--------------->
          <div class="" ng-controller='emailjunctionCtrl'>
            <div class="content">
              <div class="">
                <?php
                  if ($store_count[0]['ttl'] == 0) {
                  ?>
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <p>Please connect a store to start importing your inventory. <a class="btn btn-info" href="<?php echo $base_url . 'manage_stores' ?>">Connect Stores...</a></p>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                  }
                    ?><?php
                  if ($store_count[0]['ttl'] > 0) {
                  ?>
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <div id="basicwizard">
                          <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-4">
                            <li class="nav-item">
                              <a href="#basictab1" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2" ng-click="get_campaign_list('schduled_mail')">
                              <i class="mdi mdi-account-circle mr-1"></i>
                              <span class="d-none d-sm-inline">Scheduled Emails</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#basictab2" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2" ng-click="get_campaign_list('sent_mail')">
                              <i class="mdi mdi-face-profile mr-1"></i>
                              <span class="d-none d-sm-inline">Sent Emails</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#basictab3" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2" ng-click="get_campaign_list('blocked_mail')">
                              <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                              <span class="d-none d-sm-inline">Blocked Emails</span>
                              </a>
                            </li>
                          </ul>
                          <div class="tab-content b-0 mb-0">
                            <div class="tab-pane" id="basictab1">
                              <div class="row">
                                <div class="col-sm-2">
                                  <form role="form">
                                    <div class="form-group contact-search m-b-30">
                                      <input type="text" placeholder="Search..." ng-model='filter.search' ng-enter='filtergrid()' class="form-control" id="search">
                                    </div>
                                    <!-- form-group -->
                                  </form>
                                </div>
                                <div class="col-sm-3">
                                  <select class="form-control" ng-model='filter.camp_id'>
                                    <option value='ALL'>ALL Campaign</option>
                                    <option ng-repeat="x in campList" value='{{x.campaign_id}}'>{{x.campaign_name}}</option>
                                  </select>
                                </div>
                                <div class="col-sm-2 no-padding">
                                  <input type='text' class='form-control date_selector' jqdatepicker name='from' placeholder='From' ng-model='filter.frm_date'>
                                </div>
                                <div class="col-sm-2 no-padding">
                                  <input type='text' class='form-control date_selector' jqdatepicker name='to' placeholder='To' ng-model='filter.to_date'>
                                </div>
                                <div class="col-sm-1 no-padding">
                                  <a class='btn btn-info' ng-click='filtergrid()'>Search</a>
                                </div>
                              </div>
                              <div class="table-responsive"><h4>Email Junction</h4>
                                <table class="table table-centered mb-0">
                                  <thead class="thead-light">
                                    <tr>
                                      <th style="width: 20px;">
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="customCheck1" ng-model="checkStatus" ng-change="statusCheck()" ng-true-value="'Y'" ng-false-value="'N'" />
                                          <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                      </th>

                                      <th>Order #</th>
                                      <th>PO Date</th>
                                      <th>Date to Send</th>
                                      <th style='width:40px'>DNS</th>
                                      <th>Mail</th>
                                      <th>Campaign Name</th>
                                      <th>Buyer</th>
                                      <th>SKU</th>
                                      <th>Feedback</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr ng-repeat="tnx in transactionList ">
                                      <td>
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" checklist-value="tnx" checklist-model="selectedOrder" class="custom-control-input" id="customCheck2-{{$index+1}}">
                                          <label class="custom-control-label" for="customCheck2-{{$index+1}}">&nbsp;</label>
                                        </div>
                                      </td>
                                      <td>{{tnx.order_no}}</td>
                                      <td>{{tnx.purchase_date}}</td>
                                      <td>{{tnx.trigger_on}}</td>
                                      <td>
                                        <span ng-if="tnx.dns_status=='0'" class='label label-success'>N</span>
                                        <span ng-if="tnx.dns_status=='1'" class='label label-danger'>Y</span>
                                      </td>
                                      <td>
                                        <span ng-if="tnx.is_sent=='0'" class='label label-warning'>Not sent</span>
                                        <span ng-if="tnx.is_sent=='1'" class='label label-success'>Sent</span>
                                      </td>
                                      <td>{{tnx.campaign_name}}</td>
                                      <td>{{tnx.buyer_name}}<span ng-if="tnx.buyer_name.length==0 ">-------</span></td>
                                      <td>{{tnx.seller_sku}}</td>
                                      <td>{{tnx.fbk_comment}}<span ng-if='tnx.fbk_comment.length==0'>------</span></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              <ul class="pagination pagination-rounded justify-content-end my-2">
                                <li ng-class="prevPageDisabled()" class="page-item">
                                  <a href="javascript:void(0)" ng-click="prevPage()" class="page-link">Previous</a>
                                </li>
                                <li ng-repeat="n in range()" ng-class="{active: n == currentPage}" ng-click="setPage(n)" class="page-item">
                                  <a href="javascript:void(0)" class="page-link">{{n+1}}</a>
                                </li>
                                <li ng-class="nextPageDisabled()" class="page-item">
                                  <a href="javascript:void(0)" ng-click="nextPage()" class="page-link">Next</a>
                                </li>
                              </ul>
                            </div>
                            <div class="tab-pane" id="basictab2">
                              <div class="row">
                                <div class="col-sm-2">
                                  <form role="form">
                                    <div class="form-group contact-search m-b-30">
                                      <input type="text" placeholder="Search..." ng-model='filter.search' ng-enter='filtergrid()' class="form-control" id="search">
                                    </div>
                                    <!-- form-group -->
                                  </form>
                                </div>
                                <div class="col-sm-2">
                                  <select class="form-control" ng-model='filter.camp_id'>
                                    <option value='ALL'>ALL Campaign</option>
                                    <option ng-repeat="x in campList" value='{{x.campaign_id}}'>{{x.campaign_name}}</option>
                                  </select>
                                </div>
                                <div class="col-sm-1 no-padding">
                                  <input type='text' class='form-control date_selector' jqdatepicker name='from' placeholder='From' ng-model='filter.frm_date'>
                                </div>
                                <div class="col-sm-1 no-padding">
                                  <input type='text' class='form-control date_selector' jqdatepicker name='to' placeholder='To' ng-model='filter.to_date'>
                                </div>
                                <div class="col-sm-1 no-padding">
                                  <a class='btn btn-info' ng-click='filtergrid()'>Search</a>
                                </div>
                                <div class="col-sm-2 no-padding">
                                  <a class='btn btn-danger' ng-click='mark_as_dns()'>Mark DNS</a>
                                </div>
                                <div class="col-sm-2 no-padding">
                                  <a class='btn btn-success' ng-click='send_now()'>Send Now</a>
                                </div>
                              </div>
                              <div class="table-responsive">
                                <table class="table table-centered mb-0">
                                  <thead class="thead-light">
                                    <tr>
                                      <th style="width: 20px;">
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="customCheck1" ng-model="checkStatus" ng-change="statusCheck()" ng-true-value="'Y'" ng-false-value="'N'" />
                                          <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                      </th>
                                      <th>Order #</th>
                                      <th>PO Date</th>
                                      <th style='width:40px'>DNS</th>
                                      <th>Mail</th>
                                      <th>Campaign Name</th>
                                      <th>Buyer</th>
                                      <th>SKU</th>
                                      <th>Feedback</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr ng-repeat="tnx in transactionList ">
                                      <td>
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" checklist-value="tnx" checklist-model="selectedOrder" class="custom-control-input" id="customCheck2-{{$index+1}}">
                                          <label class="custom-control-label" for="customCheck2-{{$index+1}}">&nbsp;</label>
                                        </div>
                                      </td>
                                      <td>{{tnx.order_no}}</td>
                                      <td>{{tnx.purchase_date}}</td>
                                      <td>
                                        <span ng-if="tnx.dns_status=='0'" class='label label-success'>N</span>
                                        <span ng-if="tnx.dns_status=='1'" class='label label-danger'>Y</span>
                                      </td>
                                      <td>
                                        <span ng-if="tnx.is_sent=='0'" class='label label-warning'>Not sent</span>
                                        <span ng-if="tnx.is_sent=='1'" class='label label-success'>Sent</span>
                                      </td>
                                      <td>{{tnx.campaign_name}}</td>
                                      <td>{{tnx.buyer_name}}<span ng-if="tnx.buyer_name.length==0 ">-------</span></td>
                                      <td>{{tnx.seller_sku}}</td>
                                      <td>{{tnx.fbk_comment}}<span ng-if='tnx.fbk_comment.length==0'>------</span></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              <ul class="pagination pagination-rounded justify-content-end my-2">
                                <li ng-class="prevPageDisabled()" class="page-item">
                                  <a href="javascript:void(0)" ng-click="prevPage()" class="page-link">Previous</a>
                                </li>
                                <li ng-repeat="n in range()" ng-class="{active: n == currentPage}" ng-click="setPage(n)" class="page-item">
                                  <a href="javascript:void(0)" class="page-link">{{n+1}}</a>
                                </li>
                                <li ng-class="nextPageDisabled()" class="page-item">
                                  <a href="javascript:void(0)" ng-click="nextPage()" class="page-link">Next</a>
                                </li>
                              </ul>
                            </div>
                            <div class="tab-pane" id="basictab3">
                              <div class="row">
                                <div class="col-sm-2">
                                  <form role="form">
                                    <div class="form-group contact-search m-b-30">
                                      <input type="text" placeholder="Search..." ng-model='filter.search' ng-enter='filtergrid()' class="form-control" id="search">
                                    </div>
                                  </form>
                                </div>
                                <div class="col-sm-2">
                                  <select class="form-control" ng-model='filter.camp_id'>
                                    <option value='ALL'>ALL Campaign</option>
                                    <option ng-repeat="x in campList" value='{{x.campaign_id}}'>{{x.campaign_name}}</option>
                                  </select>
                                </div>
                                <div class="col-sm-1 no-padding">
                                  <input type='text' class='form-control date_selector' jqdatepicker name='from' placeholder='From' ng-model='filter.frm_date'>
                                </div>
                                <div class="col-sm-1 no-padding">
                                  <input type='text' class='form-control date_selector' jqdatepicker name='to' placeholder='To' ng-model='filter.to_date'>
                                </div>
                                <div class="col-sm-1 no-padding">
                                  <a class='btn btn-info' ng-click='filtergrid()'>Search</a>
                                </div>
                                <div class="col-sm-2 no-padding">
                                  <a class='btn btn-danger' ng-click='mark_as_dns()'>Mark DNS</a>
                                </div>
                                <div class="col-sm-2 no-padding">
                                  <a class='btn btn-success' ng-click='rmv_dns()'>Remove DNS</a>
                                </div>
                              </div>
                              <div class="table-responsive">
                                <table class="table table-centered mb-0">
                                  <thead class="thead-light">
                                    <tr>
                                      <th style="width: 20px;">
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="customCheck1" ng-model="checkStatus" ng-change="statusCheck()" ng-true-value="'Y'" ng-false-value="'N'" />
                                          <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                      </th>
                                      <th>Order #</th>
                                      <th>PO Date</th>
                                      <th>Date to Send</th>
                                      <th>DNS</th>
                                      <th>Mail</th>
                                      <th>Campaign Name</th>
                                      <th>Buyer</th>
                                      <th>SKU</th>
                                      <th>Feedback</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr ng-repeat="tnx in transactionList ">
                                      <td>
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" checklist-value="tnx" checklist-model="selectedOrder" class="custom-control-input" id="customCheck2-{{$index+1}}">
                                          <label class="custom-control-label" for="customCheck2-{{$index+1}}">&nbsp;</label>
                                        </div>
                                      </td>
                                      <td>{{tnx.order_no}}</td>
                                      <td>{{tnx.purchase_date}}</td>
                                      <td>{{tnx.trigger_on}}</td>
                                      <td>
                                        <span ng-if="tnx.dns_status=='0'" class='label label-success'>N</span>
                                        <span ng-if="tnx.dns_status=='1'" class='label label-danger'>Y</span>
                                      </td>
                                      <td>
                                        <span ng-if="tnx.is_sent=='0'" class='label label-warning'>Not sent</span>
                                        <span ng-if="tnx.is_sent=='1'" class='label label-success'>Sent</span>
                                      </td>
                                      <td style='width:200px'>{{tnx.campaign_name}}</td>
                                      <td style='width:200px'>{{tnx.buyer_name}}<span ng-if="tnx.buyer_name.length==0 ">-------</span></td>
                                      <td>{{tnx.seller_sku}}</td>
                                      <td>{{tnx.fbk_comment}}<span ng-if='tnx.fbk_comment.length==0'>------</span></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              <ul class="pagination pagination-rounded justify-content-end my-2">
                                <li ng-class="prevPageDisabled()" class="page-item">
                                  <a href="javascript:void(0)" ng-click="prevPage()" class="page-link">Previous</a>
                                </li>
                                <li ng-repeat="n in range()" ng-class="{active: n == currentPage}" ng-click="setPage(n)" class="page-item">
                                  <a href="javascript:void(0)" class="page-link">{{n+1}}</a>
                                </li>
                                <li ng-class="nextPageDisabled()" class="page-item">
                                  <a href="javascript:void(0)" ng-click="nextPage()" class="page-link">Next</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                  }
                  ?>
              </div>
            </div>
            <!-----------------------------------------------email Junction Data--------------->
          </div>
          <!-----------------------------sent_messages----------------------------->
        </div>
        <!-----------------------------sent_messages----------------------------->
      </div>
    </div>
    <!-- end card-box-->
    <!----------Notification Ends------------>
    <!------------------------------------------------->
    <!------------------------------------------------->
  </div>
  <!-- container -->
</div>
<!-- content -->
<script type="text/javascript">
  crawlApp.factory("campaignFactory", function($http, $q, Upload) {
    var get_data = function(offset_val, count_limit) {
      var dataset_path = "<?php echo $baseurl . 'manage_campaign/get_pre_data' ?>";
      var deferred = $q.defer();
      var path = dataset_path+'/'+offset_val+'/'+count_limit;
      $http.get(path)
        .success(function(data, status, headers, config) {
         deferred.resolve(data);
        })
       .error(function(data, status, headers, config) {
          deferred.reject(status);
        });
      return deferred.promise;
    };
    var get_customer_status = function(campaign_id)
    {
      var search_path = "<?php echo $baseurl . 'manage_campaign/get_campaign_users/'; ?>";
      return $http({
        method: "post",
        url: search_path,
        data:
        {
          campaign_id: campaign_id
        }
      });
    };
    var get_products = function(country, brand, key_word, fc_code, offset_val, count_limit)
    {
      var search_path = "<?php echo $baseurl . 'manage_campaign/get_products/'; ?>";
      return $http({
        method: "post",
        url: search_path,
        data:
        {
          country: country,
          brand: brand,
          key_word: key_word,
          fc_code: fc_code,
          offset_val: offset_val,
          count_limit: count_limit,
        }
      });
    };
    var get_brands = function(country_code)
    {
      var search_path = "<?php echo $baseurl . 'manage_campaign/get_brands_for_country/'; ?>";
      return $http({
        method: "post",
        url: search_path,
        data:
        {
          country_code: country_code
        }
      });
    };
    var delete_campaign = function(campaign_id)
    {
      var search_path = "<?php echo $baseurl . 'manage_campaign/delete_campaign/'; ?>";
      return $http({
        method: "post",
        url: search_path,
        data:
        {
          campaign_id: campaign_id
        }
      });
    };
    var edit_campaign = function(campaign_id)
    {
      var search_path = "<?php echo $baseurl . 'manage_campaign/edit_campaign/'; ?>";
      return $http({
        method: "post",
        url: search_path,
        data:
        {
          campaign_id: campaign_id
        }
      });
    };
    var preview_email = function(template_id, order_id)
    {
      var search_path = "<?php echo $baseurl . 'manage_campaign/preview_email/'; ?>";
      return $http({
        method: "post",
        url: search_path,
        data:
        {
          template_id: template_id,
          order_id: order_id
        }
      });
    };

    var change_status = function(status_id, campaign_id)
    {
      var search_path = "<?php echo $baseurl . 'manage_campaign/change_status/'; ?>";
      return $http({
        method: "post",
        url: search_path,
        data:
        {
          w_status: status_id,
          campaign_id: campaign_id,
        }
      });
    };

    var change_state = function(status_id, campaign_id)
    {
      var search_path = "<?php echo $baseurl . 'manage_campaign/change_state/'; ?>";
      return $http({
        method: "post",
        url: search_path,
        data:
        {
          w_status: status_id,
          campaign_id: campaign_id,
        }
      });
    };

    var perform_action = function(action_name, campaign_ids)
    {
      var search_path = "<?php echo $baseurl . 'manage_campaign/perform_action/'; ?>";
      console.log(action_name, campaign_ids)
      return $http({
        method: "post",
        url: search_path,
        data:
        {
          campaign_ids: campaign_ids,
          action_name: action_name
        }
      });
    };

    var test_email = function(template_id, order_id, email)
    {
      var search_path = "<?php echo $baseurl . 'manage_campaign/test_email/'; ?>";
      return $http({
        method: "post",
        url: search_path,
        data:
        {
          template_id: template_id,
          order_id: order_id,
          email: email
        }
      });
    };

    var create_folder = function(folder_name)
    {
      var search_path = "<?php echo $baseurl . 'manage_campaign/new_folder/'; ?>";
      return $http({
        method: "post",
        url: search_path,
        data:
        {
          folder_name: folder_name
        }
      });
    };

    return {
      get_customer_status: get_customer_status,
      get_data: get_data,
      get_products: get_products,
      delete_campaign: delete_campaign,
      edit_campaign: edit_campaign,
      preview_email: preview_email,
      test_email: test_email,
      change_status: change_status,
      change_state: change_state,
      get_brands: get_brands,
      perform_action: perform_action,
      create_folder: create_folder,
    };

  });

  crawlApp.controller("campaignCtrl", function campaignCtrl($window, $scope, campaignFactory, $sce, $q, $timeout, Upload)
    {
      $scope.cmp = {};
      $scope.tmp = {};
      $scope.tst = {};
      $scope.tb = {};
      $scope.tst2 = {};
      $scope.tb.currentTab = 'tab1';
      $scope.store_country = <?php echo  '"' . $store_country . '"' ?>;
      console.log($scope.store_country);
      $scope.tst.order_id = 'ALL';
      $scope.cpn = {};
      $scope.cpn.frm_date = '';
      $scope.cpn.to_date = '';
      $scope.cpn.cmp_status = 'ALL';
      $scope.adh_cpn = {};
      $scope.adh_cpn.frm_date = '';
      $scope.adh_cpn.to_date = '';
      $scope.adh_cpn.cmp_status = 'ALL';
      $scope.cmp.camp_name = '';
      $scope.cmp.camp_desc = '';
      $scope.cmp.camp_brand = 'ALL';
      $scope.cmp.fc_code = 'ALL';
      $scope.cmp.prod_search = '';
      $scope.cmp.camp_country = '<?php echo $store_country ?>';
      $scope.cmp.camp_sku = '';
      $scope.cmp.camp_fulfill = 'ALL';
      $scope.cmp.camp_status = 'Draft';
      $scope.cmp.camp_goaltype = '1'
      $scope.cmp.camp_type = '1';
      $scope.cmp.camp_template = '';
      $scope.cmp.camp_trigger = '1';
      $scope.cmp.camp_trigger_day = 'ALL';
      $scope.cmp.camp_day = '1';
      $scope.cmp.camp_days = '';
      $scope.cmp.camp_hour = '';
      $scope.cmp.camp_min = '';
      $scope.cmp.camp_am_pm = '1';
      $scope.cmp.camp_coupon = '';
      $scope.cmp.camp_review = '';
      $scope.cmp.feedback_status = '1';
      $scope.cmp.selected_star = [];
      $scope.checkCampaigns = [];
      $scope.campStatus = [{name: 'Live', id: 3}, {name: 'Draft', id: 1}, {name: 'Test', id: 2}, {name: 'Paused', id: 4}];
      $scope.showCampDrop = [];

      $scope.cmp.selected_star.push({
       star: ''
     });
      $scope.cmp.selected_star.push({
       star: ''
     });
      $scope.cmp.selected_star.push({
       star: ''
     });
      $scope.cmp.selected_star.push({
       star: ''
     });
      $scope.cmp.selected_star.push({
       star: ''
     });
      $scope.cmp.selected_star.push({
       star: ''
     });
      $scope.tmp = '0';
      $scope.show_dash = 1;
      $scope.sortorder = 'cpgn_id';
      $scope.direction = 'ASC';
      $scope.selectedProduct = [];
      $scope.product_list = [];
      $scope.checkStatus = 'N';
      $scope.tempCampList = [];
      $scope.selectedFilterStatus = 'All Campaigns';
      $scope.selectedFilterGoal = 'All Goals'
      $scope.checkStatusCamp = 'N';
      $scope.checkedAll = false;
      $scope.campList = [];
      $scope.folders = [];
      $scope.selectedFolder = 'All Folders';
      // $scope.selectedCampaign = [];
      $scope.selectedCampaign = {
        ids: []
      };
      $scope.itemsPerPage = 15;
      $scope.currentPage = 0;
      $scope.total = 0;

      $scope.block_site = function() {
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
      $scope.block_site();
      $scope.range = function() {
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
      $scope.setRound = function(n) {
        return new Array(parseInt(n));
      };
      $scope.prevPage = function() {
        if ($scope.currentPage > 0) {
          $scope.currentPage--;
        }
      };
      $scope.prevPageDisabled = function() {
        return $scope.currentPage === 0 ? "disabled" : "";
      };
      $scope.nextPage = function() {
        if ($scope.currentPage < $scope.pageCount() - 1) {
          $scope.currentPage++;
        }
      };
      $scope.nextPageDisabled = function() {
        return $scope.currentPage === $scope.pageCount() - 1 ? "disabled" : "";
      };
      $scope.pageCount = function() {
        return Math.ceil($scope.total/$scope.itemsPerPage);
      };
      $scope.setPage = function(n) {
        if (n > 0 && n < $scope.pageCount()) {
          $scope.currentPage = n;
        }
      };
      $scope.$watch("currentPage",function(newValue, oldValue) {
        $scope.get_predata(newValue);
      });
      $scope.togggle_view = function()
      {
        if ($scope.show_dash == 0)
        {
          $scope.show_dash = 1;
        } else
        {
          $scope.show_dash = 0;
        }
        // console.log($scope.show_dash);
      }
      $scope.show_camp_drop = function(val) {
        $scope.showCampDrop[val] = !$scope.showCampDrop[val];
      }
      $scope.$watch("selectedCampaign.ids.length", function(newValue, oldValue) {
        if($scope.campList.length > 0) {
          if(newValue === $scope.campList.length) {
            $scope.checkStatusCamp = 'Y'
          } else {
            $scope.checkStatusCamp = 'N'
          }
        }
      });
      $scope.addNewFolder = function () {
        swal({
          title: 'New Folder',
          type: "input",
          showCancelButton: true,
          closeOnConfirm: false,
        }, function(inputValue) {
          inputValue = inputValue.trim();
          if (inputValue.length === false) return false;
            if (inputValue.length === 0) {
              swal({
                title: 'Error',
                type: "error",
                text: 'Please enter a valid folder name',
                showCancelButton: true,
                closeOnConfirm: true,
              })
              return false
            }
            var promise = campaignFactory.create_folder(inputValue);
            $scope.block_site();
            promise.then( resp => {
              $scope.folders = resp.data.user_folders;
              if(resp.data.status_code == '2') {
                swal("Error!", resp.data.status_text, 'error');
                $.unblockUI();
              } else {
                swal("Nice!", "Folder Name: " + inputValue, "success");
                $.unblockUI();
              }
              $.unblockUI();
            })
          }
        );
      }
      $scope.statusCheckCamp = function() {
        if($scope.checkStatusCamp === 'Y') {
          $scope.selectedCampaign.ids = $scope.campList.map(function(item) { return item.campaign_id; });
        } else {
          $scope.selectedCampaign.ids = [];
        }
      }
      // $scope.campStatusCheck = function () {
      //   console.log('here3', $scope.selectedCampaign.ids)
      // }
      $scope.performAction = function (val) {
        if($scope.selectedCampaign.ids.length > 0) {
          var promise = campaignFactory.perform_action(val, $scope.selectedCampaign.ids);
          promise.then( x=> {
            $scope.selectedCampaign.ids = [];
            $scope.get_predata(0);
            swal('Success!', x.data.status_text , 'success');
          })
        }
      }
      $scope.filterCamps = function(val, type) {
        $scope.campList = $scope.tempCampList;
        if(type === 'status') {
          if(val === 'All') {
            $scope.campList = $scope.tempCampList;
            $scope.selectedFilterStatus = 'All Campaigns';
          } else {
            // [{name: 'Live', id: 3}, {name: 'Draft', id: 1}, {name: 'Test', id: 2}, {name: 'Paused', id: 4}]
            if(val == 1) {
              $scope.selectedFilterStatus = 'Draft'
            } else if(val == 2) {
              $scope.selectedFilterStatus = 'Test'
            } else if(val == 3) {
              $scope.selectedFilterStatus = 'Live'
            } else if(val == 4) {
              $scope.selectedFilterStatus = 'Paused'
            }
            var arr = [];
            $scope.campList.forEach( x=> {
              if(x.camp_status === val) {
                arr.push(x);
              }
            })
            $scope.campList = arr;
          }
        }
        if(type === 'goal') {
          if(val === 'All') {
            $scope.campList = $scope.tempCampList;
            $scope.selectedFilterGoal = 'All Goals'
          } else {
            // 1: customer service 2: Feedback 3: Review
            if(val == 1) {
              $scope.selectedFilterGoal = 'Customer Service'
            } else if(val == 2) {
              $scope.selectedFilterGoal = 'Seller Feedback'
            } else if(val == 3) {
              $scope.selectedFilterGoal = 'Product Review'
            }
            var arr = [];
            $scope.campList.forEach( x=> {
              if(x.camp_goaltype === val) {
                arr.push(x);
              }
            })
            $scope.campList = arr;
          }
        }
        if(type === 'folder') {
          if(val === 'All') {
            $scope.campList = $scope.tempCampList;
            var arr = [];
            $scope.campList.forEach( x=> {
              if(x.is_deleted == 1 || x.is_archieve == 1) {

              } else {
                arr.push(x);
              }
            })
            $scope.campList = arr;
            $scope.selectedFolder = 'All Folders'
          } else if (val === 'trash') {
            $scope.campList = $scope.tempCampList;
            var arr = [];
            $scope.campList.forEach( x=> {
              if(x.is_deleted == 1) {
                arr.push(x);
              }
            })
            $scope.campList = arr;
            $scope.selectedFolder = 'Trash'
          } else if (val === 'archive') {
            $scope.campList = $scope.tempCampList;
            var arr = [];
            $scope.campList.forEach( x=> {
              if(x.is_archieve == 1) {
                arr.push(x);
              }
            })
            $scope.campList = arr;
            $scope.selectedFolder = 'Trash'
          } else {
            $scope.selectedFolder = val.folder_name;
            $scope.campList = $scope.tempCampList;
            var arr = [];
            $scope.campList.forEach( x=> {
              if(x.is_archieve != 1 || x.is_deleted != 1) {
                if(x.folder_id == val.fol_id) {
                  arr.push(x);
                }
              }
            })
            $scope.campList = arr;
          }
        }
      }
      $scope.clear_campaign_data = function()
      {
        $scope.cmp.cpgn_id = '0';
        $scope.cmp.camp_name = '';
        $scope.cmp.camp_desc = '';
        $scope.cmp.camp_brand = 'ALL';
        $scope.cmp.fc_code = 'ALL';
        $scope.cmp.prod_search = '';
        $scope.cmp.camp_country = '<?php echo $store_country ?>';
        $scope.clear_all();
        $scope.selectedProduct = [];
        $scope.product_list = [];
        $scope.tmp = '0';
        $scope.template_content = '';
        $scope.cmp.camp_sku = '';
        $scope.cmp.camp_fulfill = '1';
        $scope.cmp.camp_status = '1';
        $scope.cmp.camp_goaltype = '1'
        $scope.cmp.camp_type = '1';
        $scope.cmp.camp_template = '';
        $scope.cmp.camp_trigger = '1';
        $scope.cmp.camp_trigger_day = 'ALL';
        $scope.cmp.camp_days = '0';
        $scope.cmp.camp_hour = '0';
        $scope.cmp.camp_min = '0';
        $scope.cmp.camp_am_pm = '1';
        $scope.cmp.feedback_status = '1';
        $scope.tst.order_id = 'ALL';
      }

      $scope.open_campaign_ui = function()
      {
        $('#menuToggle').addClass('active');
        $('body').addClass(' body-push-toleft');
        $('#theMenu').addClass('menu-open');
      }

      $scope.load_template = function(template_id)
      {
        if (template_id != '0')
        {
          $scope.cmp.template_id = template_id;
          for (i = 0; i < $scope.template_list.length; i++)
          {
            if ($scope.template_list[i].template_id == template_id)
            {
              $scope.template_content = $sce.trustAsHtml("<div class='card card-body'>"+ $scope.template_list[i].template_content +"</div>");
            }
          }
        }
        //CKEDITOR.instances.editor.setData($scope.tmp);
      }
      $scope.get_template_data = function()
      {
        if (angular.isDefined($scope.tmp) && $scope.tmp.length > 0 && parseInt($scope.tmp) != 0)
        {
          for (i = 0; i < $scope.template_list.length; i++)
          {
            if ($scope.template_list[i].template_id == $scope.tmp)
            {
              $scope.tst.email_content = $sce.trustAsHtml($scope.template_list[i].template_content);
              $scope.tst.template_id = $scope.tmp;
              $scope.tst.subject = $scope.template_list[i].subject;
              $("#Preview_email_box").modal('show');
            }
          }
        } else
        {
          swal('Error!', 'Please select any template', 'error');
        }
      }
      $scope.create_campaign = function()
      {
        if ($scope.selectedProduct.length > 0)
        {
          $scope.block_site();
          file = $scope.cmp.camp_attachment;
          var upload = Upload.upload({
            url: '<?php echo $baseurl . 'manage_campaign/create_campaign/'; ?>',
            data: {
              attached_file: file,
              camp_data: angular.toJson($scope.cmp),
              asin: angular.toJson($scope.selectedProduct)
            },
          });

         upload.then(function(response) {
            $.unblockUI();
            if (angular.isDefined(file))
            {
              $timeout(function() {
                file.result = response.data;
              });
            }
            if (response.data.status_code == '1')
            {
              swal('Success!', response.data.status_text, 'success');
              $scope.campList = response.data.campaign_list;
              $(document).ready(function () {
                $('button.confirm').on('click', function() {
                  $("#myc").addClass('ng-hide');
                  $("#myc1").removeClass('ng-hide');
                  $("#myc1").addClass('row');
                });
              });
            } else
            {
              swal("Error!", response.data.status_text, 'error');
            }
          }, function(response) {
            $.unblockUI();
            if (response.status > 0)
              $scope.errorMsg = response.status + ': ' + response.data;
          }, function(evt) {
            if (angular.isDefined(file))
              file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
          });
        } else
        {
          swal("Error!", "No product has been selected ", 'error');
        }
      }


      $scope.itemsPerPageProduct = 25;
      $scope.currentPageProduct = 0;
      $scope.totalProduct = 0;
      $scope.rangeProduct = function() {
        var rangeSize = 4;
        var ret = [];
        var start;
        start = $scope.currentPageProduct;
        if ( start > $scope.pageCountProduct()-rangeSize ) {
          start = $scope.pageCountProduct()-rangeSize;
        }
        for (var i=start; i<start+rangeSize; i++) {
          if(i>0)
            ret.push(i);
        }
        return ret;
      };
      $scope.setRoundProduct = function(n) {
        return new Array(parseInt(n));
      };
      $scope.prevPageProduct = function() {
        if ($scope.currentPageProduct > 0) {
          $scope.currentPageProduct--;
        }
      };
      $scope.prevPageDisabledProduct = function() {
        return $scope.currentPageProduct === 0 ? "disabled" : "";
      };
      $scope.nextPageProduct = function() {
        if ($scope.currentPageProduct < $scope.pageCountProduct() - 1) {
          $scope.currentPageProduct++;
        }
      };
      $scope.nextPageDisabledProduct = function() {
        return $scope.currentPageProduct === $scope.pageCountProduct() - 1 ? "disabled" : "";
      };
      $scope.pageCountProduct = function() {
        return Math.ceil($scope.totalProduct/$scope.itemsPerPageProduct);
      };
      $scope.setPageProduct = function(n) {
        if (n > 0 && n < $scope.pageCountProduct()) {
          $scope.currentPageProduct = n;
        }
      };
      $scope.$watch("currentPageProduct",function(newValue, oldValue) {
        $scope.load_product(newValue);
      });


      $scope.load_product = function(currentPageProduct)
      {
        var blk = '#product_list';
        $(blk).block({
         message: 'Loading Product'
       });
        // $scope.clear_all();
        // $scope.selectedProduct=[];
        $scope.cmp.camp_country = '<?php echo $store_country ?>';
        campaignFactory.get_products($scope.cmp.camp_country, $scope.cmp.camp_brand, $scope.cmp.prod_search, $scope.cmp.fc_code, currentPageProduct*$scope.itemsPerPageProduct,$scope.itemsPerPageProduct)
          .success(
            function(html)
            {
              $(blk).unblock();
              if (html.status_code == '0')
              {
                swal('Error!', html.status_text, 'error');
              }
              if (html.status_code == '1')
              {
                $scope.product_list = html.payload;
                $scope.totalProduct = html.total_records;
              }
            }
          )
      }
      $scope.load_country_wise_brand = function()
      {
        $scope.cmp.camp_country = '<?php echo $store_country ?>';
        var blk = '#product_list';
        $(blk).block({
         message: 'Loading Product'
        });
        campaignFactory.get_brands($scope.cmp.camp_country)
          .success(
            function(html)
            {
              $(blk).unblock();
              if (html.status_code == '0')
              {
                swal('Error!', html.status_text, 'error');
              }
              if (html.status_code == '1')
              {
                $scope.brand_list = html.brand_list;
                $scope.product_list = html.product_list;
              }
            }
          )
      }
      $scope.preview_email = function()
      {
        $scope.block_site();
        campaignFactory.preview_email($scope.tst.template_id, $scope.tst.order_id)
          .success(
            function(html)
            {
              $.unblockUI();
              if (html.status_code == '0')
              {
                swal('Error!', html.status_text, 'error');
              }
              if (html.status_code == '1')
              {
                $scope.tst.email_content = $sce.trustAsHtml(html.email_content);
              }
            }
          )
      }
      $scope.test_email = function()
      {
       $scope.block_site();
        campaignFactory.test_email($scope.tst.template_id, $scope.tst.order_id, $scope.tst.email)
          .success(
            function(html)
            {
              $.unblockUI();
              if (html.status_code == '0')
              {
                swal('Error!', html.status_text, 'error');
              }
              if (html.status_code == '1')
              {
                swal('Success!', html.status_text, 'success');
              }
            }
          )
      }
      $scope.edit_campaign = function(campaign_id)
      {
        $scope.block_site();
        $scope.tst.order_id = 'ALL';
        campaignFactory.edit_campaign(campaign_id)
          .success(
            function(html)
            {
              $.unblockUI();
              if (html.status_code == '0')
              {
                swal('Error!', html.status_text, 'error');
              }
              if (html.status_code == '1')
              {
                $scope.cmp = html.campaign_detail[0];
                $scope.cmp.camp_hour = parseInt($scope.cmp.camp_hour);
                $scope.cmp.camp_days = parseInt($scope.cmp.camp_days);
                $scope.cmp.camp_min = parseInt($scope.cmp.camp_min);
                $scope.product_list = html.other_product;
                $scope.brand_list = html.brand_list;
                $scope.clear_all();
                $scope.selectedProduct = [];
                $scope.tmp = $scope.cmp.template_id;
                $scope.load_template($scope.tmp);
                if (html.selected_product.length > 0)
                {
                  for (i = 0; i < html.selected_product.length; i++)
                  {
                    $scope.addToArray($scope.selectedProduct, html.selected_product[i]);
                  }
                }
                // console.log(html.selected_product);
                $scope.show_dash = 0;
              }
            }
          )
      }
      $scope.delete_campaign = function(campaign_id)
      {
        swal({
            title: "Are you sure to delete campaign?",
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
              campaignFactory.delete_campaign(campaign_id)
                .success(
                  function(html)
                  {
                    if (html.status_code == '0')
                    {
                      swal('Error!', html.status_text, 'error');
                      $scope.campList = html.campaign_list;
                    }
                    if (html.status_code == '1')
                    {
                      swal('Success!', html.status_text, 'success');
                      $scope.campList = html.campaign_list;
                    }
                  }
                );
            } else {
              swal("Cancelled", "Delete cancelled:)", "error");
            }
          });
      }
      $scope.change_status = function(status, campaign_id)
      {
        var msg = "Are you sure to change campaign status to" + " " + status.name;
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
              campaignFactory.change_status(status.id, campaign_id)
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
                      $scope.campList = html.campaign_list;
                    }
                  }
                );
            } else {
              swal("Cancelled", "cancelled:)", "error");
              $scope.campList = html.campaign_list;
            }
          });
      }

      $scope.change_state = function(is_active, campaign_id)
      {
        if (is_active == 1)
        {
          var sts = 'Activate';
        } else
        {
          var sts = 'Deactivate';
        }
        var msg = "Are you sure to " + sts + " campaign?";
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
              campaignFactory.change_state(is_active, campaign_id)
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
                      $scope.campList = html.campaign_list;
                    }
                  }
                );
            } else {
              swal("Cancelled", "cancelled:)", "error");
              $scope.campList = html.campaign_list;
            }
          });
      }

      $scope.block_site = function()
      {
        $.blockUI({
         css: {
            border: 'none',
            padding: '3px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
          },
          baseZ: 9999
        });
      }

      $scope.get_predata = function(currentPage)
      {
        $scope.block_site();
        var promise = campaignFactory.get_data(currentPage*$scope.itemsPerPage,$scope.itemsPerPage);
        promise.then(
          function(response)
          {
            if (response.status_code == '1')
            {
              $.unblockUI();
              $scope.campList = response.campaign_list;
              $scope.tempCampList = response.campaign_list;
              $scope.brand_list = response.brand_list;
              $scope.recent_orders = response.recent_orders;
              $scope.country_list = response.country_list;
              $scope.template_list = response.template_list;
              $scope.metrics = response.metrics;
              $scope.product_list = response.product_list;
              $scope.folders = response.user_folders;
              $scope.total = response.total_records;
              $scope.filterCamps('All','folder');
            } else
            {
              swal('Error!', response.status_text, 'error');
            }
          },

          function(reason)
          {
            $scope.serverErrorHandler(reason);
          }
        );
      }
      $scope.select_all = function()
      {
        for (i = 0; i < $scope.product_list.length; i++)
        {
          $scope.addToArray($scope.selectedProduct, $scope.product_list[i]);
        }
        $scope.selectcount = $scope.selectedProduct.length;
        $scope.totalcount = $scope.total;
      }
      $scope.clear_all = function()

      {
        $scope.clearArray($scope.selectedProduct);
      }

      $scope.checkExist = function(arr, item)
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
      $scope.addToArray = function(arr, item)

      {

        arr = angular.isArray(arr) ? arr : [];

        if (!$scope.checkExist(arr, item))

        {

          arr.push(item);

        }

      }

      $scope.removeFromArray = function(arr, item)

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



      $scope.clearArray = function(arr)

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

          if (newValue < $scope.product_list.length)

          {

            $scope.checkStatus = 'N';

          }

        });

        // $scope.$watch("checkCampaigns.length",

        // function(newValue, oldValue) {
        //   console.log('here', $scope.checkCampaigns)
        // });



      $scope.statusCheck = function()

      {



        if ($scope.checkStatus == 'Y')

        {

          $scope.select_all();

        } else if ($scope.checkStatus == 'N')

        {

          $scope.clear_all();

        }

      }
    });

  crawlApp.factory("templateFactory", function($http, $q, Upload) {
    var get_data = function() {
    var dataset_path = "<?php echo $baseurl . 'template/get_pre_data' ?>";
    var deferred = $q.defer();
    var path = dataset_path;
    $http.get(path)
      .success(function(data, status, headers, config) {
        deferred.resolve(data);
      })

      .error(function(data, status, headers, config) {
        deferred.reject(status);
      });
      return deferred.promise;
    };



    var edit_template = function(template_id)

    {

      var search_path = "<?php echo $baseurl . 'template/edit_template/'; ?>";

      return $http({

        method: "post",

        url: search_path,

        data:

        {

          template_id: template_id

        }

      });



    };

    var save_template = function(template_data)

    {

      var search_path = "<?php echo $baseurl . 'template/save_template/'; ?>";

      return $http({

        method: "post",

        url: search_path,

        data:

        {



          template_data: angular.toJson(template_data)

        }

      });



    };

    var delete_template = function(template_id)

    {

      var search_path = "<?php echo $baseurl . 'template/delete_template/'; ?>";

      return $http({

        method: "post",

        url: search_path,

        data:

        {

          template_id: template_id

        }

      });



    };











    return {

      get_data: get_data,

      edit_template: edit_template,

      save_template: save_template,

      delete_template: delete_template

    };

  });

  crawlApp.controller("templateCtrl", function templateCtrl($window,$interval, $scope, templateFactory, $sce, $q, $timeout, Upload)
    {
      $scope.tmp = {};
      $scope.tmplt = {};
      $scope.tmp.test_html = CKEDITOR.instances.editor.getData();
      $scope.show_dash_email = 1;
      $scope.tmplt.tmp_id = '';
      $scope.tmplt.is_default = '0';
      $scope.tmplt.subject = '';
      $scope.tmplt.template_name = '';
      $scope.tmplt.template_content_html = '';
      $scope.activateSave = false;
      $scope.watchTemp = false;
      $scope.block_site = function()
      {
        $.blockUI({
          css: {
            border: 'none',
            padding: '3px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
          },
          baseZ: 9999
        });
      }
      $scope.togggle_view_email = function() {
        if ($scope.show_dash_email == 0) {
          $scope.show_dash_email = 1;
        } else {
          $scope.show_dash_email = 0;
        }
      }
      $scope.open_campaign_ui = function()
      {
        $('#menuToggle').addClass('active');
        $('body').addClass(' body-push-toleft');
        $('#theMenu').addClass('menu-open');
      }
      $scope.load_template = function(template_id)
      {
        if (template_id != '0')
        {
          $scope.cmp.template_id = template_id;
          $scope.adhoc_cmp.template_id = template_id;
          for (i = 0; i < $scope.template_list.length; i++)
          {
            if ($scope.template_list[i].template_id == template_id)
            {
              $scope.template_content = $sce.trustAsHtml($scope.template_list[i].template_content);
            }
          }
        }
      }
      $scope.get_template_data = function()
      {
        if (angular.isDefined($scope.tmp) && $scope.tmp.length > 0 && parseInt($scope.tmp) != 0)
        {
          for (i = 0; i < $scope.template_list.length; i++)
          {
            if ($scope.template_list[i].template_id == $scope.tmp)
            {
              $scope.tst.email_content = $sce.trustAsHtml($scope.template_list[i].template_content);
              $scope.tst.template_id = $scope.tmp;
              $scope.tst.subject = $scope.template_list[i].subject;
              $("#Preview_email_box").modal('show');
            }
          }
        } else
        {
          swal('Error!', 'Please select any template', 'error');
        }
      }
      $scope.get_predata = function()
      {
        $scope.block_site();
        var promise = templateFactory.get_data();
        promise.then(
          function(response)
          {
            if (response.status_code == '1')
            {
              $.unblockUI();
              $scope.template_list = response.template_list;
            } else
            {
              swal('Error!', response.status_text, 'error');
            }
          },
          function(reason)
          {
            $scope.serverErrorHandler(reason);
          }
        );
      }
      $scope.get_predata();
      $scope.clear_template = function()
      {
        $scope.tmplt.tmp_id = '';
        $scope.tmplt.is_default = '0';
        $scope.tmplt.subject = '';
        $scope.tmplt.template_name = '';

        $scope.tmplt.template_content_html = '';

        CKEDITOR.instances.editor.setData('');

      }

      $scope.$watch("watchTemp",function(newValue, oldValue) {
        if(newValue == true) {
          $scope.watchPage();
        }
      });
      $scope.$watch("tmplt.subject",function(newValue, oldValue) {
        if(newValue.length > 5) {
          $scope.watchTemp =  true;
        }
      });
      function cancelNav(ev) {
        ev.preventDefault();
        ev.stopPropagation();
        swal({
              title: 'Error',
              type: "error",
              text: 'Changes to the template are not saved',
              showCancelButton: true,
              closeOnConfirm: true,
              confirmButtonColor: '#DD6B55',
              confirmButtonText: 'Stay',
              cancelButtonText: "Discard Template",
              closeOnConfirm: true,
              closeOnCancel: true
            },
            function(isConfirm) {
              if(isConfirm) {

              } else {
                var ele = $(".stop-nav");
                for ( var i = 0; i < ele.length; ++i ) {
                  ele[i].removeEventListener("click", cancelNav);
                }
              }
            }
            )
      }
      $scope.watchPage = function () {
        var ele = $(".stop-nav");
        console.log(ele)
        for ( var i = 0; i < ele.length; ++i ) {
          ele[i].addEventListener("click", cancelNav, false);
        }
      }

      $scope.save_template = function()

      {
        var ele = $(".stop-nav");
        for ( var i = 0; i < ele.length; ++i ) {
          ele[i].removeEventListener("click", cancelNav);
        }
        if ($scope.tmplt.is_default == '1')

        {

          swal('Error!', "Default Template is not editable please recreate and edit ", 'error');

        } else

        {

          $scope.block_site();

          $scope.tmplt.template_ui = CKEDITOR.instances.editor.getData();

          //console.log($scope.tmplt.attachment);

          //die();

          templateFactory.save_template($scope.tmplt)

            .success(

              function(html)

              {

                $.unblockUI();

                if (html.status_code == '0')

                {

                  swal('Error!', html.status_text, 'error');

                }

                if (html.status_code == '1')

                {

                  swal('Success!', html.status_text, 'success');

                  // $scope.template_list=html.payload;

                  $scope.get_predata();

                  $(document).ready(function () {
                    $('button.confirm').on('click', function() {
                      $("#myid1").addClass('ng-hide');
                      $("#myid").removeClass('ng-hide');
                      $("#myid").addClass('row');
                    });
                  });
                }

              }

            )

        }



      }



      $scope.block_site = function()

      {

        $.blockUI({
          css: {

            border: 'none',

            padding: '3px',

            backgroundColor: '#000',

            '-webkit-border-radius': '10px',

            '-moz-border-radius': '10px',

            opacity: .5,

            color: '#fff'

          }
        });



      }



      $scope.edit_template = function(template_id)

      {

        $scope.block_site();

        templateFactory.edit_template(template_id)

          .success(

            function(html)

            {

              $.unblockUI();

              if (html.status_code == '0')

              {

                swal('Error!', html.status_text, 'error');

              }

              if (html.status_code == '1')

              {

                $scope.tmplt = html.template_detail[0];

                CKEDITOR.instances.editor.setData($scope.tmplt.template_content);

                $scope.tmplt.template_content_html = $sce.trustAsHtml($scope.tmplt.template_content);

                $scope.tmplt.tmp_id = $scope.tmplt.template_id;



                // console.log(html.selected_product);

                $scope.show_dash_email = 0;

              }

            }

          )



      }

      $scope.delete_template = function(template_id, is_default)

      {

        //console.log(is_default);

        if (is_default == '1')

        {

          swal('Error!', "Default Template is not deletable ", 'error');

        } else

        {

          swal({

              title: "Are you sure want to Delete ?",

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

                $scope.block_site();

                templateFactory.delete_template(template_id)

                  .success(

                    function(html)

                    {

                      console.log(html);

                      $.unblockUI();

                      if (html.status_code == 0)

                      {

                        swal('Error!', html.status_text, 'error');

                      } else if (html.status_code == 1)

                      {

                        $scope.get_predata();

                        swal('Success!', 'Template Successfully Deleted', 'success');

                      }



                    }

                  )

                  .error(

                    function(data, status, headers, config)

                    {



                    }



                  );



              } else {

                swal("Cancelled", "Delete cancelled:)", "error");

              }

            });

        }

      }



      $(document).ready(function() {

        CKEDITOR.instances.editor.on('change', function() {

          $scope.tmplt.template_content_html = $sce.trustAsHtml(CKEDITOR.instances.editor.getData());

        });

      });



    });

  crawlApp.factory('emailjunctionFactory', ['$http', '$q', 'limitToFilter', function($http, $q, limitToFilter) {



    var order_list_url = "<?php echo $baseurl . "my_campaign/get_campaign_order/" ?>";





    var get_transaction_list = function(cntxt, orderby, direction, offset, limit, search)

    {

      var deferred = $q.defer();

      var path = order_list_url + cntxt + '/' + orderby + '/' + direction + '/' + offset + '/' + limit + '/' + search;

      console.log(path);

      $http.get(path)

        .success(function(data, status, headers, config) {
          deferred.resolve(data);
        })

        .error(function(data, status, headers, config) {
          deferred.reject(status);
        });

      return deferred.promise;

    };

    var get_data = function() {

      var dataset_path = "<?php echo $baseurl . 'my_campaign/get_pre_data' ?>";

      var deferred = $q.defer();

      var path = dataset_path;



      $http.get(path)

        .success(function(data, status, headers, config) {
          deferred.resolve(data);
        })

        .error(function(data, status, headers, config) {
          deferred.reject(status);
        });



      return deferred.promise;

    };

    var send_now = function(tnx)

    {

      return $http({

        method: "post",

        url: "<?php echo $baseurl . 'my_campaign/send_now' ?>",

        data: {

          cmp: angular.toJson(tnx)

        }

      });



    };

    var mark_as_dns = function(selectedOrder)

    {

      return $http({

        method: "post",

        url: "<?php echo $baseurl . 'my_campaign/mark_as_dns' ?>",

        data: {

          selected_order: angular.toJson(selectedOrder)

        }

      });



    };



    var rmv_dns = function(selectedOrder)

    {

      return $http({

        method: "post",

        url: "<?php echo $baseurl . 'my_campaign/rmv_dns' ?>",

        data: {

          selected_order: angular.toJson(selectedOrder)

        }

      });



    };







    return {

      get_transaction_list: get_transaction_list,

      get_data: get_data,

      send_now: send_now,

      mark_as_dns: mark_as_dns,

      rmv_dns: rmv_dns



    };



  }]);

  crawlApp.controller('emailjunctionCtrl', ['$scope', '$parse', '$window', 'emailjunctionFactory', '$http', 'limitToFilter', function($scope, $parse, $window, emailjunctionFactory, $http, limitToFilter) {

    $scope.transactionList = [];

    $scope.context = "schduled_mail";

    $scope.outstanding = '';

    $scope.filter = {};

    $scope.filter.search = '';

    $scope.filter.order_status = 'ALL';

    $scope.filter.tfm_status = 'ALL';

    $scope.filter.camp_id = 'ALL';

    $scope.filter.type = 'ALL';

    $scope.reset = function()

    {

      $scope.order = {};

      $scope.order_items = [];



    }

    $scope.reset();





    $scope.block_site = function()

    {

      $.blockUI({
        css: {

          border: 'none',

          padding: '3px',

          backgroundColor: '#000',

          '-webkit-border-radius': '10px',

          '-moz-border-radius': '10px',

          opacity: .5,

          color: '#fff'

        }
      });



    }



    $scope.itemsPerPage = 25;

    $scope.itm_per = '25';

    $scope.currentPage = 0;

    $scope.sortorder = 'camp_id';

    $scope.direction = 'DESC';

    $scope.searchJSON = [];

    $scope.filterquery = [];

    $scope.selectedOrder = [];

    $scope.order = {};
    $scope.allCamps = false;


    $scope.range = function()

    {

      var rangeSize = 8;

      var ret = [];

      var start;



      start = $scope.currentPage;



      if (start > $scope.pageCount() - rangeSize) {

        start = $scope.pageCount() - rangeSize;

      }



      for (var i = start; i < start + rangeSize; i++) {

        if (i > 0)

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

      return Math.ceil($scope.total / $scope.itemsPerPage);

    };



    $scope.setPage = function(n)

    {

      if (n > 0 && n < $scope.pageCount())

      {

        $scope.currentPage = n;

      }

    };



    $scope.$watch("currentPage", function(newValue, oldValue)

      {

        $scope.get_transaction_list(newValue);

      });

      $scope.$watch("allCamps", function(newValue, oldValue) {
        // console.log('why',newValue)
        // $scope.campList.forEach(x=> {
        //   $scope.checkCampaigns.push(x.campaign_id)
        // })
      });

    $scope.get_campaign_list = function(str)

    {

      $scope.context = str;

      if ($scope.currentPage == 0)

      {

        $scope.currentPage = 0;

        $scope.get_transaction_list(0);

      } else

      {

        $scope.currentPage = 0;

      }



      //

    }

    $scope.change_item_per_page = function()

    {



      $scope.itemsPerPage = parseInt($scope.itm_per);

      $scope.get_transaction_list($scope.currentPage);

    }



    $scope.get_transaction_list = function(currentPage)

    {

      $scope.block_site();

      var promise = emailjunctionFactory.get_transaction_list($scope.context, $scope.sortorder, $scope.direction, currentPage * $scope.itemsPerPage, $scope.itemsPerPage, $scope.searchJSON);

      promise.then(function(value) {

          $.unblockUI();

          if (value.status_code == 1)

          {



            $scope.transactionList = value.datalist;

            $scope.total = value.total;

            $scope.outstanding = value.outstanding;



          } else

          {

            $scope.transactionList = [];

            $scope.total = 0;

            $scope.outstanding = value.outstanding;

            console.log(value);



          }

        },

        function(reason)

        {

          console.log("Reason" + reason);

        });

    }

    $scope.mark_as_dns = function()

    {

      if ($scope.selectedOrder.length > 0)

      {



        swal({

            title: "Are you sure to mark as DNS?",

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

              emailjunctionFactory.mark_as_dns($scope.selectedOrder)

                .success(

                  function(html)

                  {

                    if (html.status_code == '0')

                    {

                      swal('Error!', html.status_text, 'error');

                    }

                    if (html.status_code == '1')

                    {

                      $scope.get_transaction_list($scope.currentPage);

                      swal('Success!', html.status_text, 'success');

                    }

                  }

                )



            } else {

              swal("Cancelled", "update cancelled:)", "error");

            }

          });





      } else

      {

        swal('Error!', "There is no order selected", 'error');

      }



    }



    $scope.rmv_dns = function()

    {

      if ($scope.selectedOrder.length > 0)

      {



        swal({

            title: "Are you sure to Remove DNS?",

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

              emailjunctionFactory.rmv_dns($scope.selectedOrder)

                .success(

                  function(html)

                  {

                    if (html.status_code == '0')

                    {

                      swal('Error!', html.status_text, 'error');

                    }

                    if (html.status_code == '1')

                    {

                      $scope.get_transaction_list($scope.currentPage);

                      swal('Success!', html.status_text, 'success');

                    }

                  }

                )



            } else {

              swal("Cancelled", "update cancelled:)", "error");

            }

          });





      } else

      {

        swal('Error!', "There is no order selected", 'error');

      }



    }



    $scope.filtergrid = function()

    {

      $scope.filterquery = [

        {
          searchtext: $scope.filter.search
        },

        {
          camp_id: $scope.filter.camp_id
        },

        {
          from_date: $scope.filter.frm_date
        },

        {
          to_date: $scope.filter.to_date
        },

        {
          order_status: $scope.filter.order_status
        },

        {
          tfm_status: $scope.filter.tfm_status
        },

        {
          type: $scope.filter.type
        }

      ];

      var argum = JSON.stringify($scope.filterquery);

      $scope.searchJSON = encodeURIComponent(argum);

      $scope.get_transaction_list(0);



    }



    $scope.get_predata = function()

    {

      var promise = emailjunctionFactory.get_data();

      promise.then(

        function(response)

        {

          if (response.status_code == '1')

          {

            $scope.campList = response.campaign_list;

          } else

          {

            swal('Error!', response.status_text, 'error');

          }

        },

        function(reason)

        {

          $scope.serverErrorHandler(reason);

        }

      );

    }

    $scope.get_predata();



    $scope.send_now = function()

    {



      if ($scope.selectedOrder.length > 0 && $scope.selectedOrder.length <= 3)

      {

        swal({

            title: "Are you sure to send mail?",

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

              $scope.block_site();

              emailjunctionFactory.send_now($scope.selectedOrder)

                .success(

                  function(html)

                  {

                    console.log(html);

                    $.unblockUI();

                    if (html.status_code == 0)

                    {

                      swal('Error!', html.status_text, 'error');

                    } else if (html.status_code == 1)

                    {

                      swal('Success!', html.status_text, 'success');

                    }



                  }

                )

                .error(

                  function(data, status, headers, config)

                  {



                  }



                );



            } else {

              swal("Cancelled", "Mail cancelled", "error");

            }

          });

      } else

      {

        swal("Error", "Please send 3 mail at a time ", "error");

      }





    }





    $scope.select_all = function()

    {

      for (i = 0; i < $scope.transactionList.length; i++)

      {

        $scope.addToArray($scope.selectedOrder, $scope.transactionList[i]);

      }

      $scope.selectcount = $scope.selectedOrder.length;

      $scope.totalcount = $scope.total;

    }



    $scope.clear_all = function()

    {

      $scope.clearArray($scope.selectedOrder);

    }



    $scope.checkExist = function(arr, item)

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



    $scope.addToArray = function(arr, item)

    {

      arr = angular.isArray(arr) ? arr : [];

      if (!$scope.checkExist(arr, item))

      {

        arr.push(item);

      }

    }

    $scope.removeFromArray = function(arr, item)

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



    $scope.clearArray = function(arr)

    {

      if (angular.isArray(arr))

      {

        for (var i = arr.length; i--;)

        {

          arr.splice(i, 1);

        }

      }

    }



    $scope.$watch("selectedOrder.length",

      function(newValue, oldValue)

      {

        if (newValue < $scope.transactionList.length)

        {

          $scope.checkStatus = 'N';

        }

      });

    $scope.statusCheck = function()

    {





      if ($scope.checkStatus == 'Y')

      {

        $scope.select_all();

      } else if ($scope.checkStatus == 'N')

      {

        $scope.clear_all();

      }

    }













  }]);
</script>
<script src="<?php echo $baseurl . 'asset/ckeditor/ckeditor.js'; ?>"></script>
<script src="<?php echo $baseurl . 'asset/ckeditor/config.js'; ?>"></script>
<script>
  CKEDITOR.editorConfig = function(config) {

    config.toolbarGroups = [

      {
        name: 'document',
        groups: ['mode', 'document', 'doctools']
      },

      {
        name: 'clipboard',
        groups: ['clipboard', 'undo']
      },

      {
        name: 'editing',
        groups: ['find', 'selection', 'spellchecker', 'editing']
      },

      {
        name: 'forms',
        groups: ['forms']
      },

      {
        name: 'basicstyles',
        groups: ['basicstyles', 'cleanup']
      },

      {
        name: 'paragraph',
        groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
      },

      {
        name: 'links',
        groups: ['links']
      },

      {
        name: 'insert',
        groups: ['insert']
      },

      {
        name: 'styles',
        groups: ['styles']
      },

      {
        name: 'colors',
        groups: ['colors']
      },

      {
        name: 'image',
        groups: ['image']
      },

      {
        name: 'tools',
        groups: ['tools']
      },

      {
        name: 'others',
        groups: ['others']
      },

      {
        name: 'about',
        groups: ['about']
      }

    ];



    config.removeButtons = 'Preview,Print,Templates,Form,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Anchor,Flash,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Font,Checkbox,Undo,Redo,Find,Replace,Subscript,Strike,Superscript,CopyFormatting,RemoveFormat,Maximize,ShowBlocks,About,Table,Paste,PasteText,PasteFromWord,CreateDiv,Save,Language,Image,JustifyLeft,JustifyRight,Link,Unlink,Cut,Copy';

  };
</script>
<script>
  CKEDITOR.replace('editor', {

    height: 350,

    on: {

      pluginsLoaded: function() {

        var editor = this,

          config = editor.config;



        editor.ui.addRichCombo('my-combo', {

          label: 'Placeholders',

          title: 'Placeholder text will be replaced by actual text',

          toolbar: 'others,0',



          panel: {

            css: [CKEDITOR.skin.getPath('editor')].concat(config.contentsCss),

            multiSelect: false,

            attributes: {
              'aria-label': 'Placeholders Tag'
            }

          },



          init: function() {

            this.startGroup('Order Info');

            this.add('{{customer_fullname}}', 'Customer Name');

            this.add('{{customer_firstname}}', 'Customer First Name');

            this.add('{{customer_lastname}}', 'Customer Last Name');

            this.add('{{order_number}}', 'Order Number');

            this.add('{{order_date}}', 'Order Date');

            this.add('{{product_name}}', 'Product Name');

            this.add('{{feedback_url}}', 'Feedback URL');

            this.add('{{review_url}}', 'Review URL');

            this.add('{{review_url_with_product_img}}', 'Review URL with Product Image');

            this.startGroup('Company Info');

            this.add('{{company_name}}', 'Company Name');

            this.add('{{store_url}}', 'Storefront URL');

          },

          onClick: function(value) {

            editor.focus();

            editor.fire('saveSnapshot');



            editor.insertHtml(value);



            editor.fire('saveSnapshot');

          }

        });

      }

    }

  });
</script>
