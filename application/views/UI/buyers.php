 <?php
$baseurl=base_url();
$base_url=base_url();
?>

            <div class="wrapper" ng-controller='invCtrl'>
			<div id="email_temp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="margin-left:-100px;width:700px">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Email To Buyer</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>

                                                <div class="modal-body p-4">
												<form  ng-submit="test_email()" name='amzForm' novalidate>
												 <div class="row" style="margin-bottom:10px">

													 <div  class="col-sm-12">

                            <input type='text' ng-disabled="true" class='form-control'  name='buyer_email_new' placeholder='Buyer Email' ng-model='cpn.buyer_email_new' required>

                            </div>

							<div  class="col-sm-12"> <br>

  <input type='text'  class='form-control'  name='seller_sku' placeholder='Subject' ng-model='cpn.subject' required>

                            </div>

							<div  class="col-sm-12"><br>
													  <div id='editor'></div>
                             </div>

							  <div class="col-sm-12"  ><br>

                              <input  style="float:right" type='submit' name='submit'  value='Send' ng-click="amz_submitted=true"  class="btn btn-info">
                              </div>



						                                                        </div>
                                                 </div>
									</form>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>

												       </div>


                                            </div>
                                        </div>
                                    </div><!-- /.modal -->


                <div class="content buyers" id="buyers">

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
									  <p>Please connect a store to start importing your inventory.  <a class="btn btn-info" href="<?php echo $base_url.'manage_stores'?>">Connect Stores...</a><p>

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
                                    <h4 class="page-title">Buyers</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

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
                                                        <label for="status-select" class="mr-2">Repeated Buyers</label>
                                                        <select class="custom-select" id="status-select" ng-change="filtergrid()" ng-model='filter.repeat_status'>
                                                             <option value="ALL">ALL</option>
                                                                <option value="YES">Yes</option>
                                                                <option value="NO">No</option>
                                                        </select>
                                                    </div>
													 <div class="form-group mx-sm-3 mb-2">
													<button style="margin-top:10px;"  ng-click="filtergrid()" type="button" class="btn btn-info waves-effect waves-light mb-2 mr-2">Search</button>
													 </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                           <table class="table table-stripped table-hover table-bordered table-centered mb-0">
                                                <thead class="thead-light">
                                                    <tr>


                                   <th ng-click="change_order('order_no')">Order No<i class="mdi mdi-sort-alphabetical "></i></th>
                                   <th ng-click="change_order('buyer_email')">Buyer Email<i  class="mdi mdi-sort-alphabetical "></i></th>
								   <th>Marketplace  </th>
                                   <th ng-click="change_order('ttl_orders')">Total Orders<i  class="mdi mdi-sort-numeric "></i></th>
                                   <th ng-click="change_order('po_date')">Last Order Date<i  class="mdi mdi-sort-numeric "></i></th>
								   <th ng-click="change_order('scd_count')">Scheduled<i  class="mdi mdi-sort-numeric "></i></th>
								   <th ng-click="change_order('sent_count')">Sent<i  class="mdi mdi-sort-numeric "></i></th>
                                   <th >Email </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="lst in transactionList ">
													<td>{{lst.order_no}}</td>
													<td>{{lst.buyer_email_new}}</td>
                                                <td ng-if="lst.country_code=='IN'"><img width="20" height="20"  src="<?php echo $base_url.'assets/img/amazon_logo.png'?> "><span style="color:#a3afb7;font-weight:300" >.in</span></td>
												<td ng-if="lst.country_code=='US'"><img width="20" height="20"  src="<?php echo $base_url.'assets/img/amazon_logo.png'?> "><span style="color:#a3afb7;font-weight:300" >.com</span></td>
												<td ng-if="lst.country_code=='UK'"><img width="20" height="20"  src="<?php echo $base_url.'assets/img/amazon_logo.png'?> "><span style="color:#a3afb7;font-weight:300" >.co.uk</span></td>
												<td ng-if="lst.country_code=='IT'"><img width="20" height="20"  src="<?php echo $base_url.'assets/img/amazon_logo.png'?> "><span style="color:#a3afb7;font-weight:300" >.it</span></td>
												<td ng-if="lst.country_code=='DE'"><img width="20" height="20"  src="<?php echo $base_url.'assets/img/amazon_logo.png'?> "><span style="color:#a3afb7;font-weight:300" >.de</span></td>
												<td ng-if="lst.country_code=='FR'"><img width="20" height="20"  src="<?php echo $base_url.'assets/img/amazon_logo.png'?> "><span style="color:#a3afb7;font-weight:300" >.fr</span></td>
												<td ng-if="lst.country_code=='ES'"><img width="20" height="20"  src="<?php echo $base_url.'assets/img/amazon_logo.png'?> "><span style="color:#a3afb7;font-weight:300" >.es</span></td>
												<td style="margin-left:20px;">{{lst.ttl_orders}}</td>
												<td style="margin-left:20px;">{{lst.purchase_date_new}}</td>
												<td style="margin-left:20px;">{{lst.scd_count_new}}</td>
												<td style="margin-left:20px;">{{lst.sent_count_new}}</td>
												<td><span   ng-click='send_email_to_buyer(lst)'  class="badge badge-info"> Sent Email</span></td>

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
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->

							 <?php
					  }
                   ?>
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->



