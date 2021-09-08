	

	<div class="container">
						<form action="" method="post"  enctype="multipart/form-data" role="form" class="viewform" data-toggle="validator">
					<div class="form-group row less_margin">
						<div class="col-md-12">
							<div class="form-material ">
									<label for="name">Company name</label>
								<input type="text" class="form-control" value="<?php echo isset($edit["company_name"])?$edit["company_name"]:""; ?>" name="company_name" required>
							</div>
								<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group row less_margin">
					<div class='col-md-12'>
						 <div class='form-group'>
							<label>Industries</label>
							<select class="form-control select2 " name="industry_id" required>
								<option value="">--Select industry name--</option>
								<?php
								foreach($industries as $val){
								$selected=isset($edit["industry_id"])&&$val->id==$edit["industry_id"]?"selected":"";
									echo "<option value='$val->id' $selected>$val->industry_name </option>";
								}
								?>
							</select>
							<div class="help-block with-errors"></div>
						</div>
					  </div>
					  </div>
					<div class="form-group row less_margin">
						<div class="col-md-12">
							<div class="form-material ">
									<label for="name">Contact Person</label>
								<input type="text" class="form-control" value="<?php echo isset($edit["contact_person"])?$edit["contact_person"]:""; ?>" name="contact_person" required>
							</div>
								<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group row less_margin">
						<div class="col-md-12">
							<div class="form-material ">
									<label for="name">Phone</label>
								<input type="text" class="form-control" value="<?php echo isset($edit["phone"])?$edit["phone"]:""; ?>" name="phone" required>
							</div>
								<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group row less_margin">
						<div class="col-md-12">
							<div class="form-material ">
									<label for="name">Address</label>
								<input type="text" class="form-control" value="<?php echo isset($edit["address"])?$edit["address"]:""; ?>" name="address" required>
							</div>
								<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group row less_margin">
							<div class="col-md-12">
								<div class="form-material ">
									<label for="name" class="logoimage" style="display: block;">Add Logo <span style="font-size: 12px;">(Please use 235x125 logo image or same ratio)</span> </label>
									<input type="file" id="exampleInputFile" name="fileToUpload" onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])" style="display: none;" required> 
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
				