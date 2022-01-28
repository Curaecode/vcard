<div class="row page-titles">
	<div class="col-md-5 col-12 align-self-center">
		<h3 class="text-themecolor mb-0"><?php  echo ucfirst($title); ?></h3>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
			<li class="breadcrumb-item active"><?php  echo ucfirst($title); ?></li>
		</ol>
	</div> 
</div>
<div class="block animated fadeIn">
<div class="block-content ">
	<div class="card card-body"> 
		<div style='margin:20px' class="alert alert-info" role="alert" align="center">
			Please refresh your page after updating the settings.
		</div>
		<!-- row #1 -->
		<!-- Dynamic Table Full -->
		<div class="block">
			<div class="block-content ">
				<form action="" method="post" enctype="multipart/form-data" class="viewform">
					<div class="row">
						<?php
						$flag=true;
						
						foreach($config as $key=>$field){
								
							?>
							<?php if($field->type=='color'){?>
								<div class='col-sm-6'>
									<div class='form-group'>
										<label><?php echo ucfirst($field->label); ?></label>
										
										<input type='<?php echo $field->type; ?>' value='<?php echo $field->value; ?>' class='form-control' name='<?php echo $field->name; ?>' >
										
										<div class="help-block with-errors"></div>
									</div>
								</div>
								
							<?php }else{ ?>
							<div class='col-sm-<?php if($field->type=='file'){?>6<?php }else{?>6<?php }?> <?php /* if($field->type=='radio'){?>fix_radio<?php } */ ?>'>
									<div class='form-group  py-2'>
										<label><?php echo ucfirst($field->label); ?></label>
										<?php
										if($field->type=='radio'){
											?>
											<div class="form-group">
												<div class="form-check form-check-inline">
												  <input class="form-check-input success" type="radio" name="<?php echo $field->name; ?>" id="<?php echo $field->name; ?>1"  value='1'  <?php echo $field->value=="1"?"checked":""; ?>>
												  <label class="form-check-label" for="<?php echo $field->name; ?>1">Enable</label>
												</div>
												<div class="form-check form-check-inline">
												  <input class="form-check-input danger" type="radio" name="<?php echo $field->name; ?>" id="<?php echo $field->name; ?>2"  value='0' <?php echo $field->value=="0"?"checked":""; ?>>
												  <label class="form-check-label" for="<?php echo $field->name; ?>2">Disable</label>
												</div>
											</div>	
											<?php /* <div class="form-check">
												<label class="form-check-label"><input type='radio' value='1' name='<?php echo $field->name; ?>' <?php echo $field->value=="1"?"checked":""; ?>> Enable</label>
											</div>	
											<div class="form-check">
												<label class="form-check-label"><input type='radio' value='0' name='<?php echo $field->name; ?>' <?php echo $field->value=="0"?"checked":""; ?>> Disable</label>
											</div> */ ?>
										<?php
										}else{
											?>
											<?php if($field->type=='file'){?>
											<div class="input-group">
												<div class="custom-file">
													<input type='<?php echo $field->type; ?>' value='<?php echo $field->value; ?>' class='form-control' name='<?php echo $field->name; ?>' > 
												</div> 
											</div>  
											<div class="help-block red">Only JPG allowed<br />Width:309px<br />Height:100px</div>
											<img style="width: 50px;padding: 9px;margin: 0 0 5px;"  id="blah1" src="<?php echo res_url()."admin/";echo isset($field->value) && $field->value!=="" ?$field->value:'defaultlogo.png'; ?>" class="profile-img" style=""  >
											
											<?php }else{ ?>
												<div class="form-group">
													<input type='<?php echo $field->type; ?>' value='<?php echo $field->value; ?>' class='form-control' name='<?php echo $field->name; ?>' > 
												</div>
											<?php } ?>
										<?php
										}
										?>
										<div class="help-block with-errors"></div>
									</div>
								</div>
							<?php } ?>
						<?php
						
						}
						?>
					</div>
					<div class="row text-center">
						<div class='col-sm-3'>
							<div class='form-group'>
								
								<div class="ms-auto mt-3 mt-md-0">
									<input type='submit' class="btn btn-info form-control" value="Submit" />
								</div>
								
								
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>
</div>
