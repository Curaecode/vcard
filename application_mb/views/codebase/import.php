<?php if ($this->session->userdata('successVal')) { ?> 
   
   <div class="alert alert-success">
      <strong>Success!</strong> <?php echo $this->session->userdata('successVal'); ?>.
    </div>
<?php 
$this->session->unset_userdata('successVal');
} ?>
<nav class="breadcrumb push">
                       <span class="breadcrumb-item active">Import Data</span>
                    </nav>
					<div class="container animated fadeIn">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Import Data</h3>
                            </div>
                            <div class="block-content">
								<?php echo isset($msg)?$msg:""; ?>
<form action="<?php echo base_url();?>admin/dashboard/importFile" method="post" enctype="multipart/form-data">
Upload excel file : 
<input type="file" name="uploadFile" value="" /><br><br>
<input type="submit" name="submit" value="Upload" />
</form>
</div>
                        </div>
                    </div>