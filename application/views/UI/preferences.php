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
            <h4 class="page-title">Account Preferences</h4>
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
        <div class="col-sm-10">
          <div class="card-box pl-5">
            <div class="h3 ml-2">Preferences</div>
            <div class="ml-4">
              <div class="mt-3 mb-3">
                <div class="h4">
                  Your store logo
                </div>
                <div style="width:310px; height:110px; background-color:gray;">
                  <img src="{{idx.item_image}}" alt="store-logo" height="100px" width="300px">
                </div>
                <div class="input-group mb-3 mt-3" style="width:310px">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile02">
                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                  </div>
                </div>
                <div>
                  <button type="button" class="btn btn-primary">Upload your logo</button>
                </div>
              </div>
              <hr>
              <div class="mt-3 mb-3">
                <div class="h4">
                  Amazon Approved Sender Email Addres
                </div>
                
                <div class="form-group" style="width:50%">
                  You will need to enter your top approved email address from your amazon account to 
                  allow us to send verified emails to buyers.
                  <input type="email" class="form-control mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group" style="width:50%">
                  <div class="h5">
                    Default Email Address for Test Messages
                  </div>
                  <input type="email" class="form-control mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
              </div>
              <hr>
              <div class="mt-3 mb-3">
                <div class="h4">
                  Negative feedback/review notifications
                </div>
                <div class="form-group" style="width:50%">
                  <div class="h5">
                    Email Address(es)
                  </div>
                  <input type="email" class="form-control mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                  <small id="emailHelp" class="form-text text-muted">separate each email with a comma.</small>
                </div>
              </div>
              <hr>
              <div class="mt-3 mb-3">
                <div class="h4">
                  Negative feedback on blacklist
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                  <label class="form-check-label" for="inlineRadio1">Automatically add buyers to the blacklist who submit negative feedback.</label>
                </div>
              </div>
              <hr>
            </div>
            <div>
              <button type="button" class="btn btn-primary">Save my preferences</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
