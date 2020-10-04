<?php
 $baseurl=base_url();
 // echo ($date_diff['date_diff']);
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

 <div class="wrapper" ng-controller='campaignCtrl'>
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="#">Camapign</a></li>

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
				<div class="col-sm-12">
		    	<a href='#' class="btn btn-info pull-right" ng-click='clear_campaign_data();togggle_view()' >Create Campaign</a><br>	<br>
				</div>

<div class="col-sm-12">
		     <div class="table-responsive">
                                            <table class="table table-centered mb-0">
                                                <thead class="thead-light">
                                                    <tr>
														<th>Active</th>
			  <th ng-click="filter_data('sent_count')">Email Sent <i class="fa fa-sort" ng-class="sortorder=='sent_count' && direction=='ASC'?'fa-sort':'fa-sort'"></i></th>
			  <th ng-click="filter_data('total_mail')">Email Scheduled <i class="fa fa-sort" ng-class="sortorder=='total_mail' && direction=='ASC'?'fa-sort':'fa-sort'"></i></th>
			  <th ng-click="filter_data('is_active')">Status <i class="fa fa-sort" ng-class="sortorder=='is_active' && direction=='ASC'?'fa-sort':'fa-sort'"></i></th>
			   <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody  ng-repeat="idx in campList track by $index">
												<tr>
										 <td><h3 style="margin-top: 2px;margin-bottom: 2px">{{idx.campaign_name}}</h3>
                <p class="text-muted">{{idx.campaign_desc}}</p></td>
				<td>{{idx.sent_count}}</td>
				<td>{{idx.total_mail}}</td>
				<td><span ng-if='idx.is_active==1'>Active</span><span ng-if='idx.is_active==0'>InActive</span></td>
				<td>


				   <div class="col-sm-12 " >
			<i ng-click='edit_campaign(idx.campaign_id)'class="fa fa-edit " ></i>
             <i  ng-click='delete_campaign(idx.campaign_id)'class="fa fa-trash " style="margin-top:-5px;"></i>

				  <label class="switch" style="margin-left:10px;margin-bottom:-5px">
 <input type="checkbox" name='enable_addon'  ng-model="idx.is_active" ng-true-value="'1'" ng-false-value="'0'" ng-change='change_status(idx.is_active,idx.campaign_id)'>
 <span class="slider round"></span>
 </label>
				  <!---<span ng-if='idx.is_active==1' style="width:110%" class="btn btn-xs btn-warning" ng-click="change_campaign_status(idx.campaign_id,1,'Deactivate')">Deactivate</span>
                  <span ng-if='idx.is_active==0' class="btn btn-xs btn-success" style="width:100%" ng-click="change_campaign_status(idx.campaign_id,0,'Activate')">Activate</span>---></div></td>
												    </tr>
													 </tbody>

                                            </table>
                                        </div>

				</div>




 </div> </div> </div>	</div>

<div class="row"  ng-show='show_dash==0'>
<div class="col-12">
<div class="card">
<div class="card-body">
<a href=""  id="menuToggle" class="pull-right  dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true" ng-click='togggle_view()'>Close</a>
<br>
<div id="basicwizard">

<ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-4">
<li  id="l1"   class="nav-item"  ng-click="tb.currentTab='tab1'"  ng-class="tb.currentTab=='tab1'?'active':''">
<a  href="#basictab1" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
<i class="mdi mdi-account-circle mr-1"></i>
<span class="d-none d-sm-inline">Campaign Details</span>
</a>
</li>
<li class="nav-item"  id="l2"  ng-click="tb.currentTab='tab2'"  ng-class="tb.currentTab=='tab2'?'active':''">
<a href="#basictab2" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2" >
<i class="mdi mdi-face-profile mr-1"></i>
<span class="d-none d-sm-inline">Campaign Type</span>
</a>
</li>
<li class="nav-item" id="l3"  ng-click="tb.currentTab='tab3'"  ng-class="tb.currentTab=='tab3'?'active':''">
<a href="#basictab3" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
<i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
<span class="d-none d-sm-inline">Pick Product</span>
</a>
</li>
<li class="nav-item" id="l4"  ng-click="tb.currentTab='tab4'"  ng-class="tb.currentTab=='tab4'?'active':''">
<a href="#basictab4" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
<i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
<span class="d-none d-sm-inline">Scheduler</span>
</a>
</li>
<li class="nav-item" id="l5"  ng-click="tb.currentTab='tab5'"  ng-class="tb.currentTab=='tab5'?'active':''">
<a href="#basictab5" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
<i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
<span class="d-none d-sm-inline">Email Content</span>
</a>
</li>
<li class="nav-item" id="l6"  ng-click="tb.currentTab='tab6'"  ng-class="tb.currentTab=='tab6'?'active':''">
<a href="#basictab6" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
<i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
<span class="d-none d-sm-inline">Finalize Camapign</span>
</a>
</li>
</ul>
<div class="tab-content b-0 mb-0">
<div class="tab-pane"  ng-class="tb.currentTab=='tab1'?'tab-pane fade active in':'tab-pane'"  id="basictab1">
<div class="col-sm-12">


                      <p class="control-label col-sm-3" style="margin-top:5px;margin-right:-30px;font-weight:700;" for="pwd">Campaign Name</p>
                     <div class="col-sm-12">
			         <input type="text" id="camp_name" name="" class="form-control" ng-model='cmp.camp_name' placeholder="Enter Campaign name">
					 </div>	 <br>
                       <p class="control-label col-sm-3" style="margin-top:5px;margin-right:-30px;font-weight:700;" for="pwd">Campaign Description</p>
                     <div class="col-sm-12">
                     <textarea rows="5" cols='12'  id="camp_desc" placeholder='Campaign description' ng-model='cmp.camp_desc' class='form-control'></textarea>
					 </div>
                       <br>

					    <ul class="list-inline wizard mb-0">
<li class="previous list-inline-item">
<a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
</li>
<li class="previous list-inline-item " style="text-align:center">
<a class="btn btn-info"  ng-if='cmp.cpgn_id.length > 0' ng-click='create_campaign()' > Update</a>
</li>
<li class="next list-inline-item float-right">
<a href="javascript: void(0);" class="btn btn-secondary">Next</a>
</li>
</ul>

<!--<a class="btn btn-info" style="margin-bottom:40px;margin-left:300px;margin-top:20px;float:right" ng-if='cmp.cpgn_id.length > 0' ng-click='create_campaign()' > Update</a>	 -->
					 </div>

</div>
<div class="tab-pane" id="basictab2" ng-class="tb.currentTab=='tab2'?'tab-pane fade active in':'tab-pane'">

