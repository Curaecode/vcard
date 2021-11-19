<script>
 $('.modal-dialog').addClass('modal-lg');
</script>
<div class="block-content "> 
	<div class="card card-body"> 
			<div class="block-content block-content-full" > 
				<table  class="table table-bordered table-striped table-vcenter  js-dataTable-full" id="basic-datatables">
					<thead>
						<tr>
							<th>Sr.</th> 
							<th>First Name</th>
							<th>Last Name</th>
							<th>Current Phone Number</th>
							<th>Phone Number</th>
							<th>SMS Date</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
					<?php if(!empty($smslogs)){ $counter=1;?>
						<?php foreach($smslogs as $key => $value){?>
							<tr>
								<td><?php echo $counter++;?></td> 
								<td><?php echo $value->first_name;?></td>
								<td><?php echo $value->last_name;?></td>
								<td><?php echo $value->phonenumber;?></td>
								<td><?php echo $value->phone_number;?></td> 
								<td><?php echo cdate($value->added_date);?></td> 
								<td><?php if($value->sendstate==1){echo 'Success';}elseif($value->sendstate==2){echo 'Fail';} ?></td> 
							<tr>
						<?php } ?>
					<?php }else{ ?>
						<tr>
							<th colspan="7">No depedant Exist</th>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div> 
	</div> 
</div>
