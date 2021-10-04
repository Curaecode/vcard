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
			<div class='col-sm-6'>
				<div class='form-group'>
					<label>Date of Bith<span style="color: red;">*</span></label> 
					<input type="date" class="form-control dateofbirth" value="<?php echo isset($edit["dob"])?$edit["dob"]:""; ?>" name="dob" required>
					<div class="help-block with-errors"></div>
				</div>
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

			<script type="text/javascript">
				/* $('.dateofbirth').mask('00/00/0000'); */
			</script>				