<div class="col-sm-12" style="margin:0px auto">
                     <p class="control-label col-sm-3" style="margin-top:5px;margin-right:-30px;font-weight:700;" for="pwd">Customer Type</p>
                     <div class="col-sm-12">
                        <select class="form-control" ng-model='cmp.camp_type'>
                        <option value="1">ALL</option>
                        <option value="2">New Customer</option>
                        <option value="3">Returning Customer</option>
                      </select>					 </div> <br>
					   <p class="control-label col-sm-3" style="margin-top:5px;margin-right:-30px;font-weight:700;" for="pwd">Fulfillment Fulfillment</p>
                     <div class="col-sm-12">
                        <select class="form-control" ng-model='cmp.camp_fulfill'>
                        <option value='1'>ALL</option>
                        <option value='2' >Match order fulfilled by Amazon</option>
                        <option value='3'>Match order fulfilled by Merchant</option>
                      </select>				 </div>

					   <br>
					   	 <ul class="list-inline wizard mb-0">
<li class="previous list-inline-item">
<a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
</li>
<li class="previous list-inline-item float-center">
<a class="btn btn-info"  ng-if='cmp.cpgn_id.length > 0' ng-click='create_campaign()' > Update</a>
</li>
<li class="next list-inline-item float-right">
<a href="javascript: void(0);" class="btn btn-secondary">Next</a>
</li>
</ul>
					 </div>



</div>

<div class="tab-pane" id="basictab3" ng-class="tb.currentTab=='tab3'?'tab-pane fade active in':'tab-pane'">

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
                                            <table class="table table-centered mb-0">
                           <tr>
						   <th style="width: 20px;">
                                             <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck1" ng-model="checkStatus" ng-change="statusCheck()" ng-true-value="'Y'" ng-false-value="'N'"/>
                                                  <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                                </div>
                                                </th>

						<th>Image</th><th>ASIN</th><th>SKU</th><th>Fullfillment</th><th>Brand</th><th>Title</th></tr>
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


                      </div>   </div>    </div>

					     <br>
						   	 <ul class="list-inline wizard mb-0">
<li class="previous list-inline-item">
<a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
</li>
<li class="previous list-inline-item float-center">
<a class="btn btn-info" ng-if='cmp.cpgn_id.length > 0' ng-click='create_campaign()' > Update</a>
</li>
<li class="next list-inline-item float-right">
<a href="javascript: void(0);" class="btn btn-secondary">Next</a>
</li>
</ul>
					   </div>



</div>

<div class="tab-pane" id="basictab4" ng-class="tb.currentTab=='tab4'?'tab-pane fade active in':'tab-pane'">
<div class="row">



                        <div class="col-sm-3 no-padding" >
            <b>Trigger On:</b>
            <select ng-model='cmp.camp_trigger' class="form-control">
                        <option value='1'>After Order Shipped</option><option value='2'>After Order Delivered</option><option value='3'>After Returned</option></select>
                        </div>
						<div class="col-sm-2 no-padding" >
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
                        </div>
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
                        <!--<input ng-model='cmp.camp_review' type='checkbox' >Only If No Review--></div></div>
                     </div>
					 <div class="col-sm-12"><p style="margin-top: 5px;margin-left:5px;">*For FBM Orders <b>5 Days</b> Additionally Added To Ship Date </div>
                   <div class="col-sm-4">
                   <br>
                   <b>Include Feedback received order ?</b>
            <select ng-model='cmp.feedback_status' class="form-control" ng-disabled="cmp.camp_trigger=='1'">
      <option value='1'>All</option>
      <option value='2'>Send only Feedback received order</option>
      <option value='0'>Don't Send feedback received order</option>
    </select>

                   </div>
  	 <ul class="list-inline wizard mb-0">
<li class="previous list-inline-item">
<a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
</li>
<li class="previous list-inline-item float-center">
<a class="btn btn-info" ng-if='cmp.cpgn_id.length > 0' ng-click='create_campaign()' > Update</a>
</li>
<li class="next list-inline-item float-right">
<a href="javascript: void(0);" class="btn btn-secondary">Next</a>
</li>
</ul>





</div>

<div class="tab-pane" id="basictab5" ng-class="tb.currentTab=='tab5'?'tab-pane fade active in':'tab-pane'">

<div class="col-sm-12">
                          <div class="form-group">
                          <p class="label_new" for="pwd">Picking a Template</p>
                          <!-- <input type="text" class="form-control" ng-model='cmp.camp_sku' id="pwd"> -->
                          <!-- <select  class='form-control' ng-model="tmp" ng-change="load_template(tmp)" ng-options="x.template_name for x in template_list"></select> -->
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

						   	 <ul class="list-inline wizard mb-0">
<li class="previous list-inline-item">
<a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
</li>
<li class="previous list-inline-item float-center">
<a class="btn btn-info"  ng-if='cmp.cpgn_id.length > 0' ng-click='create_campaign()' > Update</a>
</li>
<li class="next list-inline-item float-right">
<a href="javascript: void(0);" class="btn btn-secondary">Next</a>
</li>
</ul>
					   </div>
</div>

<div class="tab-pane" id="basictab6" ng-class="tb.currentTab=='tab6'?'tab-pane fade active in':'tab-pane'">
 <center>
                      <h1 class="glyphicon glyphicon-ok-sign" style="font-size:12em;color:#5646ff;"></h1>
                      <div class="col-sm-12">

                      </div>

                      <div class="col-sm-12" style="margin-top: 10px;margin-bottom:20px;">


<a href="javascript: void(0);" style="margin-top:20px;" class="btn btn-secondary float-left">Previous</a>

                      <a class="btn btn-info" style="margin-top:20px;margin-left:35px;" ng-click='get_template_data()'> Preview &amp; Test </a>

								<a class="btn btn-success pull-right" style="margin-top:20px;" ng-click='create_campaign()' > Make it Live</a>

                      </div>
                    </center>

</div>


</div>  </div>  </div>  </div>  </div>




						</div>
					</div>
                 </div>

<script type="text/javascript">

crawlApp.factory("campaignFactory", function($http,$q,Upload) {
//crawlApp.factory('campaignFactory', ['$http', '$q','limitToFilter', 'Upload',function($http,$q,limitToFilter,Upload) {


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

	var get_adhoc_products=function(country,brand,key_word,fc_code)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/get_adhoc_products/';?>";
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

	var delete_adhoc_campaign=function(campaign_id)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/delete_adhoc_campaign/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        campaign_id:campaign_id
                      }
                     });

    };
    var edit_adhoc_campaign=function(campaign_id)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/edit_adhoc_campaign/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        campaign_id:campaign_id
                      }
                     });

    };

	var change_adhoc_status=function(active,campaign_id)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/change_adhoc_status/';?>";
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
    var change_campaign_status=function(campaign_id,cur_sts)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/change_campaign_status/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        campaign_id:campaign_id,
                        current_status:cur_sts
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
	var preview_email_new=function(template_id,order_id)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/preview_email_new/';?>";
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
	 var filter_data=function(frm_date,to_date,cmp_status)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/filter_data/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        from_date:frm_date,
                        to_date:to_date,
						 cmp_status:cmp_status

                      }
                     });

    };

	var filter_adh_data=function(frm_date,to_date,cmp_status)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/filter_adh_data/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        from_date:frm_date,
                        to_date:to_date,
						 cmp_status:cmp_status

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

