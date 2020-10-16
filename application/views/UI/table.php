 <?php
$baseurl=base_url();
$base_url=base_url();
?>

            <div class="wrapper">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="#">Orders</a></li>
                                            <li class="breadcrumb-item active">Table</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Table</h4>
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
                                                        <input type="search" class="form-control" id="inputPassword2" placeholder="Search...">
                                                    </div>
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <label for="status-select" class="mr-2">Status</label>
                                                        <select class="custom-select" id="status-select">
                                                            <option selected>Choose...</option>
                                                            <option value="1">Paid</option>
                                                            <option value="2">Awaiting Authorization</option>
                                                            <option value="3">Payment failed</option>
                                                            <option value="4">Cash On Delivery</option>
                                                            <option value="5">Fulfilled</option>
                                                            <option value="6">Unfulfilled</option>
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="text-lg-right">
                                                	 <button type="button" class="btn btn-success waves-effect waves-light mb-2 mr-2" data-toggle="modal" data-target="#con-close-modal">Modal</button>
                                                    <button type="button" class="btn btn-danger waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-basket mr-1"></i> Add New Order</button>
                                                    <button type="button" class="btn btn-light waves-effect mb-2">Export</button>

                                                </div>
                                            </div><!-- end col-->
                                        </div>

                                        <div class="table-responsive">
                                            <table style="border: 1px solid #DEE2E6; text-align: center;" class="table table-hover table-centered mb-0">
                                                    <tr>
                                         <th style="width: 20px;">
                                             <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                  <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                                </div>
                                                </th>
                                               <th>Order ID</th>
                                                <th>Products</th>
                                                <th>Date</th>
                                                <th>Payment Status</th>
                                                 <th>Total</th>
                                                <th>Payment Method</th>
                                                <th>Order Status</th>
                                                 <th style="width: 125px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                           <td>
                                            <div class="custom-control custom-checkbox">
                                               <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                                                   </div>
                                               </td>
                                               <td><a href="#" class="text-body font-weight-bold">#UB9708</a> </td>
                                               <td>
                                                <a href="ecommerce-prduct-detail.html"><img src="<?php echo $baseurl.'assets/img/product-1.jpg'?>" alt="product-img" height="32" /></a>
                                                <a href="ecommerce-prduct-detail.html"><img src="<?php echo $baseurl.'assets/img/product-2.jpg'?>" alt="product-img" height="32" /></a>
                                                <a href="ecommerce-prduct-detail.html"><img src="<?php echo $baseurl.'assets/img/product-3.jpg'?>" alt="product-img" height="32" /></a>
                                                <a href="ecommerce-prduct-detail.html"><img src="<?php echo $baseurl.'assets/img/product-4.jpg'?>" alt="product-img" height="32" /></a>
                                                <a href="ecommerce-prduct-detail.html"><img src="<?php echo $baseurl.'assets/img/product-5.jpg'?>" alt="product-img" height="32" /></a>

                                                </td>
                                                 <td>
                                                  August 05 2018 <small class="text-muted">10:29 PM</small>
                                                  </td>
                                                 <td>
                                                 <h5><span class="badge bg-soft-success text-success"><i class="mdi mdi-coin"></i> Paid</span></h5>
                                                  </td>
                                                    <td>
                                                  $176.41
                                                  </td>
                                                   <td>
                                                            Mastercard
                                                    </td>
                                                        <td>
                                                            <h5><span class="badge badge-info">Shipped</span></h5>
                                                        </td>
                                                 <td>
                                              <a href="#" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                             <a href="#" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                              <a href="#" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                             </td>
                                                    </tr>

                                                    <tr>
                                           <td>
                                            <div class="custom-control custom-checkbox">
                                               <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                                                   </div>
                                               </td>
                                               <td><a href="#" class="text-body font-weight-bold">#UB9708</a> </td>
                                               <td>
                                                <a href="ecommerce-prduct-detail.html"><img src="<?php echo $baseurl.'assets/img/product-1.jpg'?>" alt="product-img" height="32" /></a>
                                                <a href="ecommerce-prduct-detail.html"><img src="<?php echo $baseurl.'assets/img/product-2.jpg'?>" alt="product-img" height="32" /></a>
                                                <a href="ecommerce-prduct-detail.html"><img src="<?php echo $baseurl.'assets/img/product-3.jpg'?>" alt="product-img" height="32" /></a>
                                                <a href="ecommerce-prduct-detail.html"><img src="<?php echo $baseurl.'assets/img/product-4.jpg'?>" alt="product-img" height="32" /></a>
                                                <a href="ecommerce-prduct-detail.html"><img src="<?php echo $baseurl.'assets/img/product-5.jpg'?>" alt="product-img" height="32" /></a>

                                                </td>
                                                 <td>
                                                  August 05 2018 <small class="text-muted">10:29 PM</small>
                                                  </td>
                                                 <td>
                                                 <h5><span class="badge bg-soft-success text-success"><i class="mdi mdi-coin"></i> Paid</span></h5>
                                                  </td>
                                                    <td>
                                                  $176.41
                                                  </td>
                                                   <td>
                                                            Mastercard
                                                    </td>
                                                        <td>
                                                            <h5><span class="badge badge-info">Shipped</span></h5>
                                                        </td>
                                                 <td>
                                              <a href="#" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                             <a href="#" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                              <a href="#" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                             </td>
                                                    </tr>


                                                    <tr>
                                           <td>
                                            <div class="custom-control custom-checkbox">
                                               <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                                                   </div>
                                               </td>
                                               <td><a href="#" class="text-body font-weight-bold">#UB9708</a> </td>
                                               <td>
                                                <a href="ecommerce-prduct-detail.html"><img src="<?php echo $baseurl.'assets/img/product-1.jpg'?>" alt="product-img" height="32" /></a>
                                                <a href="ecommerce-prduct-detail.html"><img src="<?php echo $baseurl.'assets/img/product-2.jpg'?>" alt="product-img" height="32" /></a>
                                                <a href="ecommerce-prduct-detail.html"><img src="<?php echo $baseurl.'assets/img/product-3.jpg'?>" alt="product-img" height="32" /></a>
                                                <a href="ecommerce-prduct-detail.html"><img src="<?php echo $baseurl.'assets/img/product-4.jpg'?>" alt="product-img" height="32" /></a>
                                                <a href="ecommerce-prduct-detail.html"><img src="<?php echo $baseurl.'assets/img/product-5.jpg'?>" alt="product-img" height="32" /></a>

                                                </td>
                                                 <td>
                                                  August 05 2018 <small class="text-muted">10:29 PM</small>
                                                  </td>
                                                 <td>
                                                 <h5><span class="badge bg-soft-success text-success"><i class="mdi mdi-coin"></i> Paid</span></h5>
                                                  </td>
                                                    <td>
                                                  $176.41
                                                  </td>
                                                   <td>
                                                            Mastercard
                                                    </td>
                                                        <td>
                                                            <h5><span class="badge badge-info">Shipped</span></h5>
                                                        </td>
                                                 <td>
                                              <a href="#" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                             <a href="#" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                              <a href="#" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                             </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                        <ul class="pagination pagination-rounded justify-content-end my-2">
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true">«</span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true">»</span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

















                                    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Modal Content is Responsive</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body p-4">
                                                	<!-- start -->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Name</label>
                                                                <input type="text" class="form-control" id="field-1" placeholder="John">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-2" class="control-label">Surname</label>
                                                                <input type="text" class="form-control" id="field-2" placeholder="Doe">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Address</label>
                                                                <input type="text" class="form-control" id="field-3" placeholder="Address">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="field-4" class="control-label">City</label>
                                                                <input type="text" class="form-control" id="field-4" placeholder="Boston">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="field-5" class="control-label">Country</label>
                                                                <input type="text" class="form-control" id="field-5" placeholder="United States">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="field-6" class="control-label">Zip</label>
                                                                <input type="text" class="form-control" id="field-6" placeholder="123456">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group no-margin">
                                                                <label for="field-7" class="control-label">Personal Info</label>
                                                                <textarea class="form-control" id="field-7" placeholder="Write something about yourself"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.modal -->
