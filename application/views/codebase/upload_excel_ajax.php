<div class="row page-titles">
	<div class="col-md-5 col-12 align-self-center">
		<h3 class="text-themecolor mb-0">Import Data</h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
			<li class="breadcrumb-item active">Import Data</li>
		</ol>
	</div> 
</div>
<?php if ($this->session->userdata('successVal')) { ?> 
<div class="card card-body">
	<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="alert alert-success">
				   <strong>Success!</strong> <?php echo $this->session->userdata('successVal'); ?>.
				</div>
			</div> 
	</div>
</div>
   <?php 
   $this->session->unset_userdata('successVal');
   } ?> 
 
 
 
	<div class="block animated fadeIn"> 
		<!-- row #1 -->
		<!-- Dynamic Table Full -->  
		<div class="block-content "> 
			<div class="card card-body">  
	
				<div class="row">
				   <div class="col-sm-12">
					  <div class="container animated fadeIn">
				   <div class="block">
					  <div class="block-header block-header-default">
						 <h3 class="block-title">Import Data</h3>
					  </div>
					  <div class="row append_colum">
						 <div class="col-sm-9 sidegapp">
							<div class="block-content upload_card_portal">
						 <img src="<?php echo res_url(); ?>img/loader_se.gif" id="image1" style="display: none;">
						 <div class="row">
							<div class="col-sm-4 ">
							   <?php echo isset($msg)?$msg:""; ?>
							   <!-- <form action="<?php echo base_url();?>admin/dashboard/upload_excel" method="post" enctype="multipart/form-data"> -->
							   Upload excel file : 
							   <input type="file" name="uploadFile" value="" class="change_file_name" />
							   <div class="msg"></div>
							</div>
							<div class="col-sm-8">
							   
							   <div class="row">
									 <input type="submit" name="submit" class="btn btn-info" value="Upload" id="submit_file" style="display: none;" />
									  <div class="wizard_validation check_validate" style="display: none;">
								  <button style="display: inline;border: none;" class="validation btn btn-info">Check Validation</button>
									 
								  </div>
								  <div class="col-sm-12">
									 <input type="hidden" id="file_name" value="">
									 <img src="<?php echo res_url(); ?>img/loader_se.gif" id="image2" style="display: none; ">
										<div class="bulk_msg"></div>
								  </div>
								  
							   </div>
								  
							</div>
						 </div>
						 
						 <div class="row">
							<div class="col-sm-6">
							   <div class="wizard_validation" style="display: none;">
								  
								  <div class="validation_box">Validation</div>
								  <div class="progress" id="progressbar">
									 <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="progressbar_validation">
										<span>
										   <p class="validation_process" style="display: inline;">0 </p>
										   % Complete 
										</span>
									 </div>
								  </div>
							   </div>
							</div>
							<div class="col-sm-6 " style="    padding: 8px 0 0;">
							   <div class="wizard_upload" style="display: none;">
								  <img src="<?php echo res_url(); ?>img/loader_se.gif" id="image3" style="display: none;">
								  <div class="uploadFile_data">Upload Data</div>
								  <div class="progress">
									 <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="100" aria-valuemax="100" style="width: 0%" id="progressbar_submit">
										<span>
										   <p style="display: inline;" class="submit_process">0 </p>
										   % Complete 
										</span>
									 </div>
								  </div>
								  
							   </div>
							</div>
							<div class="col-sm-12 wizard_upload  upload_data" style="display: none;">
							   <button style="display: inline;    margin: 0;" id="upload_file_excel" class=" btn btn-info">Submit</button>
							</div>
						 </div>
						 
					  </div>
						 </div>
						 <div class="col-sm-3 download_btn">
							<a style="border: none;" class="btn btn-info" href="<?php echo res_url(); ?>file/sampl.xlsx" target="_blank"><i class="fa fa-file-excel-o"></i> Download sample sheet</a>
						 </div>
					  </div>
					  
				   </div>
				</div>
				   </div>
				</div>

				</div>	
			
		</div>
		<!-- END Dynamic Table Full -->
	<!-- end row #1 -->
	</div>