var edit_template=function(template_id)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/edit_template/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        template_id:template_id
                      }
                     });

    };
     var save_template=function(template_data)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/save_template/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {

                        template_data:angular.toJson(template_data)
                      }
                     });

    };
    var delete_template=function(template_id)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/delete_template/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        template_id:template_id
                      }
                     });

    };

     var import_data=function(file,width,height,file2,width2,height2,file3,width3,height3,file4,width4,height4,file5,width5,height5)
    {
	var p_path        =   "<?php echo $baseurl."manage_campaign/import_data/"?>";
       return Upload.upload({
          url: p_path,
          data: {
			  import_file: file,
			  width:width,
			  height:height,
			  import_file2: file2,
			  width2:width2,
			  height2:height2,
			  import_file3: file3,
			  width3:width3,
			  height3:height3,
			  import_file4: file4,
			  width4:width4,
			  height4:height4,
			  import_file5: file5,
			  width5:width5,
			  height5:height5

			  }
         });

    }

	var import_data2=function(template_id,file,file2,file3,file4,file5)
    {
	var p_path        =   "<?php echo $baseurl."manage_campaign/import_data2/"?>";
       return Upload.upload({
          url: p_path,
          data: {
			  template_id:template_id,
			  import_file: file,
			  import_file: file,
			  import_file2:file2,
			  import_file3:file3,
			  import_file4:file4,
			  import_file5:file5

			  }
         });

    }

	var import_data3=function(file,width,height)
    {
	var p_path        =   "<?php echo $baseurl."manage_campaign/import_data3/"?>";
       return Upload.upload({
          url: p_path,
          data: {
			  import_file: file,
			  width:width,
			  height:height

			  }
         });

    }
	var import_data4=function(file,width,height)
    {
	var p_path        =   "<?php echo $baseurl."manage_campaign/import_data4/"?>";
       return Upload.upload({
          url: p_path,
          data: {
			  import_file: file,
			  width:width,
			  height:height

			  }
         });

    }

	var import_data5=function(file,width,height)
    {
	var p_path        =   "<?php echo $baseurl."manage_campaign/import_data5/"?>";
       return Upload.upload({
          url: p_path,
          data: {
			  import_file: file,
			  width:width,
			  height:height

			  }
         });

    }

		 var delete_attach_1=function(template_id)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/delete_attach_1/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        template_id:template_id
                      }
                     });

    };
	var delete_attach_2=function(template_id)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/delete_attach_2/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        template_id:template_id
                      }
                     });

    };

	var delete_attach_3=function(template_id)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/delete_attach_3/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        template_id:template_id
                      }
                     });

    };

	var delete_attach_4=function(template_id)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/delete_attach_4/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        template_id:template_id
                      }
                     });

    };

	var delete_attach_5=function(template_id)
    {
       var search_path="<?php echo $baseurl.'manage_campaign/delete_attach_5/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        template_id:template_id
                      }
                     });

    };




  return {
    get_customer_status:get_customer_status,
    get_data:get_data,
    get_products:get_products,
	get_adhoc_products:get_adhoc_products,
    delete_campaign:delete_campaign,
	delete_adhoc_campaign:delete_adhoc_campaign,
	edit_adhoc_campaign:edit_adhoc_campaign,
    change_campaign_status:change_campaign_status,
	change_adhoc_status:change_adhoc_status,
    edit_campaign:edit_campaign,
    preview_email:preview_email,
    test_email:test_email,
	filter_data:filter_data,
	edit_template:edit_template,
	save_template:save_template,
	delete_template:delete_template,
	change_status:change_status,
    get_brands:get_brands,
	filter_adh_data:filter_adh_data,
	preview_email_new:preview_email_new,
	import_data:import_data,
	import_data2:import_data2,
	import_data3:import_data3,
	import_data4:import_data4,
	import_data5:import_data5,
	delete_attach_1 :delete_attach_1,
    delete_attach_2 :delete_attach_2,
	delete_attach_3 :delete_attach_3,
	delete_attach_4 :delete_attach_4,
	delete_attach_5 :delete_attach_5
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
	   //$scope.tmp.test_html=CKEDITOR.instances.editor.getData();

	   $scope.tst2.order_id='ALL';
	   $scope.tst.order_id='ALL';
	   $scope.img_width='200';
	   $scope.img_height='100';
	   $scope.img_width2='200';
	   $scope.img_height2='100';
	   $scope.img_width3='200';
	   $scope.img_height3='100';
	   $scope.img_width4='200';
	   $scope.img_height4='100';
	   $scope.img_width5='200';
	   $scope.img_height5='100';

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
       $scope.cmp.camp_country='IN';

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

       // $scope.cmp.selected_star[0].star='';
       // $scope.cmp.selected_star[1].star='';
       // $scope.cmp.selected_star[2].star='';
       // $scope.cmp.selected_star[3].star='';
       // $scope.cmp.selected_star[4].star='';
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


		$scope.togggle_tab2=function()
        {
          if($scope.cmp.camp_name == '' ){

              swal("Please update Campaign Details");
			   $scope.tb.currentTab='tab1';
			    $(l2).addClass('disabled');
			    $(l3).addClass('disabled');
                $(l4).addClass('disabled');
			    $(l5).addClass('disabled');
                $(l6).addClass('disabled');

            }
			 else if($scope.cmp.camp_desc == ''){

              swal("Please update Campaign Details");
			   $scope.tb.currentTab='tab1';
			    $(l2).addClass('disabled');
			    $(l3).addClass('disabled');
                $(l4).addClass('disabled');
			    $(l5).addClass('disabled');
                $(l6).addClass('disabled');

            }
          else
          {
          $scope.tb.currentTab='tab2';
           $(l2).removeClass('disabled');
           $(l3).removeClass('disabled');
          }

        }
		$scope.togggle_tab3=function()
        {
		if($scope.selectedProduct.length > 0)
		{
		$scope.tb.currentTab='tab4';
		   $(l3).removeClass('disabled');
           $(l4).removeClass('disabled');
		}
		else
		{
			 swal("Please select some products");
			   $scope.tb.currentTab='tab3';
			    $(l3).addClass('disabled');
			    $(l4).addClass('disabled');
			    $(l5).addClass('disabled');
				$(l6).addClass('disabled');
		}

		}

		$scope.togggle_tab4=function()
        {


			$scope.tb.currentTab='tab5';
			 $(l3).removeClass('disabled');
             $(l4).removeClass('disabled');
             $(l5).removeClass('disabled');

		}


		$scope.togggle_tab5=function()
        {
		if(parseInt($scope.tmp) == 0)
		{
	    swal("Please Select a template to proceed");
			   $scope.tb.currentTab='tab5';

			    $(l5).addClass('disabled');
                $(l6).addClass('disabled');
		}
		else
		{
		$scope.tb.currentTab='tab6';
           $(l5).removeClass('disabled');
           $(l6).removeClass('disabled');

		}
		}
        $scope.clear_campaign_data=function()
        {

		   $scope.tb.currentTab='tab1';

		        //$(l2).addClass('disabled');
			    //$(l3).addClass('disabled');
                //$(l4).addClass('disabled');
			    //$(l5).addClass('disabled');
                //$(l6).addClass('disabled');

		  $scope.cmp.cpgn_id='';
          $scope.cmp.camp_name='';
          $scope.cmp.camp_desc='';
          $scope.cmp.camp_brand='ALL';
		  $scope.cmp.fc_code='ALL';
          $scope.cmp.prod_search='';
          $scope.cmp.camp_country='IN';

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
          //$scope.cmp.camp_coupon='';
          //$scope.cmp.camp_review='';
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
			$scope.adhoc_cmp.template_id=template_id;
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
          //$scope.cmp.camp_template=CKEDITOR.instances.editor.getData();
          // console.log($scope.selectedProduct);
          // console.log($scope.cmp);

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

		//$scope.save_template=function()
        //{
        //  //$scope.cmp.camp_template=CKEDITOR.instances.editor.getData();
        //  // console.log($scope.selectedProduct);
        //  // console.log($scope.cmp);
		//  if($scope.tmplt.is_default=='1')
        //  {
        //    swal('Error!',"Default Template is not editable please recreate and edit ",'error');
        //  }
        //
        //  else
        //  {
        //       $scope.block_site();
        //
        //       file=$scope.tmplt.email_attachment;
		//	    $scope.tmplt.template_ui=CKEDITOR.instances.editor.getData();
        //          var upload = Upload.upload({
        //          url: '<?php echo $baseurl.'manage_campaign/save_template/';?>',
        //          data: {
        //                  attached_file: file,
        //                  template_data:angular.toJson($scope.tmplt)
        //
        //                },
        //        });
        //
        //        upload.then(function (response) {
        //          $.unblockUI();
        //          if(angular.isDefined(file))
        //          {
        //            $timeout(function () {
        //            file.result = response.data;
        //
        //            });
        //
        //          }
        //          if(response.data.status_code == '1')
        //           {
        //             swal('Success!',response.data.status_text,'success');
        //            $scope.get_predata();
        //           }
        //           else
        //           {
        //             swal("Error!",response.data.status_text,'error');
        //           }
        //        }, function (response) {
        //          $.unblockUI();
        //          if (response.status > 0)
        //            $scope.errorMsg = response.status + ': ' + response.data;
        //        }, function (evt) {
        //          if(angular.isDefined(file))
        //          file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        //        });
        //   }
        // }

        $scope.fetch_user_details=function(idx,inx)
        {
            $scope.history_index=inx;
            $scope.camp_cust_list=[];
            var blk='#collapse'+inx;
            $(blk).block({message:null  });
            campaignFactory.get_customer_status(idx.campaign_id)
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
                             $scope.camp_cust_list=html.payload;
                             // console.log($scope.camp_cust_list);
                             $scope.processed_count=html.processed_count;
                             $scope.total_count=html.total_count;
                           }
                      }
                )

        }
        $scope.load_product=function()
        {
            var blk='#product_list';
            $(blk).block({message:'Loading Product'  });
            // $scope.clear_all();
            // $scope.selectedProduct=[];
            $scope.cmp.camp_country='IN';

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
          $scope.cmp.camp_country='IN';
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

		 $scope.preview_email_new=function()
        {
            $scope.block_site();
			$scope.tmplt.template_ui=CKEDITOR.instances.editor.getData();
            campaignFactory.preview_email_new($scope.tmplt.template_ui,$scope.tst2.order_id)
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
                             $scope.tmplt.template_content_html=$sce.trustAsHtml(html.email_content);
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
              // console.log($scope.tst);
              // console.log(html);
                           if(html.status_code=='0')
                           {
                // console.log("TRUE - 0 ");
                             swal('Error!',html.status_text,'error');
                           }
                           if(html.status_code == '1')
                           {
             // console.log("TRUE - 1 ");
                            swal('Success!',html.status_text,'success');
                           }
                      }
                )

        }
       $scope.edit_campaign=function(campaign_id)
        {
           $scope.block_site();
		   $scope.tst.order_id='ALL';
                             //$(l2).removeClass('disabled');
	                         //$(l3).removeClass('disabled');
                             //$(l4).removeClass('disabled');
	                         //$(l5).removeClass('disabled');
                             //$(l6).removeClass('disabled');
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
                 //$scope.product_list=html.country_product;
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

     $scope.change_campaign_status=function(campaign_id,cur_sts,sts)
        {
          var msg= "Are you sure to "+sts+" campaign?";
           swal({
                title: msg,
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
                      campaignFactory.change_campaign_status(campaign_id,cur_sts)
              .success(
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');
                             // $scope.campList=html.campaign_list;
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
                                    $scope.adhoccampList=response.adhoc_campaign_list;
                                    $scope.brand_list=response.brand_list;
									 $scope.recent_orders=response.recent_orders;
                                    $scope.country_list=response.country_list;
                                    $scope.template_list=response.template_list;

								 //console.log($scope.tmp);
                                    $scope.metrics=response.metrics;
                                    //$scope.fbk_data=response.fbk_data[0];
                                    $scope.product_list=response.product_list;
									$scope.adhoc_product_list=response.adhoc_product_list;
                                    // console.log('Product LIST');
                                    // console.log($scope.product_list);
                                    // console.log(response.product_list);

                                    // if(response.product_list.length > 0)
                                    //  {
                                    //    for(i=0;i< response.product_list.length;i++)
                                    //     {
                                    //       $scope.addToArray($scope.product_list,response.product_list[i]);
                                    //     }
                                    //  }
                                    //  console.log('Product LIST');
                                    // console.log($scope.product_list);
                                    // console.log(response.product_list);




                                    // console.log($scope.fbk_data);
                                    //$scope.graph_data=response.graph_data;
                                    // $scope.draw_graph(response.graph_data);


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

       // $scope.changeSelectAllstatus=function()
       // {
       //  alert($scope.selectedProduct.length);
       // }
       $scope.statusCheck=function()
      {

           // console.log("checkStatus");
           // console.log($scope.checkStatus);

           if($scope.checkStatus=='Y')
           {
            $scope.select_all();
           }
           else if($scope.checkStatus=='N')
           {
            $scope.clear_all();
           }
      }



        $scope.filter_data=function(col)
        {
           console.log('roder');
      $scope.sortorder=col;
      if($scope.direction=='ASC')
        $scope.direction='DESC';
      else if($scope.direction=='DESC')
        $scope.direction='ASC';
             $scope.block_site();
                campaignFactory.filter_data($scope.cpn.frm_date,$scope.cpn.to_date,$scope.cpn.cmp_status,$scope.sortorder,$scope.direction)
                          .success(
                                    function( html )
                                    {
										$.unblockUI();
                                      console.log(html);
                                        if(html.status_code==0)
                                        {
                                           swal('Error!',html.status_text,'error');
                                        }
                                        else if(html.status_code==1)
                                        {
                                           $scope.campList=html.campaign_list;
                                    $scope.brand_list=html.brand_list;
                                    $scope.country_list=html.country_list;
                                    $scope.template_list=html.template_list;
                                    $scope.metrics=html.metrics;
                                    //$scope.fbk_data=response.fbk_data[0];
                                    $scope.product_list=html.product_list;
                                    // console.log('Product LIST');

                                        }

                                    }
                          )
                          .error(
                                 function(data, status, headers, config)
                                      {

                                       }

                          );

        }


		$scope.filter_adh_data=function(col)
        {
           console.log('roder');
      $scope.sortorder=col;
      if($scope.direction=='ASC')
        $scope.direction='DESC';
      else if($scope.direction=='DESC')
        $scope.direction='ASC';
             $scope.block_site();
                campaignFactory.filter_adh_data($scope.adh_cpn.frm_date,$scope.adh_cpn.to_date,$scope.adh_cpn.cmp_status,$scope.sortorder,$scope.direction)
                          .success(
                                    function( html )
                                    {
										$.unblockUI();
                                      console.log(html);
                                        if(html.status_code==0)
                                        {
                                           swal('Error!',html.status_text,'error');
                                        }
                                        else if(html.status_code==1)
                                        {
                                           $scope.adhoccampList=html.campaign_list;
                                    $scope.brand_list=html.brand_list;
                                    $scope.country_list=html.country_list;
                                    $scope.template_list=html.template_list;
                                    $scope.metrics=html.metrics;
                                    //$scope.fbk_data=response.fbk_data[0];
                                    $scope.product_list=html.product_list;
                                    // console.log('Product LIST');

                                        }

                                    }
                          )
                          .error(
                                 function(data, status, headers, config)
                                      {

                                       }

                          );

        }
$scope.draw_graph=function(graph_data)
       {
        //   $("#area-example").empty();
        //                  setTimeout(function(){
        //     Morris.Area({
        //       element: 'area-example',
        //       data: graph_data,
        //       xkey: 'sent_on_date',
        //       ykeys: ['sent_count'],
        //       labels: ['Mail Sent'],
        //     });


        // if($('#area-example').find('svg').length > 1){
        //     $('#area-example svg:first').remove();
        //         $(".morris-hover:last").remove();
        // }

      //       $('.js-loading').addClass('hidden');
      // },100);
       }



       $scope.cmp={};
       $scope.tmplt={};
       $scope.cmp.camp_template='';
	    $scope.show_dash_email=1;

		$scope.togggle_view_email=function()
        {
          if($scope.show_dash_email==0)
          {
            $scope.show_dash_email=1;
          }
          else
          {
            $scope.show_dash_email=0;
          }
          // console.log($scope.show_dash);
        }
$scope.clear_template=function()
{
  $scope.tmplt.tmp_id='';
  $scope.tmplt.is_default='0';
  $scope.tmplt.subject='';
  $scope.tmplt.template_name='';
  $scope.tmplt.template_content_html='';
  CKEDITOR.instances.editor.setData('');
}
        $scope.save_template=function()
        {
          if($scope.tmplt.is_default=='1')
          {
            swal('Error!',"Default Template is not editable please recreate and edit ",'error');
          }
          else
          {
            $scope.block_site();
            $scope.tmplt.template_ui=CKEDITOR.instances.editor.getData();
			//console.log($scope.tmplt.attachment);
			//die();
                campaignFactory.save_template($scope.tmplt)
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
                             // $scope.template_list=html.payload;
                             $scope.get_predata();
                           }
                      }
                )
           }

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
            }});

        }

		$scope.edit_template=function(template_id)
        {
           $scope.block_site();
            campaignFactory.edit_template(template_id)
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
                             $scope.tmplt=html.template_detail[0];
							 CKEDITOR.instances.editor.setData($scope.tmplt.template_content);
							 $scope.tmplt.template_content_html=$sce.trustAsHtml($scope.tmplt.template_content);
							 $scope.tmplt.tmp_id=$scope.tmplt.template_id;

                             // console.log(html.selected_product);
                             $scope.show_dash_email=0;
                           }
                      }
                )

        }
    $scope.delete_template=function(template_id,is_default)
    {
		//console.log(is_default);
    	if(is_default=='1')
        {
            swal('Error!',"Default Template is not deletable ",'error');
        }
        else
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
                  campaignFactory.delete_template(template_id)
                          .success(
                                    function( html )
                                    {
                                      console.log(html);
                                      $.unblockUI();
                                        if(html.status_code==0)
                                        {
                                           	swal('Error!',html.status_text,'error');
                                        }
                                        else if(html.status_code==1)
                                        {
                                        	$scope.get_predata();
                                          	swal('Success!',html.status_text,'success');
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








       $scope.adhoc_cmp={};
       $scope.tmp={};
       $scope.tst={};
	   $scope.adh_tb={};
       $scope.adh_tb.currentTab='tab1';

	   $scope.adh_cpn={};
       $scope.adh_cpn.frm_date='';
       $scope.adh_cpn.to_date='';
	   $scope.adh_cpn.cmp_status='ALL';
	   $scope.adhoc_cmp.camp_name='';
       $scope.adhoc_cmp.camp_desc='';
       $scope.adhoc_cmp.camp_brand='ALL';
	   $scope.adhoc_cmp.fc_code='ALL';
       $scope.adhoc_cmp.prod_search='';
       $scope.adhoc_cmp.camp_country='IN';

       $scope.adhoc_cmp.camp_sku='';
       $scope.adhoc_cmp.camp_fulfill='ALL';
       $scope.adhoc_cmp.camp_type='1';
       $scope.adhoc_cmp.camp_template='';
       $scope.adhoc_cmp.camp_trigger='1';
       $scope.adhoc_cmp.camp_trigger_day='ALL';
       $scope.adhoc_cmp.camp_days='';
       $scope.adhoc_cmp.camp_hour='';
	   $scope.adhoc_cmp.camp_min='';
       $scope.adhoc_cmp.camp_am_pm='1';
       $scope.adhoc_cmp.camp_coupon='';
       $scope.adhoc_cmp.camp_review='';
       $scope.adhoc_cmp.feedback_status='1';
       $scope.adhoc_cmp.selected_star=[];
       $scope.adhoc_cmp.selected_star.push({star:''});
       $scope.adhoc_cmp.selected_star.push({star:''});
       $scope.adhoc_cmp.selected_star.push({star:''});
       $scope.adhoc_cmp.selected_star.push({star:''});
       $scope.adhoc_cmp.selected_star.push({star:''});
       $scope.adhoc_cmp.selected_star.push({star:''});

       // $scope.adhoc_cmp.selected_star[0].star='';
       // $scope.adhoc_cmp.selected_star[1].star='';
       // $scope.adhoc_cmp.selected_star[2].star='';
       // $scope.adhoc_cmp.selected_star[3].star='';
       // $scope.adhoc_cmp.selected_star[4].star='';
       $scope.tmp='0';
	    $scope.adhoc_show_dash=1;
	   $scope.sortorder='cpgn_id';
       $scope.direction='ASC';
       $scope.selectedProductadh=[];
       $scope.adhoc_product_list=[];
       $scope.checkStatusadh='N';

        $scope.adhoc_togggle_view=function()
        {
          if($scope.adhoc_show_dash==0)
          {
            $scope.adhoc_show_dash=1;

		}
          else
          {
            $scope.adhoc_show_dash=0;
          }
          // console.log($scope.show_dash);
        }


		$scope.adhoc_togggle_tab2=function()
        {
          if($scope.adhoc_cmp.camp_name == '' ){

              swal("Please update Campaign Details");
			   $scope.adh_tb.currentTab='tab1';
			    $(l12).addClass('disabled');
			    $(l13).addClass('disabled');
                $(l14).addClass('disabled');
			    $(l15).addClass('disabled');
                $(l16).addClass('disabled');

            }
			 else if($scope.adhoc_cmp.camp_desc == ''){

              swal("Please update Campaign Details");
			   $scope.adh_tb.currentTab='tab1';
			    $(l12).addClass('disabled');
			    $(l13).addClass('disabled');
                $(l14).addClass('disabled');
			    $(l15).addClass('disabled');
                $(l16).addClass('disabled');

            }
          else
          {
          $scope.adh_tb.currentTab='tab2';
           $(l12).removeClass('disabled');
           $(l13).removeClass('disabled');
          }

        }
		$scope.adhoc_togggle_tab3=function()
        {
		if($scope.selectedProductadh.length > 0)
		{
		$scope.adh_tb.currentTab='tab4';
		   $(l13).removeClass('disabled');
           $(l14).removeClass('disabled');
		}
		else
		{
			 swal("Please select some products");
			   $scope.adh_tb.currentTab='tab3';
			    $(l13).addClass('disabled');
			    $(l14).addClass('disabled');
			    $(l15).addClass('disabled');
				$(l16).addClass('disabled');
		}

		}

	$(document).ready(function(){
   $("#next_4").click(function() {
   var from = $('#from').val();
   var to = $('#to').val();
	if(from =='')
	{
          swal("Please update From Date To Proceed");
            $scope.adh_tb.currentTab='tab4';

            $(l14).addClass('disabled');
             $(l15).addClass('disabled');


	}
	if(to =='')
	{
          swal("Please update To Date To Proceed");
            $scope.adh_tb.currentTab='tab4';

            $(l14).addClass('disabled');
             $(l15).addClass('disabled');


	}
	else
	{
		$scope.adh_tb.currentTab='tab5';
		$(l13).removeClass('disabled');
        $(l14).removeClass('disabled');
        $(l15).removeClass('disabled');

	}
  });
});
		$scope.adhoc_togggle_tab4=function()
        {

//		if($scope.adhoc_cmp.from_date !== '-1')
//		{
//			swal("Please update From Date To Proceed");
//             $scope.adh_tb.currentTab='tab4';
//
//             $(l14).addClass('disabled');
//             $(l15).addClass('disabled');
//          if (angular.isDefined($scope.adhoc_cmp.from_date))
//			  {
//          console.log($scope.adhoc_cmp.from_date.length);
//			  }
//		  //console.log(parseInt($scope.adhoc_cmp.from_date));
//		  //console.log($scope.adhoc_cmp.to_date);
//          //console.log($scope.adhoc_cmp.from_date);
//
//        }
//		else if($scope.adhoc_cmp.to_date !== '-1')
//		{
//			swal("Please update To Date To Proceed");
//             $scope.adh_tb.currentTab='tab4';
//
//             $(l14).addClass('disabled');
//             $(l15).addClass('disabled');
//         console.log($scope.adhoc_cmp.from_date);
//		console.log($scope.adhoc_cmp.to_date);
//
//        }
 //     else
	 // {
			$scope.adh_tb.currentTab='tab5';
			 $(l13).removeClass('disabled');
             $(l14).removeClass('disabled');
             $(l15).removeClass('disabled');
      }

//		}


		$scope.adhoc_togggle_tab5=function()
        {
		if(parseInt($scope.tmp) == 0)
		{
	    swal("Please Select a template to proceed");
			   $scope.adh_tb.currentTab='tab5';

			    $(l15).addClass('disabled');
                $(l16).addClass('disabled');
		}
		else
		{
		$scope.adh_tb.currentTab='tab6';
           $(l15).removeClass('disabled');
           $(l16).removeClass('disabled');

		}
		}
        $scope.clear_adhoc_campaign_data=function()
        {
			$scope.adhoc_cmp={};
       $scope.tmp={};
       $scope.tst={};
	   $scope.adh_tb={};
		    $scope.adhoc_cmp.cpgn_id='';
          $scope.adhoc_cmp.camp_name='';
          $scope.adhoc_cmp.camp_desc='';
          $scope.adhoc_cmp.camp_brand='ALL';
		  $scope.adhoc_cmp.fc_code='ALL';
          $scope.adhoc_cmp.prod_search='';
          $scope.adhoc_cmp.camp_country='IN';
          $scope.adhoc_cmp.cpgn_id='';
          $scope.clear_all_adh();
          $scope.selectedProductadh=[];

          $scope.adhoc_product_list=[];

          $scope.tmp='0';
          $scope.template_content='';
          $scope.adhoc_cmp.camp_sku='';
          $scope.adhoc_cmp.camp_fulfill='1';
          $scope.adhoc_cmp.camp_type='1';
          $scope.adhoc_cmp.camp_template='';
          $scope.adhoc_cmp.camp_trigger='1';
		  $scope.adhoc_cmp.camp_trigger_day='ALL';
          $scope.adhoc_cmp.camp_days='';
		  $scope.adhoc_cmp.camp_hour='';
		  $scope.adhoc_cmp.camp_min='';
          $scope.adhoc_cmp.camp_am_pm='1';
          $scope.adhoc_cmp.camp_coupon='';
          $scope.adhoc_cmp.camp_review='';
		  $scope.adhoc_cmp.from_date='';
		  $scope.adhoc_cmp.to_date='';
		  $scope.adhoc_cmp.is_deleted='0';
		  $scope.adh_tb.currentTab='tab1';

		  console.log($scope.adhoc_cmp.is_deleted);

		        $(l12).addClass('disabled');
			    $(l13).addClass('disabled');
                $(l14).addClass('disabled');
			    $(l15).addClass('disabled');
                $(l16).addClass('disabled');
        }


$scope.select_all_adh=function()
   {


      for(i=0;i< $scope.adhoc_product_list.length;i++)
      {
        $scope.addToArray($scope.selectedProductadh,$scope.adhoc_product_list[i]);

      }
      $scope.selectcount=$scope.selectedProductadh.length;
	   console.log($scope.selectcount);
      $scope.totalcount=$scope.total;

   }

   $scope.clear_all_adh=function()
   {
      $scope.clearArray($scope.selectedProductadh);
   }

    $scope.$watch("selectedProductadh.length",
           function(newValue, oldValue)
           {
             if(newValue < $scope.adhoc_product_list.length)
             {
              $scope.checkStatusadh='N';
             }
            });

       // $scope.changeSelectAllstatus=function()
       // {
       //  alert($scope.selectedProduct.length);
       // }
       $scope.statusCheckadh=function()
      {

	   console.log("Works");
           // console.log("checkStatus");
           // console.log($scope.checkStatus);

           if($scope.checkStatusadh=='Y')
           {
            $scope.select_all_adh();
           }
           else if($scope.checkStatusadh=='N')
           {
            $scope.clear_all_adh();
           }
      }

      $scope.create_adhoc_campaign=function()
        {
          //$scope.cmp.camp_template=CKEDITOR.instances.editor.getData();
          // console.log($scope.selectedProduct);
          // console.log($scope.cmp);

          if($scope.selectedProductadh.length > 0)
          {
               $scope.block_site();

               file=$scope.adhoc_cmp.camp_attachment;
                  var upload = Upload.upload({
                  url: '<?php echo $baseurl.'manage_campaign/create_adhoc_campaign/';?>',
                  data: {
                          attached_file: file,
                          camp_data:angular.toJson($scope.adhoc_cmp),
                          asin:angular.toJson($scope.selectedProductadh)
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
                     $scope.adhoccampList=response.data.campaign_list;
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


$scope.load_adhoc_product=function()
        {
            var blk='#adhoc_product_list';
            $(blk).block({message:'Loading Product'  });
            // $scope.clear_all();
            // $scope.selectedProduct=[];
            $scope.adhoc_cmp.camp_country='IN';

            campaignFactory.get_adhoc_products($scope.adhoc_cmp.camp_country,$scope.adhoc_cmp.camp_brand,$scope.adhoc_cmp.prod_search,$scope.adhoc_cmp.fc_code)
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
                             console.log($scope.selectedProductadh);
                             $scope.adhoc_product_list=html.adh_payload;
                             console.log($scope.selectedProductadh);
                             console.log("LOAD PRODUCT ENDs");
                           }
                      }
                )

        }





		$scope.edit_adhoc_campaign=function(campaign_id)
        {
           $scope.block_site();
                             $(l12).removeClass('disabled');
	                         $(l13).removeClass('disabled');
                             $(l14).removeClass('disabled');
	                         $(l15).removeClass('disabled');
                             $(l16).removeClass('disabled');
            campaignFactory.edit_adhoc_campaign(campaign_id)
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
                             $scope.adhoc_cmp=html.adhoc_campaign_detail[0];
                             $scope.adhoc_cmp.camp_hour=parseInt($scope.adhoc_cmp.camp_hour);
                             $scope.adhoc_cmp.camp_days=parseInt($scope.adhoc_cmp.camp_days);
                             $scope.adhoc_cmp.camp_min=parseInt($scope.adhoc_cmp.camp_min);
                             $scope.adhoc_product_list=html.other_product;
                             $scope.brand_list=html.brand_list;
                 //$scope.product_list=html.country_product;
                             $scope.clear_all_adh();
                             $scope.selectedProductadh=[];
							 $scope.tmp=$scope.adhoc_cmp.template_id;
                             $scope.load_template($scope.tmp);
                             if(html.selected_product.length > 0)
                             {
                               for(i=0;i< html.selected_product.length;i++)
                                {
                                  $scope.addToArray($scope.selectedProductadh,html.selected_product[i]);
                                }
                             }

                             console.log(html.selected_product);
                             $scope.adhoc_show_dash=0;
                           }
                      }
                )

        }
 $scope.delete_adhoc_campaign=function(campaign_id)
        {
           swal({
                title: "Are you sure to delete Adhoc campaign?",
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
                      campaignFactory.delete_adhoc_campaign(campaign_id)
              .success(
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');
                             $scope.adhoccampList=html.adhoc_campaign_list;
                           }
                           if(html.status_code == '1')
                           {
                            swal('Success!',html.status_text,'success');
                             $scope.adhoccampList=html.adhoc_campaign_list;
                           }
                      }
                );

                } else {
                    swal("Cancelled", "Delete cancelled:)", "error");
                }
            });


        }
		$scope.uploadImport = function(file,width,height,file2,width2,height2,file3,width3,height3,file4,width4,height4,file5,width5,height5)
     {
      $scope.block_site();
        campaignFactory.import_data(file,width,height,file2,width2,height2,file3,width3,height3,file4,width4,height4,file5,width5,height5)
         .then(function (response)
               {
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
                 }
                 else
                 {
                   swal("Error!",response.data.status_text,'error');
                 }
               },
             function (response)
             {
                if (response.status > 0)
                  $scope.errorMsg = response.status + ': ' + response.data;
             },
             function (evt)
             {
                if(angular.isDefined(file))
                file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
              });
    }
	$scope.get_id=function(id,image_1,image_2,image_3,image_4,image_5,template_id)
      {
        $scope.cpn=id;
		$scope.attach_1=image_1;
	    $scope.attach_2=image_2;
		$scope.attach_3=image_3;
		$scope.attach_4=image_4;
		$scope.attach_5=image_5;
		$scope.template_id=template_id;
		console.log($scope.cpn);
		$('#import2').modal('show');

      }

	  $scope.uploadImport_attach = function(file,file2,file3,file4,file5)
    {
     $scope.block_site();
       campaignFactory.import_data2($scope.cpn,file,file2,file3,file4,file5)
        .then(function (response)
              {
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
				  $scope.get_predata();
				  $('#import2').modal('hide');

                }
                else
                {
                  swal("Error!",response.data.status_text,'error');
                }
              },
            function (response)
            {
               if (response.status > 0)
                 $scope.errorMsg = response.status + ': ' + response.data;
            },
            function (evt)
            {
               if(angular.isDefined(file))
               file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
             });
   }


   $scope.delete_attach_1=function(template_id)
        {
           swal({
                title: "Are you sure to delete attachment 1?",
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
                      campaignFactory.delete_attach_1(template_id)
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
                             //$scope.campList=html.campaign_list;
							  $scope.get_predata();
				             $('#import2').modal('hide');
                           }
                      }
                );

                } else {
                    swal("Cancelled", "Delete cancelled:)", "error");
                }
            });


        }


		$scope.delete_attach_2=function(template_id)
        {
           swal({
                title: "Are you sure to delete attachment 2?",
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
                      campaignFactory.delete_attach_2(template_id)
              .success(
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');
                             //$scope.get_pre_data=html.campaign_list;

						}
                           if(html.status_code == '1')
                           {
                            swal('Success!',html.status_text,'success');
                             //$scope.campList=html.campaign_list;
							  $scope.get_predata();
				             $('#import2').modal('hide');
                           }
                      }
                );

                } else {
                    swal("Cancelled", "Delete cancelled:)", "error");
                }
            });


        }

		$scope.delete_attach_3=function(template_id)
        {
           swal({
                title: "Are you sure to delete attachment 3?",
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
                      campaignFactory.delete_attach_3(template_id)
              .success(
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');
                             //$scope.get_pre_data=html.campaign_list;

						}
                           if(html.status_code == '1')
                           {
                            swal('Success!',html.status_text,'success');
                             //$scope.campList=html.campaign_list;
							  $scope.get_predata();
				              $('#import2').modal('hide');
                           }
                      }
                );

                } else {
                    swal("Cancelled", "Delete cancelled:)", "error");
                }
            });


        }


		$scope.delete_attach_4=function(template_id)
        {
           swal({
                title: "Are you sure to delete attachment 4?",
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
                      campaignFactory.delete_attach_4(template_id)
              .success(
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');
                             //$scope.get_pre_data=html.campaign_list;
							 //$scope.filter_data();
						}
                           if(html.status_code == '1')
                           {
                            swal('Success!',html.status_text,'success');
                             //$scope.campList=html.campaign_list;
							  $scope.get_predata();
				              $('#import2').modal('hide');
                           }
                      }
                );

                } else {
                    swal("Cancelled", "Delete cancelled:)", "error");
                }
            });


        }

		$scope.delete_attach_5=function(template_id)
        {
           swal({
                title: "Are you sure to delete attachment 5?",
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
                      campaignFactory.delete_attach_5(template_id)
              .success(
                      function( html )
                      {
                           if(html.status_code=='0')
                           {
                             swal('Error!',html.status_text,'error');
                             //$scope.get_pre_data=html.campaign_list;
							 //$scope.filter_data();
						}
                           if(html.status_code == '1')
                           {
                            swal('Success!',html.status_text,'success');
                             //$scope.campList=html.campaign_list;
							  $scope.get_predate();
				              $('#import2').modal('hide');
                           }
                      }
                );

                } else {
                    swal("Cancelled", "Delete cancelled:)", "error");
                }
            });


        }


