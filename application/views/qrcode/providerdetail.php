<?php $this->load->view('qrcode/widgets/header'); ?> 
	<body class="detail provider">
	<style>
	.nav-tabs>li {
		float: left;
		margin-bottom: -1px;
	}
	.nav>li {
		position: relative;
		display: block;
	}
	.nav-tabs>li>a {
		margin-right: 2px;
		line-height: 1.42857143;
		border: 1px solid transparent;
		border-radius: 4px 4px 0 0;
		color: #fff;
	}
	.nav>li>a {
		position: relative;
		display: block;
		padding: 10px 15px;
	}
	.nav-tabs>li a.active, .nav-tabs>li>a.active:focus, .nav-tabs>li>a.active:hover {
		color: #555;
		cursor: default;
		background-color: #f4f6fc;
		border: 1px solid #ddd;
		border-bottom-color: transparent;
		border-radius: 20px 20px 0px 0px;
		font-weight: 600;
	}
	.provideriframe iframe {
		min-height: 940px !important;
	}
	.employeriframe iframe {
		min-height: 940px !important;
	}
	.employeeiframe iframe {
		min-height: 800px !important;
	} 
	ul.elementor-icon-list-items {
	  list-style-type: none;
	} 
	ul.elementor-icon-list-items li.elementor-icon-list-item {
	      display: inline-block;
		  width: 43%;
		  color: #fff;
	}
	.elementor-icon-list-text a,.elementor-icon-list-text a:focus,.elementor-icon-list-text a:hover{
		color: #fff;
	}
	
	.detail-left-wrap p.topheading{ 
		color: #000;
		font-size: 22px;
		font-weight: bold;
		line-height: 25px;
		text-align: center;
	}
	.detail-wrap .card a.comingsoonbtn {
		    border-radius: 14px 14px 0px 0px;
		font-size: 14px;
		line-height: 19px;
		font-weight: 600;
		padding: 4px;
		color: #777777;
		display: block;
		align-items: center; 
		border-bottom: 0px solid #2BABE3;
		width: 100%;
	}
	.detail-wrap .card.livedesign {
		border-radius: 14px; 
		border-bottom: 20px solid #2BABE3; 
		background:#2BABE3;
	}
	.detail-wrap .card.livedesign a {
		border-radius: 14px;
		font-size: 14px;
		line-height: 19px;
		font-weight: 600;
		padding: 4px;
		color: #777777;
		display: flex;
		align-items: center;
		border-bottom: 5px solid #92c4e9;
		width: 100%;
		background-color: #fff;
	}
	.detail-wrap .card a.comingsoonbtn {
		border-radius: 14px;
		font-size: 14px;
		line-height: 19px;
		font-weight: 600;
		padding: 4px;
		color: #000;
		display: block;
		align-items: center; 
		border-bottom: 5px solid #9d9ea0;
		width: 100%;
	}
	.detail-wrap .card a.comingsoonheading {
		border-radius: 0px 0px 14px 14px;
		font-size: 14px;
		line-height: 19px;
		font-weight: 600;
		padding: 4px;
		color: #000;
		background: #ecedf3;
		display: block;
		align-items: center; 
		border-bottom: 0px solid #b2b2b2;
		width: 100%;
		text-align: center;
		text-transform: uppercase;
	}
	.comingsoon{
		display:block;
		width:100%;
	}
	.ftco-section { 
		background: transparent;
		padding: 0;
		background-color: transparent;
	}
	.mt-50{
		margin-top:50px
	}
	.cominheading{
		border-radius: 5px;
		background: #ecedf3;
		width:auto;
		text-align: center;
		font-weight:600;
		color:#000;
	}
	</style>
	<section class="ftco-section">
		<div class="container"> 
			<div class="row d-flex <?php /* align-items-center */ ?> justify-content-center"> 
				<div class="col-md-5 col-lg-5">
					<div class="detail-wrap ">
						<div class="detail-left-wrap py-5">
						<p class="topheading">Click on a specialty button to view providers near you</p>
						</div>
						<div class="row"> 
							<?php  
								/* $query = $this->db->get( 'care_coordination' ); */
								$this->db->from('care_coordination' );
								$this->db->order_by("comingsoon", "asc");
								$this->db->where("comingsoon", "0");
								$query = $this->db->get(); 
								$result = $query->result();
								foreach( $result as $row ){
									?>
									<div class="col-sm-6 col-xs-6">
										<div class="card livedesign">
											<a href="javascript:void(0)" <?php if($row->comingsoon==0){ ?> onclick="return openlink(<?php echo $row->id;?>)" target="_blank" <?php } ?>  <?php if($row->comingsoon==1){?>style="background: gray;color:white;"<?php }?>>
												<img src="<?php echo base_url();?>resources/admin/<?php echo $row->image;?>" />
												<?php echo $row->linkname;?>  <?php if($row->comingsoon==1){echo '(Coming soon)';}?>
											</a>
										</div>
									</div>
							<?php   } ?> 
							<div class="col-sm-6 col-xs-6">
								<div class="card livedesign">
									<a href="mailto:support@curaechoice.com" target="">
										<img src="<?php echo base_url();?>resources/assets/images/emailsupport.png" style="width: 46px; height: 46px;" />
										Email Support
									</a>
								</div>
							</div> 
						</div>
						<?php 
						$this->db->from('care_coordination' );
						$this->db->order_by("comingsoon", "asc");
						$this->db->where("comingsoon", "1");
						$query = $this->db->get(); 
						$result = $query->result();
						?>
						<div class="row"> 
							<div class="col-sm-12 col-xs-12 mt-50">
								<p class="cominheading">Specialities Coming Soon</p>
							</div>
						
							<?php  
								/* $query = $this->db->get( 'care_coordination' ); */
								
								foreach( $result as $row ){
									?>
									<div class="col-sm-6 col-xs-6">
										<div class="card" style="display:block;background: #b2b2b2;">
											<div class="comingsoon">
											<a href="javascript:void(0)" class="comingsoonbtn" <?php if($row->comingsoon==0){ ?> onclick="return openlink(<?php echo $row->id;?>)" target="_blank" <?php } ?>  <?php if($row->comingsoon==1){?>style="background: #ecedf3;"<?php }?>>
												<img src="<?php echo base_url();?>resources/admin/<?php echo $row->image;?>" />
												<?php echo $row->linkname;?> 
											</a>
											</div>
											<div class="comingsoon">
											<a href="javascript:void(0)" class="comingsoonheading" <?php if($row->comingsoon==1){?>style="background:#b2b2b2;"<?php }?>> <?php if($row->comingsoon==1){echo 'Coming soon';}?>
											</a>
											</div>
										</div>
									</div>
							<?php   } ?> 
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-6">
					<div class="detail-left-wrap py-5" style="padding-left: 10px;padding-right: 0px;"> 
						<?php /* <div class="elementor-widget-container">
						  <ul class="elementor-icon-list-items">
							<li class="elementor-icon-list-item">
							  <span class="elementor-icon-list-icon">
								<i aria-hidden="true" class="fas fa-phone-alt"></i>
							  </span>
							  <span class="elementor-icon-list-text"><a href="tel:18006469823">(800) 646-9823</a></span>
							</li>
							<li class="elementor-icon-list-item">
							  <span class="elementor-icon-list-icon">
								<i aria-hidden="true" class="fas fa-envelope"></i>
							  </span>
							  <span class="elementor-icon-list-text"><a href="mailto:support@curaechoice.com">support@curaechoice.com</a></span>
							</li> 
						  </ul>
						</div> */ ?>
						<div class="tg-textwidget">
							 <div class="panel with-nav-tabs panel-default">
								<div class="panel-heading">
										<ul class="nav nav-tabs">
											<li><a  class="active" href="#tab1default" data-toggle="tab">Submit a Ticket</a></li>
											<?php /* <li><a href="#tab2default" data-toggle="tab">Employer</a></li>
											<li><a href="#tab3default" data-toggle="tab">Provider</a></li>  */ ?>
										</ul>
								</div>
								<div class="panel-body">
									<div class="tab-content">
										<div class="tab-pane fade in active show employeeiframe" id="tab1default"><script type="text/javascript" src="https://form.jotform.com/jsform/220026142783044"></script></div>
										<?php /* <div class="tab-pane fade employeriframe" id="tab2default"><script type="text/javascript" src="https://form.jotform.com/jsform/220026401788148"></script></div>
										<div class="tab-pane fade provideriframe" id="tab3default"><script type="text/javascript" src="https://form.jotform.com/jsform/220027130419139"></script></div> */ ?>
									</div>
								</div>
							</div>
						</div>
					
					</div> 
					<?php /* <div class="detail-left-wrap py-5"> 
						<img src="<?php echo base_url();?>resources/assets/images/curae-logo.svg" class="logo"/> 
						<h3 class="logo_text">Your Ally in Care Coordination</h3>
						<h1 class="hide-mobile">Welcome!</h1>
						<div class="sapp hide-mobile"></div>
						<p>Click on any specialty button to view the map of providers</p>
					</div> */ ?>
				</div>	
				
			</div>
		</div>
	</section>
	<div style="display:none;">
		<form method="post" id="linkform" action="<?php echo base_url();?>subscriptions/openlink">
			<input type="hidden" name="longitude" id="longitude" value="" />
			<input type="hidden" name="latitude" id="latitude" value="" />
			<input type="hidden" name="linktype" id="linktype" value="0" />
			<input type="hidden" name="phone" id="phone" value="<?php if($this->session->userdata('phone')){ echo $this->session->userdata('phone');}?>" /> 
		</form>
	</div>

