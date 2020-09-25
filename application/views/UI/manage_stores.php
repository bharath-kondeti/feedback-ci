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
                                        <li class="breadcrumb-item"><a style="color:#fff" class="btn btn-info" href="<?php echo $base_url.'profile'?>">Edit Store</a></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Manage Stores</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="country_selection">
                            <div class="col-12">
                                <div class="card">


                  <div class="col-sm-12" style="border-top: 1px solid #e4eaec;padding-top:10px;padding-bottom:10px;" id="get_details_india" ng-click="get_store_info('IN')">

                  <h5><img   src="<?php echo  $base_url.'assets/img/store_icons/Marketplace_IN.png'?>" width="60" height="60"> <span style="margin-left:20px;">Amazon.in </span></h5> </div>

                  <div class="col-sm-12" style="border-top: 1px solid #e4eaec;padding-top:10px;padding-bottom:10px;"id="get_details_us" ng-click="get_store_info('US')">

                  <h5><img src="<?php echo  $base_url.'assets/img/store_icons/Marketplace_US.png'?>" width="60" height="60"> <span style="margin-left:20px;">Amazon.com </span></h5> </div>

                  <div class="col-sm-12" style="border-top: 1px solid #e4eaec;padding-top:10px;padding-bottom:10px;"  id="get_details_uk" ng-click="get_store_info('UK')">

                  <h5><img src="<?php echo  $base_url.'assets/img/store_icons/Marketplace_UK.png'?>" width="60" height="60"> <span style="margin-left:20px;">Amazon.co.uk </span></h5> </div>

                  <div class="col-sm-12" style="border-top: 1px solid #e4eaec;padding-top:10px;padding-bottom:10px;" id="get_details_it" ng-click="get_store_info('IT')">

                  <h5><img src="<?php echo  $base_url.'assets/img/store_icons/Marketplace_IT.png'?>" width="60" height="60"> <span style="margin-left:20px;">Amazon.it </span></h5> </div>

                  <div class="col-sm-12" style="border-top: 1px solid #e4eaec;padding-top:10px;padding-bottom:10px;" id="get_details_de" ng-click="get_store_info('DE')">

                  <h5><img src="<?php echo  $base_url.'assets/img/store_icons/Marketplace_DE.jpg'?>" width="60" height="60"> <span style="margin-left:20px;">Amazon.de </span></h5> </div>

                  <div class="col-sm-12" style="border-top: 1px solid #e4eaec;padding-top:10px;padding-bottom:10px;" id="get_details_fr" ng-click="get_store_info('FR')">

                  <h5><img src="<?php echo  $base_url.'assets/img/store_icons/Marketplace_FR.png'?>" width="60" height="60"> <span style="margin-left:20px;">Amazon.fr </span></h5> </div>

                  <div class="col-sm-12" style="border-top: 1px solid #e4eaec;padding-top:10px;padding-bottom:10px;" id="get_details_es" ng-click="get_store_info('ES')">

                  <h5><img src="<?php echo  $base_url.'assets/img/store_icons/Marketplace_ES.jpg'?>" width="60" height="60"> <span style="margin-left:20px;">Amazon.es </span></h5> </div>




            </div>

                         </div>

                     </div>





           <div class="row" id="india">
                            <div class="col-12">
                               <div class="card" > <br>
                 <div class="col-sm-12">
                 <a  id="back1" href='' style="float:right">Back to Stores</a> </div>
                    <form  novalidate="" name="amzForm" ng-submit="add_new_store()" class="ng-pristine ng-valid ng-valid-required">
                 <div class="row">

                <div class="col-sm-6" >
                 <h4 style="margin-left:200px">MarketPlace</h4> </div>
                 <div class="col-sm-6">
                 <h4  style="margin-left:-60px;">Amazon.in</h4> </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Store Name</h4> </div>
                 <div class="col-sm-4"  style="margin-top:15px;">
                 <input  style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.store_name' placeholder ='Store Name' class="form-control" type="text">
                 <h4     style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.store_name}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 </div>
                 <div class="col-sm-6" style="margin-top:15px;">
                 <p  style="margin-left:-60px;">Step 1: <a target="_blank" href="https://sellercentral.amazon.in/gp/mws/registration/register.html?signInPageDisplayed=1&developerName=FeedbackGrid&devMWSAccountId=1234-1234-1234">Log in to MWS </a></p>
                                 <p  style="margin-left:-60px;">Step 2: Make sure Developer Number is set as 1234-1234-1234</p>
                                 <p  style="margin-left:-60px;">Step 3: Click Next, accept terms and click Next again</p>
                                 <p  style="margin-left:-60px;">Step 4: Copy Seller ID and MWS Auth Token</p>
                                 <p  style="margin-left:-60px;">Step 5: Put them into appropriate fields below</p>
                                 <!--<p>In the case of any questions, follow these instructions</p>-->
                                 </div>

                  <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Seller ID</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input   style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.seller_id' placeholder ='Seller ID' class="form-control" type="text">
                  <h4     style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.seller_id}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">MWS Auth Token</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input  style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.tokenid' placeholder ='MWS Auth Token' class="form-control" type="text">
                  <h4    style="margin-left:-60px;"  ng-if="amz_api.is_edit=='1'">{{amz_api.tokenid}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Your Amazon Email</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <h4     style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.amazon_email}}</h4>
                 <input  style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'"  ng-model='amz_api.amazon_email' placeholder ='Your Amazon Email' class="form-control" type="text"><br>

                 <p  style="margin-left:-60px;">It should be an email stated in your <a targer="_blank" href="https://sellercentral.amazon.in/sw/AccountInfo/SellerProfileView/step/SellerProfileView">Amazon Seller Profile.</a>
                 <br> Note: Customers won't see this email.</p>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Manager Name</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input    style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.manager_name' placeholder ='Manager Name' class="form-control" type="text">
                 <h4      style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.manager_name}}</h4>
                 </div> <br> <br>  <br>
                  <div class="col-sm-6"> </div>
                 <div class="col-sm-6 text-center" style="margin-top:20px;margin-bottom:30px;margin-left:600px;">
                                       <input type="submit" class="btn btn-info" ng-click="amz_submitted=true" value="Connect store" name="submit">

                      </div>
                                        </form>

                                 </div>
                             </div>
             </div>

        </div>

        <div class="row" id="us">
                            <div class="col-12">
                               <div class="card" > <br>
                 <div class="col-sm-12">
                 <a  id="back2" href='' style="float:right">Back to Stores</a> </div>
                    <form  novalidate="" name="amzForm" ng-submit="add_new_store_us()" class="ng-pristine ng-valid ng-valid-required">
                 <div class="row">

                <div class="col-sm-6" >
                 <h4 style="margin-left:200px">MarketPlace</h4> </div>
                 <div class="col-sm-6">
                 <h4  style="margin-left:-60px;">Amazon.com</h4> </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Store Name</h4> </div>
                 <div class="col-sm-4"  style="margin-top:15px;">
                 <input  style="margin-left:-60px;"  ng-if="amz_api.is_edit=='0'" ng-model='amz_api.store_name' placeholder ='Store Name' class="form-control" type="text">
                 <h4     style="margin-left:-60px;"  ng-if="amz_api.is_edit=='1'">{{amz_api.store_name}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 </div>
                 <div class="col-sm-6" style="margin-top:15px;">
                 <p  style="margin-left:-60px;">Step 1: <a target="_blank" href="https://sellercentral.amazon.com/gp/mws/registration/register.html?signInPageDisplayed=1&developerName=FeedbackGrid&devMWSAccountId=1234-1234-1234">Log in to MWS </a></p>
                                 <p  style="margin-left:-60px;">Step 2: Make sure Developer Number is set as 1234-1234-1234</p>
                                 <p  style="margin-left:-60px;">Step 3: Click Next, accept terms and click Next again</p>
                                 <p  style="margin-left:-60px;">Step 4: Copy Seller ID and MWS Auth Token</p>
                                 <p  style="margin-left:-60px;">Step 5: Put them into appropriate fields below</p>
                                 <!--<p>In the case of any questions, follow these instructions</p>-->
                                 </div>

                  <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Seller ID</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input   style="margin-left:-60px;"  ng-if="amz_api.is_edit=='0'" ng-model='amz_api.seller_id' placeholder ='Seller ID' class="form-control" type="text">
                  <h4     style="margin-left:-60px;"  ng-if="amz_api.is_edit=='1'">{{amz_api.seller_id}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">MWS Auth Token</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input   style="margin-left:-60px;"  ng-if="amz_api.is_edit=='0'" ng-model='amz_api.tokenid' placeholder ='MWS Auth Token' class="form-control" type="text">
                  <h4     style="margin-left:-60px;"  ng-if="amz_api.is_edit=='1'">{{amz_api.tokenid}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Your Amazon Email</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <h4     style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.amazon_email}}</h4>
                 <input  style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'"  ng-model='amz_api.amazon_email' placeholder ='Your Amazon Email' class="form-control" type="text"><br>

                 <p style="margin-left:-60px;">It should be an email stated in your <a targer="_blank" href="https://sellercentral.amazon.com/sw/AccountInfo/SellerProfileView/step/SellerProfileView">Amazon Seller Profile.</a>
                 <br> Note: Customers won't see this email.</p>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Manager Name</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input  style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.manager_name' placeholder ='Manager Name' class="form-control" type="text">
                 <h4     style="margin-left:-60px;"  ng-if="amz_api.is_edit=='1'">{{amz_api.manager_name}}</h4>
                 </div> <br> <br>  <br>
                  <div class="col-sm-6"> </div>
                 <div class="col-sm-6 text-center" style="margin-top:20px;margin-bottom:30px;margin-left:600px;">
                                       <input type="submit" class="btn btn-info" ng-click="amz_submitted=true" value="Connect store" name="submit">

                      </div>
                                        </form>

                                 </div>
                             </div>
             </div>

        </div>


        <div class="row" id="uk">
                            <div class="col-12">
                               <div class="card" > <br>
                 <div class="col-sm-12">
                 <a  id="back3" href='' style="float:right">Back to Stores</a> </div>
                    <form  novalidate="" name="amzForm" ng-submit="add_new_store_uk()" class="ng-pristine ng-valid ng-valid-required">
                 <div class="row">

                <div class="col-sm-6" >
                 <h4 style="margin-left:200px">MarketPlace</h4> </div>
                 <div class="col-sm-6">
                 <h4 style="margin-left:-60px;">Amazon.co.uk</h4> </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Store Name</h4> </div>
                 <div class="col-sm-4"  style="margin-top:15px;">
                 <input style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.store_name' placeholder ='Store Name' class="form-control" type="text">
                 <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.store_name}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 </div>
                 <div class="col-sm-6" style="margin-top:15px;">
                 <p style="margin-left:-60px;">Step 1: <a target="_blank" href="https://sellercentral.amazon.co.uk/gp/mws/registration/register.html?signInPageDisplayed=1&developerName=FeedbackGrid&devMWSAccountId=1234-1234-1234">Log in to MWS </a></p>
                                 <p style="margin-left:-60px;">Step 2: Make sure Developer Number is set as 1234-1234-1234</p>
                                 <p style="margin-left:-60px;">Step 3: Click Next, accept terms and click Next again</p>
                                 <p style="margin-left:-60px;">Step 4: Copy Seller ID and MWS Auth Token</p>
                                 <p style="margin-left:-60px;">Step 5: Put them into appropriate fields below</p>
                                 <!--<p>In the case of any questions, follow these instructions</p>-->
                                 </div>

                  <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Seller ID</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input  style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.seller_id' placeholder ='Seller ID' class="form-control" type="text">
                  <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.seller_id}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">MWS Auth Token</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input style="margin-left:-60px;"  ng-if="amz_api.is_edit=='0'" ng-model='amz_api.tokenid' placeholder ='MWS Auth Token' class="form-control" type="text">
                  <h4   style="margin-left:-60px;"  ng-if="amz_api.is_edit=='1'">{{amz_api.tokenid}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Your Amazon Email</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.amazon_email}}</h4>
                 <input style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'"  ng-model='amz_api.amazon_email' placeholder ='Your Amazon Email' class="form-control" type="text"><br>

                 <p style="margin-left:-60px;">It should be an email stated in your <a targer="_blank" href="https://sellercentral.amazon.co.uk/sw/AccountInfo/SellerProfileView/step/SellerProfileView">Amazon Seller Profile.</a>
                 <br> Note: Customers won't see this email.</p>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4  style="margin-left:200px">Manager Name</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.manager_name' placeholder ='Manager Name' class="form-control" type="text">
                 <h4    style="margin-left:-60px;"  ng-if="amz_api.is_edit=='1'">{{amz_api.manager_name}}</h4>
                 </div> <br> <br>  <br>
                  <div class="col-sm-6"> </div>
                 <div class="col-sm-6 text-center" style="margin-top:20px;margin-bottom:30px;margin-left:600px;">
                                  <input type="submit" class="btn btn-info" ng-click="amz_submitted=true" value="Connect store" name="submit">
