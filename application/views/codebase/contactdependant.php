<table  class="table table-bordered table-striped table-vcenter  js-dataTable-full" id="basic-datatables">
	<thead>
		<tr>
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
				<td><?php echo $value->relationship;?></td>
				<td><?php echo $value->first_name;?></td>
				<td><?php echo $value->last_name;?></td>
				<td><a data-toggle="Delete" title="Delete" class="delete swal" href="<?php echo base_url();?>admin/dashboard/deletedependent/<?php echo $value->id;?>"><i class="fa fa-remove" style="color:red;"></i></a></td>
			<tr>
		<?php } ?>
	<?php }else{ ?>
		<tr>
			<th colspan="4">No depedant Exist</th>
		</tr>
	<?php } ?>
	</tbody>
</table>