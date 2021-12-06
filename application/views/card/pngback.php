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
			margin:0px;
			width:330px;
			background-color: #fff;
			transition: all .5s ease-in-out;
			position: relative;
			border: 0px solid transparent;
			border-radius: 8px;
			box-shadow: 0px 0px 13px 0px rgb(82 63 105 / 5%);
			overflow:hidden;
			height:450px;
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
		.xcard .card-head .avatar{
			width:241px;
			height:100px;
			display:block;
			margin: 20px auto 10px;
			border: 2px solid #0e0e0e21;
			border-radius: 0px;
			box-shadow: 0px 2px 4px 2px rgb(0 0 0 / 15%);
		}
		.qravatar{
			width: 123px;
			height: 123px;
			display: block;
			margin: 0px auto 20px;
			border: 0px solid #fff;
		}
		.xcard .card-head .avatar img{
			width:100%;
			height: 100%;
		}
		.xcard .card-body{
			padding:60px 5px 5px 5px;
			background:#fff; 
			 
		}
		.xcard.back .card-body{
			padding:60px 5px 5px 5px;
			background:#fff; 
			 
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
			font-weight:bold;
			font-size:14px;
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
			position: absolute;
			bottom: 0;
			width: 100%;
		}
		.xcard  .card-highlight p{
			font-size:10px;
			color:#fff;
			margin:0px;
		}
	</style>
 </head>
<body>  
<div class="card xcard back">
	<div class="card-head" style="height: 50px;">
		<div class="row">
			<div class="col-sm-6" style="width:50%;float:left;">
				<img style="width: 125px;margin-top: 5px;margin-left: 9px;" src="<?php echo base_url().'cardassets/cc-logo-white.png';?>" alt="user" />
			</div>
			<div class="col-sm-6" style="width:50%;float:right">
				<p style="margin-top: 4px; padding: 0px;  margin-bottom: 0px;"><a href="tel:18006469823"><img style="width: 140px;margin-top: 5px;margin-left: 9px;" src="<?php echo base_url().'cardassets/phone.png';?>" alt="user" /></a></p>
				<p style="margin: 0px; margin-top: -8px;"><a href="mailto:support@curaechoice.com"><img style="width: 140px;margin-top: 3px;margin-left: 7px;" src="<?php echo base_url().'cardassets/email.png';?>" alt="user" /></a></p>
			</div>
		</div> 
	</div>
	<div class="card-body" style="padding: 13px 8px 5px 8px;"> 
		<div class="user-data">
			<div class="row"> 
				<div class="col-sm-12">	
					<div class="avatar" style="text-align:center;z-index: 99;width:98%; display:block; margin: 0px auto; border: 2px solid #fff; border-radius: 6px; box-shadow:0px 2px 0px 4px rgb(0 0 0 / 35%);background:#fff;margin-bottom:15px;border-width: 2px; border-color:rgba(14,14,14, 0.25); border-style: solid;"> 
						<ul style="margin: 0px 5px 0px 0px;padding: 0px 10px 0px 10px; text-align: justify;list-style-type: none;color:#5a5a5a;">
							<li><strong style="font-weight:bold;font-size:16px;">Terms & Conditions</strong> </li>  
						</ul>
						<ul style="margin: 0px 5px 0px 0px;padding: 0px 10px 0px 10px; font-size:12px;text-align: justify;list-style-type: none;color:#5a5a5a;">
							<li><?php if(!empty($lineone->value)){ echo $lineone->value; }else{?>CuraeChoice is not health insurance. CuraeChoice is a benefit plan optimizer provider by and through your employer with No-Co-pay, Deductibles or Co-Insurance at participating providers<?php } ?></li> 
						</ul>
					</div>
				</div>	
				<div class="col-sm-12">	
					<div class="avatar" style="text-align:center;z-index: 99;width:98%;; display:block; margin: 0px auto; border: 2px solid #fff; border-radius: 6px; box-shadow: 0px 2px 0px 4px rgb(0 0 0 / 35%);background:#fff;margin-bottom:15px;border-width: 2px; border-color:rgba(14,14,14, 0.25); border-style: solid;">
						<ul style="margin: 0px 5px 0px 0px;padding: 10px; font-size:16px;text-align: justify;list-style-type: none;color:#5a5a5a;">
							<li><strong style="font-weight:bold;">Information for providers:</strong>
								<ul style="color:#5a5a5a;list-style-type: none;margin: 0px 5px 0px 0px;padding: 0px; font-size:12px;text-align: justify;">
									<?php if(!empty($linetwo->value)){ 
										echo $linetwo->value; 	
									}else{ ?>
									<li>Send electronics claims to payer ID CC304</li>
									<li>For eligibility verification sign up at <a href="mailto:providersupport@curaechoice.com" style="color:#5a5a5a;" target="_blank">providersupport@curaechoice.com</a></li>
									<?php } ?>
								</ul>
							</li>  
						</ul>
					</div>
				</div>		
			</div> 
			<div class="row"> 
				<div class="col-sm-12">	
					<div class="avatar" style="text-align:center;z-index: 99;width:98%;  display:block; margin: 0px auto; border: 2px solid #fff; border-radius: 6px; box-shadow:0px 2px 0px 4px rgb(0 0 0 / 35%);background:#fff;border-width: 2px; border-color:rgba(14,14,14, 0.25); border-style: solid;">
						<ul style="margin-top: 0px;padding: 10px;font-size:14px;color:#88bd23;list-style-type: none;text-align: justify;font-weight:bold;">
							<li><strong><?php if(!empty($linethree->value)){ echo $linethree->value; }else{ ?>The Right Choice, The Best Choice, The Only Choice, CuraeChoice.<?php } ?></strong></li> 
						</ul>
					</div>  
				</div> 
			</div> 
		</div> 
	</div>  
	<div class="card-highlight">
		 <?php if(!empty($providers)){ ?> 
			 
			<?php foreach($providers as $row){ ?>  
				<td align="left" valign="top" style="padding:5px 5px !important;">
					<?php  $mainURL = base_url(); ?>
					<a href="<?php echo $mainURL.$row->slug;?>" target="_blank"><img height="30" alt="curaechoice" src="<?php echo base_url();?>resources/admin/<?php echo $row->image;?>"></a>
				</td> 	 
			<?php }?>
			 
		<?php }?>
	</div>
</div>
</body>
</html>