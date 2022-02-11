<div class="row page-titles">
	<div class="col-md-5 col-12 align-self-center">
		<h3 class="text-themecolor mb-0"><?php  echo ucfirst($title); ?></h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
			<li class="breadcrumb-item active"><?php  echo ucfirst($title); ?></li>
		</ol>
	</div> 
</div>

<div class="card card-body">
	<div class="row">
			<div class="col-md-4 col-xl-2">
				<form>
					<input type="text" class="form-control product-search"  id="myInputTextField" placeholder="Search ...">
				</form>
			</div>
			<div class="col-md-8 col-xl-10 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
				 <?php if($title == 'Contact'){ ?>
					<button type="button"  style="margin-right:10px;" onclick='return sendpdfmail()' class="btn btn-sm btn-success js-tooltip-enabled sendcardbtn"  data-original-title="Send Card">Send PDF Email</button>
					<button type="button"  style="margin-right:10px;" onclick='return sendallmail()' class="btn btn-sm btn-success js-tooltip-enabled sendcardbtn"  data-original-title="Send Card">Send Email</button>
					<button type="button"  style="margin-right:10px;" onclick='return sendallcard()' class="btn btn-sm btn-success js-tooltip-enabled sendcardbtn"  data-original-title="Send Card">Send Card</button>
				 <?php } ?>
				 <?php if($title != 'Subscriptions' && $title != 'Email Logs' && $title != 'URL Access Log' && $title != 'Providers Access Log' && $title != 'Card Access Log' && $title != 'Twillio Access Log'){ ?>
					<a href="#<?php echo "$active/add"?>" id="btn-add-contact" class="btn btn-info loadview modalview" data-title='<?php echo "Add $title"; ?>'>  Add <?php echo ucfirst($title); ?></a> 
					<?php }?>
				 
			</div>
	</div>
</div>


	<div class="block animated fadeIn">
		 
		<!-- row #1 -->
		<!-- Dynamic Table Full -->  
				<div class="block-content "> 
			<div class="card card-body"> 
					<div class="block-content block-content-full" id="listingview"> 
						<table data-id="<?php echo @$id; ?>" data-active2="<?php echo @$active2; ?>"  data-active="<?php echo @$active; ?>" <?php /*  class="table table-bordered table-striped table-vcenter datatable js-dataTable-full search-table v-middle" */ ?> id="basic-datatable"  class="table table-bordered table-striped table-vcenter datatable " > 
							<thead>
								<tr role="row">
								<?php $counter=0;
									foreach($coloumns as $key=>$coloumn){
										if($counter==0){
											echo "<th class='sorting_disabled'>$coloumn</th>";
										}else{
											echo "<th class='sorting'>$coloumn</th>";
										}
										$counter++;
									}
								?>
								 
								  
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				 
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
	