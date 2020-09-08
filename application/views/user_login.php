 <?php

$baseurl=base_url();

$base_url=base_url();

?>

 <!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />

        <title>Feedback Automation</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />

        <meta content="Coderthemes" name="author" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->

        <link rel="shortcut icon" href="">



        <!-- App css -->

        <link href="<?php echo $baseurl.'assets/css/bootstrap.min.css'?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo $baseurl.'assets/css/icons.min.css'?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo $baseurl.'assets/css/app.min.css'?>" rel="stylesheet" type="text/css" />



    </head>



    <body class="authentication-bg authentication-bg-pattern">



        <div class="account-pages mt-5 mb-5">

            <div class="container"  >

                <div class="row justify-content-center">

                    <div class="col-md-8 col-lg-6 col-xl-5">

                        <div class="card bg-pattern authentication-user">
                            <div class="card-body p-4">
                                <img src="http://syndemos.com/app/assets/img/logo_feedback_1.png" class="img-fluid" />
                                <div class="text-center w-75 m-auto">
                                   <a href="index.html">
                                    </a>

                                    <!--<p class="text-muted mb-4 mt-3">Login</p>--->

                                </div>

                                <?php if(validation_errors()){echo '<div class="error" style="text-align" >'.validation_errors()."</div>";} ?>

                                <form action='<?php echo $baseurl.'user_auth/login';?>' method='post'>



                                    <div class="form-group mb-3">

                                        <label for="emailaddress">Email address</label>

                                        <input class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email" name='username'>



                                    </div>



                                    <div class="form-group mb-3">

                                        <label for="password">Password</label>

                                        <input class="form-control" type="password" required="" id="password" placeholder="Enter your password" name='password'>



                                    </div>
                                    <div class="flex-sb-m w-full">
                                        <div class="contact100-form-checkbox">
                                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                                            <label class="label-checkbox100" for="ckb1">
                                            Remember me
                                            </label>
                                            </div>
                                            <div>
                                    <div class="form-group mb-0 text-center">

                                            <label> <a href="<?php echo $base_url.'user_auth/forgot_password'?>" class=" ml-1">Forgot?</a></label>
                                        </div>
                                        </div>
                                    </div>




                                    <div class="form-group mb-0 text-center">

                                        <button class="btn btn-primary btn-block" type="submit"> Log In </button>

                                    </div>

                                    <div class="form-group mb-0 text-center">

                                    <label>Don't have an account? <a href="<?php echo $base_url.'user_auth/signup'?>" class=" ml-1"><b>Sign Up</b></a></label>
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