<?php $this->load->view('qrcode/widgets/footer'); ?>

	<script type="text/javascript"> 
		var returned = true;
		function openlink(linkid){
			/* if(returned==false){
				 Swal.fire({
					title: 'CuraeChoiceCard',
					text: 'Please enable your location to view detail.',
					type: 'error'
				});
				return false;
			} */
			$('#linktype').val(linkid); 
			document.getElementById("linkform").submit();
			return false
		}
		 $(document).ready(function() {
			 navigator.permissions.query({
				 name: 'geolocation'
			 }).then(function(result) {
				 if (result.state == 'granted') {
					 report(result.state);
					  
					navigator.geolocation.getCurrentPosition(function (p) { 
						 $('#latitude').val(p.coords.latitude);
						 $('#longitude').val(p.coords.longitude);
					});
				 } else if (result.state == 'prompt') {
					 report(result.state);
					  

					 navigator.geolocation.getCurrentPosition(function (p) { 
						 $('#latitude').val(p.coords.latitude);
						 $('#longitude').val(p.coords.longitude);
					});
					returned = false;
				 } else if (result.state == 'denied') {
					 report(result.state);
					 returned = false;
				 }
				 result.onchange = function() {
					 report(result.state);
				 }
			 });  
		 });
	   </script>
	    
	</body>
</html> 