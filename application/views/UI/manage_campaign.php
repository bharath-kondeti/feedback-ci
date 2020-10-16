<?php
 $baseurl=base_url();
 $base_url=base_url();
?>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}

.switch input {display:none;}

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
  height: 20px;
  width: 20px;
  border-radius: 50px;
  left: 1px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #33c4d4;
}

input:focus + .slider {
  box-shadow: 0 0 1px #33c4d4;
}

input:checked + .slider:before {
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
    .pad-15
    {
        padding:15px;
    }
</style>

				<div class="wrapper" ng-cloak ng-controller='campaignCtrl'>


				<div id="Preview_email_box" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
						<div class="modal-dialog">
							<div class="modal-content" style="margin-left:-100px;width:700px">
								<div class="modal-header">
									<h4 class="modal-title">Preview &amp; Test</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body p-4">
								 <div class="row" style="margin-bottom:10px">
									<div class="col-sm-10 mg-top-10" >
										<input type="email" placeholder='Email ' ng-model="tst.email" class='form-control'>
										</div>
										<div class="col-sm-1 mg-top-10">
										  <button class="btn btn-info" ng-click='test_email()'>Test</button>
										</div>
										</div>

										<div class="row" style="margin-bottom:10px">
										<div class="col-sm-10 mg-top-10" >
										<select class="form-control" ng-model='tst.order_id' >
										<option value="ALL">Select Orderid</option>
										<option ng-repeat="x in recent_orders" value='{{x.order_no}}'>{{x.order_no}}</option>
										</select>
										</div>
										<div class="col-sm-1 mg-top-10">
										  <button class="btn btn-info" ng-click='preview_email()'>Preview</button>
										</div>
										</div>
										<div class="row" style="margin-bottom:10px">
										<div class="col-sm-12 mg-top-10">
										  <table style="border: 1px solid #DEE2E6; text-align: center;" class="table table-hover table-centered mb-0">
										  <tr><th>From</th><th>feedback_mail@feedbackgrid.com</th></tr>
										  <tr><th>To</th><th><span ng-if='tst.email.length > 0'>{{tst.email}}</span><span ng-if='tst.email.length == 0'>preview_mail@feedbackgrid.com</span></th></tr>
										  <tr><th>Subject</th><th>{{tst.subject}}</th></tr>
										  <tr><td colspan="2">
											<div class="" ng-bind-html='tst.email_content'></div>
										  </td></tr>
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
									  <p>Please connect a store to start importing your inventory.  <a class="btn btn-info" href="<?php echo $base_url.'manage_stores'?>">Connect Stores...</a></p>

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
                                    <h4 class="page-title">Camapign</h4>
                                </div>
                            </div>
                        </div>

						<div class="row"  ng-show='show_dash==1'>
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<div class="col-sm-12" style="padding:10px 10px 10px 10px">
										<a href='#' style="margin-top:-20px;margin-bottom:10px; " class="btn btn-info pull-right" ng-click='clear_campaign_data();togggle_view()' >Create Campaign</a>
										</div>

										<div class="col-sm-12">
											<div class="table-responsive">
												<table style="border: 1px solid #DEE2E6; text-align: center;" class="table table-hover table-centered mb-0">
													<thead style="background-color: #f1f5f7;font-size: 12px;font-weight: 200;color: #6c757d;white-space: nowrap">
													<tr>
													<th style="color:#6c757d">MarketPlace</th>
													<th style="color:#6c757d;width: 655px;position: relative;">Name</th>
													<th style="color:#6c757d;margin-left:5px;">Scheduled </th>
													<th style="color:#6c757d;margin-left:5px;">Sent</th>
													<th></th>

													</tr>
													 <!--   <tr>
															<th>Campaign Details</th>
				  <th ng-click="filter_data('sent_count')">Email Sent <i class="fa fa-sort" ng-class="sortorder=='sent_count' && direction=='ASC'?'fa-sort':'fa-sort'"></i></th>
				  <th ng-click="filter_data('total_mail')">Email Scheduled <i class="fa fa-sort" ng-class="sortorder=='total_mail' && direction=='ASC'?'fa-sort':'fa-sort'"></i></th>
				  <th ng-click="filter_data('is_active')">Status <i class="fa fa-sort" ng-class="sortorder=='is_active' && direction=='ASC'?'fa-sort':'fa-sort'"></i></th>
				   <th>Action</th>
														</tr> -->
													</thead>
													<tbody  ng-repeat="idx in campList track by $index">
													<tr >

													<td ng-if="store_country=='IN'"><img width="20" height="20"  src="<?php echo $base_url.'assets/img/amazon_logo.png'?> "><span style="color:#a3afb7;font-weight:300" >.in</span></td>
													<td ng-if="store_country=='US'"><img width="20" height="20"  src="<?php echo $base_url.'assets/img/amazon_logo.png'?> "><span style="color:#a3afb7;font-weight:300" >.com</span></td>
													<td ng-if="store_country=='UK'"><img width="20" height="20"  src="<?php echo $base_url.'assets/img/amazon_logo.png'?> "><span style="color:#a3afb7;font-weight:300" >.co.uk</span></td>
													<td ng-if="store_country=='IT'"><img width="20" height="20"  src="<?php echo $base_url.'assets/img/amazon_logo.png'?> "><span style="color:#a3afb7;font-weight:300" >.it</span></td>
													<td ng-if="store_country=='DE'"><img width="20" height="20"  src="<?php echo $base_url.'assets/img/amazon_logo.png'?> "><span style="color:#a3afb7;font-weight:300" >.de</span></td>
													<td ng-if="store_country=='FR'"><img width="20" height="20"  src="<?php echo $base_url.'assets/img/amazon_logo.png'?> "><span style="color:#a3afb7;font-weight:300" >.fr</span></td>
													<td ng-if="store_country=='ES'"><img width="20" height="20"  src="<?php echo $base_url.'assets/img/amazon_logo.png'?> "><span style="color:#a3afb7;font-weight:300" >.es</span></td>
													<td style="position: relative;">{{idx.campaign_name}}</td>

													<td><span style="margin-left:5px"> {{idx.total_mail}} </span></td>
													<td><span style="margin-left:5px"> {{idx.sent_count}} </span></td>

													<td><div class="form-inline"><i   ng-click='edit_campaign(idx.campaign_id)' style="font-size:20px;margin-left: 10px" class="fe-edit"></i>
													<i  ng-click='delete_campaign(idx.campaign_id)' style="font-size:20px;margin-left: 10px" class="fe-trash-2"></i>
													<label class="switch" style="margin-left: 10px">
													<input type="checkbox" name='enable_addon'  ng-model="idx.is_active" ng-true-value="'1'" ng-false-value="'0'" ng-change='change_status(idx.is_active,idx.campaign_id)'>
													<span class="slider round"></span>
													</label></div></td>
												   </tr>

													</tbody>

												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

			<div class="row"  ng-show='show_dash==0'>
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<a href=""  id="menuToggle" style="margin-top:-15px;" class="pull-right  dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true" ng-click='togggle_view()'>Close</a>
							<div class="col-sm-12">
								<div class="form-inline">
									<div class="col-sm-12">
										<div class="form-group mx-sm-12 mb-12">
											<div class="col-sm-3">
												<label for="status-select" class="mr-2">Enter Campaign name</label>
											</div>
											<div class="col-sm-8">
												<input type="text" style="width:100%" id="camp_name" name="" class="form-control mr-10" ng-model='cmp.camp_name' placeholder="Enter Campaign name">
											</div>
										</div>
										<br>

										<div class="form-group mx-sm-12 mb-12">
											<div class="col-sm-3">
												<label for="status-select" class="mr-2">Customer Type</label>
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
												<label for="status-select" class="mr-2">Fulfillment</label>
											</div>
											<div class="col-sm-8">
											  <select style="width:100%" class="form-control" ng-model='cmp.camp_fulfill'>
												  <option value='1'>ALL</option>
												  <option value='2' >Match order fulfilled by Amazon</option>
												  <option value='3'>Match order fulfilled by Merchant</option>
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
						<br>
							<div class="tab-pane" id="basictab3" ng-class="tb.currentTab=='tab3'?'tab-pane fade active in':'tab-pane'"><br>
								<div class="col-sm-12" >
									<div class="form-group">
										<div class="row">
											<div class="col-sm-2 no-padding">
												<select class="form-control" ng-model='cmp.camp_brand' ng-change='load_product()'>
													<option value="ALL">ALL</option>
													<option ng-repeat="x in brand_list" value='{{x.prod_brand}}'>{{x.prod_brand}}</option>
												</select>
											</div>
											<div class="col-sm-2 no-padding">
												<select class="form-control" ng-model='cmp.fc_code' ng-change='load_product()'>
													<option value="ALL">ALL</option>
													<option value='FBA'>FBA</option>
													<option value='FBM'>FBM</option>
												</select>
											</div>
											<div class="col-lg-6 no-padding">
												<div class="input-group">
													<div class="input-group-btn">
													</div><!-- /btn-group -->
													<input type="text" ng-model='cmp.prod_search' class="form-control" aria-label="...">
													<span class="input-group-btn">
													<button style="margin-left:5px;"class="btn btn-info" ng-click='load_product()' type="button">Filter</button>
													</span>
												</div><!-- /input-group -->
											</div><!-- /.col-lg-6 -->
										</div><!-- /.row -->
									</div>
								<div class="form-group" >
									<div class="col-sm-12" id='product_list' style=" margin-top:20px;height: 350px;overflow-y:scroll">
										<div class="table-responsive">
											<table style="border: 1px solid #DEE2E6; text-align: center;" class="table table-hover table-centered mb-0">
											<tr>
												<th style="width: 20px;">
												<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="customCheck1" ng-model="checkStatus" ng-change="statusCheck()" ng-true-value="'Y'" ng-false-value="'N'"/>
												<label class="custom-control-label" for="customCheck1">&nbsp;</label>
												</div>
												</th>
												<th>Image</th><th>ASIN</th><th>SKU</th><th>Fullfillment</th><th>Brand</th><th>Title</th>
											</tr>
											<tr ng-repeat='prd in product_list'>
												<td>
												<div class="custom-control custom-checkbox">
												<input type="checkbox"  checklist-value="prd" checklist-model="selectedProduct" class="custom-control-input" id="customCheck2-{{$index+1}}">
												<label class="custom-control-label" for="customCheck2-{{$index+1}}">&nbsp;</label>
												</div>
												</td>
												<td><img src='{{prd.prod_image}}' width='50' height='50'></td><td>{{prd.prod_asin}}</td><td>{{prd.prod_sku}}</td><td>{{prd.fc_code}}</td><td>{{prd.prod_brand}}</td><td>{{prd.prod_title | limitTo:100}}<span ng-if='prd.prod_title.length>100'>...</span></td>
											</tr>

											</table>


										</div>
									</div>
								</div>

								<br>

								</div>



</div>    </div>   </div>    </div>   <br>


<div class="col-12">
<div class="card">

<div class="card-body">
<br>
<div class="tab-pane" id="basictab4" ng-class="tb.currentTab=='tab4'?'tab-pane fade active in':'tab-pane'">
<div class="row">



                        <div class="col-sm-3 no-padding" >
            <b>Trigger On:</b>
                       <select ng-model='cmp.camp_trigger' class="form-control">
                        <option value='1'>After Order Shipped</option><option value='2'>After Order Delivered - FBA </option>
						<!--<option value='3'>After Returned</option>--->
						<option value='4'>Repeated Buyers</option></select>
                        </div>
					<!--	<div class="col-sm-2 no-padding" >
            <b>Day</b>
            <select ng-model='cmp.camp_trigger_day' class="form-control">
			             <option value='ALL'>ALL</option>
                        <option value='monday'>Monday</option>
						<option value='tuesday'>Tuesday</option>
						<option value='wednesday'>Wednesday</option>
						<option value='thursday'>Thursday</option>
						<option value='friday'>Friday</option>
						<option value='saturday'>Saturday</option>
						<option value='sunday'>Sunday</option>
						</select>
                        </div>  -->
                        <div class="col-sm-2">
            <b>Days:</b>
            <input ng-model='cmp.camp_days' placeholder ='Days' class="form-control" type="number"></div>
                        <div class="col-sm-2">
            <b>Hours:</b>
            <input ng-model='cmp.camp_hour' type='number' placeholder="Hour" class="form-control"></div>
                        <div class="col-sm-2">
            <b>Minutes:</b>
            <input ng-model='cmp.camp_min' type='number' placeholder="Minutes" class="form-control"></div>

                        <div class="col-sm-1" style="padding: 0px 5px">
            <b>&nbsp;</b>
            <select ng-model='cmp.camp_am_pm' class="form-control">
                        <option value="1">AM</option><option value='2'>PM</option></select>
                        </div>
                        <div class="col-sm-2"><div  style="margin-top: 10px;"><span ng-model='cmp.camp_review'></span>
                     </div>





</div>
</div>

</div>

</div>


<div class="col-12">
<div class="card">

<div class="card-body">
<br>

<div class="tab-pane" id="basictab5" ng-class="tb.currentTab=='tab5'?'tab-pane fade active in':'tab-pane'">  <br>

<div class="col-sm-12">
                          <div class="form-group">
                          <p class="label_new" for="pwd">Picking a Template</p>
                          <select class="form-control" ng-model='tmp' ng-change="load_template(tmp)">
                            <option value='0' >Select a Template</option>
                            <option ng-repeat="x in template_list" value='{{x.template_id}}'>{{x.template_name}}</option>
                        </select>
                       </div>
                    <br>
                    <div class="form-group">
                    <div class="col-sm-12" style=" margin-top:20px;height: 350px;overflow-y:scroll">
                    <div ng-bind-html="template_content"></div>
                    </div>
                       </div>


					   </div>

					    <a class="btn btn-info" style="margin-top:20px;margin-left:35px;color:#fff" ng-click='get_template_data()'> Preview &amp; Test </a>
					    <a class="btn btn-success pull-right" style="margin-top:20px;color:#fff" ng-if='cmp.cpgn_id == 0' ng-click='create_campaign()' > Make it Live</a>
						 <a class="btn btn-success pull-right" style="margin-top:20px;color:#fff" ng-if='cmp.cpgn_id > "0"' ng-click='create_campaign()' > Update Camapign</a>
</div> </div> </div> </div>




						  <?php
					}
                   ?>

						</div>
					</div>
                 </div>
                 </div>
                 </div>
                 </div>

