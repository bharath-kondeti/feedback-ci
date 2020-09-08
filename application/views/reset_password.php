<?php 
$baseurl=base_url();
$base_url=base_url();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Reset Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="<?php echo $base_url.'assets/css/bootstrap.min.css '?>" rel="stylesheet" type="text/css" />
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
                                
                               
                                <form action='<?php echo $baseurl.'user_auth/reset_to_new_password';?>' method="post">

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">New Password</label>
                                    <input class="form-control" placeholder="New Password" type="password" name='pwd'>
                                    </div>
									
									  <div class="form-group mb-3">
                                        <label for="emailaddress">Re-Enter Password</label>
                                     <input class="form-control" placeholder="Reenter New Password" type="password" name='re_pwd'>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Reset Password </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                     
                        <!-- end row -->

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