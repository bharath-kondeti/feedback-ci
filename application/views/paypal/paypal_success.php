<?php 
$baseurl=base_url();
$base_url=base_url();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Success</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="<?php echo $base_url.'assets/css/bootstrap.min.css'?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo $base_url.'assets/css/icons.min.css'?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo $base_url.'assets/css/app.min.css'?>" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <a href="index.html">
                                        <span><img src="assets/images/logo-dark.png" alt="" height="22"></span>
                                    </a>
                                </div>

                                <div class="mt-3 text-center">
                                   <div class="card-body">
				     <h4>Dear Member</h2>
				  <p class="text-muted font-15 mt-2 text-center">
                 The Subscription process has been completed successfully! Thank you for your subscription. </p>
           <a href="<?php echo $base_url.'user_auth'?>" class="btn btn-block btn-pink waves-effect waves-light mt-3">Login</a>
                  </div>
                                    
                                </div>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


       
        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>