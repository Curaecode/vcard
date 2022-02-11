<div class="block-content "> 
	<div class="card card-body"> 
		<div class="block-content block-content-full"> 
			<div class="container">
								<form action="" method="post" enctype="multipart/form-data" class="viewform">
										<div class="form-group row">
											<div class="col-md-12">
												<div class="mb-3 floating">
													<input type="text" value='<?php echo isset($edit["name"])?$edit["name"]:""; ?>' class='form-control' name='name' required>
													<label for="name">Name</label>
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<div class="mb-3 floating">
													<textarea class="form-control" name='description' ><?php echo isset($edit["description"])?$edit["description"]:""; ?></textarea>
													<label>Description</label>
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
									   <div class="form-group row text-center">
										  <div class='col-sm-6'>
											 <div class=''>
												<input type='submit' class="btn btn-info form-control" value="Submit" name="submit" /> 
											 </div>
										  </div>
									   </div>
								</form> 
							
                    </div>
		</div>
	</div>
</div>	 