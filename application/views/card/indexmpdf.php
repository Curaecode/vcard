<!DOCTYPE html>
 <html lang='en'>
<head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
<style type="text/css">
	@font-face {
		font-family: 'Roboto';
		font-style: normal;
		font-weight: normal;
		src: local('Roboto'), url('<?php echo base_url();?>cardassets/Roboto-Regular.woff') format('woff');
    }
     .card {
		position: relative;
		display: flex;
		flex-direction: column;
		min-width: 0;
		word-wrap: break-word;
		background-color: #fff;
		background-clip: border-box;
		border: 1px solid rgba(0,0,0,.125);
		border-radius: 0.25rem;
	}
	*, ::after, ::before {
		box-sizing: border-box;
	}
	body {
		 margin: 0;
		font-family: var(--bs-body-font-family);
		font-size: var(--bs-body-font-size);
		font-weight: var(--bs-body-font-weight);
		line-height: var(--bs-body-line-height);
		color: var(--bs-body-color);
		text-align: var(--bs-body-text-align);
		background-color: var(--bs-body-bg);
		-webkit-text-size-adjust: 100%;
		-webkit-tap-highlight-color: transparent; 
	}
	.card-body {
		flex: 1 1 auto;
		padding: 1rem 1rem;
	}
	.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
		margin-top: 0;
		margin-bottom: 0.5rem;
		font-weight: 500;
		line-height: 1.2;
	}
	.row {
		 --bs-gutter-x: 1.5rem;
		--bs-gutter-y: 0;
		display: flex;
		flex-wrap: wrap;
	} 
	.row>* {
		flex-shrink: 0;
		width: 100%;
		max-width: 100%;
		padding-right: calc(var(--bs-gutter-x) * .5);
		padding-left: calc(var(--bs-gutter-x) * .5);
		margin-top: var(--bs-gutter-y);
	}
	.col-sm-6 {
		flex: 0 0 auto;
		width: 50%; 
	}
	.col-sm-2 {
		flex: 0 0 auto;
		width: 16.66667%;
	}
	.col-sm-3 {
		flex: 0 0 auto;
		width: 25%;
	}
	.col-sm-4 {
		flex: 0 0 auto;
		width: 25%;
	}
	.col-sm-4 {
		flex: 0 0 auto;
		width: 33.33333%;
	}
	.col-sm-5 {
		flex: 0 0 auto;
		width: 41.66667%;
	}
	.col-sm-8 {
		flex: 0 0 auto;
		width: 66.66667%;
	}
	.col-sm-7 {
		flex: 0 0 auto;
		width: 58.33333%;
	} 
	.col-sm-9 {
		flex: 0 0 auto;
		width: 75%;
	}
	.col-sm-12 {
		flex: 0 0 auto;
		width: 100%;
	}
	dt {
		font-weight: 700;
	} 
	.text-danger {
		--bs-text-opacity: 1;
		color: rgb(220, 53, 69) !important;
	}
		body{
			background:#f6f6f6;
			font-family: 'Roboto', sans-serif;
		}
		img, svg {
			vertical-align: middle;
		}
		.xcard{
			margin:25px;
			width:330px;
			background-color: #fff;
			transition: all .5s ease-in-out;
			position: relative;
			border: 2px solid #fff;
			border-radius: 8px; 
			overflow:hidden;
			height:204px;
			float:left;
		}
		.xcard .card-head{
			background-image:url(<?php echo base_url();?>cardassets/bg.jpg);
			height:100px;
			width:100%; 
			background-size: cover;
			background-position: center center;
			background-repeat: no-repeat;
			z-index: 9;
		}
		.avatar{
			width:200px;
			height:80px;
			display:block;
			margin: 5px auto 10px;
			border: 5px solid #fff;
			border-radius: 6px; 
		}
		.qravatar{
			 width: 123px;
			height: 123px; 
			<?php if($showdependent->value==1 && isset($dependent) && !empty($dependent)){?>margin: 0px auto;<?php }else{?>margin: 0px auto 20px;<?php } ?>
			border: 0px solid #fff;
		}
		.avatar img{
			width:100%;
			height: 100%;
		}
		.xcard .card-body{
			padding:20px 5px 5px 5px;
			background:#fff; 
			 
		}
		.xcard.back .card-body{
			padding:20px 5px 5px 5px;
			background:#fff;
			background-image:url(<?php echo base_url();?>cardassets/bg-texture-2.png);
			 
		}
		.xcard .card-body .card-heading{
			text-align:center;
			margin-bottom:15px;
		}
		.xcard .card-body .card-heading .card-title{
			margin:0px;
			font-weight:700;
			font-size:24px;
		}
		.xcard .card-body .card-heading .card-text{
			margin:0px;
			font-size:14px;
			font-weight:700;
		}
		.xcard .card-body .user-data dl{
			margin:0px;
		}
		.xcard .card-body .user-data dt{
			font-size:12px;
		}
		.xcard .card-body .user-data dd{
			font-size:14px;
			text-align: left;
			margin: 0px;
			padding: 0px;
		}
		.xcard  .card-highlight{
			background:#242424;
			padding:10px 10px;
			text-align:center;
			bottom:0;
			position:absolute;
		}
		.xcard  .card-highlight p{
			font-size:10px;
			color:#fff;
			margin:0px;
		}
	</style>
 </head>
