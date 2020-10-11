<?php
$baseurl=base_url();
$base_url=base_url();
if($blacklistCheck == 1) {
  $check = "ng-checked='true'";
}
else {
  $check = "";
}
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
                <li class="nav-item  hover-nav">
                  <a class="nav-link" href="<?php echo $baseurl.'blacklist'?>">Blacklist</a>
                </li>
                <li class="nav-item hover-nav settings-active">
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
                  <img src="<?php echo $logoPath; ?>" ng-src="{{logo_Image_url}}" id="logoImg" alt="store-logo" height="110px" width="310px">
                </div>
                <div class="input-group mb-3 mt-3" style="width:310px">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="logoImage">
                    <label id="logoImageName" class="custom-file-label" for="logoImage" aria-describedby="logoImage">Choose File
                      <span></span>
                    </label>
                  </div>
                </div>
                <div>
                  <button ng-click="uploadLogo()" type="button" class="btn btn-primary">Upload your logo</button>
                  <span ng-if="notYetUploaded" class="form-text red">Please select a file</span>
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
                  <div class="d-flex">
                    <input type="email" ng-init="approvedEmail = '<?php echo $senderEmail; ?>'" ng-model="approvedEmail" class="form-control mt-1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $senderEmail; ?>">
                  </div>
                  <small ng-if="!approvedError" class="form-text text-muted">We'll never share your email with anyone else.</small>
                  <small ng-if="approvedError" class="form-text red">Please enter valid Email address</small>
                </div>
                <div class="form-group" style="width:50%">
                  <div class="h5">
                    Default Email Address for Test Messages
                  </div>
                  <div class="d-flex">
                    <input type="email" ng-init="testEmail = '<?php echo $testEmail; ?>'" ng-model="testEmail" class="form-control mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $testEmail; ?>">
                  </div>
                  <small ng-if="testError" class="form-text red">Please enter valid Email address</small>
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
                  <input type="text" ng-init="negativeEmails = '<?php echo $negEmail; ?>'" ng-model="negativeEmails" class="form-control mt-1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $negEmail; ?>">
                  <small ng-if="!negError" id="emailHelp" class="form-text text-muted">separate each email with a comma.</small>
                  <small ng-if="negError" class="form-text red">Please enter valid Email address</small>
                </div>
              </div>
              <hr>
              <div class="mt-3 mb-3">
                <div class="h4">
                  Negative feedback on blacklist
                </div>
                <div class="form-check form-check-inline">
                  <input ng-model="blackListNotif" class="form-check-input" type="radio" name="blacklistCheck" value="1" <?php echo $check; ?>>
                  <label class="form-check-label" for="inlineRadio1">Automatically add buyers to the blacklist who submit negative feedback.</label>
                </div>
              </div>
              <hr>
            </div>
            <div>
              <button ng-click="validateData()" type="button" class="btn btn-primary">Save my preferences</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
 		crawlApp.factory("acFactory", function ($http, $q) {
      var save_data = function (app_email,test_email,neg_emails,black_val) {
      var dataset_path="<?php echo $baseurl.'preferences/save_preferences'?>";
      var deferred = $q.defer();
      var path = dataset_path+'/'+app_email+'/'+test_email+'/'+neg_emails+'/'+black_val;
      $http.get(path)
      .success(function(data,status,headers,config){deferred.resolve(data);})
      .error(function(data, status, headers, config) { deferred.reject(status);});
      return deferred.promise;
      };
      var save_logo = function(logo_image) {
        var dataset_path="<?php echo $baseurl.'preferences/save_logo'?>";
        return $http({
          method: "post",
          url: dataset_path,
          transformRequest: angular.identity,
          data: logo_image,
          headers: {
            'Content-Type': undefined
          }
        });
      }

      var get_pref_data = function ()
      {
        var inv_list_url  =   "<?php echo $baseurl ."preferences/getUserPref"?>";
        var deferred = $q.defer();
        var path = inv_list_url;
        $http.get(path)
        .success(function(data,status,headers,config){deferred.resolve(data);})
        .error(function(data, status, headers, config) { deferred.reject(status);});
        return deferred.promise;
      };
 			return {
        save_data: save_data,
        save_logo: save_logo,
        get_pref_data: get_pref_data,
 			};
 		});
 		crawlApp.controller("prefCtrl", function prefCtrl($window, $scope, acFactory, $sce, $q, $timeout, Upload) {
      $scope.testEmail = "";
      $scope.approvedEmail = "";
      $scope.negativeEmails = "";
      $scope.blackListNotif = "";
      $scope.approvedError = false;
      $scope.testError = false;
      $scope.negError = false;
      $scope.logo_Image_url = "";
      $scope.logo_Image = "";
      $scope.imageUploaded =  false;
      $scope.notYetUploaded = false;

      $scope.block_site = function () {
				$.blockUI({
					css: {
						border: 'none',
						padding: '3px',
						backgroundColor: '#000',
						'-webkit-border-radius': '10px',
						'-moz-border-radius': '10px',
						opacity: .9,
						color: '#fff'
					}
				});

			}
      $scope.block_site();
      $scope.get_data = function () {
        var promise= acFactory.get_pref_data()
         promise.then(function(value){
          console.log(value);
          $.unblockUI();
         })
      }
      $scope.get_data();
      $scope.validateData =  function() {
        if($scope.approvedEmail === undefined) {
          $scope.approvedError = true
        } else {
          $scope.approvedError = false;
        }
        if($scope.testEmail === undefined) {
          $scope.testError = true
        } else {
          $scope.testError = false;
        }
        var str = $scope.negativeEmails.replace(/\s/g, "");
        var negEmails = str.split(',');
        for(var i = 0; i<negEmails.length; i++) {
          if(validateEmail(negEmails[i])) {
            $scope.negError = false;
          } else {
            $scope.negError = true;
            break;
          }
          if(!$scope.approvedError && !$scope.testError && !$scope.negError) {
            $scope.block_site();
            var promise = acFactory.save_data($scope.approvedEmail, $scope.testEmail, negEmails, $scope.blackListNotif)
            promise.then(()=> {
              $.unblockUI();
              swal({
              title: 'Preferences updates successfully',
              type: "success",
            });
            })
          }
        }

      }
      $scope.uploadLogo = function () {
        if($scope.imageUploaded) {
          $scope.block_site();
          $scope.notYetUploaded = false;
          var data = new FormData();
          data.append('logo_image', $scope.logo_Image)
          console.log(data);
          console.log(data.logo_image);
          var promise = acFactory.save_logo(data);
          promise.then( ()=> {
            $.unblockUI();
            swal({
              title: 'Logo Uploaded',
              type: "success",
            });
          })
        } else {
          $scope.notYetUploaded = true;
        }
      }
      function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
      }
      document.querySelector('#logoImage').addEventListener('change', event => {
        handleImageUpload(event)
      })
      const handleImageUpload = event => {
        if(event.target.files.length > 0) {
          $scope.notYetUploaded = false;
          const files = event.target.files[0];
          var filename = files.name;
          var format = filename.substring(filename.lastIndexOf('.')+1, filename.length)
          if (format == "jpg" || format == "jpeg" || format == "png") {
            $scope.logo_Image_url = URL.createObjectURL(files);
            $scope.logo_Image = files;
            document.getElementById('logoImg').src = $scope.logo_Image_url;
            document.getElementById('logoImageName').innerText = filename;
            $scope.imageUploaded =  true;
          } else {
            $scope.imageUploaded =  false;
            swal({
              title: 'Error',
              text: "Only Images of format jpg/jpeg and png are allowed",
              type: "error",
            });
          }
        }
        // const formData = new FormData()
        // formData.append('myFile', files[0])

        // fetch('/saveImage', {
        //   method: 'POST',
        //   body: formData
        // })
        // .then(response => response.json())
        // .then(data => {
        //   console.log(data.path)
        // })
        // .catch(error => {
        //   console.error(error)
        // })
      }
 		});

 	</script>
