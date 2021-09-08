<div class="container">
	<form action="" method="post"  enctype="multipart/form-data" role="form" class="viewform" data-toggle="validator">
		  
		<div class="form-group row less_margin">
			<div class="col-sm-12">
				<table class="table">
					<thead>
						<tr>
							<th style="width:114px !important">Mem/Spouse/Child</th>
							<th style="width:562px !important">First Name</th>
							<th style="width:686px !important">Last name</th>
							<th></th>
						</tr>
					</thead>
					<tbody id="dependent_table">
						<?php 
							if(!empty($edit["dependent"])){
									$dependents = json_decode($edit['dependent']);
									foreach($dependents as $key=>$row){ ?>
								<tr>
									<td>
										<select style="margin: 0px !important;" class="form-control" id="member_select" name="dependent[<?php echo $key ?>][dependent]" required>
											<option value="">--Please Select--</option>
											<?php if(!empty($dependent)){ ?>
											<?php foreach($dependent as $rows){?> 
												<option <?php if (isset($row->dependent)&& $rows->dependent_type == $row->dependent) { echo "selected"; } ?> value="<?php echo $rows->dependent_type;?>"><?php echo $rows->dependent_type;?></option>
											<?php } ?>
										<?php }?> 
										</select>
									</td>
									<td>
										<input type="text" class="form-control" value="<?php echo isset($row->dependant_name) ? $row->dependant_name:""; ?>" name="dependent[<?php echo $key ?>][dependant_name]">
									</td>
									<td>
										<input type="text" class="form-control" value="<?php echo isset($row->dep_f_name) ? $row->dep_f_name:""; ?>" name="dependent[<?php echo $key ?>][dep_f_name]">
									</td>
									<td>
										<?php if($key == 0){ ?>
											<a href="javascript:void(0)" class="btn btn-info btn-xs addNewRow"><i class="fa fa-plus"></i></a>
										<?php }else{ ?>
											<a href="javascript:void(0)" class="btn btn-danger btn-xs delete_row"><i class="fa fa-trash"></i></a>
										<?php } ?>
									</td>
								</tr>
						<?php } } else{ ?>
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
									<a href="javascript:void(0)" class="btn btn-info btn-xs addNewRow"><i class="fa fa-plus"></i></a>
								</td>
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
				