</div>
                                        </form>

                                 </div>
                             </div>
             </div>

        </div>



        <div class="row" id="it">
                            <div class="col-12">
                               <div class="card" > <br>
                 <div class="col-sm-12">
                 <a  id="back4" href='' style="float:right">Back to Stores</a> </div>
                    <form  novalidate="" name="amzForm" ng-submit="add_new_store_it()" class="ng-pristine ng-valid ng-valid-required">
                 <div class="row">

                 <div class="col-sm-6" >
                 <h4 style="margin-left:200px">MarketPlace</h4> </div>
                 <div class="col-sm-6">
                 <h4 style="margin-left:-60px;">Amazon.it</h4> </div>

                <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Store Name</h4> </div>
                 <div class="col-sm-4"  style="margin-top:15px;">
                 <input style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.store_name' placeholder ='Store Name' class="form-control" type="text">
                 <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.store_name}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 </div>
                 <div class="col-sm-6" style="margin-top:15px;">
                 <p style="margin-left:-60px;">Step 1: <a target="_blank" href="https://sellercentral.amazon.it/gp/mws/registration/register.html?signInPageDisplayed=1&developerName=FeedbackGrid&devMWSAccountId=1234-1234-1234">Log in to MWS </a></p>
                                 <p style="margin-left:-60px;">Step 2: Make sure Developer Number is set as 1234-1234-1234</p>
                                 <p style="margin-left:-60px;">Step 3: Click Next, accept terms and click Next again</p>
                                 <p style="margin-left:-60px;">Step 4: Copy Seller ID and MWS Auth Token</p>
                                 <p style="margin-left:-60px;">Step 5: Put them into appropriate fields below</p>
                                 <!--<p>In the case of any questions, follow these instructions</p>-->
                                 </div>

                  <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Seller ID</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input style="margin-left:-60px;"  ng-if="amz_api.is_edit=='0'" ng-model='amz_api.seller_id' placeholder ='Seller ID' class="form-control" type="text">
                  <h4   style="margin-left:-60px;"  ng-if="amz_api.is_edit=='1'">{{amz_api.seller_id}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">MWS Auth Token</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.tokenid' placeholder ='MWS Auth Token' class="form-control" type="text">
                  <h4   style="margin-left:-60px;"  ng-if="amz_api.is_edit=='1'">{{amz_api.tokenid}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Your Amazon Email</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.amazon_email}}</h4>
                 <input style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'"  ng-model='amz_api.amazon_email' placeholder ='Your Amazon Email' class="form-control" type="text"><br>

                 <p style="margin-left:-60px;">It should be an email stated in your <a targer="_blank" href="https://sellercentral.amazon.it/sw/AccountInfo/SellerProfileView/step/SellerProfileView">Amazon Seller Profile.</a>
                 <br> Note: Customers won't see this email.</p>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Manager Name</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.manager_name' placeholder ='Manager Name' class="form-control" type="text">
                 <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.manager_name}}</h4>
                 </div> <br> <br>  <br>
                  <div class="col-sm-6"> </div>
                 <div class="col-sm-6 text-center" style="margin-top:20px;margin-bottom:30px;margin-left:600px;">
                                       <input type="submit" class="btn btn-info" ng-click="amz_submitted=true" value="Connect store" name="submit">

                      </div>
                                        </form>

                                 </div>
                             </div>
             </div>

        </div>




                            <div class="row" id="de">
                            <div class="col-12">
                               <div class="card" > <br>
                 <div class="col-sm-12">
                 <a  id="back5" href='' style="float:right">Back to Stores</a> </div>
                    <form  novalidate="" name="amzForm" ng-submit="add_new_store_de()" class="ng-pristine ng-valid ng-valid-required">
                 <div class="row">

                <div class="col-sm-6" >
                 <h4 style="margin-left:200px">MarketPlace</h4> </div>
                 <div class="col-sm-6">
                 <h4 style="margin-left:-60px;">Amazon.de</h4> </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Store Name</h4> </div>
                 <div class="col-sm-4"  style="margin-top:15px;">
                 <input style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.store_name' placeholder ='Store Name' class="form-control" type="text">
                 <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.store_name}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 </div>
                 <div class="col-sm-6" style="margin-top:15px;">
                 <p style="margin-left:-60px;">Step 1: <a target="_blank" href="https://sellercentral.amazon.de/gp/mws/registration/register.html?signInPageDisplayed=1&developerName=FeedbackGrid&devMWSAccountId=1234-1234-1234">Log in to MWS </a></p>
                                 <p style="margin-left:-60px;">Step 2: Make sure Developer Number is set as 1234-1234-1234</p>
                                 <p style="margin-left:-60px;">Step 3: Click Next, accept terms and click Next again</p>
                                 <p style="margin-left:-60px;">Step 4: Copy Seller ID and MWS Auth Token</p>
                                 <p style="margin-left:-60px;">Step 5: Put them into appropriate fields below</p>
                                 <!--<p>In the case of any questions, follow these instructions</p>-->
                                 </div>

                  <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Seller ID</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input  style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.seller_id' placeholder ='Seller ID' class="form-control" type="text">
                  <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.seller_id}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">MWS Auth Token</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input  style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.tokenid' placeholder ='MWS Auth Token' class="form-control" type="text">
                  <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.tokenid}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Your Amazon Email</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.amazon_email}}</h4>
                 <input style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'"  ng-model='amz_api.amazon_email' placeholder ='Your Amazon Email' class="form-control" type="text"><br>

                 <p style="margin-left:-60px;">It should be an email stated in your <a targer="_blank" href="https://sellercentral.amazon.de/sw/AccountInfo/SellerProfileView/step/SellerProfileView">Amazon Seller Profile.</a>
                 <br> Note: Customers won't see this email.</p>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Manager Name</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.manager_name' placeholder ='Manager Name' class="form-control" type="text">
                 <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.manager_name}}</h4>
                 </div> <br> <br>  <br>
                  <div class="col-sm-6"> </div>
                 <div class="col-sm-6 text-center" style="margin-top:20px;margin-bottom:30px;margin-left:600px;">
                                       <input type="submit" class="btn btn-info" ng-click="amz_submitted=true" value="Connect store" name="submit">

                      </div>
                                        </form>
                                 </div>
                             </div>
             </div>

        </div>


                             <div class="row" id="fr">
                            <div class="col-12">
                               <div class="card" > <br>
                 <div class="col-sm-12">
                 <a  id="back6" href='' style="float:right">Back to Stores</a> </div>
                    <form  novalidate="" name="amzForm" ng-submit="add_new_store_fr()" class="ng-pristine ng-valid ng-valid-required">
                 <div class="row">

                <div class="col-sm-6" >
                 <h4 style="margin-left:200px">MarketPlace</h4> </div>
                 <div class="col-sm-6">
                 <h4 style="margin-left:-60px;">Amazon.fr</h4> </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Store Name</h4> </div>
                 <div class="col-sm-4"  style="margin-top:15px;">
                 <input style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.store_name' placeholder ='Store Name' class="form-control" type="text">
                 <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.store_name}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 </div>
                 <div class="col-sm-6" style="margin-top:15px;">
                 <p style="margin-left:-60px;">Step 1: <a target="_blank" href="https://sellercentral.amazon.fr/gp/mws/registration/register.html?signInPageDisplayed=1&developerName=FeedbackGrid&devMWSAccountId=1234-1234-1234">Log in to MWS </a></p>
                                 <p style="margin-left:-60px;">Step 2: Make sure Developer Number is set as 1234-1234-1234</p>
                                 <p style="margin-left:-60px;">Step 3: Click Next, accept terms and click Next again</p>
                                 <p style="margin-left:-60px;">Step 4: Copy Seller ID and MWS Auth Token</p>
                                 <p style="margin-left:-60px;">Step 5: Put them into appropriate fields below</p>
                                 <!--<p>In the case of any questions, follow these instructions</p>-->
                                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Seller ID</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.seller_id' placeholder ='Seller ID' class="form-control" type="text">
                 <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.seller_id}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">MWS Auth Token</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input  style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.tokenid' placeholder ='MWS Auth Token' class="form-control" type="text">
                  <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.tokenid}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Your Amazon Email</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.amazon_email}}</h4>
                 <input style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'"  ng-model='amz_api.amazon_email' placeholder ='Your Amazon Email' class="form-control" type="text"><br>

                 <p style="margin-left:-60px;">It should be an email stated in your <a targer="_blank" href="https://sellercentral.amazon.fr/sw/AccountInfo/SellerProfileView/step/SellerProfileView">Amazon Seller Profile.</a>
                 <br> Note: Customers won't see this email.</p>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Manager Name</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.manager_name' placeholder ='Manager Name' class="form-control" type="text">
                 <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.manager_name}}</h4>
                 </div> <br> <br>  <br>
                  <div class="col-sm-6"> </div>
                 <div class="col-sm-6 text-center" style="margin-top:20px;margin-bottom:30px;margin-left:600px;">
                                       <input type="submit" class="btn btn-info" ng-click="amz_submitted=true" value="Connect store" name="submit">

                      </div>
                                        </form>

                                 </div>
                             </div>
             </div>

        </div>