<script type="text/javascript">

crawlApp.factory("campaignFactory", function($http,$q,Upload) {
     var get_data = function () {
        var dataset_path="<?php echo $baseurl.'manage_campaign/get_pre_data'?>";
        var deferred = $q.defer();
        var path =dataset_path;

        $http.get(path)
        .success(function(data,status,headers,config){deferred.resolve(data);})
        .error(function(data, status, headers, config) { deferred.reject(status);});

        return deferred.promise;
    };

    var get_customer_status=function(campaign_id)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/get_campaign_users/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        campaign_id:campaign_id

                      }
                     });

    };
     var get_products=function(country,brand,key_word,fc_code)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/get_products/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        country:country,
                        brand:brand,
                        key_word:key_word,
						fc_code:fc_code
                      }
                     });

    };

	var get_brands=function(country_code)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/get_brands_for_country/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        country_code:country_code
                      }
                     });

    };

    var delete_campaign=function(campaign_id)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/delete_campaign/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        campaign_id:campaign_id
                      }
                     });

    };
    var edit_campaign=function(campaign_id)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/edit_campaign/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        campaign_id:campaign_id
                      }
                     });

    };

	var preview_email=function(template_id,order_id)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/preview_email/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        template_id:template_id,
                        order_id:order_id
                      }
                     });

    };

	var change_status=function(active,campaign_id)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/change_status/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        w_status:active,
						campaign_id:campaign_id,
                      }
                     });

    };

    var test_email=function(template_id,order_id,email)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/test_email/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        template_id:template_id,
                        order_id:order_id,
                        email:email
                      }
                     });

    };





  return {
    get_customer_status:get_customer_status,
    get_data:get_data,
    get_products:get_products,
    delete_campaign:delete_campaign,
	edit_campaign:edit_campaign,
    preview_email:preview_email,
    test_email:test_email,
    change_status:change_status,
    get_brands:get_brands
  };
});
  crawlApp.controller("campaignCtrl",function campaignCtrl($window,$scope,campaignFactory,$sce,$q,$timeout,Upload)
  {
       $scope.cmp={};
       $scope.tmp={};
       $scope.tst={};
	   $scope.tb={};
	   $scope.tst2={};
       $scope.tb.currentTab='tab1';
	   $scope.store_country=<?php echo  '"'.$store_country.'"' ?>;
	   console.log($scope.store_country);
	   $scope.tst.order_id='ALL';
	   $scope.cpn={};
       $scope.cpn.frm_date='';
       $scope.cpn.to_date='';
	   $scope.cpn.cmp_status='ALL';
	   $scope.adh_cpn={};
       $scope.adh_cpn.frm_date='';
       $scope.adh_cpn.to_date='';
	   $scope.adh_cpn.cmp_status='ALL';
       $scope.cmp.camp_name='';
       $scope.cmp.camp_desc='';
       $scope.cmp.camp_brand='ALL';
	   $scope.cmp.fc_code='ALL';
       $scope.cmp.prod_search='';
       $scope.cmp.camp_country='<?php echo $store_country ?>';

       $scope.cmp.camp_sku='';
       $scope.cmp.camp_fulfill='ALL';
       $scope.cmp.camp_type='1';
       $scope.cmp.camp_template='';
       $scope.cmp.camp_trigger='1';
	   $scope.cmp.camp_trigger_day='ALL';
       $scope.cmp.camp_day='1';
        $scope.cmp.camp_days='';
       $scope.cmp.camp_hour='';
	    $scope.cmp.camp_min='';
       $scope.cmp.camp_am_pm='1';
       $scope.cmp.camp_coupon='';
       $scope.cmp.camp_review='';
       $scope.cmp.feedback_status='1';
       $scope.cmp.selected_star=[];
       $scope.cmp.selected_star.push({star:''});
       $scope.cmp.selected_star.push({star:''});
       $scope.cmp.selected_star.push({star:''});
       $scope.cmp.selected_star.push({star:''});
       $scope.cmp.selected_star.push({star:''});
       $scope.cmp.selected_star.push({star:''});
       $scope.tmp='0';
       $scope.show_dash=1;
	   $scope.sortorder='cpgn_id';
       $scope.direction='ASC';
       $scope.selectedProduct=[];
       $scope.product_list=[];
       $scope.checkStatus='N';

        $scope.togggle_view=function()
        {
          if($scope.show_dash==0)
          {
            $scope.show_dash=1;

		}
          else
          {
            $scope.show_dash=0;
          }
          // console.log($scope.show_dash);
        }



        $scope.clear_campaign_data=function()
        {

		  $scope.cmp.cpgn_id='0';
          $scope.cmp.camp_name='';
          $scope.cmp.camp_desc='';
          $scope.cmp.camp_brand='ALL';
		  $scope.cmp.fc_code='ALL';
          $scope.cmp.prod_search='';
          $scope.cmp.camp_country='<?php echo $store_country ?>';
          $scope.clear_all();
          $scope.selectedProduct=[];
		  $scope.product_list=[];
          $scope.tmp='0';
          $scope.template_content='';
          $scope.cmp.camp_sku='';
          $scope.cmp.camp_fulfill='1';
          $scope.cmp.camp_type='1';
          $scope.cmp.camp_template='';
          $scope.cmp.camp_trigger='1';
		  $scope.cmp.camp_trigger_day='ALL';
          $scope.cmp.camp_days='0';
		  $scope.cmp.camp_hour='0';
		  $scope.cmp.camp_min='0';
          $scope.cmp.camp_am_pm='1';
          $scope.cmp.feedback_status='1';
		  $scope.tst.order_id='ALL';

        }


        $scope.open_campaign_ui=function()
        {
          $('#menuToggle').addClass('active');
                          $('body').addClass(' body-push-toleft');
                          $('#theMenu').addClass('menu-open');
        }

        $scope.load_template=function(template_id)
        {
          if(template_id != '0')
          {
            $scope.cmp.template_id=template_id;
            for(i=0;i<$scope.template_list.length;i++)
            {
              if($scope.template_list[i].template_id==template_id)
              {
                $scope.template_content=$sce.trustAsHtml($scope.template_list[i].template_content);
              }
            }
          }
          //CKEDITOR.instances.editor.setData($scope.tmp);
        }
        $scope.get_template_data=function()
        {
          if(angular.isDefined($scope.tmp) && $scope.tmp.length > 0 && parseInt($scope.tmp) != 0)
          {
            for(i=0;i<$scope.template_list.length;i++)
            {
              if($scope.template_list[i].template_id==$scope.tmp)
              {
                $scope.tst.email_content=$sce.trustAsHtml($scope.template_list[i].template_content);
                $scope.tst.template_id=$scope.tmp;
                $scope.tst.subject=$scope.template_list[i].subject;
			    $("#Preview_email_box").modal('show');
              }
            }
          }
          else
          {
            swal('Error!','Please select any template','error');
          }
        }
        $scope.create_campaign=function()
        {
           if($scope.selectedProduct.length > 0)
          {
               $scope.block_site();

               file=$scope.cmp.camp_attachment;
                  var upload = Upload.upload({
                  url: '<?php echo $baseurl.'manage_campaign/create_campaign/';?>',
                  data: {
                          attached_file: file,
                          camp_data:angular.toJson($scope.cmp),
                          asin:angular.toJson($scope.selectedProduct)
                        },
                });

                upload.then(function (response) {
                  $.unblockUI();
                  if(angular.isDefined(file))
                  {
                    $timeout(function () {
                    file.result = response.data;

                    });

                  }
                  if(response.data.status_code == '1')
                   {
                     swal('Success!',response.data.status_text,'success');
                     $scope.campList=response.data.campaign_list;
                   }
                   else
                   {
                     swal("Error!",response.data.status_text,'error');
                   }
                }, function (response) {
                  $.unblockUI();
                  if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
                }, function (evt) {
                  if(angular.isDefined(file))
                  file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
                });
           }
           else
           {
              swal("Error!","No product has been selected ",'error');
           }

        }


        $scope.load_product=function()
        {
            var blk='#product_list';
            $(blk).block({message:'Loading Product'  });
            // $scope.clear_all();
            // $scope.selectedProduct=[];
            $scope.cmp.camp_country='<?php echo $store_country ?>';

            campaignFactory.get_products($scope.cmp.camp_country,$scope.cmp.camp_brand,$scope.cmp.prod_search,$scope.cmp.fc_code)
              .success(
                      function( html )
                      {
                           $(blk).unblock();
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');
                           }
                           if(html.status_code == '1')
                           {
                             console.log("LOAD PRODUCT");
                             console.log($scope.selectedProduct);
                             $scope.product_list=html.payload;
                             console.log($scope.selectedProduct);
                             console.log("LOAD PRODUCT ENDs");
                           }
                      }
                )

        }
        $scope.load_country_wise_brand=function()
        {
          $scope.cmp.camp_country='<?php echo $store_country ?>';
            var blk='#product_list';
            $(blk).block({message:'Loading Product'});
            campaignFactory.get_brands($scope.cmp.camp_country)
              .success(
                      function( html )
                      {
                           $(blk).unblock();
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');
                           }
                           if(html.status_code == '1')
                           {
                             $scope.brand_list=html.brand_list;
                             $scope.product_list=html.product_list;
                           }
                      }
                )

        }

        $scope.preview_email=function()
        {
            $scope.block_site();
            campaignFactory.preview_email($scope.tst.template_id,$scope.tst.order_id)
              .success(
                      function( html )
                      {
                        $.unblockUI();
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');
                           }
                           if(html.status_code == '1')
                           {
                             $scope.tst.email_content=$sce.trustAsHtml(html.email_content);
                           }
                      }
                )

        }


      $scope.test_email=function()
        {

            $scope.block_site();
            campaignFactory.test_email($scope.tst.template_id,$scope.tst.order_id,$scope.tst.email)
              .success(
                      function( html )
                      {
                        $.unblockUI();

                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');
                           }
                           if(html.status_code == '1')
                           {
                            swal('Success!',html.status_text,'success');
                           }
                      }
                )

        }
       $scope.edit_campaign=function(campaign_id)
        {
           $scope.block_site();
		   $scope.tst.order_id='ALL';
           campaignFactory.edit_campaign(campaign_id)
              .success(
                      function( html )
                      {
                        $.unblockUI();
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');
                           }
                           if(html.status_code == '1')
                           {
                             $scope.cmp=html.campaign_detail[0];
                             $scope.cmp.camp_hour=parseInt($scope.cmp.camp_hour);
                             $scope.cmp.camp_days=parseInt($scope.cmp.camp_days);
                             $scope.cmp.camp_min=parseInt($scope.cmp.camp_min);
                             $scope.product_list=html.other_product;
                             $scope.brand_list=html.brand_list;
                             $scope.clear_all();
                             $scope.selectedProduct=[];

                             $scope.tmp=$scope.cmp.template_id;
                             $scope.load_template($scope.tmp);
                             if(html.selected_product.length > 0)
                             {
                               for(i=0;i< html.selected_product.length;i++)
                                {
                                  $scope.addToArray($scope.selectedProduct,html.selected_product[i]);
                                }
                             }

                             // console.log(html.selected_product);
                             $scope.show_dash=0;
                           }
                      }
                )

        }
 $scope.delete_campaign=function(campaign_id)
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
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');
                             $scope.campList=html.campaign_list;
                           }
                           if(html.status_code == '1')
                           {
                            swal('Success!',html.status_text,'success');
                             $scope.campList=html.campaign_list;
                           }
                      }
                );

                } else {
                    swal("Cancelled", "Delete cancelled:)", "error");
                }
            });


        }


		$scope.change_status=function(is_active,campaign_id)
        {
			if(is_active==1)
			{
		    var sts='Activate';
			}else
			{
				 var sts='Deactivate';
			}
			  var msg= "Are you sure to "+sts+" campaign?";
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
                      campaignFactory.change_status(is_active,campaign_id)
                      .success(
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');

                           }
                           if(html.status_code == '1')
                           {
                            swal('Success!',html.status_text,'success');
                            $scope.campList=html.campaign_list;
                           }
                      }
                );

                } else {
                    swal("Cancelled", "cancelled:)", "error");
					$scope.campList=html.campaign_list;
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
       $scope.get_predata = function()
         {
			  $scope.block_site();
               var promise=campaignFactory.get_data();
              promise.then(
                             function(response)
                             {
                                if(response.status_code == '1')
                                {
									$.unblockUI();
                                    $scope.campList=response.campaign_list;
                                    $scope.brand_list=response.brand_list;
									$scope.recent_orders=response.recent_orders;
                                    $scope.country_list=response.country_list;
                                    $scope.template_list=response.template_list;
                                    $scope.metrics=response.metrics;
                                    $scope.product_list=response.product_list;
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

  $scope.select_all=function()
   {


      for(i=0;i< $scope.product_list.length;i++)
      {
        $scope.addToArray($scope.selectedProduct,$scope.product_list[i]);
      }
      $scope.selectcount=$scope.selectedProduct.length;
      $scope.totalcount=$scope.total;

   }

   $scope.clear_all=function()
   {
      $scope.clearArray($scope.selectedProduct);
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
             if(newValue < $scope.product_list.length)
             {
              $scope.checkStatus='N';
             }
            });

    $scope.statusCheck=function()
      {

       if($scope.checkStatus=='Y')
           {
            $scope.select_all();
           }
           else if($scope.checkStatus=='N')
           {
            $scope.clear_all();
           }
      }




		$( document ).ready(function() {
CKEDITOR.instances.editor.on('change', function() {
 $scope.tmplt.template_content_html=$sce.trustAsHtml(CKEDITOR.instances.editor.getData());
    //alert("TEST");
   });
});

});

</script>

<script src="<?php echo $baseurl.'asset/ckeditor/ckeditor.js' ;?>"></script>
<script src="<?php echo $baseurl.'asset/ckeditor/config.js' ;?>"></script>
<script>
CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'image', groups: [ 'image' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];

	config.removeButtons = 'Preview,Print,Templates,Form,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Anchor,Flash,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Font,Checkbox,Undo,Redo,Find,Replace,Subscript,Strike,Superscript,CopyFormatting,RemoveFormat,Maximize,ShowBlocks,About,Table,Paste,PasteText,PasteFromWord,CreateDiv,Save,Language,Image,JustifyLeft,JustifyRight,Link,Unlink,Cut,Copy';
};
</script>
<script>
   CKEDITOR.replace( 'editor', {
	   height: 350,
    on: {
        pluginsLoaded: function() {
            var editor = this,
                config = editor.config;

            editor.ui.addRichCombo( 'my-combo', {
                label: 'Placeholders',
                title: 'Placeholder text will be replaced by actual text',
                toolbar: 'others,0',

                panel: {
                    css: [ CKEDITOR.skin.getPath( 'editor' ) ].concat( config.contentsCss ),
                    multiSelect: false,
                    attributes: { 'aria-label': 'Placeholders Tag' }
                },

                init: function() {
                    this.startGroup( 'Order Info' );
					this.add( '{{customer_fullname}}', 'Customer Name' );
                    this.add( '{{customer_firstname}}', 'Customer First Name' );
                    this.add( '{{customer_lastname}}', 'Customer Last Name' );
                    this.add( '{{order_number}}', 'Order Number' );
                    this.add( '{{order_date}}', 'Order Date' );
                    this.add( '{{product_name}}', 'Product Name' );
                    this.add( '{{feedback_url}}', 'Feedback URL' );
                    this.add( '{{review_url}}', 'Review URL' );
                    this.add( '{{review_url_with_product_img}}', 'Review URL with Product Image' );
                    this.startGroup( 'Company Info' );
                    this.add( '{{company_name}}', 'Company Name' );
                    this.add( '{{store_url}}', 'Storefront URL' );
                   },
                    onClick: function( value ) {
                    editor.focus();
                    editor.fire( 'saveSnapshot' );

                    editor.insertHtml( value );

                    editor.fire( 'saveSnapshot' );
                }
            } );
        }
    }
} );
</script>
