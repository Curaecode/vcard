<style>
.modal-content {
	width:700px;
}
</style>
<div class="container">
	<form action="" method="post"  enctype="multipart/form-data" role="form" class="viewform" data-toggle="validator">
		  
		<div class="form-group row less_margin">
			<div class="col-sm-12">
				<table class="table" style="width:650px;">
					<thead>
						<tr>
							<th style="width:114px !important">Mem/Spouse/Child</th>
							<th style="width:562px !important">First Name</th>
							<th style="width:686px !important">Last name</th>
							<th style="width:686px !important">Phone</th>
							<th style="width:686px !important">Date of Birth</th> 
						</tr>
					</thead>
					<tbody id="dependent_table"> 
							<tr>
								<td>
									<select style="margin: 0px !important;" class="form-control" id="member_select" name="dependent[0][dependent]" required>
										<option value="">--Please Select--</option>
										<?php if(!empty($dependent)){ ?>
											<?php foreach($dependent as $rows){?> 
												<option value="<?php echo $rows->dependent_type;?>"><?php echo $rows->dependent_type;?></option>
											<?php } ?>
										<?php }?> 
									</select>
								</td>
								<td>
									<input type="text" class="form-control" value="" name="dependent[0][dependant_name]">
								</td>
								<td>
									<input type="text" class="form-control" value="" name="dependent[0][dep_f_name]">
								</td>
								<td>
									<input type="text" class="form-control" value="" name="dependent[0][phone]" required>
								</td>
								<td>
									<input type="date" class="form-control dateofbirth" value="" name="dependent[0][dob]" required <?php /* data-mask="00/00/0000" data-mask-selectonfocus="true" placeholder="mm/dd/yyyy" */ ?>>
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
			<script type="text/javascript">
				$('.dateofbirth').mask('00/00/0000');
			</script>	