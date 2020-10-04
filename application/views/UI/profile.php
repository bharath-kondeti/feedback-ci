 <?php
$baseurl=base_url();
$base_url=base_url();
?>

            <div class="wrapper" ng-controller='profileCtrl'>
                <div class="content">

                    <div class="container-fluid">


                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">

                                        </ol>
                                    </div>
                                    <h4 class="page-title">Edit Store</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="country_selection">
                            <div class="col-12">
                                <div class="card">

								  <div class="card-panel"> <br> <br>

								  <div class="col-sm-12">

								   <form  novalidate="" name="amzForm" ng-submit="update_amazon_api()" class="ng-pristine ng-valid ng-valid-required">


                                                   <div class="form-group p-v-5">

                                                    <div  class="col-sm-12" ng-class="{ 'has-error' : amzForm.store_name.$invalid &amp;&amp; amz_submitted  }">
													  <label class="control-label col-sm-4" >Store Name</label>
													  <div class="col-sm-8" style="float:right;">
                                                   <input type="text" ng-model="amz_api.store_name" placeholder="Store Name" name="store_name" class="form-control">
                                        </div>    </div>
                                                </div>



														 <div class="form-group p-v-5"  ng-if="amz_api.is_edit==0">

                                               <div   class="col-sm-12" ng-class="{ 'has-error' : amzForm.seller_id.$invalid &amp;&amp; amz_submitted  }">
													  <label class="control-label col-sm-4">Seller ID</label>
													  <div class="col-sm-8" style="float:right;">
                                                   <input type="text" ng-model="amz_api.seller_id" placeholder="SELLER ID" name="seller_id" class="form-control">
                                        </div>    </div>
                                                </div>

												  <div class="form-group p-v-5"  ng-if="amz_api.is_edit==1">
                                               <div   class="col-sm-12" ng-class="{ 'has-error' : amzForm.seller_id.$invalid &amp;&amp; amz_submitted  }">
													  <label class="control-label col-sm-4">Seller ID</label>
													  <div class="col-sm-8" style="float:right;">
                                                 {{amz_api.seller_id}}
                                        </div>    </div>
                                                </div>


												  <div class="form-group p-v-5" ng-if="amz_api.is_mws_work=='0'">

                                                    <div  class="col-sm-12" ng-class="{ 'has-error' : amzForm.tokenid.$invalid &amp;&amp; amz_submitted  }">
													  <label class="control-label col-sm-4" >Auth Token</label>
													  <div class="col-sm-8" style="float:right;">
                      <input type="text" ng-model="amz_api.tokenid" placeholder="Auth Token" name="tokenid" class="form-control">
                                        </div>    </div>
                                                </div>

												<div class="form-group p-v-5" ng-if="amz_api.is_mws_work=='1'">

                                                    <div  class="col-sm-12" ng-class="{ 'has-error' : amzForm.tokenid.$invalid &amp;&amp; amz_submitted  }">
													  <label class="control-label col-sm-4" >Auth Token</label>
													  <div class="col-sm-8" style="float:right;">
													  {{amz_api.tokenid}}
                                         </div>    </div>
                                                </div>


												  <div class="form-group p-v-5">

                                                    <div  class="col-sm-12" ng-class="{ 'has-error' : amzForm.amazon_email.$invalid &amp;&amp; amz_submitted  }">
													  <label class="control-label col-sm-4" >Your Amazon Email</label>
													  <div class="col-sm-8" style="float:right">
                                                   <input type="text" ng-model="amz_api.amazon_email" placeholder="Store Name" name="amazon_email" class="form-control">
                                        </div>    </div>
                                                </div>

                                           <div class="form-group p-v-5">

                                                    <div  class="col-sm-12" ng-class="{ 'has-error' : amzForm.manager_name.$invalid &amp;&amp; amz_submitted  }">
													  <label class="control-label col-sm-4" >Manager Name</label>
													  <div class="col-sm-8" style="float:right;">
                                                   <input type="text" ng-model="amz_api.manager_name" placeholder="Store Name" name="manager_name" class="form-control">
                                        </div>    </div>
                                                </div>


                                            <div class="col-md-12"style="float:right">
                                       <input type="submit" style="margin-top:30px;float:right;margin-bottom:30px;" class="btn btn-info" ng-click="amz_submitted=true" value="Update" name="submit">

											</div>
                                        </form>

								   </div>
                            </div>
                        </div>
				   </div>












				 </div>

			 </div>

		 </div>









 <script type="text/javascript">
