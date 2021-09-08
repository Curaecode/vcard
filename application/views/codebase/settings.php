<div class="block animated fadeIn">
	<div class="block-header block-header-default">
		<h3 class="block-title">
			<?php 
				echo ucfirst($title);
			?>
		</h3>
	</div>
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
							<div class='col-sm-6 fix_radio'>
								<div class='form-group '>
									<label><?php echo ucfirst($field->label); ?></label>
									<?php
									if($field->type=='radio'){
										?>
										<input type='radio' value='1' name='<?php echo $field->name; ?>' <?php echo $field->value=="1"?"checked":""; ?>>Enable
										<input type='radio' value='0' name='<?php echo $field->name; ?>' <?php echo $field->value=="0"?"checked":""; ?>>Disable
									<?php
									}
									else{
										?>
										<input type='<?php echo $field->type; ?>' value='<?php echo $field->value; ?>' class='form-control' name='<?php echo $field->name; ?>' >
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
							<input type='submit' class="btn btn-info form-control" value="Submit" />
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
