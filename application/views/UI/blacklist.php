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
        <div class="col-sm-12">
          <div class="card-box pl-5">
            <div class="h3 ml-2">Blacklisted Buyers</div>
            <div class="mt-3 mb-3">
            <table style="border: 1px solid #DEE2E6; text-align: center;" class="table table-hover table-centered mb-0">
              <thead class="thead-color">
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
