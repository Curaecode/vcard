<div class="block-header block-header-default">
	 <h3 class="block-title">&nbsp;</h3>
		<button type="button" style="margin-right:10px;" onclick="return sendallcarddependent();" class="btn btn-sm btn-success  sendcardbtn pull-right" data-original-title="Send Card">Send Card</button>  
	
</div>
<table  class="table table-bordered table-striped table-vcenter  js-dataTable-full" id="basic-datatables">
	<thead>
		<tr>
			<th><label><input type='checkbox' class='form-control' name='showhide' id='select_alldependent' onchange='selectalldependent(this)'> Select All</label></th>
			<th>Relation</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php if(!empty($contactdependent)){?>
		<?php foreach($contactdependent as $key => $value){?>
			<tr>
				<td><input type='checkbox' value='<?php echo $value->id;?>' class='checkboxdependent form-control'></td>
				<td><?php echo $value->relationship;?></td>
				<td><?php echo $value->first_name;?></td>
				<td><?php echo $value->last_name;?></td>
				<td>
					<a data-toggle='Send vCard' class='send send_contacts_email_vcard' title='Send vCard' href='<?php echo base_url();?>admin/dashboard/send_dependent_vcard/<?php echo $value->id;?>'><i class='fa fa-paper-plane'></i> </a>
					<a data-toggle="Delete" title="Delete" class="delete swal" href="<?php echo base_url();?>admin/dashboard/deletedependent/<?php echo $value->id;?>"><i class="fa fa-remove" style="color:red;"></i></a>
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