//	$scope.uploadImport2 = function(file,width,height)
//    {
//     $scope.block_site();
//       campaignFactory.import_data2(file,width,height)
//        .then(function (response)
//              {
//               $.unblockUI();
//               if(angular.isDefined(file))
//                 {
//                   $timeout(function () {
//                   file.result = response.data;
//                   });
//
//                 }
//               if(response.data.status_code == '1')
//                {
//                  swal('Success!',response.data.status_text,'success');
//                }
//                else
//                {
//                  swal("Error!",response.data.status_text,'error');
//                }
//              },
//            function (response)
//            {
//               if (response.status > 0)
//                 $scope.errorMsg = response.status + ': ' + response.data;
//            },
//            function (evt)
//            {
//               if(angular.isDefined(file))
//               file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
//             });
//   }
//
//	$scope.uploadImport3 = function(file,width,height)
//    {
//     $scope.block_site();
//       campaignFactory.import_data3(file,width,height)
//        .then(function (response)
//              {
//               $.unblockUI();
//               if(angular.isDefined(file))
//                 {
//                   $timeout(function () {
//                   file.result = response.data;
//                   });
//
//                 }
//               if(response.data.status_code == '1')
//                {
//                  swal('Success!',response.data.status_text,'success');
//                }
//                else
//                {
//                  swal("Error!",response.data.status_text,'error');
//                }
//              },
//            function (response)
//            {
//               if (response.status > 0)
//                 $scope.errorMsg = response.status + ': ' + response.data;
//            },
//            function (evt)
//            {
//               if(angular.isDefined(file))
//               file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
//             });
//   }
//
//	$scope.uploadImport4 = function(file,width,height)
//    {
//     $scope.block_site();
//       campaignFactory.import_data4(file,width,height)
//        .then(function (response)
//              {
//               $.unblockUI();
//               if(angular.isDefined(file))
//                 {
//                   $timeout(function () {
//                   file.result = response.data;
//                   });
//
//                 }
//               if(response.data.status_code == '1')
//                {
//                  swal('Success!',response.data.status_text,'success');
//                }
//                else
//                {
//                  swal("Error!",response.data.status_text,'error');
//                }
//              },
//            function (response)
//            {
//               if (response.status > 0)
//                 $scope.errorMsg = response.status + ': ' + response.data;
//            },
//            function (evt)
//            {
//               if(angular.isDefined(file))
//               file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
//             });
//   }
//
//
//	$scope.uploadImport5 = function(file,width,height)
//    {
//     $scope.block_site();
//       campaignFactory.import_data5(file,width,height)
//        .then(function (response)
//              {
//               $.unblockUI();
//               if(angular.isDefined(file))
//                 {
//                   $timeout(function () {
//                   file.result = response.data;
//                   });
//
//                 }
//               if(response.data.status_code == '1')
//                {
//                  swal('Success!',response.data.status_text,'success');
//                }
//                else
//                {
//                  swal("Error!",response.data.status_text,'error');
//                }
//              },
//            function (response)
//            {
//               if (response.status > 0)
//                 $scope.errorMsg = response.status + ': ' + response.data;
//            },
//            function (evt)
//            {
//               if(angular.isDefined(file))
//               file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
//             });
//   }

