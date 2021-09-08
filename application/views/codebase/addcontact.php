<div class="container">
	<form action="" method="post"  enctype="multipart/form-data" role="form" class="viewform" data-toggle="validator">
		<div class="form-group row less_margin">
			<div class="col-sm-6">
				<div class="form-material ">
					<label for="name">First Name<span style="color: red;">*</span></label>
					<input type="text" class="form-control" value="<?php echo isset($edit["first_name"])?$edit["first_name"]:""; ?>" name="first_name" required>
				</div>
				<div class="help-block with-errors"></div>
			</div>
			<div class="col-sm-6">
				<div class="form-material ">
					<label for="name">Last Name<span style="color: red;">*</span></label>
					<input type="text" class="form-control" value="<?php echo isset($edit["last_name"])?$edit["last_name"]:""; ?>" name="last_name" required>
				</div>
				<div class="help-block with-errors"></div>
			</div>
		</div>
		<div class="form-group row less_margin">
			<div class="col-sm-6">
				<div class="form-material ">
		 	 		<label for="name">Email Address<span style="color: red;">*</span></label>
					<input type='email' value='<?php echo isset($edit["email"])?$edit["email"]:""; ?>' class='form-control' name='email' required>
				</div>
				<div class="help-block with-errors"></div>
			</div>
			<div class="col-sm-6">
				<div class="form-material ">
					<label for="name">Enter Phone<span style="color: red;">*</span></label>
					<input type="text" class="form-control" value="<?php echo isset($edit["phone"])?$edit["phone"]:""; ?>" name="phone" required>
				</div>
				<div class="help-block with-errors"></div>
			</div>
		</div>
		<div class="form-group row less_margin">
			<div class='col-sm-6'>
				<div class='form-group'>
					<label>Company<span style="color: red;">*</span></label>
					<select class="form-control select2 " name="company_id" required>
						<option value="">--Select company name--</option>
						<?php
						foreach($companies as $val){
						$selected=isset($edit["company_id"])&&$val->id==$edit["company_id"]?"selected":"";
							echo "<option value='$val->id' $selected>$val->company_name </option>";
						}
						?>
					</select>
					<div class="help-block with-errors"></div>
				</div>
		  	</div>
		  	<div class='col-sm-6'>
				<div class='form-group'>
					<label>Location<span style="color: red;">*</span></label>
					<select class="form-control select2 location_select" name="location_id" required>
					<?php foreach ($locations as $key => $singleLocation) {?>
						<option <?php if (isset($edit['location_id']) && $edit['location_id']==$singleLocation->id) { echo "selected"; } ?> value="<?php echo $singleLocation->id; ?>"><?php echo $singleLocation->location_name; ?></option>
					<?php } ?>
					</select>
					<div class="help-block with-errors"></div>
				</div>
	  		</div>
		</div>
		<div class="form-group row less_margin">
			<div class='col-sm-6'>
				<div class='form-group'>
					<label>Sales group<span style="color: red;">*</span></label>
					<select class="form-control select2 " name="group_id" required>
						<option value="">--Select Sales group--</option>
						<?php
						foreach($groups as $val){
						$selected=isset($edit["group_id"])&&$val->id==$edit["group_id"]?"selected":"";
							echo "<option value='$val->id' $selected>$val->group_name </option>";
						}
						?>
					</select>
					<div class="help-block with-errors"></div>
				</div>
		 	</div>
		  	<div class='col-sm-6'>
				<div class='form-group'>
					<label>Country Name<span style="color: red;">*</span></label>
					<select class="form-control select2 " name="country_id" required>
						<option value="">--Select country name--</option>
						<?php
						foreach($countries as $val){
						$selected=isset($edit["country_id"])&&$val->id==$edit["country_id"]?"selected":"";
							echo "<option value='$val->id' $selected>$val->country_name </option>";
						}
						?>
					</select>
					<div class="help-block with-errors"></div>
				</div>
		  	</div>
		</div>
		<div class="form-group row less_margin">
			<div class='col-sm-6'>
				<div class='form-group'>
					<label>State<span style="color: red;">*</span></label>
					<select class="form-control select2 select_state" name="state_id" required>
						<?php foreach ($states as $key => $singleState) {?>
							<option <?php if (isset($edit['state_id']) && $edit['state_id']==$singleState->id) { echo "selected"; } ?> value="<?php echo $singleState->id; ?>"><?php echo $singleState->state_name; ?></option>
						<?php } ?>
					</select>
					<div class="help-block with-errors"></div>
				</div>
		  	</div>
			<div class="col-sm-6">
				<div class="form-material ">
		 	 		<label for="name">SSN</label>
					<input type='text' value='<?php echo isset($edit["ssn"])?$edit["ssn"]:""; ?>' class='form-control' name='ssn' >
				</div>
				<div class="help-block with-errors"></div>
			</div> 
		</div> 
		<div class="form-group row less_margin">
			<div class="col-sm-6">
				<div class="form-material ">
					<label for="name">Active member date</label>
					<input type="date" class="form-control" value="<?php echo isset($edit["active_member"])?$edit["active_member"]:""; ?>" name="active_member">
				</div>
				<div class="help-block with-errors"></div>
			</div>
		    <div class="col-sm-6">
				<div class="form-material ">
					<label for="name">Enter website link</label>
					<input type="text" class="form-control" value="<?php echo isset($edit["website"])?$edit["website"]:""; ?>" name="website">
				</div>
				<div class="help-block with-errors"></div>
			</div>
	    </div>
	    <div class="form-group row less_margin">
			<div class='col-sm-12'>
				<div class='form-group'>
					<label>Industries</label>
					<select class="form-control select2 " name="industry_id" >
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
		<div class="row text-center">
		    <div class='col-sm-3'>
				<div class='form-group'>
					<input type='submit' style="background: #1c97a6;" class="btn btn-info form-control" value="Submit" name="submit" /> 
				</div>
		    </div>
	   </div>
	</form>
</div>
				