	

	<div class="container">
						<form action="" method="post"  enctype="multipart/form-data" role="form" class="viewform" data-toggle="validator">
					<div class="form-group row less_margin">
						<div class="col-md-12">
							<div class="form-material ">
									<label for="name">State name</label>
								<input type="text" class="form-control" value="<?php echo isset($edit["state_name"])?$edit["state_name"]:""; ?>" name="state_name" required>
							</div>
								<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group row less_margin">
						<div class="col-md-12">
							<div class="form-material ">
									<label for="name">Country name</label>
								<input type="text" class="form-control" value="<?php echo isset($edit["country"])?$edit["country"]:""; ?>" name="country" required>
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
				