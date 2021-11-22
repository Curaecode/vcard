<div class="print-preview-wrapper" style="margin-bottom:20px">   <div class="print-preview" style="padding: 0px; max-width: 8.3in; margin: auto;">    
<div class="print-format" style="display: flex; flex-direction: column;min-height: 0in; padding: 0in; margin-top: 0mm; margin-left: 0mm; margin-right: 0mm; margin-bottom: 0mm;background-color: white;  box-shadow: 0px 0px 9px rgb(0 0 0 / 50%); max-width: 8.3in;">  
<div style="<?php /* transform: scale(0.334,0.334); margin:0px auto; background:#f3fafb; */ ?>">
<table cellspacing="0" cellpadding="0" border="0" height="100%" width="100%">
<tbody><tr>
<td>
	<table cellspacing="0" cellpadding="0" border="0" bgcolor="#fff" align="center" height="100%" width="100%">
	<tbody>
		<tr>
		<td align="center" style="background:#ffffff;" valign="top">
			<table cellspacing="0" cellpadding="0" border="0" height="232" width="100%" >
				<tbody>
				<tr>
				<td align="left" valign="middle" bgcolor="#fff" style="padding:15px  !important;background: rgb(255 255 255 / 40%);  background-repeat: no-repeat;background-size: contain;background-position: right top;background-image: url(<?php echo base_url().'cardassets/topimage.png';?>);">
				</td>
				</tr>
				</tbody>
			</table>
		</td>
		</tr>

		<tr>
		<td align="center" style="background:#f3fafb;" valign="top">
			<table cellspacing="0" cellpadding="0" border="0" height="175" style="margin-top:-100px;box-shadow: 0px 0px 9px rgb(0 0 0 / 50%);" width="250">
			<tbody>
				<tr>
				<td align="center" valign="middle" bgcolor="#fff" style="padding:0px  !important; background:none;"><img style="border-radius: 5px;border: 10px solid #fff;display: block;" height="175" alt="user" src="<?php echo base_url().'resources/admin/'.$image->value;?>">
				</td>
				</tr>
			</tbody>
			</table>
		</td>
		</tr>

		<tr>
		<td align="center" style="background:#f3fafb;" valign="top">
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tbody>
				<tr>
					<th colspan="2" align="center" style="padding:15px; text-align: center;">
					<?php if($showname->value==1){ ?>
					<h1 style="margin:10px 0px; font-size:40px; font-weight:bold; line-height:60px; color:#212121;"><?php echo ucwords($contact->first_name." ".$contact->last_name);?></h1>
					<?php } ?>
					<?php $account_id=(!empty($contact->account_code)?$contact->account_code:''); ?>
					<p style="margin:5px 0px 0px 0px; font-size:24px; text-transform:uppercase; font-weight:600; line-height:23px; color:#212121; padding:5px 0px;"><?php echo $account_id;?></p>
					
					</th>
				</tr>
				<tr>
					<td colspan="2" style="padding:5px 15px;"></td>
				</tr>
				<tr>
				<?php if($showdependent->value==1){ ?>
				<?php if(isset($dependent) && !empty($dependent)){?>
					<td style="padding:0px 10px  !important;" valign="top" align="center">
						<table cellspacing="0" cellpadding="0" border="0" width="100%">
							<tbody>
								<?php foreach($dependent as $key => $value){ ?>
									<?php if(!empty($value->relationship) || !empty($value->first_name) || !empty($value->last_name)){?>
										<?php 
											$dependent_data =(isset($value->relationship) && !empty($value->relationship)) ? $value->relationship.':':'';
											$datadependent = explode(' ',trim($dependent_data)); 
											if(count($datadependent) > 1){ 
												$dependent_datas=$datadependent[1];
											}else{
												$dependent_datas = $datadependent[0];
											} 
											$mystring = strtolower($dependent_datas);  
											$findme   = 'spouse';
											$pos = strpos($mystring, $findme);
											
											if ($pos === false){
												$dependent_datas = 'D';
											}else{
												$dependent_datas = 'S';
											}
											$dependent_datas=$dependent_datas.' ';
											$dependent_data2 = '';
						
										$dependent_data2.=(isset($value->first_name) && !empty($value->first_name)) ? ucwords($value->first_name):'';
										$dependent_data2.=(isset($value->last_name)  && !empty($value->last_name)) ? ' '.ucwords($value->last_name):'';
										?>
										<tr style="font-size:16px;">
											<td style="padding:8px 10px  !important;" width="15%"></td>
											<td style="padding:8px 10px  !important;" width="15%"><strong><?php echo $dependent_datas;?></strong></td>
											<td style="padding:8px 10px  !important;" width="10%">:</td>
											<td style="padding:8px 10px  !important;" width="55%"><strong><?php echo $dependent_data2;?></strong></td>
											<td style="padding:8px 10px  !important;" width="5%"></td>
										</tr>
									<?php } ?>
								<?php } ?>
								
								
							</tbody>
						</table>
					</td> 
				<?php } ?>	
				<?php } ?>	
					<td <?php if($showdependent->value==1 && isset($dependent) && !empty($dependent)){ ?>colspan="1"<?php }else{ ?>colspan="2"<?php } ?> align="center" valign="top" bgcolor="#fff" style="padding:0px  !important; background:none;">
						<img style="border-radius: 5px;border: 10px solid #fff;display: block;" height="240" alt="user" src="<?php echo base_url().'resources/qrimage/'.$contact->qrimage;?>">
						<?php $date=date("M d,Y",strtotime($contact->active_member));?>
						<p style="margin:5px 0px 0px 0px; font-size:24px; text-transform:uppercase; font-weight:600; line-height:23px; color:#ff0000; padding:5px 0px;"> <?php echo $date;?></p>
					</td>
				</tr> 
				<tr>
					<td colspan="2" style="padding: 13px  !important;"></td>
				</tr>

			</tbody>
			</table>
		</td>
		</tr>
		<tr>
		<td align="center" style="background:#f3fafb;" valign="top">
			<table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-top:1px solid #dae4f5; border-bottom:8px solid #4e4e4e;background-repeat: no-repeat;background-size: cover;background-position: right top;background-image: url(<?php echo base_url();?>cardassets/bottom-b-bg.png);">
			<tbody>
			<tr>
				<td align="center" valign="middle" style="padding:15px 0px !important;line-height: 20px; color:#fff;font-family:Arial;font-size:20px">This card is the property of Curaechoice (Pvt.) Ltd. <br>If found please return to:<br>3179 Green Valley Road, Suite 634,<br> Vestavia, AL 35243-5239. Phone: 1 800 646 9823<br> www.curaechoice.com
				</td>
										
			</tr>
			<tr>
				<td style="padding: 13px  !important;"></td>
			</tr>
			</tbody>
			</table>
		</td>
		</tr>
		<?php if(!empty($providers)){ ?>
		<tr>
		<td align="center" style="background:#f3fafb;" valign="top">
			<table cellspacing="0" cellpadding="0" border="0" width="100%" style=" background:#e9f7fe;">
			<tbody>
			<tr>
			<?php foreach($providers as $row){ ?>  
				<td align="left" valign="top" style="padding:20px 10px !important;">
					<img height="55" alt="curaechoice" src="<?php echo base_url();?>resources/admin/<?php echo $row->image;?>">
				</td> 	 
			<?php }?>
			</tr>
			</tbody>
			</table>
		</td>
		</tr>
		<?php }?>
		<tr>
		<td align="center" style="background:#f3fafb;" valign="top">
			<table cellspacing="0" cellpadding="0" border="0" width="100%" style=" background:#e9f7fe;">
			<tbody>
			<tr> 
				<td align="left" valign="top" style="padding:20px 10px !important;">
					<img style="width:100%" alt="curaechoice" src="<?php echo base_url();?>cardassets/bottomcard.png">
				</td> 		
			</tr>
			</tbody>
			</table>
		</td>
		</tr>
	</tbody>
	</table>
