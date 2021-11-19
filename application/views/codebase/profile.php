<div class="row page-titles">
	<div class="col-md-5 col-12 align-self-center">
		<h3 class="text-themecolor mb-0">Profile</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
			<li class="breadcrumb-item active">Profile</li>
		</ol>
	</div> 
</div>
<div class="block animated fadeIn"> 
		<div class="block-content ">
		<div class="card card-body">
			<!-- Main Container -->
           	<?php echo @$msg; ?>
                <!-- Page Content -->
                <!-- User Info -->
				<form action="" method="post" class="viewform animated fadeIn" enctype="multipart/form-data" >
                          
                <div class="bg-image bg-image-bottom">
                    <div class="bg-primary-dark-op py-30">
                        <div class="content content-full text-center">
                            <!-- Avatar -->
						                         
						   <div class="mb-15">
                                <a class="img-link" href="#">
									<input type="file" id="exampleInputFile" name="fileToUpload" onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])" style="display: none;" >  
									 <img src="<?php echo res_url()."admin/";echo isset($edit["image"])?$edit["image"]:"default.jpg"; ?>" id="blah1" class="profile-img" style="cursor: pointer;object-fit: contain;height: 150px;border-radius: 50%;box-shadow: 0 0 0 5px rgba(255,255,255,.4);    border: 10px solid #eef5f9;">
				  
                                 </a>
                            </div>
                            <!-- END Avatar -->
                            <!-- Personal -->
                            <h1 class="h3 text-white font-w700 mb-10"><?php echo isset($edit["Name"])?$edit["Name"]:""; ?></h1>
								<h2 class="h5 text-white-op">
									<?php echo "Admin";?>
								</h2>
								<!-- END Personal -->
							</div>
						</div>
					</div>
					<!-- END User Info -->
						<div class="content">
							<div class="container">
								<div class="row">
									<div class="col-lg-12 mb-4">
										<div class="block">
											<div class="block-header block-header-default">
												<h3 class="block-title">Details</h3>
											</div>
										</div>
									</div>
									<div class="col-lg-6 mb-4">
										<div class="block"> 
											<div class="block-content">
												<div class="form-group row">
													<label class="col-12" for="example-text-input">Enter Name</label>
													<div class="col-12">
														<input type='text' value='<?php echo isset($edit["Name"]) ? $edit["Name"]:""; ?>' class='form-control' name='Name' required>
						  							</div>
												</div>
												<div class="form-group row">
													<label class="col-12" for="example-text-input">Enter Email</label>
													<div class="col-12">
												 		<input type='text' value='<?php echo isset($edit["email"]) ? $edit["email"]:""; ?>' class='form-control' name='email' required>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6  mb-4">
										<div class="block"> 
											<div class="block-content">
												<div class="form-group row">
													<label class="col-12" for="example-text-input">Enter Username</label>
													<div class="col-12">
														<input type='text' value='<?php echo isset($edit["user_name"])?$edit["user_name"]:""; ?>' class='form-control' name='user_name'>
													</div>
												</div> 
												<div class="form-group row">
													<label class="col-12" for="example-text-input">Address</label>
													<div class="col-12">
												 		<input type='text' value='<?php echo isset($edit["address"]) ? $edit["address"]:""; ?>' class='form-control' name='address'>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class='col-lg-6 mt4'>
									 <div class='form-group'>
										<input type='submit' class="btn btn-info form-control" value="Submit"/> 
									 </div>
								  </div>
		                    </div>
		                </div>
		            </div>
				</form>
                <!-- END Main Content -->
                <!-- END Page Content -->
           
            <!-- END Main Container -->
		
		</div> 
		</div>
	</div>	 

            
