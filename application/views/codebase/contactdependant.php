<div class="block-content "> 
	<div class="card card-body"> 
		<div class="block-content block-content-full"> 
			
<script>
 $('.modal-dialog').addClass('modal-xl');
</script>
 <div class="alert alert-light-info text-info alert-dismissible fade show" role="alert">
	<div class="d-flex text-info font-weight-medium text-end d-flex justify-content-md-end justify-content-center">
		 <button type="button" style="margin-right:10px;" onclick="return sendallcarddependent();" class="btn btn-sm btn-success  sendcardbtn pull-right" data-original-title="Send Card"><i class="fa fa-paper-plane"></i> Send SMS</button> 
	</div> 
</div> 

<table  class="table table-bordered table-striped table-vcenter  js-dataTable-full" id="basic-datatables">
	<thead>
		<tr>
			<th>
			<div class='form-check'><input class='form-check-input' type='checkbox' id='select_alldependent'  onchange='selectalldependent(this)'><label class='form-check-label' for='select_alldependent'>Select All</label></div> </th>
			<th width="10%">Relation</th>
			<th width="20%">First Name</th>
			<th width="20%">Last Name</th>
			<th width="20%">Cell Number</th>
			<th width="20%">Date of Birth</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
	<?php if(!empty($contactdependent)){?>
		<?php foreach($contactdependent as $key => $value){?>
			<tr>
				<td>
				<div class='form-check'><input class='form-check-input checkboxdependent' value='<?php echo $value->id;?>' type='checkbox' ></div>
				</td>
				<td><?php echo $value->relationship;?></td>
				<td><?php echo $value->first_name;?></td>
				<td><?php echo $value->last_name;?></td>
				<td><?php echo $value->phone;?></td>
				<td><?php if($value->dob!='0000-00-00'){ echo usadate($value->dob);}?></td>
				<td>  
					<div class="columns columns-right mb-2 btn-group pull-right"><a data-toggle='Send vCard' class='btn btn-default send send_contacts_email_vcard' title='Send vCard' href='<?php echo base_url();?>admin/dashboard/send_dependent_vcard/<?php echo $value->id;?>'><i class='fa fa-paper-plane'></i> </a>
					<a data-toggle="Delete" title="Delete" class="btn btn-danger delete swal" href="<?php echo base_url();?>admin/dashboard/deletedependent/<?php echo $value->id;?>"><i class="fas fa-trash"></i></a></div>
				</td>
			<tr>
		<?php } ?>
	<?php }else{ ?>
		<tr>
			<th colspan="4">No depedant Exist</th>
		</tr>
	<?php } ?>
	</tbody>
</table>
		</div>
	</div>
</div>	
