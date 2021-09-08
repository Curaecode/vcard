					<nav class="breadcrumb push">
                       <span class="breadcrumb-item active">Change Password</span>
                    </nav>
					<div class="container animated fadeIn">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Change Password</h3>
                            </div>
                            <div class="block-content">
								<?php echo isset($msg)?$msg:""; ?>
									<form action="" method="post" class="viewform" >
									   <div class="row">
											<div class='col-sm-6'>
											 <div class='form-group'>
												<label>Old Password</label>
												<input type='password' class='form-control' name='oldPassword' required>
												<div class="help-block with-errors"></div>
											 </div>
										  </div>
										  <div class='col-sm-6'>
											 <div class='form-group'>
												<label>New Password</label>
												<input type='password' class='form-control' id="password" name='password' required>
												<div class="help-block with-errors"></div>
											  </div>
										  </div>
										  <div class='col-sm-6'>
											 <div class='form-group'>
												<label>Confirm Password</label>
												<input type='password' class='form-control' name='cpassword' data-match="#password" required>
												<div class="help-block with-errors"></div>
											 </div>
										  </div>
										</div>
										<div class="row">
										  <div class='col-sm-3'>
											 <div class='form-group'>
												<input type='submit' class="btn btn-info form-control" value="Submit"  /> 
											 </div>
										  </div>
									   </div>
									</form>
                            </div>
                        </div>
                    </div>
             