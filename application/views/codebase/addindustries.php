<div class="block-content "> 
	<div class="card card-body"> 
		<div class="block-content block-content-full"> 
			<div class="container">
						<form action="" method="post"  enctype="multipart/form-data" role="form" class="viewform" data-toggle="validator">
					<div class="form-group row less_margin">
						<div class="col-md-12">
							<div class="mb-3 ">
									<label for="name">Industry name</label>
								<input type="text" class="form-control" value="<?php echo isset($edit["industry_name"])?$edit["industry_name"]:""; ?>" name="industry_name" required>
							</div>
								<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group row less_margin">
						<div class="col-md-12">
							<div class="mb-3 ">
									<label for="name">Contact Person</label>
								<input type="text" class="form-control" value="<?php echo isset($edit["contact_person"])?$edit["contact_person"]:""; ?>" name="contact_person" required>
							</div>
								<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group row less_margin">
						<div class="col-md-12">
							<div class="mb-3 ">
									<label for="name">Phone</label>
								<input type="text" class="form-control" value="<?php echo isset($edit["phone"])?$edit["phone"]:""; ?>" name="phone" required>
							</div>
								<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group row less_margin">
						<div class="col-md-12">
							<div class="mb-3 ">
									<label for="name">Address</label>
								<input type="text" class="form-control" value="<?php echo isset($edit["address"])?$edit["address"]:""; ?>" name="address" required>
							</div>
								<div class="help-block with-errors"></div>
						</div>
					</div>

					
				<div class="row text-center">
				  <div class='col-sm-3'>
					 <div class='form-group'>
						<input type='submit' class="btn btn-info form-control" value="Submit" name="submit" /> 
					 </div>
				  </div>
			   </div>
			</form>
		</div>
		</div>
	</div>
</div>	
 			