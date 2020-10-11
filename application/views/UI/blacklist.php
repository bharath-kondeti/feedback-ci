<?php
$baseurl=base_url();
$base_url=base_url();
?>

<div class="wrapper" ng-cloak ng-controller='prefCtrl'>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <div class="page-title-right"></div>
            <h4 class="page-title settings-border">Settings</h4>
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
                <li class="nav-item  hover-nav settings-active">
                  <a class="nav-link" href="<?php echo $baseurl.'blacklist'?>">Blacklist</a>
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
        <div class="col-sm-10">
          <div class="card-box pl-5">
            <div class="h3 ml-2">Blacklisted Buyers</div>
            <div class="mt-3 mb-3">
            <table class="text-center table-bordered table">
              <thead class="thead-light">
                <tr>
                  <th>Buyer Email</th>
                  <th>Order ID</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $rows = '';
                  foreach ($result as $key => $value) {
                     $rows .= "<tr><td>" . $value['buyer_email'] . "</td><td>" . $value['fd_order_id'] . "</td></tr>";
                  }
                  echo $rows;
                ?>
              </tbody>
            </table>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