<script type="text/javascript">
crawlApp.factory('invFactory', ['$http', '$q','limitToFilter', 'Upload',function($http,$q,limitToFilter,Upload) {


    var inv_list_url        =   "<?php echo $baseurl ."buyers/get_inventory_list/"?>";
	var ord_list_url        =   "<?php echo $baseurl ."buyers/get_order_list/"?>";


    var get_transaction_list = function (orderby,direction,offset,limit,search)
    {
          var deferred = $q.defer();
          var path =inv_list_url+orderby+'/'+direction+'/'+offset+'/'+limit+'/'+search;
          $http.get(path)
          .success(function(data,status,headers,config){deferred.resolve(data);})
          .error(function(data, status, headers, config) { deferred.reject(status);});
          return deferred.promise;
    };

	  var get_order_list = function (buyer_email,orderby,direction,offset,limit,search)
    {
          var deferred = $q.defer();
          var path =ord_list_url+buyer_email+'/'+orderby+'/'+direction+'/'+offset+'/'+limit+'/'+search;
          $http.get(path)
          .success(function(data,status,headers,config){deferred.resolve(data);})
          .error(function(data, status, headers, config) { deferred.reject(status);});
          return deferred.promise;
    };


	 var test_email=function(buyer_email,subject,message)
    {
       var search_path="<?php echo $baseurl.'buyers/test_email/';?>";
         return $http({
                      method: "post",
                      url: search_path,
                      data:
                      {
                        buyer_email:buyer_email,
                        subject:subject,
                        message:message
                      }
                     });

    };

    return {
        get_transaction_list:get_transaction_list,
		get_order_list:get_order_list,
		test_email:test_email

    };

}]);
crawlApp.controller('invCtrl', ['$scope','$parse','$window','invFactory','$http','limitToFilter','$timeout',function($scope,$parse,$window,invFactory,$http,limitToFilter,$timeout) {
      $scope.transactionList=[];
      $scope.filter={};
      $scope.filter.search='';
	  $scope.filter.open_status='ALL';
	  $scope.filter.click_status='ALL';
	  $scope.filter.repeat_status='ALL';
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


	   $scope.send_email_to_buyer=function(tnx)
      {
        $scope.cpn=tnx;
		console.log($scope.cpn);
		$('#email_temp').modal('show');
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
						  {repeat_status:$scope.filter.repeat_status},
						  {open_status:$scope.filter.open_status},
						  {click_status:$scope.filter.click_status}

                          ];
    var argum=JSON.stringify($scope.filterquery);
    $scope.searchJSON=encodeURIComponent(argum);
    $scope.get_transaction_list(0);

   }

  $scope.change_item_per_page=function()
   {
    //alert($scope.itm_per);
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


   $scope.test_email=function()
        {

            $scope.block_site();
			 $scope.cpn.message=CKEDITOR.instances.editor.getData();
            invFactory.test_email($scope.cpn.buyer_email_new,$scope.cpn.subject,$scope.cpn.message)
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




$scope.date_filter_tmpl="date_filter_tmpl.html";
      $scope.ord_filter={};
      $scope.ord_filter.search='';
      $scope.ord_filter.date_rng='';
      $scope.ord_filter.order_status='ALL';
      $scope.ord_filter.tfm_status='ALL';
      $scope.dt_text='';

      $scope.item_per_page = 25;
    $scope.current_page = 0;
    $scope.sort_order='added_date';
    $scope.srt_direc='DESC';
    $scope.searchOrder=[];
    $scope.filterOrder=[];

     $scope.ord_range = function()
    {
        var rangeSize = 8;
        var ret = [];
        var start;

        start = $scope.current_page;

        if ( start > $scope.ord_page_count()-rangeSize ) {
          start = $scope.ord_page_count()-rangeSize;
        }

        for (var i=start; i<start+rangeSize; i++) {
          if(i>0)
          ret.push(i);
        }
        return ret;
   };

   $scope.ord_prev_page = function()
   {
        if ($scope.current_page > 0)
        {
          $scope.current_page--;
        }
   };

   $scope.ord_prev_PageDisabled = function()
   {
        return $scope.current_page === 0 ? "disabled" : "";
   };

   $scope.ord_next_page = function()
   {
        if ($scope.current_page < $scope.ord_page_count() - 1)
        {
          $scope.current_page++;
        }
   };

   $scope.ord_next_pageDisabled = function()
   {
        return $scope.current_page === $scope.ord_page_count() - 1 ? "disabled" : "";
   };

   $scope.ord_page_count = function()
   {
        return Math.ceil($scope.order_total/$scope.item_per_page);
   };

   $scope.ord_set_page = function(n)
   {
        if (n > 0 && n < $scope.ord_page_count())
        {
          $scope.current_page = n;
        }
   };

   $scope.$watch("current_page",function(newValue, oldValue)
   {
     if(angular.isDefined($scope.context_buyer_email))
     $scope.get_order_list(newValue);
   });



$scope.get_order_details=function(lst,inx)
   {
	    //console.log(lst);
		//die();
            $scope.context_buyer_email=lst.buyer_email_new2;
            $scope.box_index=inx;
            $scope.ord_filter={};
            $scope.ord_filter.search='';
            $scope.ord_filter.date_rng='';
            $scope.ord_filter.order_status='ALL';
            $scope.ord_filter.tfm_status='ALL';
            $scope.dt_text='';
            $('#order_history').modal('show');
            $scope.get_order_list(0);

   }

  $scope.get_order_list=function(currentPage)
   {
      var blk='#collapse'+$scope.box_index;
      $(blk).block({message:null  });
      var promise= invFactory.get_order_list($scope.context_buyer_email,$scope.sort_order,$scope.srt_direc,currentPage*$scope.item_per_page,$scope.item_per_page,$scope.searchOrder);
         promise.then(function(value){
          $(blk).unblock();
         if(value.status_code==1)
         {
              $scope.orderList=value.datalist;
              $scope.order_total=value.total;
         }
         else
         {
            $scope.orderList=[];
            $scope.order_total=0;
         }
       },
      function(reason)
      {
        console.log("Reason"+reason);
      });
   }
   $scope.ord_filtergrid=function()
   {

    if(angular.isDefined($scope.ord_filter.frm_date) && angular.isDefined($scope.ord_filter.to_date) && $scope.ord_filter.frm_date.length > 0 && $scope.ord_filter.to_date.length > 0)
    {
      $scope.dt_text="ORDERS BETWEEN ["+$scope.ord_filter.frm_date+"] To ["+$scope.ord_filter.to_date+"]";
    }

     $scope.filter_query=[
                          {searchtext:$scope.ord_filter.search},
                          {order_status:$scope.ord_filter.order_status},
                          {from_date:$scope.ord_filter.frm_date},
                          {to_date:$scope.ord_filter.to_date},
                          {tfm_status:$scope.ord_filter.tfm_status},
                          {date_rng:$scope.ord_filter.date_rng}

                        ];
    var argum=JSON.stringify($scope.filter_query);
    $scope.searchOrder=encodeURIComponent(argum);
    $scope.get_order_list(0);

   }



}]);
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
                label: 'Tags',
                title: 'Placeholder text will be replaced by actual text',
                toolbar: 'others,0',

                panel: {
                    css: [ CKEDITOR.skin.getPath( 'editor' ) ].concat( config.contentsCss ),
                    multiSelect: false,
                    attributes: { 'aria-label': 'Placeholders Tag' }
                },

                init: function() {
                    this.startGroup( 'Order Info' );
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


