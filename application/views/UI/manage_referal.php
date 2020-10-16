<?php
$baseurl=base_url();
$base_url=base_url();
?>
<div class="wrapper" ng-controller='refCtrl'>
	<div class="content">

		<div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <div class="page-title-right"></div>
            <h4 class="page-title settings-border">Manage Referral</h4>
          </div>
        </div>
      </div>
			<div class="row">
        <div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class='row'>
						<div class="col-sm-12">
							<div class="alert alert-info alert-dismissable">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<!-- Refer your friends and get free 5 credits when they sign up and paid -->

								<p><b>Share the below link to your friends to get 500 Rupees when they signup & pay</b></p>
								<?php echo base_url()."user_auth/referal_self_signup/".$this->user_id."/".strtoupper($ref_key)?>
							</div>
						</div>
					</div>
					<div class="row">

						<div class="col-sm-12">

							<div class="card panel ">
								<div class="panel-heading ml-3">
									<h3 class="panel-title" style="padding:10px 10px 10px 10px"> Refer a Friend</h3>


								</div>
								<div class="panel-body ml-5" style="padding:10px 10px 10px 10px">
									<div class="row">
										<div class="col-sm-9">
											<form name="myForm">
												<i class='pull-right' ng-show="myForm.refering_fname.$error.required"><span
														style='color:#f00'>*Required</span></i>
												<input type='text' class='form-control' name='refering_fname' ng-model='ref_fname'
													placeholder="Friend's First name" required>


												<i ng-show="myForm.refering_lname.$error.required" class='pull-right'><span
														style='color:#f00'>*Required</span></i>
												<input type='text' class='form-control' name='refering_lname' ng-model='ref_lname'
													placeholder="Friend's Last name" required>

												<i class='pull-right' ng-show="myForm.refering_email.$error.required"><span
														style='color:#f00'>*Required</span></i>
												<input type='email' class='form-control' name='refering_email' ng-model='ref_email'
													placeholder="Friend's Email" required>

												<i class='pull-right' ng-show="myForm.msg.$error.required"><span
														style='color:#f00'>*Required</span></i>
												<textarea class="form-control" rows="7" name='msg' placeholder='Type Message' required
													ng-model='ref_msg'></textarea>


												<button style="margin-top: 10px;float:right" class='btn btn-info' ng-disabled="!myForm.$valid"
													ng-click="send_referal_link()">Send Referal Link As Mail</button>
											</form>

										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-12">

							<div class="card panel ">
								<div class="panel-heading">
									<h3 class="panel-title" style="padding:10px 10px 10px 10px"> Referal List</h3>
								</div>
								<div class="panel-body table-responsive">
									<table style="border: 1px solid #DEE2E6; text-align: center;" class="table table-hover table-centered mb-0">
										<tr>
											<th>S_no</th>
											<th>Refered Name</th>
											<th>Refered Mail</th>
											<th>Refered On</th>
											<th>is_signup</th>
											<th>is_credited</th>
											<th>Credited on
										</tr>
										<?php
                  if(isset($referals) && count($referals)>0)
                  {
                    $i=1;
                    foreach($referals as $ser)
                    {
                      $row="<tr>";
                      $row.="<td>{$i}</td>";
                      $row.="<td>".$ser['refered_fname']."</td>";
                      $row.="<td>".$ser['refered_mail']."</td>";
                      $row.="<td>".$ser['ref_on']."</td>";
                      if($ser['is_signup'])
                        $row.="<td><span class='label label-success'>Signed Up</span></td>";
                      else
                        $row.="<td><span class='label label-warning'>Not signed up</span></td>";
                      if($ser['is_credited'])
                        $row.="<td><span class='label label-success'>Credited</span></td>";
                      else
                        $row.="<td><span class='label label-warning'>Not credited</span></td>";
                      $row.="<td>".$ser['credited_on']."</td>";
                      $row.="</tr>";
                      echo $row;
                      $i++;
                    }
                  }
                  else
                  {
                    echo "<tr><td colspan='7'><h3 class='text-center'>No Referals Made</h3></td></tr>";
                  }
                  ?>
									</table>
								</div>
							</div>

						</div>

					</div>
				</div>
        <div class="col-sm-2"></div>
			</div>

		</div>
		<script type="text/javascript">
			crawlApp.factory("refFactory", function ($http, $q) {


				var send_referal_link = function (ref_fname, ref_lname, ref_mail, ref_msg) {
					var search_path = "<?php echo $baseurl.'manage_referal/send_referal_link/';?>";
					return $http({
						method: "post",
						url: search_path,
						data: {
							ref_fname: ref_fname,
							ref_lname: ref_lname,
							ref_mail: ref_mail,
							ref_msg: ref_msg
						}
					});

				};

				return {
					send_referal_link: send_referal_link

				};
			});
			crawlApp.controller("refCtrl", function refCtrl($window, $scope, refFactory, $sce, $q) {
				$scope.send_referal_link = function () {
					$scope.block_site();
					refFactory.send_referal_link($scope.ref_fname, $scope.ref_lname, $scope.ref_email, $scope.ref_msg)
						.success(
							function (html) {
								$.unblockUI();
								if (html.status_code == '0') {
									swal('Error!', html.status_text, 'error');
								}
								if (html.status_code == '1') {
									swal('Success!', html.status_text, 'success');
									$("#myModal").modal('show');

								}
							}
						)
						.error(
							function (data, status, headers, config) {
								if (status == 404) {
									alert("Page Missing");
								}
							}

						);


				}

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

			});

		</script>
