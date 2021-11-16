	

	<div class="container">
						<form action="" method="post"  enctype="multipart/form-data" role="form" class="viewform" data-toggle="validator">
					 
					 
					<div class="form-group row less_margin">
						<div class="col-md-6">
							<div class="form-material ">
									<label for="name">Title</label>
									<input type="text" class="form-control" value="<?php echo isset($edit["linkname"])?$edit["linkname"]:""; ?>" name="linkname" required>
							</div>
							<div class="help-block with-errors"></div>
						</div>
						<div class="col-md-6">
							<div class="form-material ">
									<label for="name">Slug</label>
								<input type="text" class="form-control" value="<?php echo isset($edit["slug"])?$edit["slug"]:""; ?>" name="slug" required>
							</div>
								<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group row less_margin">
						<div class="col-md-6">
							<div class="form-material ">
									<label for="name">Embeded URL</label>
								<input type="text" class="form-control" value="<?php echo isset($edit["embed"])?$edit["embed"]:""; ?>" name="embed" required>
							</div>
								<div class="help-block with-errors"></div>
						</div>
					 
						<div class="col-md-6">
							<div class="form-material ">
									<label for="name">URL</label>
								<input type="text" class="form-control" value="<?php echo isset($edit["url"])?$edit["url"]:""; ?>" name="url" required>
							</div>
								<div class="help-block with-errors"></div>
						</div>
					</div> 
					<div class="form-group row less_margin">
						<div class="col-md-6">
							<div class="form-material ">
								<label for="is_card">Show on Card</label>
								<select name="is_card" class="form-control">
									<option value="1" <?php if(isset($edit["is_card"]) && $edit["is_card"] == 1){ ?>selected<?php } ?>>Show</option>
									<option value="0" <?php if(isset($edit["is_card"]) && $edit["is_card"] == 0){ ?>selected<?php } ?>>Hide</option>
								</select> 
							</div>
								<div class="help-block with-errors"></div>
						</div>
					</div> 
					
					<div class="form-group row less_margin">
							<div class="col-md-12">
								<div class="form-material ">
									<label for="name" class="logoimage" style="display: block;">Add Logo <span style="font-size: 12px;">(Please use 235x125 logo image or same ratio)</span> </label>
									<input type="file" id="exampleInputFile" name="fileToUpload" onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])" style="display: none;" <?php if(!isset($edit["image"])){?>required<?php } ?>> 
									<img style="width: 158px;padding: 9px;margin: 0 0 5px;"  id="blah1" src="<?php echo res_url()."admin/";echo isset($edit["image"]) && $edit["image"]!=="" ?$edit["image"]:'defaultlogo.png'; ?>" class="profile-img" style=""  >
									
								
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
				