</td>
</tr>
</tbody></table>
</div>
</div>   
</div>  
</div>


<div class="print-preview-wrapper">   <div class="print-preview" style="padding: 0px; max-width: 8.3in; margin: auto;">    
<div class="print-format" style="display: flex; flex-direction: column;min-height: 0in; padding: 0in; margin-top: 0mm; margin-left: 0mm; margin-right: 0mm; margin-bottom: 0mm;background-color: white;  box-shadow: 0px 0px 9px rgb(0 0 0 / 50%); max-width: 8.3in;">  
<div style="<?php /* transform: scale(0.334,0.334); margin:0px auto; background:#f3fafb; */ ?>">
<table cellspacing="0" cellpadding="0" border="0" height="100%" width="100%">
<tbody><tr>
<td>
	<table cellspacing="0" cellpadding="0" border="0" bgcolor="#fff" align="center" height="100%" width="100%">
	<tbody>
		<tr>
		<td align="center" style="background:#ffffff;" valign="top">
			<table cellspacing="0" cellpadding="0" border="0" height="132" width="100%" >
				<tbody>
				<tr>
				<td align="left" valign="middle" bgcolor="#fff" style="padding:15px  !important;background: rgb(255 255 255 / 40%);  background-repeat: no-repeat;background-size: contain;background-position: right top;background-image: url(<?php echo base_url().'cardassets/topimage.png';?>);">
				</td>
				</tr>
				</tbody>
			</table>
		</td>
		</tr> 
		<tr>
		<td align="center" style="background:#f3fafb;" valign="top">
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tbody>
				<tr>
					<th colspan="2" style="padding:15px; text-align: left;">
					  
					 
					<p style="margin:5px 0px 0px 0px; font-size:24px; text-transform:uppercase; font-weight:600; line-height:23px; color:#ff0000; padding:5px 0px;">Term & Conditions</p>
					
					</th>
				</tr>
				<tr>
					<td colspan="2" style="padding:15px 15px;"></td>
				</tr>
				<tr>
					<td colspan="2" style="padding:15px 15px;font-family:Arial;">
						<ul>
							<li>This is only valid for Identification in emergency Hospitalization.</li>
							<li>Original CNIC should be presented with this card.</li>
							<li>Hospital/Participant holder should intimate Curaechoice within 24 hours of hospitalization </li>
						</ul>
					
					</td>
				</tr>
				 
				<tr>
					<td colspan="2" style="padding: 13px  !important;"></td>
				</tr>

			</tbody>
			</table>
		</td>
		</tr>
		 
		<?php if(!empty($providers)){ ?>
		<tr>
		<td align="center" style="background:#f3fafb;" valign="top">
			<table cellspacing="0" cellpadding="0" border="0" width="100%" style=" background:#e9f7fe;">
			<tbody>
			<tr>
			<?php foreach($providers as $row){ ?>  
				<td align="left" valign="top" style="padding:20px 10px !important;">
					<img height="55" alt="curaechoice" src="<?php echo base_url();?>resources/admin/<?php echo $row->image;?>">
				</td> 	 
			<?php }?>
			</tr>
			</tbody>
			</table>
		</td>
		</tr>
		<?php }?>
		<tr>
		<td align="center" style="background:#f3fafb;" valign="top">
			<table cellspacing="0" cellpadding="0" border="0" width="100%" style=" background:#e9f7fe;">
			<tbody>
			<tr> 
				<td align="left" valign="top" style="padding:20px 10px !important;">
					<img style="width:100%" alt="curaechoice" src="<?php echo base_url();?>cardassets/bottomcard.png">
				</td> 		
			</tr>
			</tbody>
			</table>
		</td>
		</tr>
	</tbody>
	</table>
</td>
</tr>
</tbody></table>
</div>
</div>   
</div>  
</div>