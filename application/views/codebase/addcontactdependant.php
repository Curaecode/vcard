<div class="block-content "> 
	<div class="card card-body"> 
		<div class="block-content block-content-full"> 
			<script>
 $('.modal-dialog').addClass('modal-xl');
</script>
<div class="">
	<form action="" method="post" role="form" class="viewform">
		  
		<div class="form-group row less_margin">
			<div class="col-sm-12">
				<table class="table table-bordered table-striped">
					<thead>
						<tr> 
							<th style="width:150px;">Spouse / Dependent</th>
							<th style="width:200px;">First Name</th>
							<th style="width:200px;">Last name</th>
							<th style="width:300px;">Cell Number</th>
							<th style="width:100px;">Date of Birth</th> 
							<th>&nbsp;</th> 
						</tr>
					</thead>
					<tbody id="dependent_table"> 
							<tr>
								<td style="padding:0.75rem 0px;">
									<select style="margin: 0px !important;" class="form-select" id="member_select" name="dependent[0][dependent]" required>
										<option value="">Please Select</option>
										<option value="Spouse">Spouse</option>
										<option value="Dependent">Dependent</option>
										<?php /* if(!empty($dependent)){ ?>
											<?php foreach($dependent as $rows){?> 
												<option value="<?php echo $rows->dependent_type;?>"><?php echo $rows->dependent_type;?></option>
											<?php } ?>
										<?php } */ ?> 
									</select>
								</td>
								<td style="padding: 0.75rem 0px;">
									<input type="text" class="form-control" value="" name="dependent[0][dependant_name]">
								</td>
								<td style="padding:0.75rem 0px;">
									<input type="text" class="form-control" value="" name="dependent[0][dep_f_name]">
								</td>
								<td style="padding:0.75rem 0px;">
									<div class="input-group">
									  <div class="input-group-prepend">
										<span class="input-group-text">
										  +1
										</span>
									  </div>
									  <input type="text" class="form-control" value="" name="dependent[0][phone]">
									</div>
									
								</td>
								<td style="padding:0.75rem 0px;">
									<input type="date" class="form-control dateofbirth" value="" name="dependent[0][dob]">
								</td>
								<td>
									<a href="javascript:void(0)" class="btn btn-info btn-xs addNewRow"><i class="fa fa-plus"></i></a>
								</td>
							</tr> 
						
					</tbody>
				</table>
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
		</div>
	</div>
</div>	


			<script type="text/javascript">
				/* $('.dateofbirth').mask('00/00/0000'); */
			</script>	