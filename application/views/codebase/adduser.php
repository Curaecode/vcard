<script>
 $('.modal-dialog').addClass('modal-lg');
</script>
<div class="block-content "> 
	<div class="card card-body"> 
			<div class="block-content block-content-full"> 
				<div class="container">
					<form action="" method="post"  enctype="multipart/form-data" role="form" class="viewform" data-toggle="validator"> 
						<div class="form-group row less_margin">
							<div class="col-md-6">
								<div class="mb-3 ">
										<label for="Name">Name</label>
										<input type="text" class="form-control" value="<?php echo isset($edit["Name"])?$edit["Name"]:""; ?>" name="Name" required>
								</div>
								<div class="help-block with-errors"></div>
							</div>
							<div class="col-md-6">
								<div class="mb-3 ">
										<label for="user_name">User Name</label>
									<input type="text" class="form-control" value="<?php echo isset($edit["user_name"])?$edit["user_name"]:""; ?>" name="user_name" required>
								</div>
									<div class="help-block with-errors"></div>
							</div>
						</div> 
						<div class="form-group row less_margin">
							<div class="col-md-6">
								<div class="mb-3 ">
										<label for="email">Email</label>
										<input type="text" class="form-control" value="<?php echo isset($edit["email"])?$edit["email"]:""; ?>" name="email" required>
								</div>
								<div class="help-block with-errors"></div>
							</div>
							<div class="col-md-6">
								<div class="mb-3 ">
										<label for="password">Password</label>
										<input type="text" class="form-control" value="" name="password">
								</div>
								<div class="help-block with-errors"></div>
							</div>
						</div> 
						<div class="form-group row less_margin">
							<div class="col-md-12">
								<div class="mb-3 ">
										<label for="name">Address</label>
									<input type="text" class="form-control" value="<?php echo isset($edit["address"])?$edit["address"]:""; ?>" name="address">
								</div>
									<div class="help-block with-errors"></div>
							</div>
						</div>  
						
						<div class="form-group row less_margin">
								<div class="col-md-12">
									<div class="mb-3 ">
										<label for="name" class="logoimage" style="display: block;">Image <span style="font-size: 12px;">(Please use 235x125 logo image or same ratio)</span> </label>
										<input type="file" id="exampleInputFile" name="fileToUpload" onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])" style="display: none;"> 
										<img style="width: 158px;padding: 9px;margin: 0 0 5px;"  id="blah1" src="<?php echo res_url()."admin/";echo isset($edit["image"]) && $edit["image"]!=="" ?$edit["image"]:'defaultlogo.png'; ?>" class="profile-img" style=""  >
										
									
									</div>
									<div class="help-block with-errors"></div>
								</div>
						</div>
					<div class="row text-center">
					  <div class='col-sm-3'>
						 <div class='form-group'>
							<input type="hidden" name="type" value="1" />
							<input type='submit' class="btn btn-info form-control" value="Submit" name="submit" /> 
						 </div>
					  </div>
				   </div>
				</form>
			</div>
					
			</div> 
	</div> 
</div>

	