$scope.show_adhoc_edit_message=function()
        {
		swal('Adhoc Campaign Completed, Unable to Edit');
		}
		$scope.change_adhoc_status=function(is_active,campaign_id)
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
                      campaignFactory.change_adhoc_status(is_active,campaign_id)
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
                            $scope.adhoccampList=html.adhoc_campaign_list;
                           }
                      }
                );

                } else {
                    swal("Cancelled", "cancelled:)", "error");
					$scope.adhoccampList=html.adhoc_campaign_list;
                }
            });


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
   //initSample();
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
					this.add( '{{logo_image1}}', 'Logo Image 1' );
					this.add( '{{logo_image2}}', 'Logo Image 2' );
					this.add( '{{logo_image3}}', 'Logo Image 3' );
					this.add( '{{logo_image4}}', 'Logo Image 4' );
					this.add( '{{logo_image4}}', 'Logo Image 5' );
                    this.add( '{{customer_fullname}}', 'Customer Name' );
                    this.add( '{{customer_firstname}}', 'Customer First Name' );
                    this.add( '{{customer_lastname}}', 'Customer Last Name' );
                    this.add( '{{order_number}}', 'Order Number' );
                    this.add( '{{order_date}}', 'Order Date' );
                    this.add( '{{product_name}}', 'Product Name' );
                    this.add( '{{feedback_url}}', 'Feedback URL' );
                    this.add( '{{review_url}}', 'Review URL' );
                    this.add( '{{review_url_with_product_img}}', 'Review URL with Product Image' );
                    this.startGroup( 'Coupon Info' );
                    this.add( '{{single_user_coupon}}', 'Single User coupon' );
                    this.add( '{{multi_user_coupon}}', 'Multi User coupon' );

                   // this.add( '{{order_link}}', 'Order Link' );
                    //this.add( '{{sku_list}}', 'SKU List' );
                   // this.add( '{{order_date}}', 'Order Date' );



                    this.startGroup( 'Company Info' );
                    // this.add( '{{vendor_name}}', 'Amazon Vendor Name' );
                    this.add( '{{company_name}}', 'Company Name' );
                    //this.add( '{{contact_us}}', 'Contact us' );
                    this.add( '{{store_url}}', 'Storefront URL' );
                    //this.add( '{{unsubscribe_link}}', 'Unsubscribe Link' );


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