<body>
<div class="card xcard front" style="margin:25px; width:325px; background-color: #fff; transition: all .5s ease-in-out; position: relative; border: 1px solid transparent; border-radius: 8px; overflow:hidden; height: 500px; float:left;">
	<div class="card-head" style="height:100px;border-radius: 5px 5px 0px 0px;">
		<div class="row">
			<div class="col-sm-5" style="float:left;">
				<img style="width: 125px;margin-top: 5px;margin-left: 9px;" src="<?php echo base_url().'cardassets/cc-logo-white.png';?>" alt="user" />
			</div>
			<div class="col-sm-5" style="float:right;">
				<?php /* <img style="width: 140px;margin-top: 5px;" src="<?php echo base_url().'cardassets/ph-email-white.png';?>" alt="user" /> */ ?>
				<p style="margin-top: 4px; padding: 0px;  margin-bottom: 0px;"><a href="tel:18006469823"><img style="width: 140px;margin-top: 5px;margin-left: -10px;" src="<?php echo base_url().'cardassets/phone.png';?>" alt="user" /></a></p>
				<p style="margin: 0px; margin-top: -8px;"><a href="mailto:support@curaechoice.com"><img style="width: 140px;margin-top: 3px;margin-left: -10px;" src="<?php echo base_url().'cardassets/email.png';?>" alt="user" /></a></p>
			</div>
		</div> 
	</div>
	 <div class="avatar" style="z-index: 99;width:250px; height:50px; display:block; margin: 0px auto 10px;margin-top:-50px; border: 2px solid #fff; border-radius: 6px; box-shadow: 0px 2px 4px 2px rgb(0 0 0 / 15%);background:#fff;">
		<img src="<?php echo base_url().'resources/admin/'.str_replace('_thumb.','.',$image->value);?>" alt="user" />
	</div> 
	<div class="card-body" style="flex: 1 1 auto; padding: 0px 1rem;height:350px">
		<div class="card-heading">
			<?php if($showname->value==1){ ?>
			<h5 class="card-title"><?php echo ucwords($contact->first_name." ".$contact->last_name);?></h5> 
			<?php } ?>
			<?php $account_id=(!empty($contact->account_code)?$contact->account_code:''); ?>
			<p class="card-text"><?php echo $account_id;?></p>
		</div>
		<div class="user-data">
			<div class="row">
				<?php if($showdependent->value==1){ ?>
					<?php if(isset($dependent) && !empty($dependent)){?>
					<div class="col-sm-5" style="float:left;padding:0px;margin:0px;">	
						<dl class="row" style="margin-top: 5px;">
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
											<?php /* <dt class="col-sm-2"><?php echo $dependent_datas;?></dt>
											<dd class="col-sm-9"><?php echo $dependent_data2;?></dd>  */ ?>
											<dd class="col-sm-12"><strong><?php echo $dependent_datas;?>:</strong> <?php echo $dependent_data2;?></dd>
										<?php } ?>
							<?php } ?>
						</dl>
					</div>		
					<?php } ?> 
				<?php } ?>
				<?php if($showdependent->value==1 && isset($dependent) && !empty($dependent)){  $col='5'; }else{$col='12'; } ?>
				<div class="col-sm-<?php echo $col;?>"  <?php if($showdependent->value==1 && isset($dependent) && !empty($dependent)){?>style="float:right;padding:0px;margin:0px;"<?php }?>>
					<div class="qravatar" <?php if($showdependent->value==1 && isset($dependent) && !empty($dependent)){?>style="width:100%;margin-left:40px;text-align: right;"<?php }?>><img src="<?php echo base_url().'resources/qrimage/'.$contact->qrimage;?>" alt="user" />
					<?php $date=date("M d,Y",strtotime($contact->active_member));?>
					<p style="margin:0px 0px 0px 0px; font-size:12px; text-transform:uppercase; font-weight:600; line-height:23px; color:#ff0000; padding:5px 0px;text-align:center;"><?php echo $date;?></p>
					</div>
					
				</div> 
			</div> 
		</div> 
	</div>  
	<div class="card-highlight" style="border-radius: 0px 0px 5px 5px;font-size:12px;padding:5px 5px;">
		<p style="margin:0px; padding:0px 0px;">This card is the property of CuraeChoice, LLC. If found please return to 3179 Green Valley Rd. Suite 634, Vestavia, AL 35243-5239</p>
	</div>
