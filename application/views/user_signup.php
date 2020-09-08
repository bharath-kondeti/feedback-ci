 <?php
$baseurl=base_url();
$base_url=base_url();
?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>SignUp</title>
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
                                
                                <form action='<?php echo $baseurl.'user_auth/add_user';?>' method='post' >

                                    <div class="form-group">
                                        <label for="fullname">First Name</label>
                                       <?php echo form_error('fname', '<div class="error">', '</div>'); ?>
							            <input class="form-control" placeholder="First Name" type="text" name='fname' value="<?php echo set_value('fname'); ?>">
                                    </div>
									<div class="form-group">
                                        <label for="fullname">Last Name</label>
                                        <?php echo form_error('lname', '<div class="error">', '</div>'); ?>
							            <input class="form-control" placeholder="Last Name" type="text" name='lname' value="<?php echo set_value('lname'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="emailaddress">Email address</label>
                                        <?php echo form_error('email', '<div class="error">', '</div>'); ?>
							<input class="form-control" placeholder="Email Address" type="text" name='email' value="<?php echo set_value('email'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <?php echo form_error('pwd', '<div class="error">', '</div>'); ?>
							<input class="form-control" placeholder="Password" type="password" name='pwd' >
                                    </div>
									       <label for="password">Confirm Password</label>
                                        <?php echo form_error('rpwd', '<div class="error">', '</div>'); ?>
							<input class="form-control" placeholder="Password" type="password" name='rpwd' >
                                    </div>
                                    
                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-success btn-block" type="submit"> Sign Up </button>
                                    </div>

                                </form>

                          
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-white-50">Already have account?  <a href="<?php echo $base_url.'user_auth'?>" class="text-white ml-1"><b>Sign In</b></a></p>
                            </div> <!-- end col -->
                        </div>
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