$(document).ready(function ($) {

             $("#country_selection").show();
             $("#india").hide();
			 $("#us").hide();
			 $("#uk").hide();
			 $("#it").hide();
			 $("#de").hide();
			 $("#fr").hide();
			 $("#es").hide();

            $("#get_details_india").click(function(){
             $("#country_selection").hide();
             $("#india").show();
			 $("#us").hide();
			 $("#uk").hide();
			 $("#it").hide();
			 $("#de").hide();
			 $("#fr").hide();
			 $("#es").hide();
            });

			$("#get_details_us").click(function(){
             $("#country_selection").hide();
             $("#india").hide();
			 $("#us").show();
			 $("#uk").hide();
			 $("#it").hide();
			 $("#de").hide();
			 $("#fr").hide();
			 $("#es").hide();
            });

			$("#get_details_uk").click(function(){
             $("#country_selection").hide();
             $("#india").hide();
			 $("#us").hide();
			 $("#uk").show();
			 $("#it").hide();
			 $("#de").hide();
			 $("#fr").hide();
			 $("#es").hide();
            });

			$("#get_details_it").click(function(){
             $("#country_selection").hide();
             $("#india").hide();
			 $("#us").hide();
			 $("#uk").hide();
			 $("#it").show();
			 $("#de").hide();
			 $("#fr").hide();
			 $("#es").hide();
            });

			$("#get_details_de").click(function(){
             $("#country_selection").hide();
             $("#india").hide();
			 $("#us").hide();
			 $("#uk").hide();
			 $("#it").hide();
			 $("#de").show();
			 $("#fr").hide();
			 $("#es").hide();
            });

			$("#get_details_fr").click(function(){
             $("#country_selection").hide();
             $("#india").hide();
			 $("#us").hide();
			 $("#uk").hide();
			 $("#it").hide();
			 $("#de").hide();
			 $("#fr").show();
			 $("#es").hide();
            });

			$("#get_details_es").click(function(){
             $("#country_selection").hide();
             $("#india").hide();
			 $("#us").hide();
			 $("#uk").hide();
			 $("#it").hide();
			 $("#de").hide();
			 $("#fr").hide();
			 $("#es").show();
            });

			 $("#back1").click(function(){
             $("#country_selection").show();
             $("#india").hide();
			 $("#us").hide();
			 $("#uk").hide();
			 $("#it").hide();
			 $("#de").hide();
			 $("#fr").hide();
			 $("#es").hide();
            });

			$("#back2").click(function(){
             $("#country_selection").show();
             $("#india").hide();
			 $("#us").hide();
			 $("#uk").hide();
			 $("#it").hide();
			 $("#de").hide();
			 $("#fr").hide();
			 $("#es").hide();
            });

			$("#back3").click(function(){
             $("#country_selection").show();
             $("#india").hide();
			 $("#us").hide();
			 $("#uk").hide();
			 $("#it").hide();
			 $("#de").hide();
			 $("#fr").hide();
			 $("#es").hide();
            });
			$("#back4").click(function(){
             $("#country_selection").show();
             $("#india").hide();
			 $("#us").hide();
			 $("#uk").hide();
			 $("#it").hide();
			 $("#de").hide();
			 $("#fr").hide();
			 $("#es").hide();
            });
			$("#back5").click(function(){
             $("#country_selection").show();
             $("#india").hide();
			 $("#us").hide();
			 $("#uk").hide();
			 $("#it").hide();
			 $("#de").hide();
			 $("#fr").hide();
			 $("#es").hide();
            });
			$("#back6").click(function(){
             $("#country_selection").show();
             $("#india").hide();
			 $("#us").hide();
			 $("#uk").hide();
			 $("#it").hide();
			 $("#de").hide();
			 $("#fr").hide();
			 $("#es").hide();
            });
			$("#back7").click(function(){
             $("#country_selection").show();
             $("#india").hide();
			 $("#us").hide();
			 $("#uk").hide();
			 $("#it").hide();
			 $("#de").hide();
			 $("#fr").hide();
			 $("#es").hide();
            });




 });