<div class="row" id="es">
                            <div class="col-12">
                               <div class="card" > <br>
                 <div class="col-sm-12">
                 <a  id="back7" href='' style="float:right">Back to Stores</a> </div>
                    <form  novalidate="" name="amzForm" ng-submit="add_new_store_es()" class="ng-pristine ng-valid ng-valid-required">
                 <div class="row">

                <div class="col-sm-6" >
                 <h4 style="margin-left:200px">MarketPlace</h4> </div>
                 <div class="col-sm-6">
                 <h4 style="margin-left:-60px;">Amazon.es</h4> </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Store Name</h4> </div>
                 <div class="col-sm-4"  style="margin-top:15px;">
                 <input style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.store_name' placeholder ='Store Name' class="form-control" type="text">
                 <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.store_name}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 </div>
                 <div class="col-sm-6" style="margin-top:15px;">
                 <p style="margin-left:-60px;">Step 1: <a target="_blank" href="https://sellercentral.amazon.es/gp/mws/registration/register.html?signInPageDisplayed=1&developerName=FeedbackGrid&devMWSAccountId=1234-1234-1234">Log in to MWS </a></p>
                                 <p style="margin-left:-60px;">Step 2: Make sure Developer Number is set as 1234-1234-1234</p>
                                 <p style="margin-left:-60px;">Step 3: Click Next, accept terms and click Next again</p>
                                 <p style="margin-left:-60px;">Step 4: Copy Seller ID and MWS Auth Token</p>
                                 <p style="margin-left:-60px;">Step 5: Put them into appropriate fields below</p>
                                 <!--<p>In the case of any questions, follow these instructions</p>-->
                                 </div>

                  <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Seller ID</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input  style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.seller_id' placeholder ='Seller ID' class="form-control" type="text">
                  <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.seller_id}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">MWS Auth Token</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input style="margin-left:-60px;"  ng-if="amz_api.is_edit=='0'" ng-model='amz_api.tokenid' placeholder ='MWS Auth Token' class="form-control" type="text">
                  <h4   style="margin-left:-60px;"  ng-if="amz_api.is_edit=='1'">{{amz_api.tokenid}}</h4>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Your Amazon Email</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.amazon_email}}</h4>
                 <input style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'"  ng-model='amz_api.amazon_email' placeholder ='Your Amazon Email' class="form-control" type="text"><br>

                 <p style="margin-left:-60px;">It should be an email stated in your <a targer="_blank" href="https://sellercentral.amazon.es/sw/AccountInfo/SellerProfileView/step/SellerProfileView">Amazon Seller Profile.</a>
                 <br> Note: Customers won't see this email.</p>
                 </div>

                 <div class="col-sm-6" style="margin-top:15px;">
                 <h4 style="margin-left:200px">Manager Name</h4> </div>
                 <div class="col-sm-4" style="margin-top:15px;">
                 <input style="margin-left:-60px;" ng-if="amz_api.is_edit=='0'" ng-model='amz_api.manager_name' placeholder ='Manager Name' class="form-control" type="text">
                 <h4    style="margin-left:-60px;" ng-if="amz_api.is_edit=='1'">{{amz_api.manager_name}}</h4>
                 </div> <br> <br>  <br>
                  <div class="col-sm-6"> </div>
                 <div class="col-sm-6 text-center" style="margin-top:20px;margin-bottom:30px;margin-left:600px;">
                                       <input type="submit" class="btn btn-info" ng-click="amz_submitted=true" value="Connect store" name="submit">

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
        var path ="<?php echo $baseurl.'manage_stores/get_profile_info'?>";
        $http.get(path)
        .success(function(data,status,headers,config){deferred.resolve(data);})
        .error(function(data, status, headers, config) { deferred.reject(status);});
        return deferred.promise;
    };
     var update_amazon_api=function(api)
    {
       return $http({
                      method: "post",
                      url: "<?php echo $baseurl.'manage_stores/update_amazon_api'?>",
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
        add_new_store:add_new_store,
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
                opacity: .5,
                color: '#fff'
            },baseZ:9999});

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


     $scope.update_amazon_api=function()
      {

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

      }

    $scope.get_store_info=function(country)
      {

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
                                        }
                                    }
                          )
                          .error(
                                 function(data, status, headers, config)
                                      {

                                       }

                          );

      }
    $scope.get_profile_info=function()
    {
        var promise=profileFactory.get_profile_info();
            promise.then(function(response){
            $scope.usr=response.details[0];
       $scope.states=response.user_states;
              if(response.api_details.length > 0)
              $scope.amz_api=response.api_details[0];
              if(response.com_details.length > 0)
              $scope.com_info=response.com_details[0];

            $scope.countries=[];
            $scope.user_stores=[];
            $scope.countries=response.supported_country;
            $scope.user_stores=response.user_stores;

            console.log($scope.amz_api);

                 },
           function(reason) {
            console.log("Reason"+reason);
         });
    }
    $scope.get_profile_info();




});
</script>
