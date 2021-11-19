<div class="block-content "> 
	<div class="card card-body"> 
		<div class="block-content block-content-full"> 
			
<script>
 $('.modal-dialog').addClass('modal-lg');
</script>
<div class="container">
	<form action="" method="post" role="form" class="viewform">
		  
		<div class="form-group row less_margin">
			<div class="col-sm-12">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th style="width:150px;">Spouse / Dependent</th>
							<th style="width:200px;">First Name</th>
							<th style="width:200px;">Last name</th>
							<th style="width:200px;">Cell Number</th>
							<th style="width:100px;">Date of Birth</th>  
						</tr>
					</thead>
					<tbody id="dependent_table"> 
							<?php $counter=0;if(!empty($contactdependent)){?>
						<?php foreach($contactdependent as $key => $value){?>
							<tr>
								<td>
									<select style="margin: 0px !important;" class="form-control" id="member_select" name="dependent[<?php echo $counter; ?>][dependent]" required>
										<option value="">Please Select</option>
										<option value="Spouse" <?php echo ($value->relationship=='Spouse'?'selected':'');?>>Spouse</option>
										<option value="Dependent"  <?php echo ($value->relationship=='Dependent'?'selected':'');?>>Dependent</option> 
									</select>
								</td>
								<td>
									<input type="text" class="form-control" value="<?php echo $value->first_name;?>" name="dependent[<?php echo $counter; ?>][dependant_name]">
								</td>
								<td>
									<input type="text" class="form-control" value="<?php echo $value->last_name;?>" name="dependent[<?php echo $counter; ?>][dep_f_name]">
								</td>
								<td>
									<div class="input-group">
									  <div class="input-group-prepend">
										<span class="input-group-text">
										  +1
										</span>
									  </div>
									  <input type="text" class="form-control" value="<?php echo str_replace('+92','',str_replace('+1','',$value->phone));?>" name="dependent[<?php echo $counter; ?>][phone]">
									</div>
									
								</td>
								<td>
									<input type="date" class="form-control dateofbirth" value="<?php echo $value->dob;?>" name="dependent[<?php echo $counter; ?>][dob]">
									<input type="hidden" class="form-control" value="<?php echo $value->id;?>" name="dependent[<?php echo $counter; ?>][id]">
								</td>
								 <?php $counter++;?>
							</tr> 
						<?php } ?>
						<?php }else{ ?>
							<tr>
								<th colspan="5">No depedant Exist</th>
							</tr>
						<?php } ?>
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