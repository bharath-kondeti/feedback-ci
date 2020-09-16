<?php
$baseurl=base_url();
$base_url=base_url();
?>

<div class="wrapper">
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <div class="page-title-right"></div>
            <h4 class="page-title">Cancel Your Account ?</h4>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-2">
          <div class="card-box">
            <div class="h4">
              App
            </div>
            <div class="ml-2">
              <ul class="nav flex-column">
                <li class="nav-item  hover-nav">
                  <a class="nav-link" href="#">Blacklist</a>
                </li>
                <li class="nav-item hover-nav">
                  <a class="nav-link active" href="<?php echo $baseurl.'preferences'?>">Preferences</a>                  
                </li>
              </ul>
            </div>
            <div class="h4">
              Billing
            </div>
            <div class="ml-2">
              <ul class="nav flex-column">
                <li class="nav-item hover-nav">
                  <a class="nav-link" href="<?php echo $baseurl . 'billing' ?>">Billing Info</a>
                </li>
                <li class="nav-item hover-nav">
                  <a class="nav-link" href="#">Invoices</a>                  
                </li>
                <!-- <li class="nav-item hover-nav">
                  <a class="nav-link" href="#">My Plan</a>                  
                </li> -->
                <li class="nav-item hover-nav">
                  <a class="nav-link" href="<?php echo $baseurl.'cancel'?>">Cancel</a>                  
                </li>
              </ul>
            </div>
            <div class="h4">
              My Account
            </div>
            <div class="ml-2">
              <ul class="nav flex-column">
                <li class="nav-item hover-nav">
                  <a class="nav-link" href="<?php echo $base_url . 'change_password' ?>">Change Password</a>
                </li>
              </ul>
            </div>
            <div class="h4">
              Promotions
            </div>
            <div class="ml-2">
              <ul class="nav flex-column">
                <li class="nav-item hover hover-nav">
                  <a class="nav-link" href="<?php echo $base_url . 'manage_referal' ?>">Refer a friend</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-10">
          <div class="card-box">
            <div class="page-title-box">
              <div class="page-title-right"></div>
              <h4 class="page-title">Put your account on hold</h4>
              <p>You have an option to put your account on Hold for few days/months</p>
            </div>
            <hr>
            <form name="hold-account" class="hold-account" id="hold-account">
              <div class="col-sm-2 mg-top-10">
                <button class="btn btn-block btn-info" name="hold">Hold Account</button>
              </div>
            </form>
            <div class="col-12">
              <div class="page-title-box">
                <div class="page-title-right"></div>
                <h4 class="page-title">Request Account Cancellation</h4>
                <p>Raise a request for account cancellation and out team will get back to you.</p>
              </div>
            </div>
            <hr>
            <form name="cancel-account" class="cancel-account" id="cancel-account">
              <div class="col-sm-2 mg-top-10">
                <button class="btn btn-block btn-info" name="cancel">Cancel Account</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
