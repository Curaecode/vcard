
	<div class="block animated fadeIn">
		<div class="block-header block-header-default">
			<h3 class="block-title">
				<?php 
					echo ucfirst($title);
				?>
			</h3>
			
			<?php if($title == 'Contact'){ ?>
				<button type="button"  style="margin-right:10px;" onclick='return sendallmail()' class="btn btn-sm btn-success js-tooltip-enabled sendcardbtn"  data-original-title="Send Card">Send Email</button>
				<button type="button"  style="margin-right:10px;" onclick='return sendallcard()' class="btn btn-sm btn-success js-tooltip-enabled sendcardbtn"  data-original-title="Send Card">Send Card</button>
			<?php }?>
			<?php if($title != 'Subscriptions' && $title != 'Email Logs'){ ?>
			<a class="loadview modalview" data-title='<?php echo "Add $title"; ?>' href="#<?php echo "$active/add"?>" >
				<button type="button" class=" btn btn-sm btn-success js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Add">
					<i class="fa fa-plus"></i> Add <?php echo ucfirst($title); ?>
				</button>
			</a>
			<?php }?>
			
			
		</div>
		<!-- row #1 -->
		<!-- Dynamic Table Full -->
		<div class="block">
				
				
			<?php
			if($active=="contacts"){ 
				if($id==""){
					
						?>
						<div class="block-content col-sm-12">
							<div class="row">
								<div class='col-sm-3'>
									<div class='form-group'>
										<label>Select company</label>
											<select class="form-control" name="company_id" required>
												<option value="all">--Select company--</option>
												<?php
													foreach($companies as $company){
														echo "<option value='$company->id'>$company->company_name</option>";
													}
												?>
											</select>
									</div>
								</div>
								<div class='col-sm-3'>
									<div class='form-group'>
										<label>Select Group</label>
											<select class="form-control" name="group_id" required>
												<option value="all">--Select group--</option>
												<?php
													foreach($groups as $group){
														echo "<option value='$group->id'>$group->group_name</option>";
													}
												?>
											</select>
									</div>
								</div>
								<!-- <div class='col-sm-3'>
							<div class='form-group'>
								<label></label>
								<input type='submit'  class='form-control btn btn-info' value="Filter" name='filter'>
							</div>
						</div> -->
							</div>
							
						</div>
					
					
				
				
			<?php
				}
			} 
			?>
					
				</div>
					
					
				<?php
			if($active=="orders"){ ?>
				<div class="block-content ">
					<div class="row">
						<div class='col-sm-4'>
							 <div class='form-group'>
								<label>From Date</label>
								<input type='text' class='datepicker form-control from_date' value="" name=''>
							</div>
						</div>
						<div class='col-sm-4'>
							 <div class='form-group'>
								<label>To Date</label>
								<input type='text'  class='datepicker form-control to_date' value="" name=''>
							</div>
						</div>
						<div class='col-sm-4'>
							<div class='form-group'>
								<label></label>
								<input type='submit'  class='form-control btn btn-info' value="Filter" name='filter'>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
				<div class="block-content ">
					
					
					
				
			
			<div class="block-content block-content-full" id="listingview">
				<!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
				<table data-id="<?php echo @$id; ?>" data-active2="<?php echo @$active2; ?>"  data-active="<?php echo @$active; ?>" class="table table-bordered table-striped table-vcenter datatable js-dataTable-full" id="basic-datatable">
					
					<thead>
						<tr role="row">
						<?php
							foreach($coloumns as $coloumn){
								echo "<th class='sorting' style='width:50px;'>$coloumn</th>";
							}
						?>
						 
						  
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END Dynamic Table Full -->
	<!-- end row #1 -->
	</div>

            <!-- END Main Container -->
<style>
.select2-container--default{
	width:100% !important;
}
</style>
	