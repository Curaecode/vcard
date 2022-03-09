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
		.xcard {
			margin: 0px;
			width: 337px;
			background-image:url(<?php echo base_url();?>resources/img/format.png);
			transition: all .5s ease-in-out;
			position: relative;
			border: 0px solid transparent;
			border-radius: 53px;
			box-shadow: 0px 0px 13px 0px rgb(82 63 105 / 5%);
			overflow: hidden;
			height: 541px;
			float: left;
			margin-top: -8px;
		}
		.xcard .card-head{ 
			height:100px;
			width:100%; 
			margin-top: 110px;
		}
		.xcard .card-head .avatar{
			/* width:315px;
			height:100px; */
			display:block;
			margin: 20px auto 10px;
			text-align: center;			
		}
		.qravatar{
			width: 123px;
			height: 123px;
			display: block;
			margin: 0px auto 20px;
			border: 0px solid #fff;
		}
		.xcard .card-head .avatar img{
			/* width:100%;
			height: 100%;
			padding: 0px 2px 0px 0px;
			background: white; */
			/* width: 100%;
			height: 90%; */
			padding: 10px 2px 0px 0px;
			background: white;
		}
		.xcard .card-body{
			padding:60px 5px 5px 5px;
			/* background:#fff;  */
			 
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
<div class="card xcard front">
	<div class="card-head"> 
		<div class="avatar" style="">
			<img src="<?php echo base_url().'resources/admin/'.str_replace('_thumb.','.',$image->value);?>" alt="user" />
		</div>
	</div>
	<div class="card-body">
		<div class="card-heading">
			<?php if($showname->value==1){ ?>
			<h5 class="card-title"><?php echo ucwords($contact->first_name." ".$contact->last_name);?></h5> 
			<?php } ?>
			<?php $account_id=(!empty($contact->account_code)?$contact->account_code:''); ?>
			<p class="card-text"><?php echo $account_id;?></p>
		</div>
		<div class="user-data">
			<div class="row" style="width:100%;">
				<?php if($showdependent->value==1){ ?>
					<?php if(isset($dependent) && !empty($dependent)){?>
					<div class="col-sm-7" style="float:left;width: 58%;">	
						<dl class="row" style="margin-top: 10px;margin-left: 10px;">
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
				<?php if($showdependent->value==1 && isset($dependent) && !empty($dependent)){  $col='4'; }else{$col='12'; } ?>
				<div class="col-sm-<?php echo $col;?>"  <?php if($showdependent->value==1 && isset($dependent) && !empty($dependent)){ ?>style="float:left;width: 33%;" <?php } ?>>
					<div class="qravatar"><img src="<?php echo base_url().'resources/qrimage/'.$contact->qrimage;?>" alt="user" />
					<?php $date=date("M d, Y",strtotime($regdate->value));?>
					<p style="margin:0px 0px 0px 0px; font-size:12px; text-transform:uppercase; font-weight:600; line-height:23px; color:#ff0000; padding:5px 0px;text-align:center;"><?php echo $date;?></p>
					</div>
					
				</div> 
			</div> 
		</div> 
	</div>  
</div> 
</body>
</html>