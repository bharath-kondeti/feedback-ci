<?php
 $baseurl=base_url();
?>


   <div class="wrapper" ng-controller='templateCtrl'>
                <div class="content">

                    <div class="container-fluid">


                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">

                                        </ol>
                                    </div>
                                    <h4 class="page-title">Give Us Feedback</h4>
                                </div>
                            </div>
                        </div>

                       <div class="row">
                            <div class="col-12">
                                <div class="card">
								   <div class="card-panel"> <br> <br>
								        <div class="col-sm-12">
                                             <label for="pwd">Feedback</label>
											 <textarea name="comment" class="form-control height-100" ng-model='tmplt.comment' cols="3" rows="5" placeholder="Enter your message…" title="Please enter your message (at least 10 characters)"></textarea>
                           <button name="submit" type="submit"  ng-click="save_template()" class="btn btn-lg btn-primary" id="submit" style="width:100%;margin-top: 15px;">Send</button>

		  <br>
		   <br> <br>


										   </div>
										 </div>
				                      </div>
					              </div>
                              </div>





					   </div>
					 </div>
                 </div>

<script type="text/javascript">

crawlApp.factory("templateFactory", function($http,$q) {


     var save_template=function(template_data)
    {
       var search_path="<?php echo $baseurl.'give_us_feedback/save_template/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        template_data:angular.toJson(template_data)
                      }
                     });

    };

  return {

    save_template:save_template
  };
});
  crawlApp.controller("templateCtrl",function templateCtrl($window,$scope,templateFactory,$sce,$q,$timeout,Upload)
  {
       $scope.cmp={};
       $scope.tmplt={};
       $scope.cmp.camp_template='';

        $scope.save_template=function()
        {
            $scope.block_site();
            //$scope.tmplt.template_ui=CKEDITOR.instances.editor.getData();
                templateFactory.save_template($scope.tmplt)
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
                             //$scope.get_predata();
                           }
                      }
                )


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





});
</script>
