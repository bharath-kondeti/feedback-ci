 <?php
$baseurl=base_url();
$base_url=base_url();
?>

            <div class="wrapper" ng-controller='templateCtrl'>
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">

                                        </ol>
                                    </div>
                                    <h4 class="page-title">Template</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row" ng-show='show_dash_email==1'>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

									<div class="col-sm-12">
										<a href='#'   style="float:right;margin-bottom:10px;" class="btn btn-info" ng-click='clear_template();togggle_view_email()' >Create  New Template</a>
									</div>

										<div class="table-responsive">
                                            <table style="border: 1px solid #DEE2E6; text-align: center;" class="table table-hover table-centered mb-0">
                                                <thead style="background-color: #f1f5f7;font-size: 12px;font-weight: 200;color: #6c757d;white-space: nowrap">
												<tr>
												<th style="color:#6c757d;width: 466px;position: relative;" >Name</th>
												<th style="color:#6c757d;width: 466px;position: relative;" >Subject</th>
												<th style="color:#6c757d"></th>
											</tr>

                                                </thead>
                                                <tbody  ng-repeat="idx in template_list track by $index">
												<tr >
											    <td >{{idx.template_name}}</td>
												<td >{{idx.subject}}</td>
												<td><div class="form-inline"><i   ng-click='edit_template(idx.template_id);togggle_view_email()' style="font-size:20px;margin-left: 10px" class="fe-edit"></i>
												<i ng-if="idx.is_default=='0'" ng-click='delete_template(idx.template_id,idx.is_default)' style="font-size:20px;margin-left: 10px" class="fe-trash-2"></i>

												</div></td>
										       </tr>

													 </tbody>

                                            </table>
                                        </div>




									</div>
								</div>
							</div>
						</div>


						<div class="row" ng-show='show_dash_email==0'>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
									 <div class="col-sm-12">
										<a href="" style="margin-right:10px;font-size:15px;" id="menuToggle" class="pull-right  dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true" ng-click='togggle_view_email()'>Close</a>
											<p class="control-label col-sm-3" style="margin-top:5px;font-weight:700;margin-left:20px;" for="pwd">Template Name</p>
									<div class="col-sm-9">
										<input type="text" class="form-control" style="margin-left:20px;" ng-model='tmplt.template_name' >
									</div>
												 <br>
									  <p class="control-label col-sm-3" style="margin-top:5px;font-weight:700;margin-left:20px;" for="pwd">Subject</p>
												 <div class="col-sm-9">
									   <input type='text' style="margin-left:20px;" class="form-control" ng-model='tmplt.subject'> </div>
									  <br>
									   <div id='editor' ></div>  </div>
										<br>
										 <br>
										  </div>
										<div class="pull-right"> <br>
									  <button class='btn btn-info'  style="float:right;margin:-40px 10px 10px 10px" ng-if="tmplt.is_default=='0'"  ng-click="save_template()">SAVE</button>
									  </div>

									 </div>
								</div>
						</div>
					</div>



				 </div>
			  </div>
			</div>

<script type="text/javascript">

crawlApp.factory("templateFactory", function($http,$q,Upload) {

   var get_data = function () {
        var dataset_path="<?php echo $baseurl.'template/get_pre_data'?>";
        var deferred = $q.defer();
        var path =dataset_path;

        $http.get(path)
        .success(function(data,status,headers,config){deferred.resolve(data);})
        .error(function(data, status, headers, config) { deferred.reject(status);});

        return deferred.promise;
    };

   var edit_template=function(template_id)
    {
       var search_path="<?php echo $baseurl.'template/edit_template/';?>";
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
       var search_path="<?php echo $baseurl.'template/save_template/';?>";
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
       var search_path="<?php echo $baseurl.'template/delete_template/';?>";
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
    get_data:get_data,
    edit_template:edit_template,
	save_template:save_template,
	delete_template:delete_template
  };
});
  crawlApp.controller("templateCtrl",function templateCtrl($window,$scope,templateFactory,$sce,$q,$timeout,Upload)
  {

       $scope.tmp={};
	   $scope.tmplt={};
       $scope.tmp.test_html=CKEDITOR.instances.editor.getData();
	   $scope.show_dash_email=1;
	   $scope.tmplt.tmp_id='';
       $scope.tmplt.is_default='0';
       $scope.tmplt.subject='';
       $scope.tmplt.template_name='';
       $scope.tmplt.template_content_html='';
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

       $scope.get_predata = function()
         {
			  $scope.block_site();
               var promise=templateFactory.get_data();
              promise.then(
                             function(response)
                             {
                                if(response.status_code == '1')
                                {
							      $.unblockUI();
                                  $scope.template_list=response.template_list;
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
            templateFactory.edit_template(template_id)
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
                  templateFactory.delete_template(template_id)
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

$( document ).ready(function() {
CKEDITOR.instances.editor.on('change', function() {
 $scope.tmplt.template_content_html=$sce.trustAsHtml(CKEDITOR.instances.editor.getData());
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