</div> 

<div class="card xcard back" style="margin:25px; width:325px; background-color: #fff; transition: all .5s ease-in-out; position: relative; border: 1px solid transparent; border-radius: 5px;  overflow:hidden; height: 550px; float:left;">
	<div class="card-head" style="height: 50px;border-radius: 5px 5px 0px 0px;">
		<div class="row">
			<div class="col-sm-5" style="float:left;">
				<img style="width: 125px;margin-top: 5px;margin-left: 10px;" src="<?php echo base_url().'cardassets/cc-logo-white.png';?>" alt="user" />
			</div>
			<div class="col-sm-5" style="float:right;">
				<p style="margin-top: 4px; padding: 0px;  margin-bottom: 0px;"><a href="tel:18006469823"><img style="width: 140px;margin-top: 5px;margin-left: -10px;" src="<?php echo base_url().'cardassets/phone.png';?>" alt="user" /></a></p>
				<p style="margin: 0px; margin-top: -8px;"><a href="mailto:support@curaechoice.com"><img style="width: 140px;margin-top: 3px;margin-left: -10px;" src="<?php echo base_url().'cardassets/email.png';?>" alt="user" /></a></p>
			</div>
		</div> 
	</div>
	<div class="card-body" style="padding: 13px 10px 0px 13px;flex: 1 1 auto;height: 470px;">
		<div class="card-heading"> 
			<h5 class="card-title text-danger">Terms & Conditions</h5>   
		</div>
		<div class="user-data" style="flex: 1 1 auto;">
			<div class="row"> 
				<div class="col-sm-12">	
					<ul style="width:295px;margin: 10px 5px 0px 15px;padding: 0px; font-size:12px;text-align: justify;">
						<li>CuraeChoice is a benefit plan optimizer provider by and through your employer.</li>
						<li>No-Co-pay, Deductibles or Co-Insurance.</li>  
						<li>Information for Providers:
							<ul style="width:295px;margin: 10px 5px 0px 15px;padding: 0px; font-size:12px;text-align: justify;">
								<li>Send electronics claims to payer ID CC304</li>
								<li>For eligibility verification sign up at <a href="https://monday.com/" target="_blank">Monday.com</a></li>
							</ul>
						</li>  
					</ul>
				</div>	 	 
			</div> 
			<div class="row"> 
				<div class="col-sm-12">	
					<ul style="width:295px;margin-top: 10px;padding: 0px;font-size:14px;color:#88bd23;list-style-type: none;text-align: justify;">
						<li>The Right Choice, The Best Choice, The Only Choice, CuraeChoice.</li> 
					</ul>
				</div> 
			</div> 
		</div> 
	</div>  
	<div class="card-highlight" style="width:330px;background:#242424;padding: 10px 0px;text-align: center;min-height:200px;bottom:0; position:absolute;border-radius: 0px 0px 5px 5px">
		 <?php if(!empty($providers)){  $counter=1;?> 
			 
			<?php foreach($providers as $row){ ?>  
				<span style=" padding:15px 15px !important; float:left;">
					<?php  $mainURL = base_url(); ?>
					<a href="<?php echo $mainURL.$row->slug;?>" target="_blank"><img height="30" alt="curaechoice" src="<?php echo base_url();?>resources/admin/<?php echo $row->image;?>"></a>
				</span> 	 
			<?php }?>
			 
		<?php }?>
	</div>
</div>
</body>
</html>