</script>








<script type="text/javascript">

crawlApp.factory("profileFactory", function($http,$q) {
    var get_profile_info = function () {
        var deferred = $q.defer();
        var path ="<?php echo $baseurl.'profile/get_profile_info'?>";
        $http.get(path)
        .success(function(data,status,headers,config){deferred.resolve(data);})
        .error(function(data, status, headers, config) { deferred.reject(status);});
        return deferred.promise;
    };
     var update_amazon_api=function(api)
    {
       return $http({
                      method: "post",
                      url: "<?php echo $baseurl.'profile/update_amazon_api'?>",
                      data:{
                          api_detail:angular.toJson(api)
                      }
                     });

    };
    var add_new_store=function(api)
    {
       return $http({
                      method: "post",
                      url: "<?php echo $baseurl.'manage_stores/add_new_store'?>",
                      data:{
                          api_detail:angular.toJson(api)
                      }
                     });

    };

	 var add_new_store_us=function(api)
    {
       return $http({
                      method: "post",
                      url: "<?php echo $baseurl.'manage_stores/add_new_store_us'?>",
                      data:{
                          api_detail:angular.toJson(api)
                      }
                     });

    };

	 var add_new_store_uk=function(api)
    {
       return $http({
                      method: "post",
                      url: "<?php echo $baseurl.'manage_stores/add_new_store_uk'?>",
                      data:{
                          api_detail:angular.toJson(api)
                      }
                     });

    };

	 var add_new_store_it=function(api)
    {
       return $http({
                      method: "post",
                      url: "<?php echo $baseurl.'manage_stores/add_new_store_it'?>",
                      data:{
                          api_detail:angular.toJson(api)
                      }
                     });

    };

	 var add_new_store_de=function(api)
    {
       return $http({
                      method: "post",
                      url: "<?php echo $baseurl.'manage_stores/add_new_store_de'?>",
                      data:{
                          api_detail:angular.toJson(api)
                      }
                     });

    };
	 var add_new_store_fr=function(api)
    {
       return $http({
                      method: "post",
                      url: "<?php echo $baseurl.'manage_stores/add_new_store_fr'?>",
                      data:{
                          api_detail:angular.toJson(api)
                      }
                     });

    };

	var add_new_store_es=function(api)
    {
       return $http({
                      method: "post",
                      url: "<?php echo $baseurl.'manage_stores/add_new_store_es'?>",
                      data:{
                          api_detail:angular.toJson(api)
                      }
                     });

    };
    var update_company_api=function(com_info)
    {
       return $http({
                      method: "post",
                      url: "<?php echo $baseurl.'manage_stores/update_company_api'?>",
                      data:{
                          comp_info:angular.toJson(com_info)
                      }
                     });

    };

    var update_password=function(pwd)
    {
       return $http({
                      method: "post",
                      url: "<?php echo $baseurl.'manage_stores/update_password'?>",
                      data:{
                          pwd_detail:angular.toJson(pwd)
                      }
                     });

    };
    var update_eu_config=function(config_val)
    {
       return $http({
                      method: "post",
                      url: "<?php echo $baseurl.'manage_stores/update_eu_config'?>",
                      data:{
                          eu_config:config_val
                      }
                     });

    };
	var add_authorization=function()
    {
       return $http({
                      method: "post",
                      url: "<?php echo $baseurl.'manage_stores/add_authorization'?>",
                      data:1
                     });

    };

	var get_store_info=function(country)
    {
       return $http({
                      method: "post",
                      url: "<?php echo $baseurl.'manage_stores/get_store_info'?>",
                      data:{country:country}
                     });

    };

    return {
       get_profile_info:get_profile_info,
       update_amazon_api:update_amazon_api,
       update_company_api:update_company_api,
       update_password:update_password,
       add_new_store:add_new_store,
       //update_eu_config:update_eu_config,
	   add_authorization:add_authorization,
	   add_new_store_us:add_new_store_us,
	   add_new_store_uk:add_new_store_uk,
	   add_new_store_it:add_new_store_it,
	   add_new_store_de:add_new_store_de,
	   add_new_store_fr:add_new_store_fr,
	   add_new_store_es:add_new_store_es,
	   get_store_info:get_store_info
    };

});
  crawlApp.controller("profileCtrl",function profileCtrl($window,$scope,profileFactory,$sce,$q,$timeout,Upload)
  {
    $scope.amz_api={};
    $scope.amz_api.is_edit=0;
    $scope.amz_api.store_url="http://www.amazon.in/s?ie=UTF8&me=";
    $scope.pwd={};
    $scope.com_info={};
	$scope.com_info.comp_state='1';

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

    $scope.append_state_code=function()
    {
      $scope.com_info.comp_state=$scope.com_info.gst_number.substring(0, 2)
	  console.log($scope.com_info.comp_state);
	  }


    $scope.add_new_store=function()
    {
      if($scope.amzForm.$valid)
      {
        $scope.block_site();
                 profileFactory.add_new_store($scope.amz_api)
                          .success(
                                    function( html )
                                    {
                                      $.unblockUI();
                                        if(html.status_code==0)
                                        {
                                            swal("Error!",html.status_text,'error');
                                        }
                                        else if(html.status_code==1)
                                        {
                                            $scope.msg=html.msg;
                                            swal("Success!",html.status_text,'success');
                                        }
                                    }
                          )
                          .error(
                                 function(data, status, headers, config)
                                      {
                                        $.unblockUI();
                                       }

                          );



      }
  }


      $scope.add_new_store_us=function()
    {
      if($scope.amzForm.$valid)
      {
        $scope.block_site();
                 profileFactory.add_new_store_us($scope.amz_api)
                          .success(
                                    function( html )
                                    {
                                      $.unblockUI();
                                        if(html.status_code==0)
                                        {
                                            swal("Error!",html.status_text,'error');
                                        }
                                        else if(html.status_code==1)
                                        {
                                            $scope.msg=html.msg;
                                            swal("Success!",html.status_text,'success');
                                        }
                                    }
                          )
                          .error(
                                 function(data, status, headers, config)
                                      {
                                        $.unblockUI();
                                       }

                          );



      }
  }


   $scope.add_new_store_uk=function()
    {
      if($scope.amzForm.$valid)
      {
        $scope.block_site();
                 profileFactory.add_new_store_uk($scope.amz_api)
                          .success(
                                    function( html )
                                    {
                                      $.unblockUI();
                                        if(html.status_code==0)
                                        {
                                            swal("Error!",html.status_text,'error');
                                        }
                                        else if(html.status_code==1)
                                        {
                                            $scope.msg=html.msg;
                                            swal("Success!",html.status_text,'success');
                                        }
                                    }
                          )
                          .error(
                                 function(data, status, headers, config)
                                      {
                                        $.unblockUI();
                                       }

                          );



      }
  }

   $scope.add_new_store_it=function()
    {
      if($scope.amzForm.$valid)
      {
        $scope.block_site();
                 profileFactory.add_new_store_it($scope.amz_api)
                          .success(
                                    function( html )
                                    {
                                      $.unblockUI();
                                        if(html.status_code==0)
                                        {
                                            swal("Error!",html.status_text,'error');
                                        }
                                        else if(html.status_code==1)
                                        {
                                            $scope.msg=html.msg;
                                            swal("Success!",html.status_text,'success');
                                        }
                                    }
                          )
                          .error(
                                 function(data, status, headers, config)
                                      {
                                        $.unblockUI();
                                       }

                          );



      }
  }

  $scope.add_new_store_de=function()
    {
      if($scope.amzForm.$valid)
      {
        $scope.block_site();
                 profileFactory.add_new_store_de($scope.amz_api)
                          .success(
                                    function( html )
                                    {
                                      $.unblockUI();
                                        if(html.status_code==0)
                                        {
                                            swal("Error!",html.status_text,'error');
                                        }
                                        else if(html.status_code==1)
                                        {
                                            $scope.msg=html.msg;
                                            swal("Success!",html.status_text,'success');
                                        }
                                    }
                          )
                          .error(
                                 function(data, status, headers, config)
                                      {
                                        $.unblockUI();
                                       }

                          );



      }
  }

  $scope.add_new_store_fr=function()
    {
      if($scope.amzForm.$valid)
      {
        $scope.block_site();
                 profileFactory.add_new_store_fr($scope.amz_api)
                          .success(
                                    function( html )
                                    {
                                      $.unblockUI();
                                        if(html.status_code==0)
                                        {
                                            swal("Error!",html.status_text,'error');
                                        }
                                        else if(html.status_code==1)
                                        {
                                            $scope.msg=html.msg;
                                            swal("Success!",html.status_text,'success');
                                        }
                                    }
                          )
                          .error(
                                 function(data, status, headers, config)
                                      {
                                        $.unblockUI();
                                       }

                          );



      }
  }


  $scope.add_new_store_es=function()
    {
      if($scope.amzForm.$valid)
      {
        $scope.block_site();
                 profileFactory.add_new_store_es($scope.amz_api)
                          .success(
                                    function( html )
                                    {
                                      $.unblockUI();
                                        if(html.status_code==0)
                                        {
                                            swal("Error!",html.status_text,'error');
                                        }
                                        else if(html.status_code==1)
                                        {
                                            $scope.msg=html.msg;
                                            swal("Success!",html.status_text,'success');
                                        }
                                    }
                          )
                          .error(
                                 function(data, status, headers, config)
                                      {
                                        $.unblockUI();
                                       }

                          );



      }
  }
      $scope.toggle_eu_status=function()
        {
        	var lbl=$scope.usr.eu_config=='1'?'Enable':'Disable';
               swal({
                title: "Are you sure to "+lbl+" EU Grouping?",
                text: "",
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
                      profileFactory.update_eu_config($scope.usr.eu_config)
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

                           }
                      }
                );

                } else {

$scope.$apply(function () {
                    var eu=$scope.usr.eu_config=='1'?'0':'1';
                    $scope.usr.eu_config=eu;

});

                    swal("Cancelled", "Update cancelled:)", "error");
                }
            });



        }

     $scope.update_amazon_api=function()
      {
         // if($scope.amzForm.$valid)
         //  {
     //update check

             $scope.block_site();
                 profileFactory.update_amazon_api($scope.amz_api)
                          .success(
                                    function( html )
                                    {
                                      $.unblockUI();
                                        if(html.status_code==0)
                                        {
                                            swal("Error!",html.status_text,'error');
                                        }
                                        else if(html.status_code==1)
                                        {
                                            $scope.msg=html.msg;
                                            swal("Success!",html.status_text,'success');
                                        }
                                    }
                          )
                          .error(
                                 function(data, status, headers, config)
                                      {
                                        $.unblockUI();

                                       }

                          );




           // }
           // else
           // {
           //  console.log("Form Error ");
           // }
      }
      $scope.update_company_api=function()
      {


        // if($scope.comForm.$valid)
         // {
             $scope.block_site();

              profileFactory.update_company_api($scope.com_info)
                          .success(
                                    function( html )
                                    {
                                      $.unblockUI();
                                        if(html.status_code==0)
                                        {
                                            swal("Error!",html.status_text,'error');
                                        }
                                        else if(html.status_code==1)
                                        {
                                            $scope.msg=html.msg;
                                            swal("Success!",html.status_text,'success');
                                        }
                                    }
                          )
                          .error(
                                 function(data, status, headers, config)
                                      {$.unblockUI();

                                       }

                          );
                          $.unblockUI();
          // }
          // else
          // {
          //  console.log("Fomr error ");
          // }
      }
      $scope.update_password=function()
      {
         //if($scope.pwdForm.$valid)
         // {
              profileFactory.update_password($scope.pwd)
                          .success(
                                    function( html )
                                    {
                                      console.log(html);
                                        if(html.status_code==0)
                                        {
                                            swal("Error!",html.status_text,'error');
                                        }
                                        else if(html.status_code==1)
                                        {
                                            // $scope.msg=html.msg;
                                            swal("Success!",html.status_text,'success');
                                        }
                                    }
                          )
                          .error(
                                 function(data, status, headers, config)
                                      {

                                       }

                          );
         //  }
         //  else
         //  {
         //   console.log("Fomr error ");
         //  }
      }

	  $scope.get_store_info=function(country)
      {
         //if($scope.pwdForm.$valid)
         // {
              profileFactory.get_store_info(country)
                          .success(
                                    function( html )
                                    {
                                      console.log(html);
                                        if(html.status_code==0)
                                        {
                                            swal("Error!",html.status_text,'error');
                                        }
                                        else if(html.status_code==1)
                                        {
                                              $scope.amz_api=html.api_details[0];
                                            //swal("Success!",html.status_text,'success');
                                        }
                                    }
                          )
                          .error(
                                 function(data, status, headers, config)
                                      {

                                       }

                          );
         //  }
         //  else
         //  {
         //   console.log("Fomr error ");
         //  }
      }
    $scope.get_profile_info=function()
    {
        var promise=profileFactory.get_profile_info();
            promise.then(function(response){
            $scope.usr=response.details[0];
			 $scope.states=response.user_states;
			//$scope.pwd=response.details[0];
              if(response.api_details.length > 0)
              $scope.amz_api=response.api_details[0];
              if(response.com_details.length > 0)
              $scope.com_info=response.com_details[0];

            $scope.countries=[];
            $scope.user_stores=[];
            $scope.countries=response.supported_country;
            $scope.user_stores=response.user_stores;

       //     if($scope.amz_api.store_name.length =='')
       //     {
       //       swal("Please update Store Details");
		//	   //$('#step1').addClass('active');
		//	   //$('#step2').removeClass('active');
		//	   //$('#step3').removeClass('active');
		//	   //$('#step4').removeClass('active');
		//
		//	  // $('#tab_step1').addClass('active show');
		//	  // $('#tab_step2').removeClass('active show');
		//	  // $('#tab_step3').removeClass('active show');
		//	  //  $('#tab_step4').removeClass('active show');
       //     }
             //if($scope.com_info.com_name=='')
             // {
              // swal("Please update Company Details");
			   //class="nav nav-pills1"
			   //$('#ul_class').addClass('nav nav-pills1');
			  // $('#step1').removeClass('active');
			  // $('#step2').removeClass('active');
			  // $('#step3').addClass('active');
			  // $('#step4').removeClass('active');

			   //$('#tab_step1').removeClass('active show');
			   //$('#tab_step2').removeClass('active show');
			   //$('#tab_step3').addClass('active show');
			   //$('#tab_step4').removeClass('active show');
             //}

            console.log($scope.amz_api);

                 },
           function(reason) {
            console.log("Reason"+reason);
         });
    }
    $scope.get_profile_info();
    $scope.send_message = function(file)
     {
        var upload = Upload.upload({
          url: '<?php echo $baseurl.'manage_stores/update_profile/';?>',
          data: {attached_file: file,fname:$scope.usr.fname,lname:$scope.usr.lname,'default_store':$scope.usr.default_store},
        });

        upload.then(function (response) {
          if(angular.isDefined(file))
          {
            $timeout(function () {
            file.result = response.data;

            });

          }
          if(response.data.status_code == '1')
           {
             swal('Success!','profile updated','success');
           }
           else
           {
             swal("Error!",response.data.status_text,'error');
           }
        }, function (response) {
          if (response.status > 0)
            $scope.errorMsg = response.status + ': ' + response.data;
        }, function (evt) {
          if(angular.isDefined(file))
          file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        });
    }



	$scope.authorization_email=function()
	{
         $scope.block_site();
         profileFactory.add_authorization()
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
                               	//$scope.get_predata();
                                 	//swal('Success!',html.status_text,'success');
									      $scope.tb.currentTab='tab3';

                               }

                           }
                 )
                 .error(
                        function(data, status, headers, config)
                             {

                              }

                 );

  }

});
</script>

