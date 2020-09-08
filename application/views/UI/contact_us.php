<?php
 $baseurl=base_url();
?>
<style>
.cke_chrome {margin-left:0px !important;}
</style>
   
   <div class="wrapper" ng-controller='templateCtrl'>
                <div class="content">

                    <div class="container">
                        
                       
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Contact Us</h4>
                                </div>
                            </div>
                        </div>  

                       <div class="row">
                            <div class="col-12">
                                <div class="card">
								   <div class="card-panel"> <br> <br>
								        <div class="col-sm-12">
											<div class="form-group">
												<label for="subject">Subject</label>
												<input type='text' class="form-control" ng-model='tmplt.subject'>  
											</div>
											
											<div class="form-group">
												<label for="subject">Message</label>
												<div id='editor'></div>  
											</div>
											<div class="form-group">
												<button class='btn btn-info' ng-click="save_template()">SEND</button>
											</div>
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
       var search_path="<?php echo $baseurl.'contact_us/save_template/';?>";
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
            $scope.tmplt.template_ui=CKEDITOR.instances.editor.getData();
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
                opacity: .5, 
                color: '#fff' 
            }});

        }
      


       

});
</script>
<!-- <link href="<?php echo $baseurl.'asset/tkeditor/neo.css' ;?>" rel="stylesheet"> -->
<script src="<?php echo $baseurl.'asset/ckeditor/ckeditor.js' ;?>"></script>
<script src="<?php echo $baseurl.'asset/ckeditor/samples/js/sample.js' ;?>"></script>
<script>
   //initSample();
   CKEDITOR.replace( 'editor', {
    on: {
        pluginsLoaded: function() {
            var editor = this,
                config = editor.config;
            
            editor.ui.addRichCombo( 'my-combo', {
              
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